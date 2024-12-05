<?php

class Validate
{

    use File ;

    public $data;
    public static $files ;
    public $errors = [];

    public function __construct($data ,$files)
    {
        $this->data = $data ;
        self::$files = $files ;
    }

    public function validate()
    {
        $this->checkName($this->data['username']);
        $this->checkEmail($this->data['email']);
        $this->checkFile(static::$files);

        return $this->errors;
    }

    public function checkName(string $username)
    {
        $name = self::clean($username);
        $pattern = "/^[a-zA-Z]{5,10}$/";

        if (empty($name)) {
            $this->errors['username'] = 'username can`t be empty';
        } elseif (!preg_match($pattern, $name)) {
            $this->errors['username'] = 'chars must be larger than 5 chars';
        }
    }

    public function checkEmail(string $email)
    {
        $mail = self::clean($email);
        if (empty($email)) {
            $this->errors['email'] = 'email can`t be empty';
        } elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'wrong email type';
        }
    }

    public static function clean($data)
    {
        $clean = trim($data);
        $clean = htmlspecialchars($clean);

        return $clean;
    }
}
