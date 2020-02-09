<?php

use src\Model\Task as Task;

$task = new Task();

if (isset($this->params['id'])) {
    if (isset($_SESSION['permissions']) && $_SESSION['permissions'] >= $this->params['permissions']) {
        $body = $task->where('id', $this->params['id'])->value('body');
    } else {
        throw new \Exception('У Вас нет доступа к данной операции.');
    }
}

if (isset($_POST['body'])) {
    if (strcmp($_POST['body'], $body) !== 0) {
        $task->where('id', $this->params['id'])->update(['body' => $_POST['body']]);
        $task->where('id', $this->params['id'])->update(['edited' => 1]);
        header("Location: /?success='Запись обновлена'");
    }
}

?>

<div class="container">
    <div class="py-4 text-center">
        <h2>Редактирование задачи #<?= $this->params['id'] ?></h2>
    </div>
    <form method="post" action="/saveEditedTask/<?= $this->params['id'] ?>">
        <div class="form-group">
            <textarea id="editTask" class="form-control" rows="10" name="body" style="width:100%"><?= $body ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block"">Сохранить</button>
    </form>
</div>