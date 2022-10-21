<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
    private $loginInfo;
    public function __construct(){
        parent::__construct();
        $this->load->helper('panel/login');
        $this->loginInfo = getLoginInfo();
        $this->load->model('ModelCustomer');
    }
	public function index(){
        $data['pageTitle'] = 'پیشخوان';
        $this->load->view('customer/static/header', $data);
        $this->load->view('customer/home/index', $data);
        $this->load->view('customer/home/index_js', $data);
	    $this->load->view('customer/static/footer');
	}
    public function doPagination(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs['CustomerId'] = getLoggedCustomerId();
        $data = $this->ModelCustomer->getOrdersByCustomerId($inputs);
        $data['htmlResult'] = $this->load->view('customer/home/pagination', $data, TRUE);
        unset($data['data']);
        echo json_encode($data);
    }
}