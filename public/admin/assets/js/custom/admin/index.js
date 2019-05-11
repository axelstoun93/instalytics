(function () {

    $('.date').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'ru'
    });

    var table;

    var selectButton;
    var url;
    var selectTr;
    var nameBlock;
    var currentDate;
    var date;

    table = $('.base-configuration').DataTable({
        "pageLength": 100,
        'lengthMenu': [ [100, 200,300,-1], [100,200,300, 'Все'] ],
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
        },"aoColumns": [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            {"sType": "date-uk"},
            null
        ]

    });


    $(document).ready(function() {
        sortLogic();
    });


    function sortLogic() {

        $('.hiddenBots').click(function() {
            if($(".hiddenBots").is(':checked')){
                $('.base-configuration tr').each(function (i,element) {
                    if($(element).hasClass('bg-bots')){
                        $(element).hide();
                    }
                });
            }else{
                $('.base-configuration tr').each(function (i,element) {
                    if($(element).hasClass('bg-bots')){
                        $(element).show();
                    }
                });
            }
        });

    }

    categorySelectLogic();
    function categorySelectLogic() {
        $( "#categorySelect").on('change', function() {
            if(!!$(this).find(":selected").val()){
                window.location.replace($(this).find(":selected").val());
            }
        });
    }


    editDayClient();
    function editDayClient(){
        $(document).on("click", ".edit-day-button", function(){
            $('#editDay').modal('show');

            selectButton = $(this);
            url = $(this).data('url');

            currentDate = $(this).data('edit-date');
            selectTr = $(this).parents('tr')[0];
            nameBlock = $('#editDate');
            date = $(selectTr).find('.td-date');

            $('#editDayForm').trigger('reset');
            nameBlock.attr('value',currentDate);
        });

        $('#editDayForm').submit(function (e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            $('#editDay').modal('hide');
            sendEditDayPay(url,data);
        });
    }


    function sendEditDayPay(url,data) {

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
                    console.log(e);
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
                console.log(e);

                alert('Произошла ошибка при передаче на сервер!');
            }
        });

    }




})();