<div class="container">
    <? if (isset($_GET['error'])): ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <?=$_GET['error']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <? endif; ?>
    <form class="form-signin" method="post" action="/authenticate">
        <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
        <label for="inputLogin" class="sr-only">Логин</label>
        <input type="login" id="inputLogin" class="form-control" placeholder="Логин" required autofocus name="login">
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required name="password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Авторизоваться</button>
    </form>
</div>