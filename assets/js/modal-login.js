function submitMyModalForm(form, formdata)
{
    var formAction = form.attr('action');
    var baseUrl = $('#base-url').html();
    formdata = formdata ? formdata : form.serialize();
    
    $.ajax({
        url         : formAction,
        datatype    : 'json',
        data        : formdata ? formdata : form.serialize(),
        cache       : false,
        contentType : false,
        processData : false,
        type        : 'POST',
        success     : function(data, textStatus, jqXHR) {
            if ((typeof data.success !== 'undefined') && (data.success == true)) {
                loginSuccess(data);
                $('#modalContent').html('');
                $('#modal-window').modal('hide');
                return false;
            } else {
                var formId = '#'+form.attr('id');
                var selection = false;
                if ($(formId + ' .error-summary')[0]) {
                    selection = formId + ' .error-summary';
                    $(selection).show();
                    $(selection + ' ul').empty();
                } else if ($(formId + ' .alert-danger')[0]) {
                    selection = formId + ' .alert-danger';
                    $(selection).show();
                    $(selection + ' ul').empty();
                }
                if (selection) {
                    for (const [key, values] of Object.entries(data)) {
                        for (var i = values.length - 1; i >= 0; i--) {
                            $(selection + ' ul').append('<li>'+values[i]+'</li>');
                        }
                    }
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("server error when submitMyModalForm");
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

$(".modal-form").click(function(e)
{
    e.preventDefault();

    $("#modalContent").load($(this).attr("url"));
    $(".modal-title").html($(this).attr("for"));

    $('#modal-window').on('show.bs.modal', function (e) {
        setTimeout(function() {
            var formId = $('#login-form-id').html();
            $('#' + formId).on('beforeSubmit', function(e) {
                var form = $(this);
                var formdata = false;
                if (window.FormData){
                    formdata = new FormData(form[0]);
                }

                submitMyModalForm(form, formdata);
                return false;
            }).on('submit', function(e) {
                e.preventDefault();
                return false;
            });
        }, 500);
    });
    $('#modal-window').modal();
});

function loginSuccess(data)
{
    var event = new CustomEvent('onLoginSuccess', {
        detail: data
    });
    document.dispatchEvent(event);
}