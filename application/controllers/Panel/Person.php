<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Person extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('panel/login');
    }
    public function doAdd(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $personId = $this->ModelPerson->doAdd($inputs);
        echo $personId;
    }
    public function doEditByColumn(){
        $inputs = $this->input->post(NULL, TRUE);
        $inputs =array_map(function($v){ return strip_tags($v); }, $inputs);
        $inputs =array_map(function($v){ return remove_invisible_characters($v); }, $inputs);
        $inputs =array_map(function($v){ return makeSafeInput($v); }, $inputs);
        $this->ModelPerson->doEditByColumn($inputs);
        echo json_encode($this->config->item('DBMessages')['SuccessAction']);
    }
}