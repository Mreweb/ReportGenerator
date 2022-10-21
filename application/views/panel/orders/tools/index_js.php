<script type="text/javascript">
    $(document).ready(function () {

        $("#inputToolType").change(function () {
            if ($(this).val() === 'Normal') {
                $(".tool-other").addClass('hidden');
                $(".tool-common").removeClass('hidden');
                $(".tool-other-file").addClass('hidden');

                $fileAddress = $(".tool-common-select option:selected").data('common-file');
                $("#inputToolCommonDescriptionFile").val($fileAddress);
            } else {
                $(".tool-other").removeClass('hidden');
                $(".tool-common").addClass('hidden');
                $(".tool-other-file").removeClass('hidden');
            }
        });
        $(".tool-common-select").change(function () {
            $fileAddress = $(".tool-common-select option:selected").data('common-file');
            $("#inputToolCommonDescriptionFile").val($fileAddress);
        });
        $("#inputToolType").change();

        $("#addTools").click(function () {
            $fileSrc = "";

            if ($("#inputToolType").val() !== 'Normal') {
                var form_data = new FormData();
                form_data.append("file", document.getElementById('inputDescriptionFile').files[0]);
                $.ajax({
                    url: base_url + 'Home/uploadFile',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (data) {
                        $result = JSON.parse(data);
                        if ($result['fileSrc'] === '') {
                            $fileSrc = 'NONE';
                        }
                        $fileSrc = $result['fileSrc'];

                        $inputToolTitle = ""
                        if ($("#inputToolType").val() === 'Normal') {
                            $inputToolTitle = $.trim($(".tool-common-select").val());
                        } else {
                            $inputToolTitle = $.trim($("#inputToolTitle").val());
                        }

                        $inputToolType = $.trim($("#inputToolType").val());
                        $inputOrderId = $.trim($("#inputOrderId").val());
                        toggleLoader();
                        $sendData = {
                            'inputToolTitle': $inputToolTitle,
                            'inputToolGuideFile': $fileSrc,
                            'inputToolType': $inputToolType,
                            'inputOrderId': $inputOrderId
                        }
                        $.ajax({
                            type: 'post',
                            url: base_url + 'Orders/doToolsAdd',
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


                    },
                    error: function (data) {
                        $result = JSON.parse(data);
                        notify($result['content'], $result['type']);
                        return false;
                    }
                });
            }
            else{
                $fileSrc = $("#inputToolCommonDescriptionFile").val();
                $inputToolTitle = ""
                if ($("#inputToolType").val() === 'Normal') {
                    $inputToolTitle = $.trim($(".tool-common-select").val());
                }
                else {
                    $inputToolTitle = $.trim($("#inputToolTitle").val());
                }
                $inputToolType = $.trim($("#inputToolType").val());
                $inputOrderId = $.trim($("#inputOrderId").val());
                toggleLoader();
                $sendData = {
                    'inputToolTitle': $inputToolTitle,
                    'inputToolGuideFile': $fileSrc,
                    'inputToolType': $inputToolType,
                    'inputOrderId': $inputOrderId
                }
                $.ajax({
                    type: 'post',
                    url: base_url + 'Orders/doToolsAdd',
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
            }


        });

        $(document).on('click', '.remove', function () {
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
                                'inputToolId': $this.data('id')
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Orders/doToolsDelete',
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