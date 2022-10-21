<script type="text/javascript">
    $(document).ready(function () {

        $("#addCustomer").click(function () {
            $fileSrc = "";
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
                        $result['fileSrc'] = 'NONE';
                    }
                    $fileSrc = $result['fileSrc'];

                    $inputCustomerTitle = $.trim($("#inputCustomerTitle").val());
                    $inputCustomerAddress = $.trim($("#inputCustomerAddress").val());
                    $inputDescriptionFile = $.trim($("#inputDescriptionFile").val());
                    $inputDescription = $.trim($("#inputDescription").val());

                    $inputPersonFirstName = $.trim($("#inputPersonFirstName").val());
                    $inputPersonLastName = $.trim($("#inputPersonLastName").val());
                    $inputPersonNationalCode = $.trim($("#inputPersonNationalCode").val());
                    $inputPersonPhone = $.trim($("#inputPersonPhone").val());
                    $inputUsername = $.trim($("#inputUsername").val());
                    $inputPassword = $.trim($("#inputPassword").val());
                    toggleLoader();
                    $sendData = {
                        'inputPersonFirstName': $inputPersonFirstName,
                        'inputPersonLastName': $inputPersonLastName,
                        'inputPersonNationalCode': $inputPersonNationalCode,
                        'inputPersonPhone': $inputPersonPhone,
                        'inputUsername': $inputUsername,
                        'inputPassword': $inputPassword
                    }
                    $.ajax({
                        type: 'post',
                        url: base_url + 'Person/doAdd',
                        data: $sendData,
                        success: function (data) {
                            toggleLoader();
                            $personId = jQuery.parseJSON(data);
                            $sendData = {
                                'inputCustomerTitle': $inputCustomerTitle,
                                'inputCustomerAddress': $inputCustomerAddress,
                                'inputDescriptionFile': $fileSrc,
                                'inputDescription': $inputDescription,
                                'inputPersonId': $personId
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Customer/doAdd',
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


        });


    });
</script>