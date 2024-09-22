<?php

use Phalcon\Cli\Task;
use Workerman\Worker;
use PHPSocketIO\SocketIO;

class MainTask extends Task
{
     /**
     * @var array Usuarios conectados
     */
    protected static $users = [];

    public function mainAction()
    {
        $io = new SocketIO($this->config->socket->port);

        $io->on('connection', function ($socket) use ($io) {
            /**
             * Registra nuevo usuario en el chat
             */
            $socket->on('join', function ($user) use ($socket) {

                MainTask::log($user['usu_nombre'] . ' se ha conectado.');

                // Asignar usuario
                if (isset(MainTask::$users[$user['usu_id']])) {
                    MainTask::$users[$user['usu_id']]['sockets'][] = $socket->id;
                } else {
                    MainTask::$users[$user['usu_id']] = $user;
                    MainTask::$users[$user['usu_id']]['sockets'][] = $socket->id;
                }
            });

            $socket->on('message', function ($data) use ($io, $socket) {

                // Conversación
                $conversation = Conversacion::findFirst($data['con_id']);
                if ( ! $conversation) {
                    MainTask::log('No se pudo guardar el mensaje');
                }

                // Registrar nuevo mensaje
                $msg = new Mensaje();
                $msg->con_id = $conversation->con_id;
                $msg->usu_id = $data['usu_id'];
                $msg->arc_id = $data['arc_id'];
                $msg->men_mensaje = $data['men_mensaje'];
                $msg->save();

                // Debug
                MainTask::log($msg->men_mensaje);

                // Enviar al destinatario / destinatarios
                $recipients = [];
                if (is_null($conversation->pro_id))
                {
                    $recipient_id = $conversation->con_destinatario_id == $msg->usu_id ? $conversation->con_remitente_id : $conversation->con_destinatario_id;

                    MainTask::log("Dest: " . $recipient_id);

                    $recipients[] = $recipient_id;
                }
                else
                {
                    $team = $conversation->Proyecto->Equipo;
                    foreach ($team as $usu) {
                        if ($msg->usu_id !== $usu->Usuario->usu_id)
                            $recipients[] = $usu->Usuario->usu_id;
                    }
                }

                // Preparar mensaje
                $message = $msg->toArray();
                $message['usuario'] = $msg->Usuario->toArray();

                // Enviar a todos los destinatarios
                if (count($recipients) > 0) {

                    foreach ($recipients as $recipient_id) {

                        if (isset(MainTask::$users[$recipient_id])) {

                            MainTask::log("Sockets: " . count(MainTask::$users[$recipient_id]['sockets']));

                            // Enviar en todos los chats conectados
                            foreach (MainTask::$users[$recipient_id]['sockets'] as $socket_id)
                            {
                                if (isset($io->sockets->connected[$socket_id]))
                                {
                                    $io->sockets->connected[$socket_id]->emit('message.' . $conversation->con_id, $message);
                                }
                            }
                        }
                    }
                }

            });

            $socket->on('disconnect', function () use ($socket) {

                $deleteId = null;
                foreach (MainTask::$users as $user_id => $user) {
                    foreach ($user['sockets'] as $socket_id) {
                        if ($socket_id == $socket->id) {
                            $deleteId = $user_id;
                            break;
                        }
                    }

                    if ($deleteId !== null)
                        break;
                }

                if ($deleteId) {
                    $name = MainTask::$users[$deleteId]['usu_nombre'];
                    unset(MainTask::$users[$deleteId]);
                    MainTask::log($name . ' se ha desconectado');
                }
            });
        });

        Worker::runAll();
    }

    /**
     * Mostrar un mensaje en la consola
     *
     * @param $msg
     */
    public static function log($msg)
    {
        echo $msg.PHP_EOL;
    }
}