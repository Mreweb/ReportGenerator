<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GetCaptcha extends CI_Controller
{
    public function index(){
        /*$random_alpha = mb_strtoupper(md5(rand()));*/
        $random_alpha = mb_strtoupper(rand(11111,99999));
        /*$random_alpha = str_ireplace("O","K",$random_alpha);
        $random_alpha = str_ireplace("0","N",$random_alpha);
        $random_alpha = str_ireplace("I","T",$random_alpha);*/
        $captcha_code = substr($random_alpha, 0, 5);
        $this->session->set_userdata('captchaCode',$captcha_code);
        $target_layer = imagecreatetruecolor(70, 40);
        $captcha_background = imagecolorallocate($target_layer, 255, 255, 255);
        imagefill($target_layer, 0, 0, $captcha_background);
        $captcha_text_color = imagecolorallocate($target_layer, 0, 0, 0);
        imagestring($target_layer, 5, 15, 10, $captcha_code, $captcha_text_color);
        header("Content-type: image/jpeg");
        imagejpeg($target_layer);
    }
}

?>