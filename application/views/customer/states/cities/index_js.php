<?php $ci =& get_instance(); ?>
<script type="text/javascript">
    $items = <?php echo $ci->config->item('defaultPageSize'); ?>;
    $itemsOnPage = <?php echo $ci->config->item('defaultPageSize'); ?>;
    $selectedPage = 1;
    $totalResultCount = 0;
    $hasPagination = false;
    $(document).ready(function(){


        $("#addStateCity").click(function () {
            $inputStateId = $.trim($("#inputStateId").val());
            $inputCityName = $.trim($("#inputCityName").val());
            /* Validation */
            if (hasNumber($inputCityName)) {
                notify('عنوان شهرستان نامعتبر است', 'red');
                return false;
            }
            /* End Validation */
            toggleLoader();
            $sendData = {
                'inputStateId': $inputStateId,
                'inputCityName': $inputCityName
            }
            $.ajax({
                type: 'post',
                url: base_url + 'States/doAddStateCity',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                    setTimeout(function(){
                        if ($result['success']) {
                            location.reload();
                        }
                    } , 1000);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('اطلاعات استان تکراری ست', 'red');
                    toggleLoader();
                }
            });
        });

        $(document).on('click', '.remove-city', function () {
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
                                'inputCityId': $this.data('id'),
                                'inputStateId': $this.data('state-id'),
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'States/doDeleteStateCity',
                                data: $sendData,
                                success: function (data) {
                                    toggleLoader();
                                    $result = jQuery.parseJSON(data);
                                    notify($result['content'], $result['type']);
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
        })

        $(".edit-city").focusout(function(){
            toggleLoader();
            $sendData = {
                'inputCityId': $(this).data('id'),
                'inputCityName': $(this).text()
            }
            $.ajax({
                type: 'post',
                url: base_url + 'States/doEditStateCity',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
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
        });

    });
</script>