(function () {


    $(document).ready(function() {

        $('.mask-card-number').mask('9999 9999 9999 9999');

        var table;

        table = $('.base-configuration').DataTable({
            "pageLength": 30,
            'lengthMenu': [ [30,14,7], [30,14,7] ],
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
                { type: 'date-eu', targets: 0 }
            ],"aoColumns": [
                {"sType": "date-eu"},
                null,
                null
            ],
            "order": [[ 0, "desc" ]]

        });



    });


    jQuery.extend( jQuery.fn.dataTableExt.oSort, {
        "date-eu-pre": function ( date ) {
            date = date.replace(" ", "");

            if ( ! date ) {
                return 0;
            }

            var year;
            var eu_date = date.split(/[\.\-\/]/);

            /*year (optional)*/
            if ( eu_date[2] ) {
                year = eu_date[2];
            }
            else {
                year = 0;
            }

            /*month*/
            var month = eu_date[1];
            if ( month.length == 1 ) {
                month = 0+month;
            }

            /*day*/
            var day = eu_date[0];
            if ( day.length == 1 ) {
                day = 0+day;
            }

            return (year + month + day) * 1;
        },

        "date-eu-asc": function ( a, b ) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },

        "date-eu-desc": function ( a, b ) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
    } );

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