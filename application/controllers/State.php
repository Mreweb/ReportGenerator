<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class State extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('ModelCountry');
    }
    /* Helper Functions */
    public function getCityByStateId($stateId)
    {
        echo json_encode($this->ModelCountry->getCityByStateId($stateId));
    }
    /* End Helper Functions*/
}