/* После полной загрузки DOM - получение списка сообщений и постраничный вывод*/
$(document).ready(function () {
    $(".page").each(function (index, element) {
        $(element).click(function (event) {
            event.preventDefault();
            var form = $("#feedback-list");
            var result = $("#feedback-list-result", form);
            var loader = $("#feedback-list-loader", form);
            var errorResult = $(".alert-danger", form);
            $("input[name='page']", form).val($(this).data("page"));
            $.ajax({
                type: "POST",
                url: $(form).attr("action"),
                data: $(form).serialize(),
                beforeSend: function () {
                    $(errorResult).addClass("hide");
                    $(loader).removeClass("hide");
                    $(result).empty();
                },
                complete: function() {
                    $(loader).addClass("hide");
                },
                success: function(data, textStatus, jqXHR) {
                    var message;
                    for(var index in jqXHR.responseJSON.messages) {
                        message = jqXHR.responseJSON.messages[index];
                        $(result).append(
                            "<dt>#"+message.id+") "+message.name+", "+message.email+" in "+message.createdAt+"</dt>" +
                            "<dd>"+message.message+"</dd>"
                        )
                    }
                    $(result).removeClass("hide");
                },
                error: function (jqXHR) {
                    var error;
                    try {
                        error = jqXHR.responseJSON.error;
                    } catch (e) {
                        error = jqXHR.responseText;
                    }
                    $(errorResult).removeClass("hide").text(error);
                },
            });
        });
        // При загрузке страницы вызвать загрузку первной страницы по клику.
        if (0 === index) {
            $(element).click();
        }
    });
});
