<script type="text/javascript">
    $(document).ready(function () {

        $("#editCustomer").click(function () {
            $inputCustomerId = $.trim($("#inputCustomerId").val());
            $inputCustomerTitle = $.trim($("#inputCustomerTitle").val());
            $inputCustomerAddress = $.trim($("#inputCustomerAddress").val());
            $inputDescriptionFile = $.trim($("#inputDescriptionFile").val());
            $inputDescription = $.trim($("#inputDescription").val());
            $fileSrc = "";
            if(document.getElementById('inputDescriptionFile').files.length === 0){
                $sendData = {
                    'inputCustomerId': $inputCustomerId,
                    'inputCustomerTitle': $inputCustomerTitle,
                    'inputCustomerAddress': $inputCustomerAddress,
                    'inputDescriptionFile': '',
                    'inputDescription': $inputDescription
                }
                $.ajax({
                    type: 'post',
                    url: base_url + 'Customer/doEdit',
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
            else{
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
                        $fileSrc = $result['fileSrc'];
                        console.log($fileSrc);
                        $sendData = {
                            'inputCustomerId': $inputCustomerId,
                            'inputCustomerTitle': $inputCustomerTitle,
                            'inputCustomerAddress': $inputCustomerAddress,
                            'inputDescriptionFile': $fileSrc,
                            'inputDescription': $inputDescription
                        }
                        $.ajax({
                            type: 'post',
                            url: base_url + 'Customer/doEdit',
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
                                'inputRowId': $this.data('id')
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Customer/doDeleteFile',
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