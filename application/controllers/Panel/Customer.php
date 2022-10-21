<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends CI_Controller{
    private $loginInfo;
    public function __construct(){
        parent::__construct();
        $this->load->helper('panel/login');
        $this->loginInfo = getLoginInfo();
        $this->load->model('ModelFoundation');
        $this->load->model('ModelCustomer');
        if(!isFoundationRole()){
            redirect(base_url('Panel/Home?error=1&errorContent=شما دسترسی موسسه ارزیابی را ندارید'));
        }
    }
    public function index(){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'موسسات ارزیابی';
        $inputs['pageIndex'] = 1;
        if(isFoundationRole()){
            $data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
            if(!$data['foundation']['IsActive']){
                redirect(base_url('Panel/Home?error=1&errorContent=موسسه ارزیابی توسط مدیر سیستم غیرفعال شده است'));
            }
        }
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/customer/home/index');
        $this->load->view('panel/customer/home/index_css');
        $this->load->view('panel/customer/home/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doPagination(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs['FoundationId'] = getLoggedFoundationId();
        $data = $this->ModelCustomer->get($inputs);
        $data['htmlResult'] = $this->load->view('panel/customer/home/pagination', $data, TRUE);
        unset($data['data']);
        echo json_encode($data);
    }
    public function add(){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'افزودن مشتری';
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/customer/add/index');
        $this->load->view('panel/customer/add/index_css');
        $this->load->view('panel/customer/add/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doAdd(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputCustomerTitle', 'عنوان مشتری', 'trim|required');
        $this->form_validation->set_rules('inputCustomerAddress', 'آدرس مشتری', 'trim|required');
        $this->form_validation->set_rules('inputDescriptionFile', 'فایل', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $inputs['FoundationId'] = getLoggedFoundationId();
        $result = $this->ModelCustomer->doAdd($inputs);
        echo json_encode($result);
    }
    public function edit($id){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش مشتری';
        $data['customer'] = $this->ModelCustomer->getByCustomerId($id);
        $data['customerFiles'] = $this->ModelCustomer->getFilesByCustomerId($id);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/customer/edit/index' , $data);
        $this->load->view('panel/customer/edit/index_css');
        $this->load->view('panel/customer/edit/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doEdit(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputCustomerTitle', 'عنوان مشتری', 'trim|required');
        $this->form_validation->set_rules('inputCustomerAddress', 'آدرس مشتری', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $inputs['FoundationId'] = getLoggedFoundationId();
        $result = $this->ModelCustomer->doEdit($inputs);
        echo json_encode($result);
    }
    public function doDelete(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $result = $this->ModelCustomer->doDelete($inputs);
        echo json_encode($result);
    }
    public function doDeleteFile(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $result = $this->ModelCustomer->doDeleteFile($inputs);
        echo json_encode($result);
    }

    public function account($id){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'رابط های موسسه ارزیابی';
        $data['customer'] = $this->ModelCustomer->getByCustomerId($id);
        $data['customerAdmin'] = $this->ModelCustomer->getAdminByCustomerId($id);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/customer/account/index' , $data);
        $this->load->view('panel/customer/account/index_css');
        $this->load->view('panel/customer/account/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doEditCustomerAdmin(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $result = $this->ModelCustomer->doEditCustomerAdmin($inputs);
        echo json_encode($result);
    }

}