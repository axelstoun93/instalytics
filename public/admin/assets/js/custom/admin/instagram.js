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


       var base = $('.base-configuration').DataTable({
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

        base.column(1).data().sum();

    });




    $(document).ready(function() {
        sortLogic();
        categorySelectLogic();

        var followUnfollowBlock = $('#follow-unfollow-block');


        function categorySelectLogic() {
            $( "#categorySelect").on('change', function() {
                if(!!$(this).find(":selected").val()){
                    window.location.replace($(this).find(":selected").val());
                }
            });}


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



        $('#accountFollowersButton').click(function (e) {
            e.preventDefault();
            var instagramId = $(this).attr('data-instagram-id');
            var url = $(this).attr('data-url');
            accountCheckSend(url,instagramId);

        });


        function accountCheckSend(url,id) {

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,             // указываем URL и
                data:{instagramId:id},
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
