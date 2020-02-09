<?php

use \src\Model\Task as Task;

$tasks = Task::all();
$currentPageValue = 1;
$sortDirection = 'asc';
$sortDirectionToggle = 'asc';
$ValueToSort = 'name';

if ($tasks->isNotEmpty()) {
    $tasksPerPage = 3;
    if (isset($_GET['sortDirection']) && isset($_GET['ValueToSort'])) {
        $ValueToSort = $_GET['ValueToSort'];
        $sortDirection = $_GET['sortDirection'];
        $sortDirectionToggle = $sortDirectionToggle === $sortDirection ? 'desc': 'asc';
    }
    $tasksSorted = $sortDirection === 'asc' ? $tasks->sortBy($ValueToSort) : $tasks->sortByDesc($ValueToSort);
    $tasksSortedChunked = $tasksSorted->chunk($tasksPerPage);
    $pagesQuantity = $tasksSortedChunked->count();

    if (isset($_GET['page'])) {
        $currentPageValue = intval($_GET['page']);
        if ($currentPageValue <= 0) {
            $currentPageValue = 1;
        } else if ($currentPageValue > $pagesQuantity) {
            $currentPageValue = $pagesQuantity;
        }
    }
} else {
    header("Location: /addTask?error=Задач не найдено. Для начала работы создайте новую.");
}

$currentPageTasks = $tasksSortedChunked[$currentPageValue - 1];

?>

<div class="container">
    <? if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=$_GET['success']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <? endif; ?>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="/?page=<?= $currentPageValue ?>&sortDirection=<?= $sortDirectionToggle ?>&ValueToSort=name">По имени пользователя</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="/?page=<?= $currentPageValue ?>&sortDirection=<?= $sortDirectionToggle ?>&ValueToSort=email">По email</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="/?page=<?= $currentPageValue ?>&sortDirection=<?= $sortDirectionToggle ?>&ValueToSort=completed">По статусу</a>
        </li>
    </ul>
    <main role="main" class="container">
        <div class="row">
            <div class="col-md blog-main">
                <div>
                    <? foreach ($currentPageTasks as $task): ?>
                        <div>
                            <h2 class="blog-post-title"><?=$task->name?></h2>
                            <p>Email: <?=$task->email?></p>
                            <p><?=$task->body?></p>
                            <p><?=$task->getStatus()?></p>
                            <? if (isset($_SESSION['permissions'])): ?>
                                <a href="/editTask/<?=$task->id?>" class="badge badge-secondary">Редактировать</a>
                                <? if ($task->completed === 0): ?>
                                    <a href="/setTaskDone/<?=$task->id?>" class="badge badge-secondary">Отметить выполненной</a>
                                <? endif; ?>
                            <? endif; ?>
                            <hr>
                        </div>
                    <? endforeach; ?>
                </div>
                <? if ($pagesQuantity > 1): ?>
                    <nav class="blog-pagination">
                        <? for ($pageNumber = 1; $pageNumber <= $pagesQuantity; $pageNumber++): ?>
                            <span class="blog-Task">
                                <a href="/?page=<?=$pageNumber?>&sortDirection=<?= $sortDirection ?>&ValueToSort=<?= $ValueToSort ?>"><?=$pageNumber?></a>
                            </span>
                        <? endfor; ?>
                    </nav>
                <? endif; ?>
            </div>
        </div>
    </main>
</div>