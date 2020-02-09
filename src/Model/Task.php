<?php

namespace src\Model;
use Illuminate\Database\Eloquent\Model as Model;

class Task extends Model
{
    private $name;
    private $email;
    private $body;
    private $status;
    private $id;

    protected $table = 'tasks';
    public $timestamps = false;

    public function setName($name)
    {
        $name = trim($name);
        $name = htmlspecialchars($name);
        $this->name = $name;
    }

    public function emailValidate($email)
    {
        $email = trim($email);
        $email = htmlspecialchars($email);
        if (preg_match('/[а-яА-ЯёЁ]/', $email)) {
            return false;
        } else if (! strripos($email, '@')) {
            return false;
        } else if (! strripos($email, '.') || strripos($email, '.') < strripos($email, '@')) {
            return false;
        } else {
            return true;
        }
    }

    public function setEmail($email)
    {
       $this->email = $email;
    }

    public function setBody($body)
    {
        $body = trim($body);
        $body = htmlspecialchars($body);
        $this->body = $body;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getStatus()
    {
        $this->status = $this->edited === 0 ? '' : 'Отредактировано администратором. ';
        $this->status .= $this->completed === 0 ? '' : 'Выполнено. ';
        return $this->status;
    }
}
