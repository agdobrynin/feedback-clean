/* Функция обновления значения для CSRF защиты форм */
$(document).ajaxComplete(function( event, xhr, settings ) {
    if ("POST" === settings.type.toUpperCase()) {
        // Имя поля CSRF должно совпадать с тем что задается в настройках backend класса Core/Csrf.php
        $("input[type='hidden'][name='Csrf-Token']").val(xhr.getResponseHeader('Csrf-Token'));
    }
});
/**
 * Простой шаблонизатор.
 * @param tpl Шаблон
 * @param data переменные заключенные в пару <%имя-переменной%>
 */
var TemplateEngine = function(tpl, data) {
    var re = /<%([^%>]+)?%>/g, match;
    while(match = re.exec(tpl)) {
        tpl = tpl.replace(match[0], data[match[1]])
    }

    return tpl;
}