(function () {



    var table;

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
        },

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

})();