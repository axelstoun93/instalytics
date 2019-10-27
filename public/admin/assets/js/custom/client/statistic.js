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
    });


    $('#accountFollowersButton').click(function (e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        accountCheckSend(url);
    });


    function accountCheckSend(url) {

        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,             // указываем URL и
            data:{},
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
                        if(e[i].type == 'info'){
                            toastr.info(e[i].status, 'Оповещение!', {"progressBar": true});
                        }
                    }
                }
                else
                {
                    if(e.type == 'success'){
                        toastr.success(e.status, 'Оповещение!', {"progressBar": true});
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
                alert('Произошла ошибка при передаче на сервер!');
            }
        });

    }

})();
