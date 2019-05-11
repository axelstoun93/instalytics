<div class="modal fade text-left" id="phoneForm" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel33">Укажите ваш номер телефона</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('clientSetting.addPhone')}}" id="phoneClientForm" method="post">
                {{csrf_field()}}
                <div class="modal-body">
                    <label>Телефон: </label>
                    <div class="form-group">
                        <input type="text" name="phone" id="editPhone" value="" placeholder="7 (000) 000-00-00" class="phone form-control">
                    </div>
                    <p>Мы информируем посредством SMS сообщений своих клиентов. Вы в праве отказаться от любой формы информирования по окончанию сотрудничества с нами или в процессе работы в разделе <a href="{{route('clientSetting')}}"> привязки номера телефона</a>.</p>
                    <p>Нажимая кнопку "Далее" вы даете свое согласие на <a href="{{route('police')}}">обработку персональных данных</a>.</p>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="закрыть">
                    <input type="submit" class="btn btn-outline-primary btn-lg" value="Далее">
                </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    $('document').ready(function () {
        $(".phone").mask("+ 0 (000) 000-00-00");
        $("#phoneForm").modal('show');
    });
</script>