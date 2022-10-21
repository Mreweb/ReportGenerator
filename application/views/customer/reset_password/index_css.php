<?php $_DIR = base_url('assets/ui/v4/'); ?>
<style>
    .login-wrap {
        background: rgba(255, 255, 255, 0.9);
    }


    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }



    body, html {
        direction: rtl;
        height: 100%;

    }
    .container-fluid{
        padding: 0;
    }
    a {

        font-size: 12px;
        line-height: 1.7;
        color: #FFFFFF;
        margin: 0px;
        transition: all 0.4s;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        float: right;
        margin-top: -30px;
    }

    a:focus {
        outline: none !important;
    }

    a:hover {
        text-decoration: none;
        color: #666666;
    }
    .p-t-90{
        padding-top: 90px;
    }

    .p-b-34{
        padding-bottom: 34px;
    }
    .p-t-27{
        padding-top: 27px;
    }
    .container-login {
        width: 100%;
        min-height: 100vh;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 15px;
        background-image: url("<?php echo $_DIR; ?>/images/slide3_850.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        z-index: 1;
    }

    .container-login::before {
        content: "";
        display: block;
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(255,255,255,0.5);
    }
    .wrap-login {
        width: 500px;
        border-radius: 10px;
        overflow: hidden;
        padding: 55px 55px 37px 55px;

        background-color: rgba(2,45,109,0.8);

    }
    .login-form {
        width: 100%;
    }

    .login-form-logo {
        font-size: 60px;
        color: #333333;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 120px;
        height: 120px;
        border-radius: 20%;
        background-color: #fff;
        margin: 0 auto;
        background-image: url("<?php echo $_DIR; ?> images/main-logo.png");
        background-repeat: no-repeat;
        background-position: center;
        background-size:cover ;
        position: relative;
    }

    .login-form-title {
        font-size: 20px;
        color: #fff;
        line-height: 3;
        text-align: center;
        text-transform: uppercase;
        display: block;
    }
    .wrap-input {
        width: 100%;
        position: relative;
        border-bottom: 2px solid #D10B20;
        margin-bottom: 30px;
    }

    .input {
        font-size: 16px;
        color: #022D6D;
        line-height: 1.2;
        display: block;
        width: 100%;
        height: 45px;
        background: #FFFFFF;
        padding: 0 43px 0 38px;
    }

    .focus-input {
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
    }

    .focus-input::before {
        content: "";
        display: block;
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
        background: #fff;
    }

    .focus-input::after {
        font-size: 22px;
        color: #fff;

        content: attr(data-placeholder);
        display: block;
        width: 100%;
        position: absolute;
        top: 6px;
        left: 0px;
        padding-left: 5px;

        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
    }

    .input:focus {
        padding-left: 5px;
    }

    .input:focus + .focus-input::after {
        top: -22px;
        font-size: 18px;
    }

    .input:focus + .focus-input::before {
        width: 100%;
    }

    .has-val.input + .focus-input::after {
        top: -22px;
        font-size: 18px;
    }

    .has-val.input + .focus-input::before {
        width: 100%;
    }

    .has-val.input {
        padding-left: 5px;
    }

    .contact100-form-checkbox {
        padding-left: 5px;
        padding-top: 5px;
        padding-bottom: 35px;
    }

    .input-checkbox100 {
        display: none;
    }

    .label-checkbox100 {
        font-family: Poppins-Regular;
        font-size: 13px;
        color: #fff;
        line-height: 1.2;

        display: block;
        position: relative;
        padding-left: 26px;
        cursor: pointer;
    }

    .label-checkbox100::before {
        content: "\f26b";
        font-size: 13px;
        color: transparent;

        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        width: 16px;
        height: 16px;
        border-radius: 2px;
        background: #fff;
        left: 0;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .input-checkbox100:checked + .label-checkbox100::before {
        color: #D10B20;
    }
    .container-login100-form-btn {
        width: 100%;
        /*display: flex;*/
        /*justify-content: center;*/

    }
    .login100-form-btn:focus,
    .login100-form-btn:hover{
        outline: 0;
        color: #fff !important;
    }

    .login100-form-btn {
        font-size: 16px;
        color: #FFFFFF;
        line-height: 1.2;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 20px;
        min-width: 120px;
        height: 50px;
        border-radius: 0px;
        background:#D10B20;
        position: relative;
        z-index: 1;
        border: none;
        float: left;

    }

    .login100-form-btn:hover {
        color: #000000;
    }

    .wrap-input-secode{
        width: 45%;
        position: relative;
        border-bottom: 2px solid #D10B20;
        margin-bottom: 30px;

    }

    .capcha{
        width:39%;
        height: 45px;
        position: relative;
        margin-bottom: 30px;
        margin-left:11px;

    }
    .refresh{
        width:6%;
        float:left;
        margin-right: 14px;
        padding-top: 9px;
        margin-bottom: 30px;
        cursor: pointer;


    }
    #input-code{
        font-size: 16px;
        color: #022D6D;
        line-height: 1.2;
        display: block;
        width: 100%;
        height: 45px;
        text-align: center;
        background: #FFFFFF;
        padding: 0 50px 0 38px;
    }
    .fa-li {

        left: -0.142857em;
        width: 2.14285714em;
        top: .14285714em;
        text-align: center;
        margin-top: 5px;
        margin-left: 3px;
    }

    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size:34px;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    i:focus{outline: none;}





</style>