<?php
$_URL = base_url();
$_DIR = base_url('assets/ui/');
?>
<!DOCTYPE html>
<html>
<head>
    <title>پنل مدیریت</title>
    <base href="<?php echo base_url(); ?>"/>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link href="<?php echo base_url('assets/ui/css/bootstrap.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/ui/css/font-awesome-css.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/ui/css/iziToast.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/ui/css/compiled.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/ui/css/responsive.css'); ?>" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url('assets/ui/js/jquery-2.2.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/ui/js/iziToast.min.js'); ?>"></script>
    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>Panel/";
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
                <span class="login-form-title p-b-34 p-t-27">
                   ورود مدیر به حساب کاربری
               </span>
                <div class="wrap-input validate-input">
                    <input class="input" id="inputPhone" type="text" name="inputPhone" placeholder="شماره همراه">
                    <span class="focus-input " style="text-align: right"></span>
                </div>
                <div class="wrap-input validate-input">
                    <input class="input" id="inputPassword" type="password" name="inputPassword" placeholder="رمز عبور">
                    <span class="focus-input " style="text-align: right"></span>
                </div>
                <div class="form-group">
                    <img class="refresh" src="<?php echo $_DIR; ?>/images/refresh.png" style="float:left">
                    <img class="captcha" src="<?php echo base_url('GetCaptcha'); ?>" style="float:left">
                    <div class="wrap-input-secode  ">
                        <input class="input" id="inputCaptcha" type="text" name="inputCaptcha" placeholder="کد امنیتی">
                        <span class="focus-input" data-placeholder=""></span>
                    </div>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="button">
                        <span id="log">ورود</span>
                        <i style="width: 100% ;height: 32px;display: none" class="fa-li fa fa-spinner fa-spin"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>