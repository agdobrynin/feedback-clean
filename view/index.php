<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Демо страница с Feedback формой</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/assests/js/app.js"></script>
</head>
<body>

<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="/">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav ">
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="col-md-12">

        <p>Задача простая, но обратите внимание на безопасность и оформление кода. Важно использовать комментарии, правильное именование переменных и т.д.</p>
        <ol>
            <li>Сделать форму обратной связи! На чистом PHP, Mysql, Jquery</li>
            <li>Создать таблицу MySQL в которой будут храниться оставленные данные и дата заявки.</li>
            <li>Сверстать страницу, на которой размещена форма (поля ввода (имя, email, текст сообщения) и кнопка).</li>
        </ol>
        <p>Пользователь вводит имя и в бд создается запись с данными и датой добавления.</p>
        <p>Форма исчезает вместо нее появляется надпись "Спасибо, {имя}"</p>
        <p>Необходимо фильтровать вводимые данные (проверка корректности вводимых данных, защита от взлома и ботов и т.д.) и обрабатывать ошибку.</p>

        <form action="/store" method="post" id="feedback-form">
            <h3>Отправить сообщение</h3>
            <?php print $csrf->getCsrfFiled();?>
            <div class="form-group">
                <label>Имя</label>
                <input type="text" class="form-control" required name="name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" required name="email">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Сообщение</label>
                <textarea name="message" class="form-control"rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-default">Добавить отзыв</button>
        </form>
        <p>&nbsp;</p>
        <div class="hide alert alert-success"></div>
        <div class="hide alert alert-danger"></div>

    </div>
</div>

    <p>&nbsp;</p>
<footer class="footer">
    <div class="container panel panel-default">
        <div class="panel-body">
            &copy; Тестовое задание.
        </div>
    </div>
</footer>
</body>
</html>
