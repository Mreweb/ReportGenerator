<script type="text/javascript">

    $(document).ready(function () {
        $("#addAbility").click(function () {
            $inputOrderId            = $.trim($("#inputOrderId").val());
            $inputModelId            = $.trim($("#inputModelId").val());
            $inputAbilityTitle       = $.trim($("#inputAbilityTitle").val());
            $inputLow                  = $.trim($("#inputLow").val());
            $inputHigh                 = $.trim($("#inputHigh").val());
            $inputMin                   = $.trim($("#inputMin").val());
            $inputLowEditRange  = $.trim($("#inputLowEditRange").val());
            $inputHighEditRange = $.trim($("#inputHighEditRange").val());
            $inputRandType         = $.trim($("#inputRandType").val());
            $inputIsAbilityBase     = $.trim($("#inputIsAbilityBase").val());

            if(parseFloat($inputLow) >= parseFloat($inputHigh)){
                notify('کمترین نمره باید از بیشترین نمره کوچکتر باشد', 'red');
                return false;
            }

            if(parseFloat($inputMin) > parseFloat($inputHigh)){
                notify('حداقل نمره باید عددی بین بیشترین نمره و کمترین نمره باشد', 'red');
                return false;
            }
            if(parseFloat($inputMin) <= parseFloat($inputLow)){
                notify('حداقل نمره باید عددی بین بیشترین نمره و کمترین نمره باشد', 'red');
                return false;
            }


            $inpuHighLowDistance = parseFloat($inputHigh) - parseFloat($inputLow);
            if(parseFloat($inputHighEditRange) > parseFloat($inpuHighLowDistance)){
                notify('حداکثر بازه تغییر باید کوچکتر از '+$inpuHighLowDistance+' باشد', 'red');
                return false;
            }
            if(parseFloat($inputLowEditRange) < (-1*parseFloat($inpuHighLowDistance))){
                notify('حداقل بازه تغییر باید بزرگتراز '+-1*$inpuHighLowDistance+' باشد', 'red');
                return false;
            }


            toggleLoader();
            $sendData = {
                'inputOrderId': $inputOrderId,
                'inputModelId': $inputModelId,
                'inputAbilityTitle': $inputAbilityTitle,
                'inputLow': $inputLow,
                'inputHigh': $inputHigh,
                'inputMin': $inputMin,
                'inputLowEditRange': $inputLowEditRange,
                'inputHighEditRange': $inputHighEditRange,
                'inputRandType': $inputRandType,
                'inputIsAbilityBase': $inputIsAbilityBase
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doAbilityAdd',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                    if($result['success'] == true){
                        reloadPage(3000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطای ارتباط با سرور', 'red');
                    toggleLoader();
                }
            });
        });
        $(document).on('click', '.remove', function () {
            $this = $(this);
            $title = "<strong class='badge'> " + $this.data('title') + " </strong>";
            $.confirm({
                title: '',
                content: 'آیا از حذف '+ $title +' مطمئن هستید؟',
                buttons: {
                    specialKey: {
                        text: 'تایید',
                        btnClass: 'btn-blue',
                        action: function () {
                            toggleLoader();
                            $sendData = {
                                'inputAbilityId': $this.data('id')
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Orders/doAbilityDelete',
                                data: $sendData,
                                success: function (data) {
                                    toggleLoader();
                                    $result = jQuery.parseJSON(data);
                                    iziToast.show({
                                        title: $result['content'],
                                        color: $result['type'],
                                        zindex: 9060,
                                        position: 'topLeft'
                                    });
                                    setTimeout(function(){
                                        if ($result['success']) {
                                            location.reload();
                                        }
                                    } , 1000);
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    iziToast.show({
                                        title: 'خطای ارتباط با سرور.دقایقی دیگر تلاش کنید',
                                        color: 'red',
                                        zindex: 9060,
                                        position: 'topLeft'
                                    });
                                    toggleLoader();
                                }
                            });
                        }
                    },
                    alphabet: {
                        text: 'انصراف',
                        action: function () {
                            //$.alert('A or B was pressed');
                        }
                    }
                }
            });
        });


        $( ".sortable" ).sortable({
            placeholder: "ui-state-highlight",
            update: function( event, ui ) {

                $abilitySort = [];
                $(".ability-row").each(function(){
                    $abilitySort.push($(this).data('ability-id'));
                });
                $sendData = {
                    'inputAbilitySort': $abilitySort,
                }
                $.ajax({
                    type: 'post',
                    url: base_url + 'Orders/doUpdateAbilitySort',
                    data: $sendData,
                    success: function (data) {
                        toggleLoader();
                        $result = jQuery.parseJSON(data);
                        notify($result['content'], $result['type']);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        notify('خطای ارتباط با سرور', 'red');
                        toggleLoader();
                    }
                });
            }
        });
        $( ".sortable" ).disableSelection();
    });
</script>