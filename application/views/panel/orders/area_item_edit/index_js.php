<script type="text/javascript">
    $(document).ready(function () {
        $("#edit").click(function () {
            $inputFATId         = $.trim($("#inputFATId").val());
            $inputFATTitle           = $.trim($("#inputFATTitle").val());
            toggleLoader();
            $sendData = {
                'inputFATId': $inputFATId,
                'inputFATTitle': $inputFATTitle
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doEditAreaItem',
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