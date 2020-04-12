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
            if (data.success == true) {
                loginSuccess(data);
                $('#modalContent').html('');
                $('#modal-window').modal('hide');
                return false;
            } else {
                var formId = '#'+form.attr('id');
                $(formId + ' .alert-danger').show();
                $(formId + ' .alert-danger ul').empty();
                for (const [key, values] of Object.entries(data.errors)) {
                    for (var i = values.length - 1; i >= 0; i--) {
                        $(formId + ' .alert-danger ul').append('<li>'+values[i]+'</li>');
                    }
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('error');
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