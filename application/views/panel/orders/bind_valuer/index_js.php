<script type="text/javascript">
    $(document).ready(function () {

        $(".add-to-order").click(function () {
            toggleLoader();
            $sendData = {
                'inputPersonId': $(this).data('person-id'),
                'inputOrderId': $("#inputOrderId").val()
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doBindValuer',
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

        $(document).on('click', '.edit-from-order', function () {
            toggleLoader();
            $sendData = {
                'inputRowId': $(this).data('id'),
                'inputValuerId': $(this).prev('select').val()
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doEditOrderValuer',
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
                    if ($result['success']) {
                        location.reload();
                    }
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


        $(document).on('click', '.delete-from-order', function () {
            $this = $(this);
            $title = "<strong class='badge'> " + $this.data('title') + " </strong>";
            $.confirm({
                title: '',
                content: 'آیا از حذف ' + $title + ' مطمئن هستید؟',
                buttons: {
                    specialKey: {
                        text: 'تایید',
                        btnClass: 'btn-blue',
                        action: function () {
                            toggleLoader();
                            $sendData = {
                                'inputRowId': $this.data('id')
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Orders/doDeleteOrderValuer',
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
                                    setTimeout(function () {
                                        if ($result['success']) {
                                            location.reload();
                                        }
                                    }, 1000);
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