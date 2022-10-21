<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controller to Handle Admin Login/Logout
 * @author MohammadrezaEsmaeeli (info@mreweb.ir)
 * @license GPL
 * */
class Home extends CI_Controller{
    //load models
    public function __construct(){
        parent::__construct();
        $this->load->model('ModelAccount');
    }
    //load view
    public function index(){

        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = $this->config->item('defaultPageTitle');
        $data['title'] = '';
        $data['description'] = '';
        $this->load->view('ui/login/index', $data);
        $this->load->view('ui/login/index_css');
        $this->load->view('ui/login/index_js');
    }
    /**
     * Function to LogIn Admin
     * @params Array inputs - array of username and password
     * @return string - in json format
     * @author MohammadrezaEsmaeeli (info@mreweb.ir)
     * @license GPL
     * */
    public function doLogin()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $inputs = array_map(function ($v) {
            return strip_tags($v);
        }, $inputs);
        $inputs = array_map(function ($v) {
            return remove_invisible_characters($v);
        }, $inputs);
        $inputs = array_map(function ($v) {
            return makeSafeInput($v);
        }, $inputs);

        if($this->session->userdata('CSRF') !== $inputs['inputCSRF']){
            $arr = array(
                'type' => "red",
                'content' => "لطفا صفحه را مجددا بارگذاری کنید"
            );
            echo json_encode($arr);
            die();
        }

        $captchaCode = $this->session->userdata('captchaCode');
        if(strtolower($inputs['inputCaptcha']) !== strtolower($captchaCode)){
            $arr = array(
                'type' => "red",
                'content' => "کد امنیتی نامعتبر است"
            );
            echo json_encode($arr);
            die();
        }
        $result = $this->ModelAccount->doLogin($inputs);
        echo json_encode($result);
    }
    //clear session is enough
    public function doLogOut(){
        $this->session->unset_userdata('LoginInfo');
        $this->session->unset_userdata('IsLogged');
        $this->session->unset_userdata('CSRF');
        redirect(base_url());
    }

}
