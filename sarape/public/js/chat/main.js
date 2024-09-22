(function () {
    'use strict';

    /**
     * Socket IO
     */
    var socket = io(socketUrl);

    /**
     * AJAX
     */
    var Chat = axios.create({
        baseURL: baseUrl + 'chat'
    });

    /**
     * Nos permite renderizar un mensaje antes de ser enviado.
     * @type object
     */
    var Message = {
        men_id: null, // ID
        con_id: null, // Conversación
        usu_id: null, // Usuario
        arc_id: null, // Archivo adjunto
        men_mensaje: null, // Mensaje
        men_fecha: null
    };

    /**
     * Gestiona los mensajes del chat
     */
    window.ChatJS = Vue.extend({
        //el: '#chat',
        // ------------------------------------------------------------------
        // Datos
        // ------------------------------------------------------------------
        data: function () {
            return {
                // - - - - - - - - - - - - - - - - - - - - -
                // Estilos
                // - - - - - - - - - - - - - - - - - - - - -
                styles: {
                    cons: {
                        height: 'auto'
                    },
                    body: {
                        height: 'auto'
                    },
                    composer: {
                        height: 'auto'
                    }
                },
                // - - - - - - - - - - - - - - - - - - - - -
                // General
                // - - - -- - - - - - - - - - - - - - - - -
                baseUrl: this.baseUrl,

                // - - - - - - - - - - - - - - - - - - - - -
                // Estados
                // - - - - - - - - - - - - - - - - - - - - -
                states: {
                    isNew: false // TRUE: Si se escribirá un nuevo mensaje
                },

                // - - - - - - - - - - - - - - - - - - - - -
                // Socket
                // - - - - - - - - - - - - - - - - - - - - -
                channel: null, // Canal del chat

                // - - - - - - - - - - - - - - - - - - - - -
                // Proyecto
                // - - - - - - - - - - - - - - - - - - - - -
                isProject: false,
                proId: null,
                project: {},
                participants: [],

                // - - - - - - - - - - - - - - - - - - - - -
                // Archivos
                // - - - - - - - - - - - - - - - - - - - - -
                attachments: [],

                // - - - - - - - - - - - - - - - - - - - - -
                // Mensajes
                // - - - - - - - - - - - - - - - - - - - - -
                conversation: null, // Conversación actual
                sender: null, // Remitente
                recipient: null, // Destinatario

                conversations: [], // Conversaciones "anteriores"
                currentConIndex: 0, // Índice de la conversación actual
                messages: [], // Mensajes de la conversación
                message: null, // Contenido del mensaje

                attachment: null, // Archivo adjunto al mensaje
            }
        },
        // ------------------------------------------------------------------
        // Eventos del Socket
        // ------------------------------------------------------------------
        created: function () {

            // Al conectar al servidor
            socket.on('connect', this.onConnect);
        },
        // ------------------------------------------------------------------
        // Métodos
        // ------------------------------------------------------------------
        methods: {

            // - - - - - - - - - - - - - - - - - - - - -
            // Autocomplete
            // - - - - - - - - - - - - - - - - - - - - -

            /**
             * Initicializa el plugin de jQuery [autocomplete]
             */
            initAutocomplete: function () {
                var vm = this;

                // Buscar & auto-completar destinatarios
                $(this.$refs.autocomplete).autocomplete({
                    serviceUrl: this.baseUrl + 'chat/recipients',
                    paramName: 'q',
                    onSelect: function (selected) {
                        vm.setConversationTo(selected);
                    }
                });
            },

            /**
             * Nano Scroll plugin
             */
            scrollToEnd: function () {

                $(this.$refs.messages).each(function () {
                    var $body = $(this)
                        , boxHeight = $body.find('.chat-box').height();

                    setTimeout(function () {
                        $body.scrollTop(boxHeight)
                    }, 0);
                })
            },

            // - - - - - - - - - - - - - - - - - - - - -
            // Usuario
            // - - - - - - - - - - - - - - - - - - - - -

            /**
             * Obtener la url de una foto del usuario
             *
             * @param photo
             * @returns {string}
             */
            getUserPhoto: function (photo) {
                return this.baseUrl + 'images/fotos/' + photo;
            },

            // - - - - - - - - - - - - - - - - - - - - -
            // Conversación
            // - - - - - - - - - - - - - - - - - - - - -

            /**
             * Prepara los elementos para una nueva conversación
             */
            newConversation: function () {

                // Nueva conversación
                this.states.isNew = true;

                // Inicializar plugin
                this.$nextTick(function () {
                    this.initAutocomplete();
                });
            },

            /**
             * Establece el destinatario
             * @param to
             */
            setConversationTo: function (to) {
                var vm = this;

                // ID del destinatario
                this.recipient = to.data;

                // Obtener o generar una conversación...
                Chat.get('/single', {
                    params: {from: this.sender.usu_id, to: this.recipient.usu_id}
                }).then(function (res) {
                    vm.conversation = res.data;
                });
            },

            /**
             * Cambiar conversación
             * @param index
             */
            changeConversation: function (index) {

                // La misma
                if (index === this.currentConIndex)
                    return;

                // Context
                var vm = this;

                // Cambiar de conversación
                var conversation = vm.conversations[index];

                // Necesitamos cargar la conversación
                if (conversation.usuario === undefined)
                {
                    // Cargar conversación inicial
                    Chat.get('/conversation/' + conversation.con_id).then(function (res) {
                        vm.conversation = res.data;
                    });
                // Conversación previamente cargada
                } else {
                    vm.conversation = conversation;
                }

                // Cambiar current
                vm.currentConIndex = index;
            },

            // - - - - - - - - - - - - - - - - - - - - -
            // Funciones para los mensajes
            // - - - - - - - - - - - - - - - - - - - - -

            /**
             * Enviar un mensaje
             */
            sendMessage: function () {

                // Componer mensaje
                var data = {
                    men_id: null, // ID
                    con_id: this.conversation.con_id, // Conversación
                    usu_id: this.sender.usu_id, // Usuario
                    arc_id: null, // Archivo adjunto
                    usuario: this.sender,
                    men_mensaje: this.message, // Mensaje
                    men_fecha: new Date().toLocaleString()
                };

                // Mostrar el mensaje
                this.conversation.mensajes.push(data);

                // Scroll
                this.scrollToEnd();

                this.message = null;

                socket.emit('message', data);
            },

            /**
             * Adjuntar archivo
             * @param e
             */
            attachFile: function (e) {
                // click "falso" al input
                $(this.$refs.attachment).trigger('click');
            },

            /**
             * Enviar archivo por el chat
             * @param e
             */
            sendAttachment: function (e) {

                // Nada que subir
                if (e.target.files.length === 0)
                    return;

                var maxSize = 1024 * 1024 // 1MB TODO: Cambiar el límite
                    , file = e.target.files[0];

                if (file.size > maxSize)
                {
                    alertify.alert('Error al subir los archivos',
                        'El archivo que seleccionaste es demasiado grande. El tamaño máximo es de 1 MB.');

                    return;
                }

                // Pre-carga del archivo como mensaje
                var msg = {
                    men_id: null, // ID
                    con_id: this.conversation.con_id, // Conversación
                    usu_id: this.sender.usu_id, // Usuario
                    arc_id: -1, // Archivo adjunto
                    arc_url: null,
                    usuario: this.sender,
                    men_mensaje: file.name, // Mensaje
                    men_fecha: new Date().toLocaleString()
                };

                // Agregar como mensaje
                this.conversation.mensajes.push(msg);

                // Scroll
                this.scrollToEnd();

                // Preparar el archivo
                var data = new FormData();
                data.append('con_id', this.conversation.con_id);
                data.append('attachment', file);

                // Reiniciar input
                $(e.target).val('');

                //
                var vm = this;

                // Upload to attachments
                Chat.post('/attachment', data).then(function (res) {
                    msg.arc_id = res.data.arc_id;
                    msg.arc_url = '/archivos/download/' + msg.arc_id;

                    // Agregar a la lista
                    vm.attachments.push(res.data);

                    //
                    socket.emit('message', msg);
                });
            },

            /**
             * Generar URL del archivo adjunto
             *
             * @param arc_id
             * @returns {*}
             */
            getAttachUrl: function (arc_id) {
                return arc_id !== null && arc_id > 0 ? this.baseUrl + 'archivos/descargar/' + arc_id : null;
            },

            // - - - - - - - - - - - - - - - - - - - - -
            // Event Handlers
            // - - - - - - - - - - - - - - - - - - - - -

            /**
             * Cuando se conecta al servidor socket...
             */
            onConnect: function () {
                // Nothing
            },

            /**
             * Mostrar mensaje al ser recibido
             * @param msg
             */
            onMessage: function (msg) {
                // Fecha actual
                msg.men_fecha = new Date().toLocaleString();

                // Agregar el nuevo mensaje
                this.conversation.mensajes.push(msg);

                // Scroll
                this.scrollToEnd();
            },

            onResize: function () {
                // Global available height
                var height = getAvailableHeight();

                // Conversation list
                this.styles.cons.height = height + 'px';

                // Chat body
                this.styles.body.height = height;

                // Reduce by .chat-composer
                this.styles.body.height -= 49; // .chat-composer
                this.styles.body.height += 'px';

                // TODO: Calcular el alto del .chat-composer
            }
        },
        // ------------------------------------------------------------------
        // Mixed
        // ------------------------------------------------------------------
        mounted: function () {

            this.$nextTick(function () {
                // Cargar datos
                var vm = this;

                // Obtener información de la sesión actual
                Chat.get('/session', {
                    params: {
                        proId: vm.proId // ID del proyecto
                    }
                }).then(function (res) {
                    vm.conversations = res.data.conversations;
                    vm.sender = res.data.sender;
                    vm.project = res.data.project;
                    vm.participants = res.data.participants;
                    vm.attachments = res.data.attachments;

                    // Registrar el usuario
                    socket.emit('join', vm.sender);

                    // No hay conversaciones
                    if (vm.conversations.length === 0 && vm.proId === null) {
                        vm.newConversation();
                        return;
                    }

                    // Cargar conversación inicial
                    Chat.get('/conversacion/' + vm.conversations[0].con_id).then(function (res) {

                        vm.conversation = res.data;

                        // Scroll
                        setTimeout(vm.scrollToEnd, 100);
                    });
                });


                // on window resize
                this.onResize();

                // Add Events
                window.addEventListener('resize', _.debounce(this.onResize));
            });
        },
        /**
         * Escucha los cambios de los datos
         */
        watch: {

            /**
             * Al cambiar la conversación
             */
            conversation: function () {
                var vm = this;

                // Sockets
                socket.on('message.' + vm.conversation.con_id, vm.onMessage);
            }
        }
    });

    // -----------------------------------------------------------------------------
    // Helpers
    // -----------------------------------------------------------------------------
    function getAvailableHeight() {
        var body = document.body,
            html = document.documentElement;

        var height = Math.min( body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight, window.innerHeight );

        height = height < 400 ? 400 : height;

        // Reducir en base al diseño web
        height -= 86; // .nav_menu
        height -= 51; // .chat-top & chat-search
        height -= 45; // <footer>
        height -= 16; // <== no se de donde viene

        return height;
    }
})();