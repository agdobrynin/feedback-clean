/* После полной загрузки DOM */
$(document).ready(function () {
    /* Отправка Feedback формы на backend и обработка результата */
    $("#feedback-form").submit(function (event) {
        event.preventDefault();
        var form = event.target;
        $.ajax({
            type: "POST",
            url: form.action,
            data: $(form).serialize(),
            beforeSend: function () {
                $(".alert-success, .alert-danger").addClass("hide");
                $("button", form).attr("disabled", "disabled");
            },
            complete: function() {
                $("button", form).removeAttr("disabled");
            },
            success: function(data, textStatus, jqXHR) {
                var success;
                try {
                    success = jqXHR.responseJSON.success;
                } catch (e) {
                    success = jqXHR.responseText;
                }
                // Показать ответ
                $(".alert-success").removeClass("hide").text(success);
                // скрыть форму
                $(form).addClass("hide");
            },
            error: function (jqXHR) {
                var error;
                try {
                    error = jqXHR.responseJSON.error;
                } catch (e) {
                    error = jqXHR.responseText;
                }
                $(".alert-danger").removeClass("hide").text(error);
            },
        });
    });
});
