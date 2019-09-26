(function () {


    $(document).ready(function() {

        $('#phoneClientForm').submit(function (e) {

            e.preventDefault();

            var url = $(this).attr('action');
            var data = $(this).serializeArray();

            $('#phoneForm').modal('hide');
            send(url,data);

            $('#addClientForm').trigger('reset');

        });




        function send(url,data) {

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
                    if(Array.isArray(e))
                    {
                        for(var i = 0;e.length > i;++i) {
                            if(e[i].type == 'success'){
                                toastr.success(e[i].status, 'Оповещение!', {"progressBar": true});
                            }
                            if(e[i].type == 'error'){
                                toastr.error(e[i].status, 'Оповещение!', {"progressBar": true});
                            }
                        }
                    }
                    else
                    {
                        if(e.type == 'success'){
                            toastr.success(e.status, 'Оповещение!', {"progressBar": true});
                        }
                        if(e.type === 'error'){
                            toastr.error(e.status, 'Оповещение!', {"progressBar": true});
                        }
                    }
                },
                error:function (e) {
                    alert('Произошла ошибка при передаче на сервер!');
                }
            });

        }

        var followUnfollowBlock = $('#follow-unfollow-block');

        getFollowUnfollowList();
        function getFollowUnfollowList(){
            $( "#dataFollowUnfollowSelect").on('change', function() {
                if(!!$(this).find(":selected").val()){
                    var date = $(this).find(":selected").val();
                    var url = $(this).attr('data-url');
                    sendFollowUnfollowList(url,date);
                }
            });
        }

        function sendFollowUnfollowList(url,date) {
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,             // указываем URL и
                data:{date:date},
                dataType : 'html',
                method:'POST',
                asyns:false,
                success: function (e) {
                    followUnfollowBlock.empty();
                    followUnfollowBlock.html(e);
                },
                error:function (e) {
                    toastr.error('Не удалось получить данные!', 'Оповещение!', {"progressBar": true});
                }
            });

        }



    })


})();
