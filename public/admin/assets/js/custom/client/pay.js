(function () {

    $(document).ready(function() {
        calculationAmount();
        function calculationAmount(){

            var paymentType = $(this).find(":selected").val();
            var sumInput = $('#sumId');
            var defaultSum = 500;
            var commissionPC = 0.005;
            var commissionAC = 0.02;
            var readySum = '';


            $( "#paySelect").on('change', function() {

                if(!!$(this).find(":selected").val()){
                    var paymentType = $(this).find(":selected").val();

                    if(paymentType === 'PC'){
                        readySum =  Math.ceil(defaultSum + defaultSum * (commissionPC / (1 + commissionPC)));
                        sumInput.val(readySum);
                    }

                    if(paymentType === 'AC'){
                        readySum =  Math.ceil(defaultSum + defaultSum * (commissionAC / (1 + commissionAC)));
                        sumInput.val(readySum);
                    }

                }



            });
        }
    })

})();
