<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Foundation extends CI_Controller{
    private $loginInfo;
    public function __construct(){
        parent::__construct();
        $this->load->helper('panel/login');
        $this->loginInfo = getLoginInfo();
        $this->load->model('ModelFoundation');
    }
    public function index(){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'سازمان';
        $inputs['pageIndex'] = 1;
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/foundation/home/index');
        $this->load->view('panel/foundation/home/index_css');
        $this->load->view('panel/foundation/home/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doPagination(){
        $inputs = $this->input->post(NULL, TRUE);
        $data = $this->ModelFoundation->get($inputs);
        $data['htmlResult'] = $this->load->view('panel/foundation/home/pagination', $data, TRUE);
        unset($data['data']);
        echo json_encode($data);
    }
    public function add(){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'افزودن سازمان';
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/foundation/add/index');
        $this->load->view('panel/foundation/add/index_css');
        $this->load->view('panel/foundation/add/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doAdd(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputFoundationTitle', 'عنوان سازمان', 'trim|required|min_length[2]|max_length[80]');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelFoundation->doAdd($inputs);
        echo json_encode($result);
    }
    public function edit($id){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش سازمان';
        $data['foundation'] = $this->ModelFoundation->getByFoundationId($id);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/foundation/edit/index' , $data);
        $this->load->view('panel/foundation/edit/index_css');
        $this->load->view('panel/foundation/edit/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doEdit(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputFoundationTitle', 'عنوان سازمان', 'trim|required|min_length[2]|max_length[80]');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelFoundation->doEdit($inputs);
        echo json_encode($result);
    }
    public function doDelete(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $result = $this->ModelFoundation->doDelete($inputs);
        echo json_encode($result);
    }
    public function account($id){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'رابط  سازمان';
        $data['foundation'] = $this->ModelFoundation->getByFoundationId($id);
        $data['foundationAdmin'] = $this->ModelFoundation->getAdminByFoundationId($id);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/foundation/account/index' , $data);
        $this->load->view('panel/foundation/account/index_css');
        $this->load->view('panel/foundation/account/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doEditFoundationAdmin(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $result = $this->ModelFoundation->doEditFoundationAdmin($inputs);
        echo json_encode($result);
    }
}