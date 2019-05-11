(function () {


    $(document).ready(function () {
        $('.all-instagram-account').DataTable({
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
            }
        });


       var test = $('.base-configuration').DataTable({
            "pageLength": 30,
            'lengthMenu': [ [7,14,30,40], [7,14,30,40] ],
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
            "order": [[ 0, "desc" ]],
           drawCallback: function () {
               var api = this.api();
               $('.growth-data').html(api.column(1, {page:'current'}).data().sum());
           }

        });


       test.column(1).data().sum();


        $('.base-configuration-client').DataTable({
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
                { type: 'date-eu', targets: 0 }
            ],"aoColumns": [
                {"sType": "date-eu"},
                null,
                null
            ],
            "order": [[ 0, "asc" ]]

        });

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
        });}



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


    jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
        return this.flatten().reduce( function ( a, b ) {
            if ( typeof a === 'string' ) {
                a = a.replace(/[^\d.-]/g, '') * 1;
            }
            if ( typeof b === 'string' ) {
                b = b.replace(/[^\d.-]/g, '') * 1;
            }

            return a + b;
        }, 0 );
    } );

})();