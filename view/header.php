<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Task Manager</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/view/blog.css" rel="stylesheet">
    <link href="/view/signin.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="btn btn-sm btn-outline-secondary" href="/addTask">Добавить задачу</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="/">Task Manager</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <?php if (isset($_SESSION['permissions'])): ?>
                        <a class="btn btn-sm btn-outline-secondary" href="/logout">Выйти</a>
                    <?php else: ?>
                        <a class="btn btn-sm btn-outline-secondary" href="/authentication">Войти</a>
                    <?php endif; ?>
                </div>
            </div>
        </header>
    </div>
