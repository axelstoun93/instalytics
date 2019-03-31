(function () {


    $(document).ready(function() {

        $('.mask-card-number').mask('9999 9999 9999 9999');

        var table;

        table = $('.base-configuration').DataTable({
            "pageLength": 40,
            'lengthMenu': [ [40], [40] ],
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
            columnDefs: [
                {
                    targets: -1,
                    className: 'dt-body-right'
                }
            ],

        });



    });

    window.addEventListener('load', function () {
        var clipboard = new ClipboardJS('#pay-copy');

        clipboard.on('success', function(e) {
            toastr.success('Номер карты успешно скопирован в буфер!', 'Оповещение!', {"progressBar": true});
        });

        clipboard.on('error', function(e) {
            toastr.error('Произошла ошибка при копировании номера карты!', 'Оповещение!', {"progressBar": true});
        });
    })

})();