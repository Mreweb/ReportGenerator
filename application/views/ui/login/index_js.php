<script type="text/javascript">
    $(document).ready(function () {
        function isLoading() {
            $(".fa-li").show();
            $("#log").hide();
        }
        function endLoading() {
            $(".fa-li").hide();
            $("#log").show();
        }
        $(".login100-form-btn").click(function (e) {
                e.preventDefault();
                isLoading();
                /* Validation */
                $inputUsername = $.trim($("#inputUsername").val());
                $inputPassword = $.trim($("#inputPassword").val());
                if ($inputPassword === '' || $inputUsername === '') {
                    iziToast.show({
                        position: "topCenter",
                        title: 'اطلاعات نامعتبر است'
                    });
                    endLoading();
                    return;
                }
                $inputCaptchaVal = $.trim($("#inputCaptcha").val());
                $lencaptcha = $inputCaptchaVal.length;
                if ($lencaptcha !== 5) {
                    iziToast.info({
                        position: "topCenter",
                        title: 'کد امنیتی نامعتبر است'
                    });
                    endLoading();
                    return;
                }
                /* Send Request */
                $sendData = {
                    'inputUserName': $inputUsername,
                    'inputPassword': $inputPassword,
                    'inputCaptcha': $inputCaptchaVal,
                    'inputCSRF': $("meta[name='CSRF']").attr('content')
                }
                $.ajax({
                    type: 'post',
                    url: base_url + 'Home/doLogin',
                    data: $sendData,
                    success: function (data){
                        $result = jQuery.parseJSON(data);
                        iziToast.show({
                            title: $result['content'],
                            color: $result['type'],
                            zindex: 2030,
                            position: 'topLeft'
                        });
                        if ($result['success']) {
                            setTimeout(function () {
                                window.location.href = "<?php echo base_url('Panel');  ?>";
                            }, 2000);
                        }
                        endLoading();
                        return;
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        iziToast.error({
                            position: "topCenter",
                            title: 'خطای ارتباط با سرور',
                        });
                        endLoading();
                        return;
                    }
                });
            });
        function reCaptcha() {
            $(".recaptcha").addClass('fa-spin');
            $src = $(".captcha").attr('src');
            $(".captcha").attr('src', $src + '?' + Date.now());
            setTimeout(function(){
                $(".refresh").removeClass('fa fa-spin');
            } , 1500);
        }
        $(".refresh").click(function () {
            $(this).addClass('fa fa-spin');
            reCaptcha();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                $(".login100-form-btn").click();
            }
        });
    });
</script>