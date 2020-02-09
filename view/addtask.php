<div class="container">
    <? if (isset($_GET['error'])): ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <?=$_GET['error']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <? endif; ?>
    <div class="py-5 text-center">
        <h2>Добавление задачи</h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form class="needs-validation" action="/publishTask" method="post">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="name">Имя пользователя</label>
                        <input type="text" class="form-control" id="name" placeholder="Введите имя" name="name">
                        <div class="invalid-feedback">
                            Имя пользователя обязательно!
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Введите email" name="email">
                        <div class="invalid-feedback">
                            Почта пользователя обязательна!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="inputArea">Текст задачи</label>
                        <textarea id="inputArea" rows="10" name="body" style="width:100%"></textarea>
                    </div>
                </div>
                <hr class="mb-3">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
</div>