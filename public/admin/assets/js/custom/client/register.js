(function () {


$(document).ready(function() {

    $('#registerForm').submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        var form = $('#registerForm');
        registerSend(url,data);
    });


    function registerSend(url,data) {
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,             // указываем URL и
            data:data,
            dataType : 'json',
            method:'POST',
            asyns:false,
            success: function (e)
            {
                console.log(e);
                if(Array.isArray(e))
                {
                    for(var i = 0;e.length > i;++i) {
                        if(e[i].type == 'success'){
                            toastr.success(e[i].status, 'Оповещение!', {"progressBar": true});
                            $('#registerForm').trigger('reset');
                            setTimeout(function(){
                                document.location.href = 'http://www.datalytics.pro';
                            },3000);
                        }
                        if(e[i].type == 'error'){
                            toastr.error(e[i].status, 'Оповещение!', {"progressBar": true});
                        }
                        if(e[i].type == 'info'){
                            toastr.info(e[i].status, 'Оповещение!', {"progressBar": true});
                        }
                    }
                }
                else
                {
                    if(e.type == 'success'){
                        toastr.success(e.status, 'Оповещение!', {"progressBar": true});
                        $('#registerForm').trigger('reset');
                        setTimeout(function(){
                            document.location.href = 'http://www.datalytics.pro';
                        },3000);
                    }
                    if(e.type ==='error'){
                        toastr.error(e.status, 'Оповещение!', {"progressBar": true});
                    }
                    if(e.type == 'info'){
                        toastr.info(e.status, 'Оповещение!', {"progressBar": true});
                    }
                }

            },
            error:function (e) {
                alert('Произошла ошибка при передаче данных на сервер!');
            }
            });
        }
    }
)})();
