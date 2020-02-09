<?php

namespace src\App;
use Illuminate\Database\Capsule\Manager as Capsule,
    \src\App\Config as Config;

class Application
{
    public $router;

    public function __construct($router)
    {
        $this->router = $router;
    }
    
    public function initialize()
    {
        $capsule = new Capsule;
        $config = Config::getInstance();
        $config->get('php_config');
        $capsule->addconnection($config->get('db'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        session_start();
    }

    public function renderException(\Exception $e)
    {
        if ($e instanceof Renderable) {
            $e->render();
        } else {
            if ($e->getCode() !== 0) {
                $errorCode = $e->getCode();
            } else {
                $errorCode = 500;
            }
            include VIEW_DIR . 'header.php';
            $format = '<div class="container">Возникла ошибка: %s Код ошибки - %d</div>';
            echo '
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        ' . sprintf($format, $e->getMessage(), $errorCode) . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ';
            include VIEW_DIR . 'footer.php';
        }
    }

    public function run()
    {
        try {
            echo $this->router->dispatch();
        } catch (\Exception $e) {
            $this->renderException($e);
        }
    }
}
