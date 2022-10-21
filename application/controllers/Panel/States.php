<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class States extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('panel/login');
        $this->load->model('ModelCountry');
    }
    public function index(){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'فهرست استان ها';
        $inputs['pageIndex'] = 1;
        $data['states'] = $this->ModelCountry->getStateList();
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/states/home/index');
        $this->load->view('panel/states/home/index_css');
        $this->load->view('panel/states/home/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doPagination(){
        $inputs = $this->input->post(NULL, TRUE);
        $data = $this->ModelCountry->getStates($inputs);
        $data['htmlResult'] = $this->load->view('panel/states/home/pagination', $data, TRUE);
        unset($data['data']);
        echo json_encode($data);
    }
    public function edit($stateId){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش استان';
        $data['data'] = $this->ModelCountry->getStateById($stateId)[0];
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/states/edit/index' , $data);
        $this->load->view('panel/states/edit/index_css');
        $this->load->view('panel/states/edit/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doEdit(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $result = $this->ModelCountry->doEditState($inputs);
        echo json_encode($result);
    }
    public function cities($stateId){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'فهرست شهر های استان';
        $data['data'] = $this->ModelCountry->getStateById($stateId)[0];
        $data['cities'] = $this->ModelCountry->getCityByStateId($stateId);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/states/cities/index' , $data);
        $this->load->view('panel/states/cities/index_css');
        $this->load->view('panel/states/cities/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doAddStateCity(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $result = $this->ModelCountry->doAddStateCity($inputs);
        echo json_encode($result);
    }
    public function doEditStateCity(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $result = $this->ModelCountry->doEditStateCity($inputs);
        echo json_encode($result);
    }
    public function doDeleteStateCity(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $result = $this->ModelCountry->doDeleteStateCity($inputs);
        echo json_encode($result);
    }
    public function getCityByStateId($stateId)
    {
        echo json_encode($this->ModelCountry->getCityByStateId($stateId));
    }
}