<?php

class RemoteControlAPI {

    private $rpcUrl;
    private $user;
    private $password;

    public function __construct($rpcUrl, $user, $password) {
        $this->rpcUrl = $rpcUrl;
        $this->user = $user;
        $this->password = $password;
    }

    public function getSessionKey() {
        $data = array(
            'jsonrpc' => '2.0',
            'method' => 'get_session_key',
            'params' => array($this->user, $this->password),
            'id' => 1
        );

        return $this->performJsonRpcRequest($data);
    }

    public function listSurveys($sessionKey) {
        $data = array(
            'jsonrpc' => '2.0',
            'method' => 'list_surveys',
            'params' => array($sessionKey),
            'id' => 2
        );

        return $this->performJsonRpcRequest($data);
    }

    public function getSummaryOfSurvey($sSessionKey, $iSurveyID) {
        $data = array(
            'jsonrpc' => '2.0',
            'method' => 'get_summary',
            'params' => array($sSessionKey, $iSurveyID),
            'id' => 3
        );

        return $this->performJsonRpcRequest($data);
    }
    
    public function exportResponses(
        $sSessionKey,
        $iSurveyID,
        $sDocumentType,
        $sLanguageCode = null,
        $sCompletionStatus = 'all',
        $sHeadingType = 'code',
        $sResponseType = 'short',
        $iFromResponseID = null,
        $iToResponseID = null,
        $aFields = null
    ) {
        $data = array(
            'jsonrpc' => '2.0',
            'method' => 'export_responses',
            'params' => array(
                $sSessionKey,
                $iSurveyID,
                $sDocumentType,
                $sLanguageCode,
                $sCompletionStatus,
                $sHeadingType,
                $sResponseType,
                $iFromResponseID,
                $iToResponseID,
                $aFields
            ),
            'id' => 4
        );
    
        return $this->performJsonRpcRequest($data);
    }

    public function getQuestionsAnswers($sSessionKey, $iSurveyID) {
        $data = array(
            'jsonrpc' => '2.0',
            'method' => 'export_responses_s',
            'params' => array($sSessionKey, $iSurveyID),
            'id' => 3
        );

        return $this->performJsonRpcRequest($data);
    }
    

    private function performJsonRpcRequest($data) {
        $headers = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-type: application/json\r\n" ,
                'content' => json_encode($data)
            )
        );
        error_log(print_r($data));
        $context = stream_context_create($headers);
        $result = file_get_contents($this->rpcUrl, false, $context);

        if ($result === FALSE) {
            echo 'Error al realizar la solicitud JSON-RPC con file_get_contents';
        }

        return json_decode($result, true);
    }

    
}
