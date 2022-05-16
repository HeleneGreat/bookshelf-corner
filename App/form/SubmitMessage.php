<?php

namespace Projet\Forms;

class SubmitMessage
{

    private string $code;
    private string $message;

    function __construct(string $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    function getCode()
    {
        return $this->code;
    }

    function getMessage()
    {
        return $this->message;
    }

    function formatedMessage()
    {
        return [
            "code" => $this->getCode(),
            "message" => $this->getMessage()
        ];
    }

}