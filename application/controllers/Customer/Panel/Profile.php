<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('panel/login');
        $this->load->model('ModelProfile');
        $this->load->model('ModelPerson');
    }
	public function index()
	{
	    $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش پروفایل';
	    $this->load->view('customer/static/header', $data);
	    $this->load->view('customer/profile/index', $data);
        $this->load->view('customer/profile/index_css');
        $this->load->view('customer/profile/index_js');
	    $this->load->view('customer/static/footer');
	}
    public function doUpdateProfile(){
        $inputs = $this->input->post(NULL, TRUE);
        $personId = getPersonId();
        $data = $this->ModelPerson->getPersonById($personId);
        if(isset($inputs['inputOldPassword']) && $inputs['inputOldPassword'] !==""){
            if($data[0]['Password'] !== md5($inputs['inputOldPassword'])){
                echo json_encode(array(
                    'type' => "red",
                    'content' => "رمز عبور فعلی نامعتبر است",
                    'success' => false
                ));
                die();
            }
            $inputs['personId'] = $personId;
            $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
            $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
            $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
            $result = $this->ModelProfile->doUpdateProfile($inputs);
            echo json_encode($result);
        }
        else{
            echo json_encode(array(
                'type' => "red",
                'content' => "رمز عبور فعلی نامعتبر است",
                'success' => false
            ));
            die();
        }
    }
}