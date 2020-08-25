/* Фнкция обновления значения для CSRF защиты форм */
$(document).ajaxComplete(function( event, xhr, settings ) {
    if ("POST" === settings.type.toUpperCase()) {
        // Имя поля CSRF должно совпадать с тем что задается в настройках backend класса Core/Csrf.php
        $("input[type='hidden'][name='Csrf-Token']").val(xhr.getResponseHeader('Csrf-Token'));
    }
});
