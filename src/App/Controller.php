<?php

namespace src\App;

use \src\Model\Task as Task;

class Controller
{
    private static function checkPermissions($permissions)
    {
        if (! isset($_SESSION['permissions']) || $_SESSION['permissions'] !== 1) {
            throw new \Exception('У Вас нет доступа к данной операции.');
        }
    }

    public static function authenticate()
    {
        if ($_POST['login'] !== '' && $_POST['password'] !== '') {
            if ($_POST['login'] === 'admin') {
                if ($_POST['password'] === '123') {
                    $_SESSION['permissions'] = 1;
                    header('Location: /?success=Успешно авторизован');
                } else {
                    throw new \Exception('Неправильный пароль.');
                }

            } else {
                throw new \Exception('Пользователя с таким логином не существует.');
            }

        } else {
            throw new \Exception('Не все поля заполнены.');
        }
    }

    public static function logout()
    {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        header('Location: /?success=Вы вышли из аккаунта');
    }

    public static function publishTask()
    {
        $task = new Task();


        if ($_POST['email'] !== '' && $task->emailValidate($_POST['email'])) {
            if ($_POST['name'] !== '') {
                if ($_POST['body'] !== '') {
                    $task->setName($_POST['name']);
                    $task->setEmail($_POST['email']);
                    $task->setBody($_POST['body']);
                    $task->insert(
                        ['name' => $task->getName(), 'email' => $task->getEmail(), 'body' => $task->getBody()]
                    );
                    header('Location: /?success=Задача успешно опубликована');
                } else {
                    throw new \Exception('Не введена задача.');
                }
            } else {
                throw new \Exception('Не введено имя.');
            }
        } else {
            throw new \Exception('Неверно введен email.');
        }
    }

    public static function setTaskDone($id, $permissions)
    {
        self::checkPermissions($permissions);

        $task = new Task();
        $task->where('id', $id)->update(['completed' => 1]);
        header("Location: /?success=Задача отмечена как выполненная");
    }
}
