<script type="text/javascript">
    $(document).ready(function () {

        /* Update User Info */
        $("#updateAdminProfile").click(function () {
            $inputOldPassword = $.trim($("#inputOldPassword").val());
            $inputNewPassword = $.trim($("#inputNewPassword").val());
            $inputConfirmPassword = $.trim($("#inputConfirmPassword").val());
            if (!isEmpty($inputOldPassword) && !isEmpty($inputNewPassword) && !isEmpty($inputConfirmPassword)) {
                if ($inputNewPassword !== $inputConfirmPassword) {
                    notify('رمز عبور با تکرا آن یکی نیست', 'red');
                    return false;
                }
            }
            /* End Validation */
            toggleLoader();
            $sendData = {
                'inputOldPassword': $inputOldPassword,
                'inputNewPassword': $inputNewPassword
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Profile/doUpdateProfile',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطای ارتباط با سرور.دقایقی دیگر تلاش کنید', 'red');
                    toggleLoader();
                }
            });
        });
        /* End Update User Info */

    });
</script>