<script type="text/javascript">
    $(document).ready(function () {
        $("#addFoundation").click(function () {
            $inputFoundationTitle = $.trim($("#inputFoundationTitle").val());
            $inputPersonFirstName = $.trim($("#inputPersonFirstName").val());
            $inputPersonLastName = $.trim($("#inputPersonLastName").val());
            $inputPersonNationalCode  = $.trim($("#inputPersonNationalCode").val());
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
                        'inputFoundationTitle': $inputFoundationTitle,
                        'inputPersonId': $personId
                    }
                    $.ajax({
                        type: 'post',
                        url: base_url + 'Foundation/doAdd',
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
        });
    });
</script>