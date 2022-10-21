<script type="text/javascript">
    $(document).ready(function () {
        $("#addOrderPlanTime").click(function () {
            $inputOrderPlanId          = $.trim($("#inputOrderPlanId").val());
            $inputTimeFrom             = $.trim($("#inputTimeFrom").val());
            $inputTimeTo      = $.trim($("#inputTimeTo").val());
            toggleLoader();
            $sendData = {
                'inputOrderPlanId': $inputOrderPlanId,
                'inputTimeFrom': $inputTimeFrom,
                'inputTimeTo': $inputTimeTo
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doOrderPlanTimeAdd',
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
                                'inputTimeId': $this.data('id')
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Orders/doOrderPlanTimeDelete',
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
        $(document).on('keypress', '.time-edit', function (e) {
            $this= $(this);
            if(e.which === 13){
                toggleLoader();
                $sendData = {
                    'inputTimeId': $this.data('time-id'),
                    'inputTimeType': $this.data('time-type'),
                    'inputTimeContent': $this.text()
                }
                $.ajax({
                    type: 'post',
                    url: base_url + 'Orders/doOrderPlanTimeEdit',
                    data: $sendData,
                    success: function (data) {
                        toggleLoader();
                        $result = jQuery.parseJSON(data);
                        notify($result['content'], $result['type']);
                        $this.blur();
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
                return false;
            }
        });
    });
</script>