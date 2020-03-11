<?php


class authorizationExeptions extends Exception {

    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString():String {
        $dirError = "../simple-php-vk-auth/error";
        $error = "[Exception]: возникла ошибка:";
        $error = "Время:".date("H:i:s");
        $error .= "\r\n[Exception]: текст: {$this->getMessage()}";
        $error .= "\r\n[Exception]: код ошибки: {$this->getCode()}";
        $error .= "\r\n[Exception]: файл: {$this->getFile()}:{$this->getLine()}";
        $error .= "\r\n[Exception]: путь ошибки: {$this->getTraceAsString()}\r\n";
        if (!is_dir($dirError))
            mkdir($dirError);
        $file = fopen($dirError.'/error_log' . date('d-m-Y_h') . ".log", 'a');
        fwrite($file, $error);
        fclose($file);
        return $error;
    }
}
?>