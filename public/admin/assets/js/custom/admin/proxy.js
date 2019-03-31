(function () {



    var table;
    var url;
    var selectTr;

    var nameBlock;
    var name;

    table = $('.base-configuration').DataTable({
        "language": {
            "processing": "Подождите...",
            "search": "Поиск:",
            "lengthMenu": "Показать _MENU_ записей",
            "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
            "infoEmpty": "Записи с 0 до 0 из 0 записей",
            "infoFiltered": "(отфильтровано из _MAX_ записей)",
            "infoPostFix": "",
            "loadingRecords": "Загрузка записей...",
            "zeroRecords": "Записи отсутствуют.",
            "emptyTable": "В таблице отсутствуют данные",
            "paginate": {
                "first": "Первая",
                "previous": "Предыдущая",
                "next": "Следующая",
                "last": "Последняя"
            },
            "aria": {
                "sortAscending": ": активировать для сортировки столбца по возрастанию",
                "sortDescending": ": активировать для сортировки столбца по убыванию"
            }
        }
    });




    $('#addProxyForm').submit(function (e) {
        e.preventDefault();

        var url = $(this).attr('action');
        var data = $(this).serializeArray();

        $('#addForm').modal('hide');
        send(url,data);
        $(this).trigger('reset');

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
                        var data = jQuery.parseJSON( e.data );
                        addRow(data);
                    }
                    if(e.type ==='error'){
                        toastr.error(e.status, 'Оповещение!', {"progressBar": true});
                    }
                }
            },
            error:function (e) {
                alert('Произошла ошибка при передаче на сервер!');
            }
        });

    }



    function curlDelete(url) {

        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,             // указываем URL и
            dataType : 'json',
            method:'DELETE',
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
                        selectTr.remove().draw()
                    }
                    if(e.type ==='error'){
                        toastr.error(e.status, 'Оповещение!', {"progressBar": true});
                    }
                }
            },
            error:function (e) {
                alert('Произошла ошибка при передаче на сервер!');
            }
        });

    }


    function addRow(data) {

        var tr =   table.row.add( [
            data.name,
            data.password,
            data.ip,
            data.port,
            'Активен',
            data.html
        ]).draw().node();

        $(tr).addClass("bg-success");

      /*  $(tr).find('td').eq(3).addClass('phone');
        $(tr).find('td').eq(4).addClass('td-date');
        $(tr).find('td').eq(5).addClass('center');*/


    }


    statusProxy();

    function statusProxy(){
        $(document).on("click", ".status-button", function(){
            url = $(this).data('url');
            selectTr = $(this).parents('tr')[0];
            curlStatus(url);
        });


    }

    function curlStatus(url) {

        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,             // указываем URL и
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
                        var statusTd = $(selectTr).find('td').eq(4);
                        $(selectTr).removeClass('bg-warning').addClass('bg-success');
                        $(statusTd).empty().text('Активен');
                    }
                    if(e.type ==='error'){
                        toastr.error(e.status, 'Оповещение!', {"progressBar": true});
                        var statusTd = $(selectTr).find('td').eq(4);
                        $(selectTr).removeClass('bg-success').addClass('bg-warning');
                        $(statusTd).empty().text('Не активен');
                    }
                }
            },
            error:function (e) {
                alert('Произошла ошибка при передаче на сервер!');
            }
        });

    }





    deleteProxy();
    function deleteProxy() {
        $(document).on("click", ".remove-button", function(){

            name = $(this).data('login');
            nameBlock = $('#remove-name');

            nameBlock.empty();
            nameBlock.text(name);

            selectTr = table.row($(this).parents('tr')[0]);
            url = $(this).data('url');

            $('#removeModal').modal('show');
        });

        $('.remove-yes').click(function () {
            curlDelete(url);
            $('#removeModal').modal('hide');
        })

    }

})();