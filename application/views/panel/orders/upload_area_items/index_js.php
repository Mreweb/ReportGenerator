<script type="text/javascript">
    $(document).ready(function () {

        $inputAttachmentSource = "";
        function readURL(input) {
            if (input.files && input.files[0] && input.files[0].name.match(/\.(xlsx)$/)) {
                $FileSize = input.files[0].size / 1024 / 1024;
                if ($FileSize < 8) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) { var file = e.target.result; };
                        reader.readAsDataURL(input.files[0]);
                        var file_data = input.files[0];
                        var form_data = new FormData();
                        form_data.append('file',file_data);
                        form_data.append('inputAreaId',$("#inputAreaId").val());
                        form_data.append("inputCSRF", $.trim($("#inputCSRF").attr('content')));
                        toggleLoader();
                        $.ajax({
                            url: base_url + 'Orders/doUploadItems',
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function (data) {
                                $result = JSON.parse(data);
                                notify($result['content'], $result['type']);
                                toggleLoader();
                                location.reload();
                            },
                            error: function (data) {
                            }
                        });
                    }
                }
                else {
                    notify("فایل شما باید کمتر از هشت مگابایت باشد", "red");
                }
            }
            else {
                notify("فرمت فایل نامعتبر است", "red");
            }
        }
        $("#file").change(function () {
            readURL(this);
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
                                'inputFATId': $this.data('id')
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Orders/doDeleteAreaItem',
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