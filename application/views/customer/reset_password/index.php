<?php
$_URL = base_url();
$_DIR = base_url('assets/ui/v4/');
?>
<!DOCTYPE html>
<html>
<head>
    <title>پنل مدیریت</title>
    <base href="<?php echo base_url(); ?>" />
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="جوان کار - سامانه کاریابی و جذب نیرو"/>
    <link rel="icon" href="<?php echo base_url('assets/ui/v1/images/logo.png'); ?>" type="image/png"/>
    <link href="<?php echo base_url('assets/ui/v1/css/bootstrap.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/ui/v1/css/font-awesome-css.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/ui/v1/css/iziToast.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/ui/v1/css/custom.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/ui/v1/css/responsive.css'); ?>" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url('assets/ui/v1/js/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/ui/v1/js/iziToast.min.js'); ?>"></script>
    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>Admin/";
        function toggleLoader() {
            $(".preloader").fadeToggle();
        }
        function reCaptcha() {
            $(".recaptcha").addClass('fa-spin');
            $src = $(".captcha").attr('src');
            $(".captcha_img").attr('src', '').css({
                width: '100px',
                height: '50px',
                display: 'inline-block',
                opacity: '0'
            });
            setTimeout(function () {
                $(".captcha_img").attr('src', $src).css({
                    width: '100px',
                    height: '50px',
                    display: 'inline-block',
                    opacity: '1'
                });
                $(".recaptcha").removeClass('fa-spin');
            }, 400);
        }
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="container-login" style="background-color: #2b669a">
        <div class="wrap-login" style="text-align: center ">
            <form class="login-form validate-form ">
                <img src="<?php echo $_DIR; ?>/images/main-logo.png" style="width: 100px ; text-align: center"/>
                <span class="login-form-title p-b-34 p-t-27">
                  بازیابی رمز عبور
               </span>
                <div class="wrap-input validate-input">
                    <input class="input" id="inputPhone" type="text" name="inputPhone" placeholder="شماره همراه">
                    <span class="focus-input " style="text-align: right"><img src="<?php echo $_DIR; ?>/images/call-answer.png"
                          style="width: 7% ;padding-top: 13px ;padding-right: 8px ;"></span>

                </div>
<!---->
<!--                <div class="wrap-input validate-input" >-->
<!--                    <input class="input" id="inputPassword" type="text" name="inputPassword" placeholder="رمز عبور">-->
<!--                    <span class="focus-input " style="text-align: right"><img src="--><?php //echo $_DIR; ?><!--/images/locked-padlock.png"-->
<!--                          style="width: 7% ;padding-top: 13px ;padding-right: 8px"></span>-->
<!--                </div>-->
                <div class="form-group">
                    <img class="refresh" src="<?php echo $_DIR; ?>/images/update-arrows%20(1).png" >
                    <img class="captcha" src="<?php echo base_url('GetCaptcha'); ?>" style="float:left">
                    <div class="wrap-input-secode  " >
                        <input class="input" id="inputCaptcha" type="text" name="inputCaptcha" placeholder="کد امنیتی">

                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="button">
                        <span id="log">بازیابی</span><i style="width: 100% ;height: 32px;display: none" class="fa-li fa fa-spinner fa-spin"></i>
                    </button>
                </div>

                <div class="text-center p-t-90">
                    <a class="txt1" href="http://localhost:8080/Majless/Admin/Account/" style="font-size: 14px">
                        ورود
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
</body>
</html>