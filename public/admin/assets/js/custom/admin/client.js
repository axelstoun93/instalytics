(function () {


    $(".phone").mask("+ 0 (000) 000-00-00");
    $('.date').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'ru'
    });

    var table;
    var id;
    var url;
    var name;
    var nameBlock;
    var date;
    var selectTr;
    var currentDate;
    var promotion;
    var bots;
    var category;

    var selectButton;


        var table;
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
                "aoColumns": [
                    null,
                    null,
                    null,
                    null,
                    {"sType": "date-uk"},
                    null
                ],
                "order": [[ 4, "asc" ]]
            });
        });




    jQuery.extend( jQuery.fn.dataTableExt.oSort, {
        "date-uk-pre": function ( a ) {
            var ukDatea = a.split('/');
            return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
        },

        "date-uk-asc": function ( a, b ) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },

        "date-uk-desc": function ( a, b ) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
    } );










    $('#addClientForm').submit(function (e) {

    e.preventDefault();

    var url = $(this).attr('action');
    var data = $(this).serializeArray();

    $('#addForm').modal('hide');
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
            data.account.login,
            data.account.old_login,
            data.phone,
            data.date,
            data.html
        ]).draw().node();

        $(tr).find('td').eq(3).addClass('phone');
        $(tr).find('td').eq(4).addClass('td-date');
        $(tr).find('td').eq(5).addClass('center');
        $(".phone").mask("+ 0 (000) 000-00-00");

    }

    editClient();
    function editClient(){

        $('.edit-button').click(function(){

            $('#editForm').modal('show');
            name = $(this).data('login');
            url = $(this).data('url');
            nameBlock = $('#editLogin');
            selectButton = $(this);
            promotion = parseInt($(this).attr('data-promotion'));
            category =  parseInt($(this).attr('data-category'));
            bots = parseInt($(this).attr('data-bots'));

            selectTr = $(this).parents('tr')[0];
            var password = $('#editPassword');

            $('#editPromotion').find('option:selected').removeAttr("selected");
            $('#editCategory').find('option:selected').removeAttr("selected");
            $('#editBots').find('option:selected').removeAttr("selected");



            $('#editClientForm').trigger('reset');
            $("#editPromotion option[value='"+promotion+"']").attr("selected", "selected");
            $("#editCategory option[value='"+category+"']").attr("selected", "selected");
            $("#editBots option[value='"+bots+"']").attr("selected", "selected");
            nameBlock.attr('value',name);


        });

        $('#editClientForm').submit(function (e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            $('#editForm').modal('hide');
            sendUpdate(url,data);
        });
    }

    payClient();

    function payClient(){
        $(document).on("click", ".pay-button", function(){
            $('#payForm').modal('show');

            selectButton = $(this);
            url = $(this).data('url');

            currentDate = $(this).data('date');
            selectTr = $(this).parents('tr')[0];
            nameBlock = $('#payDate');
            date = $(selectTr).find('.td-date');
            $('#payClientForm').trigger('reset');
            nameBlock.attr('value',currentDate);
        });

        $('#payClientForm').submit(function (e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            $('#payForm').modal('hide');
            sendUpdatePay(url,data);
        });
    }

    function sendUpdate(url,data) {

        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,             // указываем URL и
            data:data,
            dataType : 'json',
            method:'PUT',
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
                        if($(selectTr).hasClass('promotion')){
                            $(selectTr).removeClass('promotion');
                            $(selectTr).addClass('no-promotion');
                            $(selectButton).attr('data-promotion',0);
                            sortLogic();
                        }else{
                            $(selectTr).removeClass('no-promotion');
                            $(selectTr).addClass('promotion');
                            $(selectButton).attr('data-promotion',1);
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




    function sendUpdatePay(url,data) {

        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,             // указываем URL и
            data:data,
            dataType : 'json',
            method:'PUT',
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
                        selectButton.data('date',data[1].value);
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


    deleteClient();
    function deleteClient() {
        $(document).on("click", ".remove-button", function(){

           selectTr = table.row($(this).parents('tr')[0]);
           id = $(this).data('id');
           url = $(this).data('url');
           name = $(this).data('login');
           nameBlock = $('#remove-name');

            nameBlock.empty();
            nameBlock.text(name);

            $('#removeModal').modal('show');
        });

        $('.remove-yes').click(function () {
            curlDelete(url);
            $('#removeModal').modal('hide');
        })

    }

    $(document).ready(function() {
        sortLogic();
    });

    function sortLogic() {


        $('.hiddenAccount').click(function() {
            if($(".hiddenAccount").is(':checked')){
                $('.base-configuration tr').each(function (i,element) {
                    if($(element).hasClass('no-promotion')){
                        $(element).hide();
                    }
                });
            }else{
                $('.base-configuration tr').each(function (i,element) {
                    if($(element).hasClass('no-promotion')){
                        $(element).show();
                    }
                });
            }
        });

        $('.hiddenData').click(function() {
            if($(".hiddenData").is(':checked')){
                $('.base-configuration tr').each(function (i,element) {
                    if($(element).hasClass('bg-warning')){
                        $(element).hide();
                    }
                });

            }else{
                $('.base-configuration tr').each(function (i,element) {
                    if($(element).hasClass('bg-warning')){
                        $(element).show();
                    }
                });
            }
        });


    }

})();