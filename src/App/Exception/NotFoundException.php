<?php

namespace src\App\Exception;
use \src\App\Renderable as Renderable,
    \src\App\Exception\HttpException as HttpException;

class NotFoundException extends HttpException implements Renderable
{
    public function render()
    {
        include VIEW_DIR . 'header.php';
        $format = '<div class="container">Возникла ошибка: %s Код ошибки - %d</div>';
        echo '
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    ' . sprintf($format, $this->getMessage(), $this->getCode()) . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        include VIEW_DIR . 'footer.php';
    }
}
