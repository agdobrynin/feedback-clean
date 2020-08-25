<?php require_once 'header.php'?>
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

<script src="/assests/js/saveFeedback.js"></script>
<?php require_once 'footer.php'?>