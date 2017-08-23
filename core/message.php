<?php

namespace App;

class Message
{


    public static function getMessage()
    {
        $msg = $_SESSION['message'];
        unset($_SESSION['message']);
        if ($msg['type']) {
            return "<div class ='message bad' >{$msg['message']}</div>";
        } else {
            return "<div class ='message good' >{$msg['message']}</div>";
        }
    }

    public static function setMessage($message = '', $type = 0)
    {
        $msg = ['type' => $type, 'message' => $message];
        $_SESSION['message'] = $msg;
    }

}