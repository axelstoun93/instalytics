(function () {


    var table;

    var selectButton;
    var url;
    var selectTr;
    var nameBlock;
    var currentDate;
    var date;


    $('#publicDate').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'ru'
    });



    $(document).ready( function () {
        table = $('.base-configuration').DataTable({
            "pageLength": 1000,
            'lengthMenu': [ [100, 500,1000,-1], [100,300,1000, 'Все'] ],
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
                },
            },
            "order": [[ 3, "desc" ]]
        });
    });






    publicDayClient();
    function publicDayClient(){
        $(document).on("click", ".public-day-button", function(){
            $('#publicDay').modal('show');

            selectButton = $(this);
            url = $(this).data('url');

            currentDate = $(this).data('public-date');
            selectTr = $(this).parents('tr')[0];
            nameBlock = $('#publicDate');
            date = $(selectTr).find('.td-date');

            $('#publicDayForm').trigger('reset');
            nameBlock.attr('value',currentDate);
        });

        $('#publicDayForm').submit(function (e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            $('#publicDay').modal('hide');
            sendPublicDay(url,data);
        });
    }


    function sendPublicDay(url,data) {

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
                        var newData = jQuery.parseJSON(e.data);
                        date.text(newData.date);
                        selectButton.data('edit-date',data[1].value);
                        if($(selectTr).hasClass('bg-warning')){
                            $(selectTr).removeClass('bg-warning');
                            $(selectTr).addClass('bg-white');
                            sortLogic();
                        }else{
                            $(selectTr).removeClass('bg-warning');
                            $(selectTr).addClass('bg-white');
                            sortLogic();
                        }
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


})();