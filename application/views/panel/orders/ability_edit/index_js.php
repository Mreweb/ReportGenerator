<script type="text/javascript">
    $(document).ready(function () {
        $("#editAbility").click(function () {
            $inputAbilityId           = $.trim($("#inputAbilityId").val());
            $inputAbilityTitle      = $.trim($("#inputAbilityTitle").val());
            $inputLow               = $.trim($("#inputLow").val());
            $inputHigh              = $.trim($("#inputHigh").val());
            $inputMin               = $.trim($("#inputMin").val());
            $inputLowEditRange      = $.trim($("#inputLowEditRange").val());
            $inputHighEditRange     = $.trim($("#inputHighEditRange").val());
            $inputRandType          = $.trim($("#inputRandType").val());

            if(parseInt($inputLow) >= parseInt($inputHigh)){
                notify('کمترین نمره باید از بیشترین نمره کوچکتر باشد', 'red');
                return false;
            }

            if(parseInt($inputMin) > parseInt($inputHigh)){
                notify('حداقل نمره باید عددی بین بیشترین نمره و کمترین نمره باشد', 'red');
                return false;
            }
            if(parseInt($inputMin) <= parseInt($inputLow)){
                notify('حداقل نمره باید عددی بین بیشترین نمره و کمترین نمره باشد', 'red');
                return false;
            }


            $inpuHighLowDistance = parseInt($inputHigh) - parseInt($inputLow);
            if(parseInt($inputHighEditRange) > parseInt($inpuHighLowDistance)){
                notify('حداکثر بازه تغییر باید کوچکتر از '+$inpuHighLowDistance+' باشد', 'red');
                return false;
            }
            if(parseInt($inputLowEditRange) < (-1*parseInt($inpuHighLowDistance))){
                notify('حداقل بازه تغییر باید بزرگتراز '+-1*$inpuHighLowDistance+' باشد', 'red');
                return false;
            }
            toggleLoader();
            $sendData = {
                'inputAbilityId': $inputAbilityId,
                'inputAbilityTitle': $inputAbilityTitle,
                'inputLow': $inputLow,
                'inputHigh': $inputHigh,
                'inputMin': $inputMin,
                'inputLowEditRange': $inputLowEditRange,
                'inputHighEditRange': $inputHighEditRange,
                'inputRandType': $inputRandType
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doAbilityEdit',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                    reloadPage(3000);
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
    });
</script>