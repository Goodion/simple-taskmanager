<?php

namespace view;

use \src\App\Renderable as Renderable;

class View implements Renderable
{
    public function __construct($path, $callback)
    {
        $this->path = str_replace('.', '/', $path);
        $this->file = VIEW_DIR . str_replace('\\', '/', $this->path) . '.php';
        $this->params = $callback;
        $this->header = VIEW_DIR . 'header.php';
        $this->footer = VIEW_DIR . 'footer.php';
    }

    public function checkPermissions()
    {
        if (isset($this->params['permissions'])) {
            if (! isset($_SESSION['permissions']) || $_SESSION['permissions'] < $this->params['permissions']) {
                header("Location: /authentication?error=У вас нет доступа к данной странице.");
            }
        }
    }

    public function render()
    {
        $this->checkPermissions();
        include $this->header;
        include $this->file;
        include $this->footer;
    }
}
