<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Orders extends CI_Controller{

    private $loginInfo;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('panel/login');
        $this->loginInfo = getLoginInfo();
        $this->load->model('ModelFoundation');
        $this->load->model('ModelCustomer');
        $this->load->model('ModelOrders');
    }

    public function index()
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'سفارشات';
        $inputs['pageIndex'] = 1;
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/home/index');
        $this->load->view('panel/orders/home/index_css');
        $this->load->view('panel/orders/home/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doPagination()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $data = $this->ModelOrders->get($inputs);
        $data['htmlResult'] = $this->load->view('panel/orders/home/pagination', $data, TRUE);
        unset($data['data']);
        echo json_encode($data);
    }

    public function managerOrders()
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'سفارشات';
        $inputs['pageIndex'] = 1;
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/home/index_for_manager');
        $this->load->view('panel/orders/home/index_css');
        $this->load->view('panel/orders/home/index_for_manager_js');
        $this->load->view('panel/static/footer');
    }

    public function doManagerOrdersPagination()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $inputs['FoundationManagerIds'] = getLoggedFoundationManagerFoundationsManagerIds();
        $data = $this->ModelOrders->getByManagerId($inputs);
        $data['htmlResult'] = $this->load->view('panel/orders/home/pagination_for_manager', $data, TRUE);
        unset($data['data']);
        echo json_encode($data);
    }

    public function add()
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'افزودن سفارش';
        $data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        $data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['customers'] = $this->ModelCustomer->getByFoundationId(getLoggedFoundationId());

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/add/index');
        $this->load->view('panel/orders/add/index_css');
        $this->load->view('panel/orders/add/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doAdd()
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
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputOrderTitle', 'عنوان سفارش', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doAdd($inputs);
        echo json_encode($result);
    }

    public function edit($id)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش سفارش';
        $data['order'] = $this->ModelOrders->getByOrderId($id);
        $data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        $data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['customers'] = $this->ModelCustomer->getByFoundationId(getLoggedFoundationId());
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/edit/index', $data);
        $this->load->view('panel/orders/edit/index_css');
        $this->load->view('panel/orders/edit/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doEdit()
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
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputOrderTitle', 'عنوان سفارش', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doEdit($inputs);
        echo json_encode($result);
    }

    public function doDelete()
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
        $result = $this->ModelOrders->doDelete($inputs);
        echo json_encode($result);
    }

    public function doCopy()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $data['order'] = $this->ModelOrders->getByOrderId($inputs['inputOrderId']);
        $data['orderModel'] = $this->ModelOrders->getModelByOrderId($inputs['inputOrderId']);
        $data['orderModelOptions'] = $this->ModelOrders->getModelOptionsByModelId($data['orderModel']['ModelId']);
        $data['orderAbility'] = $this->ModelOrders->getAbilityByModelId($data['orderModel']['ModelId']);
        $abilityIndex = 0;
        foreach ($data['orderAbility'] as $item) {
            $data['orderAbility'][$abilityIndex]['markers'] = $this->ModelOrders->getMarkersByAbilityId($item['AbilityId']);
            $abilityIndex += 1;
        }
        $data['orderTools'] = $this->ModelOrders->getToolsByOrderId($inputs['inputOrderId']);
        $data['orderOAR'] = $this->ModelOrders->getOARByOrderId($inputs['inputOrderId']);


        $UserArray = array(
            'OrderTitle' => randomString() . "_" . $data['order']['OrderTitle'],
            'CustomerId' => $data['order']['CustomerId'],
            'FoundationId' => $data['order']['FoundationId'],
            'ManagerId' => $data['order']['ManagerId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order', $UserArray);
        $orderId = $this->db->insert_id();


        $UserArray = array(
            'ModelTitle' => $data['orderModel']['ModelTitle'],
            'OrderId' => $orderId,
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_model', $UserArray);
        $modelId = $this->db->insert_id();

        foreach ($data['orderModelOptions'] as $orderModelOption) {
            $UserArray = array(
                'OptionTitle' => $orderModelOption['OptionTitle'],
                'OptionValue' => $orderModelOption['OptionValue'],
                'ModelId' => $modelId,
                'CreateDateTime' => time()
            );
            $this->db->insert('foundation_order_model_options', $UserArray);
        }

        foreach ($data['orderAbility'] as $orderAbility) {
            $UserArray = array(
                'AbilityTitle' => $orderAbility['AbilityTitle'],
                'Low' => $orderAbility['Low'],
                'High' => $orderAbility['High'],
                'Min' => $orderAbility['Min'],
                'LowEditRange' => $orderAbility['RandType'],
                'HighEditRange' => $orderAbility['LowEditRange'],
                'RandType' => $orderAbility['HighEditRange'],
                'ModelId' => $modelId,
                'CreateDateTime' => time()
            );
            $this->db->insert('foundation_order_model_ability', $UserArray);
            $abilityId = $this->db->insert_id();
            foreach ($orderAbility['markers'] as $markers) {
                $UserArray = array(
                    'MarkerTitle' => $markers['MarkerTitle'],
                    'AbilityId' => $abilityId,
                    'CreateDateTime' => time()
                );
                $this->db->insert('foundation_order_model_ability_marker', $UserArray);
            }
        }

        foreach ($data['orderTools'] as $orderTools) {
            $UserArray = array(
                'ToolTitle' => $orderTools['ToolTitle'],
                'ToolGuideFile' => $orderTools['ToolGuideFile'],
                'ToolType' => $orderTools['ToolType'],
                'OrderId' => $orderId,
                'CreateDateTime' => time()
            );
            $this->db->insert('foundation_order_tools', $UserArray);
        }

        /* $inputData = array();
         $inputData['inputData'] = array();
         foreach ($data['orderOAR'] as $orderOAR) {
             $UserArray = array(
                 'inputToolId' => $orderOAR['ToolId'],
                 'inputMarkerId' => $orderOAR['MarkerId'],
                 'inputAbilityId' => $orderOAR['AbilityId'],
                 'inputOrderId' => $orderId
             );
             array_push($inputData['inputData'], $UserArray);
         }
         $this->ModelOrders->doUpdateAbilityToolsRelation($inputData);*/
        echo json_encode($this->config->item('DBMessages')['SuccessAction']);
    }

    public function model($orderId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'افزودن مدل';
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderModel'] = $this->ModelOrders->getModelByOrderId($orderId);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/model/index', $data);
        $this->load->view('panel/orders/model/index_css');
        $this->load->view('panel/orders/model/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doModelEdit()
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
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputModelTitle', 'عنوان مدل', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doModelEdit($inputs);
        echo json_encode($result);
    }

    public function ability($orderId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'فهرست شایستگی';
        //$data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        //$data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderModel'] = $this->ModelOrders->getModelByOrderId($orderId);
        $data['orderModelAbility'] = $this->ModelOrders->getAbilityByModelId($data['orderModel']['ModelId']);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/ability/index', $data);
        $this->load->view('panel/orders/ability/index_css');
        $this->load->view('panel/orders/ability/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doAbilityAdd()
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
        /* validation */

        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputAbilityTitle', 'عنوان شایستگی', 'trim|required');
        $this->form_validation->set_rules('inputLow', 'کمترین نمره', 'trim|required');
        $this->form_validation->set_rules('inputHigh', 'بیشترین نمره', 'trim|required');
        $this->form_validation->set_rules('inputMin', 'حداقل نمره', 'trim|required');
        $this->form_validation->set_rules('inputLowEditRange', 'حداقل بازه تغییر', 'trim|required');
        $this->form_validation->set_rules('inputHighEditRange', 'حداکثر بازه تغییر', 'trim|required');
        $this->form_validation->set_rules('inputRandType', 'نحوه رند نمره', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doAbilityAdd($inputs);
        echo json_encode($result);
    }

    public function doUpdateAbilitySort()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $result = $this->ModelOrders->doUpdateAbilitySort($inputs);
        echo json_encode($result);
    }

    public function doAbilityDelete()
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
        $result = $this->ModelOrders->doAbilityDelete($inputs);
        echo json_encode($result);
    }

    public function abilityEdit($abilityId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'فهرست شایستگی';
        $data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        $data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['ability'] = $this->ModelOrders->getAbilityByAbilityId($abilityId);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/ability_edit/index', $data);
        $this->load->view('panel/orders/ability_edit/index_css');
        $this->load->view('panel/orders/ability_edit/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doAbilityEdit()
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
        /* validation */

        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputAbilityTitle', 'عنوان شایستگی', 'trim|required');
        $this->form_validation->set_rules('inputLow', 'کمترین نمره', 'trim|required');
        $this->form_validation->set_rules('inputHigh', 'بیشترین نمره', 'trim|required');
        $this->form_validation->set_rules('inputMin', 'حداقل نمره', 'trim|required');
        $this->form_validation->set_rules('inputLowEditRange', 'حداقل بازه تغییر', 'trim|required');
        $this->form_validation->set_rules('inputHighEditRange', 'حداکثر بازه تغییر', 'trim|required');
        $this->form_validation->set_rules('inputRandType', 'نحوه رند نمره', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doAbilityEdit($inputs);
        echo json_encode($result);
    }

    public function markers($abilityId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'فهرست شایستگی';
        //$data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        //$data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['ability'] = $this->ModelOrders->getAbilityByAbilityId($abilityId);
        $data['markers'] = $this->ModelOrders->getMarkersByAbilityId($abilityId);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/ability_markers/index', $data);
        $this->load->view('panel/orders/ability_markers/index_css');
        $this->load->view('panel/orders/ability_markers/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doMarkerAdd()
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
        /* validation */

        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputMarkerTitle', 'عنوان نشانگر', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doMarkerAdd($inputs);
        echo json_encode($result);
    }

    public function doMarkerDelete()
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
        $result = $this->ModelOrders->doMarkerDelete($inputs);
        echo json_encode($result);
    }

    public function markerEdit($markerId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'فهرست شایستگی';
        //$data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        //$data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['marker'] = $this->ModelOrders->getMarkerByMarkerId($markerId);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/ability_marker_edit/index', $data);
        $this->load->view('panel/orders/ability_marker_edit/index_css');
        $this->load->view('panel/orders/ability_marker_edit/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doMarkerEdit()
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
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputMarkerTitle', 'عنوان نشانگر', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doMarkerEdit($inputs);
        echo json_encode($result);
    }

    public function scoreTable($orderId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'فهرست شایستگی';
        //$data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        //$data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderModel'] = $this->ModelOrders->getModelByOrderId($orderId);
        $data['orderModelOptions'] = $this->ModelOrders->getModelOptionsByModelId($data['orderModel']['ModelId']);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/score_table/index', $data);
        $this->load->view('panel/orders/score_table/index_css');
        $this->load->view('panel/orders/score_table/index_js');
        $this->load->view('panel/static/footer');
    }

    public function scoreTableEdit($optionId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'فهرست شایستگی';
        //$data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        //$data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['option'] = $this->ModelOrders->getModelOptionByOptionId($optionId);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/score_table_edit/index', $data);
        $this->load->view('panel/orders/score_table_edit/index_css');
        $this->load->view('panel/orders/score_table_edit/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doModelOptionAdd()
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
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputOptionTitle', 'عنوان کیفی', 'trim|required');
        $this->form_validation->set_rules('inputOptionValue', 'مقدار کمی', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doModelOptionAdd($inputs);
        echo json_encode($result);
    }

    public function doModelOptionEdit()
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
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputOptionTitle', 'عنوان کیفی', 'trim|required');
        $this->form_validation->set_rules('inputOptionValue', 'مقدار کمی', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doModelOptionEdit($inputs);
        echo json_encode($result);
    }

    public function doModelOptionDelete()
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
        $result = $this->ModelOrders->doModelOptionDelete($inputs);
        echo json_encode($result);
    }

    public function tools($orderId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'فهرست ابزار';
        //$data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        //$data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderModel'] = $this->ModelOrders->getModelByOrderId($orderId);
        $data['orderTools'] = $this->ModelOrders->getToolsByOrderId($orderId);
        $data['orderCommonTools'] = $this->ModelOrders->getCommonTools();

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/tools/index', $data);
        $this->load->view('panel/orders/tools/index_css');
        $this->load->view('panel/orders/tools/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doToolsAdd()
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
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputToolTitle', 'عنوان ابزار', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doToolsAdd($inputs);
        echo json_encode($result);
    }

    public function toolsEdit($toolId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'ویرایش ابزار';
        //$data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        //$data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['tool'] = $this->ModelOrders->getToolByToolId($toolId);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/tools_edit/index', $data);
        $this->load->view('panel/orders/tools_edit/index_css');
        $this->load->view('panel/orders/tools_edit/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doToolsEdit()
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
        /* validation */
        $this->form_validation->set_data($inputs);
        $this->form_validation->set_rules('inputToolTitle', 'عنوان ابزار', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error = $this->config->item('DBMessages')['RequiredFields'];
            $error['content'] = validation_errors();
            echo json_encode($error);
            die();
        }
        /* End validation*/
        $result = $this->ModelOrders->doToolsEdit($inputs);
        echo json_encode($result);
    }

    public function doToolsDelete()
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
        $result = $this->ModelOrders->doToolsDelete($inputs);
        echo json_encode($result);
    }

    public function abilityToolsRelation($orderId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'ماتریس شایستگی ابزار';
        //$data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        //$data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        /*order ability relation*/
        $data['oar'] = $this->ModelOrders->getOARByOrderId($orderId);
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderModel'] = $this->ModelOrders->getModelByOrderId($orderId);
        $data['orderTools'] = $this->ModelOrders->getToolsByOrderId($orderId);
        $data['orderModelAbility'] = $this->ModelOrders->getAbilityByModelId($data['orderModel']['ModelId']);
        $index = 0;
        foreach ($data['orderModelAbility'] as $item) {
            $data['orderModelAbility'][$index]['markers'] = $this->ModelOrders->getMarkersByAbilityId($item['AbilityId']);
            $index += 1;
        }
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/ability_tools_relation/index', $data);
        $this->load->view('panel/orders/ability_tools_relation/index_css');
        $this->load->view('panel/orders/ability_tools_relation/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doUpdateAbilityToolsRelation()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $inputs['inputData'] = json_decode($inputs['inputData'], TRUE);
        $result = $this->ModelOrders->doUpdateAbilityToolsRelation($inputs);
        echo json_encode($result);
    }

    public function doDeleteAbilityToolsRelation()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $result = $this->ModelOrders->doDeleteAbilityToolsRelation($inputs);
        echo json_encode($result);
    }

    public function bindValuer($orderId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'افزودن ارزیاب';
        //$data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
        //$data['managers'] = $this->ModelFoundation->getManagerByFoundationId(getLoggedFoundationId());
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderValuer'] = $this->ModelOrders->getOrderValuersByOrderId($orderId);
        $data['valuers'] = $this->ModelFoundation->getFoundationAllValuers($data['order']['FoundationId']);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/bind_valuer/index', $data);
        $this->load->view('panel/orders/bind_valuer/index_css');
        $this->load->view('panel/orders/bind_valuer/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doBindValuer()
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
        $result = $this->ModelOrders->doBindValuer($inputs);
        echo json_encode($result);
    }

    public function doEditOrderValuer()
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
        $result = $this->ModelOrders->doEditOrderValuer($inputs);
        echo json_encode($result);
    }

    public function doDeleteOrderValuer()
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
        $result = $this->ModelOrders->doDeleteOrderValuer($inputs);
        echo json_encode($result);
    }

    public function orderPerson($orderId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'فهرست ارزیابی شوندگان';
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderPerson'] = $this->ModelOrders->getOrderPersonByOrderId($orderId);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/person/index', $data);
        $this->load->view('panel/orders/person//index_css');
        $this->load->view('panel/orders/person//index_js');
        $this->load->view('panel/static/footer');
    }

    public function doAddOrderPerson()
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
        $result = $this->ModelOrders->doAddOrderPerson($inputs);
        echo json_encode($result);
    }

    public function doDeleteOrderPerson()
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
        $result = $this->ModelOrders->doDeleteOrderPerson($inputs);
        echo json_encode($result);
    }

    public function plan($orderId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'افزودن برنامه';
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderPlans'] = $this->ModelOrders->getOrderPlanByOrderId($orderId);
        $data['planManagers'] = $this->ModelFoundation->getFoundationAllPlanManager();
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/plan/index', $data);
        $this->load->view('panel/orders/plan/index_css');
        $this->load->view('panel/orders/plan/index_js');
        $this->load->view('panel/static/footer');
    }

    public function planEdit($planId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش برنامه';
        $data['orderPlan'] = $this->ModelOrders->getOrderPlanByPlanId($planId);
        $data['order'] = $this->ModelOrders->getByOrderId($data['orderPlan']['OrderId']);
        $data['planManagers'] = $this->ModelFoundation->getFoundationAllPlanManager();

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/plan_edit/index', $data);
        $this->load->view('panel/orders/plan_edit/index_css');
        $this->load->view('panel/orders/plan_edit/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doOrderPlanAdd()
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
        $result = $this->ModelOrders->doOrderPlanAdd($inputs);
        echo json_encode($result);
    }

    public function doOrderPlanEdit()
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
        $result = $this->ModelOrders->doOrderPlanEdit($inputs);
        echo json_encode($result);
    }

    public function doOrderPlanDelete()
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
        $result = $this->ModelOrders->doOrderPlanDelete($inputs);
        echo json_encode($result);
    }

    public function planTable($planId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'جدول زمانی';
        $data['orderPlan'] = $this->ModelOrders->getOrderPlanByPlanId($planId);
        $orderId = $data['orderPlan']['OrderId'];
        $data['planManagers'] = $this->ModelFoundation->getFoundationAllPlanManager();
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderModel'] = $this->ModelOrders->getModelByOrderId($orderId);
        $data['orderTools'] = $this->ModelOrders->getToolsByOrderId($orderId);
        $data['orderValuer'] = $this->ModelOrders->getOrderValuersByOrderId($orderId);
        $data['orderPerson'] = $this->ModelOrders->getOrderPersonByOrderId($orderId);
        $data['orderPlanTimes'] = $this->ModelOrders->getOrderPlanTimesByPlanId($data['orderPlan']['OrderPlanId']);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/plan_table/index', $data);
        $this->load->view('panel/orders/plan_table/index_css');
        $this->load->view('panel/orders/plan_table/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doOrderPlanTimeAdd()
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
        $result = $this->ModelOrders->doOrderPlanTimeAdd($inputs);
        echo json_encode($result);
    }

    public function doOrderPlanTimeEdit()
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
        $result = $this->ModelOrders->doOrderPlanTimeEdit($inputs);
        echo json_encode($result);
    }

    public function doOrderPlanTimeDelete()
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
        $result = $this->ModelOrders->doOrderPlanTimeDelete($inputs);
        echo json_encode($result);
    }

    public function planTableRecords($planId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'تکمیل جدول زمانی';
        $data['orderPlan'] = $this->ModelOrders->getOrderPlanByPlanId($planId);
        $orderId = $data['orderPlan']['OrderId'];
        $data['planManagers'] = $this->ModelFoundation->getFoundationAllPlanManager();
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderModel'] = $this->ModelOrders->getModelByOrderId($orderId);
        $data['orderTools'] = $this->ModelOrders->getToolsByOrderId($orderId);
        $data['orderValuer'] = $this->ModelOrders->getOrderValuersByOrderId($orderId);
        $data['orderPerson'] = $this->ModelOrders->getOrderPersonByOrderId($orderId);
        $data['orderPlanTimes'] = $this->ModelOrders->getOrderPlanTimesByPlanId($data['orderPlan']['OrderPlanId']);

        $data['orderPlanRecords'] = $this->ModelOrders->getOrderPlanRecordsByPlanId($planId);
        $index = 0;
        foreach ($data['orderPlanRecords'] as $orderPlanRecord) {
            $data['orderPlanRecords'][$index]['persons'] = $this->ModelOrders->getRecordsPersonByRecordId($orderPlanRecord['RecordId']);
            $index += 1;
        }


        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/plan_table_record/index', $data);
        $this->load->view('panel/orders/plan_table_record/index_css');
        $this->load->view('panel/orders/plan_table_record/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doPlanTableRecordsAdd()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $inputs['inputPersonIds'] = explode(',', $inputs['inputPersonIds']);
        $inputs = array_map(function ($v) {
            return remove_invisible_characters($v);
        }, $inputs);
        $inputs = array_map(function ($v) {
            return makeSafeInput($v);
        }, $inputs);
        $result = $this->ModelOrders->doPlanTableRecordsAdd($inputs);
        echo json_encode($result);
    }

    public function doPlanTableRecordsDelete()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $inputs = array_map(function ($v) {
            return remove_invisible_characters($v);
        }, $inputs);
        $inputs = array_map(function ($v) {
            return makeSafeInput($v);
        }, $inputs);
        $result = $this->ModelOrders->doPlanTableRecordsDelete($inputs);
        echo json_encode($result);
    }

    public function doDeleteOrderPlanRecordPersonByRecordPerson()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $inputs = array_map(function ($v) {
            return remove_invisible_characters($v);
        }, $inputs);
        $inputs = array_map(function ($v) {
            return makeSafeInput($v);
        }, $inputs);
        $result = $this->ModelOrders->doDeleteOrderPlanRecordPersonByRecordPerson($inputs);
        echo json_encode($result);
    }

    public function result($orderId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'نتیجه سفارش';
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderModel'] = $this->ModelOrders->getModelByOrderId($orderId);
        $data['orderModelAbility'] = $this->ModelOrders->getAbilityByModelId($data['orderModel']['ModelId']);
        $index = 0;
        foreach ($data['orderModelAbility'] as $oma) {
            $data['orderModelAbility'][$index]['markers'] = $this->ModelOrders->getMarkersByAbilityId($oma['AbilityId']);
            $index += 1;
        }
        $data['orderTools'] = $this->ModelOrders->getToolsByOrderId($orderId);
        $data['orderPerson'] = $this->ModelOrders->getOrderPersonByOrderId($orderId);
        $data['orderPlans'] = $this->ModelOrders->getOrderPlanByOrderId($orderId);

        $index = 0;
        foreach ($data['orderPlans'] as $orderPlan) {
            $data['orderPlans'][$index]['records'] = $this->ModelOrders->getOrderPlanRecordsByPlanId($orderPlan['OrderPlanId']);
            $index += 1;
        }



        $index = 0;
        foreach ($data['orderPerson'] as $op) {
            $scoreIndex = 0;
            foreach ($data['orderTools'] as $ot) {
                $toolId = $ot['ToolId'];
                foreach ($data['orderModelAbility'] as $oma) {
                    $abilityId = $oma['AbilityId'];
                    $score = $this->ModelOrders->getFinalScoresByToolAbilityPersonId($toolId, $abilityId, $op['PersonId']);
                    if (isset($score[0])) {
                        $data['orderPerson'][$index]['score'][$scoreIndex] = $score[0];
                        $data['orderPerson'][$index]['score'][$scoreIndex]['HasScore'] = TRUE;
                        $data['orderPerson'][$index]['score'][$scoreIndex]['AbilityTitle'] = $oma['AbilityTitle'];
                        $data['orderPerson'][$index]['score'][$scoreIndex]['ToolTitle'] = $ot['ToolTitle'];
                    } else {
                        $data['orderPerson'][$index]['score'][$scoreIndex] = NULL;
                        $data['orderPerson'][$index]['score'][$scoreIndex]['HasScore'] = FALSE;
                        $data['orderPerson'][$index]['score'][$scoreIndex]['AbilityTitle'] = $oma['AbilityTitle'];
                        $data['orderPerson'][$index]['score'][$scoreIndex]['ToolTitle'] = $ot['ToolTitle'];
                    }
                    $data['orderPerson'][$index]['score'][$scoreIndex]['MinimumRequiredScore'] = $oma['Min'];
                    $scoreIndex += 1;
                }
                $data['orderPersons'][$index]['score'] = $data['orderPerson'][$index]['score'];
            }
            $index += 1;
        }


        $data['AcceptedPersonCount'] = 0;
        $data['FailedPersonCount'] = 0;
        $index = 0;
        foreach ($data['orderPerson'] as $op) {
            $data['orderPerson'][$index]['Accepted'] = TRUE;
            $hasFailedAnyBody = FALSE;
            foreach ($op['score'] as $score) {
                if (isset($score['PlanManagerAVGScore']) && $score['PlanManagerAVGScore'] > 0) {
                    if ($score['MinimumRequiredScore'] > $score['PlanManagerAVGScore']) {
                        $data['orderPerson'][$index]['Accepted'] = FALSE;
                        if (!$hasFailedAnyBody) {
                            $data['FailedPersonCount'] += 1;
                            $hasFailedAnyBody = TRUE;
                        }
                    }
                }
            }
            if (!$hasFailedAnyBody) {
                $data['AcceptedPersonCount'] += 1;
            }
            $index += 1;
        }



        $index = 0;
        $data['AbilityMinMaxAvg'] = $data['orderModelAbility'];
        foreach ($data['AbilityMinMaxAvg'] as $oma) {
            $data['AbilityMinMaxAvg'][$index] = array();
            $data['AbilityMinMaxAvg'][$index]['AbilityId'] = $oma['AbilityId'];
            $data['AbilityMinMaxAvg'][$index]['AbilityTitle'] = $oma['AbilityTitle'];
            $data['AbilityMinMaxAvg'][$index]['AVG'] = $this->ModelOrders->getAbilityAvg($oma['AbilityId']);
            $data['AbilityMinMaxAvg'][$index]['MAX'] = $this->ModelOrders->getAbilityMax($oma['AbilityId']);
            $data['AbilityMinMaxAvg'][$index]['MIN'] = $this->ModelOrders->getAbilityMin($oma['AbilityId']);
            $index += 1;
        }

        /*$index = 0;
        foreach ($data['orderPerson'] as $person) {
            foreach ($data['orderTools'] as $tool) {
                $data['orderPerson'][$index]['Tools'][$tool['ToolTitle']] = $this->ModelOrders->getPersonToolsScore(array('ToolId' => $tool['ToolId'], 'PersonId' => $person['PersonId']));
            }
            $index += 1;
        }*/


        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/result/index', $data);
        $this->load->view('panel/orders/result/index_css');
        $this->load->view('panel/orders/result/index_js', $data);
        $this->load->view('panel/static/footer');
    }

    public function exportResultExcel()
    {
        $inputs = $this->input->post(NULL, TRUE);
        require 'vendor/autoload.php';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $titlesIndex = 0;
        foreach (json_decode($inputs['titles'], true) as $title) {
            $sheet->setCellValue(columnFromIndex($titlesIndex) . "1", $title);
            $titlesIndex += 1;
        }

        $index = 2;
        foreach (json_decode($inputs['result'], true) as $item) {
            $resultTitlesIndex = 0;
            foreach ($item as $score) {
                $sheet->setCellValue(columnFromIndex($resultTitlesIndex) . $index, $score);
                $resultTitlesIndex += 1;
            }
            $index += 1;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'Result' . randomString() . '.xlsx';
        $writer->save($filename);
        echo base_url($filename);

    }

    public function uploadToolComponet($toolId)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'بارگذاری فایل بعد/مولفه';
        $data['tool'] = $this->ModelOrders->getToolByToolId($toolId);
        $data['components'] = $this->ModelOrders->getToolComponent($toolId);
        $data['TOA'] = $this->ModelOrders->getFullOARByToolId($toolId);
        $data['ComponentMarkerRelation'] = $this->ModelOrders->getComponentMarkerRelationByToolId($toolId);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/tools_upload_component/index', $data);
        $this->load->view('panel/orders/tools_upload_component/index_css');
        $this->load->view('panel/orders/tools_upload_component/index_js');
        $this->load->view('panel/static/footer');
    }

    public function doUploadToolComponent($toolId)
    {
        $this->load->helper('plugins/excel/bootstrap_helper');
        $this->load->helper('plugins/excel/PHPExcel/iofactory_helper');
        $failedInserts = array();
        $inputFileName = $_FILES["inputFile"]['tmp_name'];
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            array_push($failedInserts,
                array(
                    'FullName' => 'خطا در فایل ارسالی',
                    'Title' => 'ساختار فایل ارسالی نامعتبر است',
                )
            );
            die();
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE)[0];
            $this->ModelOrders->doAddToolComponent($rowData[1], $rowData[3], $toolId);
        }
        echo json_encode($this->config->item('DBMessages')['SuccessAction']);
    }

    public function doDeleteComponent()
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
        $result = $this->ModelOrders->doDeleteComponent($inputs);
        echo json_encode($result);
    }

    public function doAddComponentMarkerRelation()
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
        $result = $this->ModelOrders->doAddComponentMarkerRelation($inputs);
        echo json_encode($result);
    }

    public function doDeleteComponentMarker()
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
        $result = $this->ModelOrders->doDeleteComponentMarker($inputs);
        echo json_encode($result);
    }

    public function doUploadScoreComponent($toolId)
    {
        $this->load->helper('plugins/excel/bootstrap_helper');
        $this->load->helper('plugins/excel/PHPExcel/iofactory_helper');
        $failedInserts = array();
        $inputFileName = $_FILES["inputFile"]['tmp_name'];
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            array_push($failedInserts,
                array(
                    'FullName' => 'خطا در فایل ارسالی',
                    'Title' => 'ساختار فایل ارسالی نامعتبر است',
                )
            );
            die();
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $Record = $this->ModelOrders->getOrderPlanRecordsByToolId($toolId)[0];

        $persons = array();
        /*Get Persons*/
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE)[0];
            $persons[] = $this->ModelPerson->getPersonByNationalCode($rowData[0])[0];
        }
        $persons = array_map("unserialize", array_unique(array_map("serialize", $persons)));
        $persons = array_values($persons);

        /*Get Component For Each Person*/
        $personIndex = 0;
        foreach ($persons as $tempPerson) {
            $components = array();
            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE)[0];
                if ($tempPerson['PersonNationalCode'] == $rowData[0] || $tempPerson['PersonCode'] == $rowData[0]) {
                    $component = $this->ModelOrders->getComponentByComponentTitle($rowData[1]);
                    if (isset($component[0])) {
                        $component = $component[0];
                    }
                    $component['marker'] = $this->ModelOrders->getComponentMarkerRelationByComponentId($component['ComponentId']);
                    $component['score'] = $rowData[2];
                    $components[] = $component;
                }
            }
            $persons[$personIndex]['component'] = $components;
            $personIndex += 1;
        }

        /*Update Score In Options */
        foreach ($persons as $tempPerson) {
            $markersArray = array();
            foreach ($tempPerson['component'] as $cmp) {
                foreach ($cmp['marker'] as $mrk) {
                    $mrk['score'] = $cmp['score'];
                    $mrk['weightScore'] = $cmp['score'] * $mrk['Weight'];
                    array_push($markersArray, $mrk);
                }
            }

            $markerIndex = 0;
            $copyOfMarkers = $markersArray;
            foreach ($markersArray as $mrk) {
                $sigmaCI = 0;
                $sigmaWI = 0;

                $sigmaWI += $mrk['Weight'];
                $sigmaCI += ($mrk['weightScore']);
                foreach ($copyOfMarkers as $cpmrk) {
                    if ($mrk['MarkerId'] == $cpmrk['MarkerId'] && $mrk['AbilityId'] == $cpmrk['AbilityId'] && $mrk['RowId'] != $cpmrk['RowId']) {
                        $sigmaWI += $cpmrk['Weight'];
                        $sigmaCI += ($cpmrk['weightScore']);
                    }
                }
                $markersArray[$markerIndex]['FinlaScore'] = round(floatval($sigmaCI / $sigmaWI), 2);
                $optionId = $this->ModelOrders->getModelOptionByOptionValue($markersArray[$markerIndex]['FinlaScore']);

                if (empty($optionId)) {
                    $toolData = $this->ModelOrders->getToolByToolId($toolId);
                    $modelData = $this->ModelOrders->getModelByOrderId($toolData['OrderId']);
                    $inputs['inputOptionTitle'] = $markersArray[$markerIndex]['FinlaScore'];
                    $inputs['inputOptionValue'] = $markersArray[$markerIndex]['FinlaScore'];
                    $inputs['inputModelId'] = $modelData['ModelId'];
                    $optionId = $this->ModelOrders->doInActiveModelOptionAdd($inputs);
                }
                $markersArray[$markerIndex]['PersonId'] = $tempPerson['PersonId'];
                $markersArray[$markerIndex]['RecordId'] = $Record['RecordId'];
                $markersArray[$markerIndex]['OptionId'] = $optionId['OptionId'];
                $markerIndex += 1;
            }
        }


        foreach ($persons as $tempPerson) {
            $markersArray = array();
            foreach ($tempPerson['component'] as $cmp) {
                foreach ($cmp['marker'] as $mrk) {
                    $mrk['score'] = $cmp['score'];
                    $mrk['weightScore'] = $cmp['score'] * $mrk['Weight'];
                    array_push($markersArray, $mrk);
                }
            }

            $markerIndex = 0;
            $copyOfMarkers = $markersArray;
            foreach ($markersArray as $mrk) {
                $sigmaCI = 0;
                $sigmaWI = 0;

                $sigmaWI += $mrk['Weight'];
                $sigmaCI += ($mrk['weightScore']);
                foreach ($copyOfMarkers as $cpmrk) {
                    if ($mrk['MarkerId'] == $cpmrk['MarkerId'] && $mrk['AbilityId'] == $cpmrk['AbilityId'] && $mrk['RowId'] != $cpmrk['RowId']) {
                        $sigmaWI += $cpmrk['Weight'];
                        $sigmaCI += ($cpmrk['weightScore']);
                    }
                }
                $markersArray[$markerIndex]['FinlaScore'] = round(floatval($sigmaCI / $sigmaWI), 2);
                $optionId = $this->ModelOrders->getModelOptionByOptionValue($markersArray[$markerIndex]['FinlaScore']);
                $markersArray[$markerIndex]['PersonId'] = $tempPerson['PersonId'];
                $markersArray[$markerIndex]['RecordId'] = $Record['RecordId'];
                $markersArray[$markerIndex]['OptionId'] = $optionId['OptionId'];
                $markerIndex += 1;
            }

            foreach ($markersArray as $mrk) {
                $this->ModelOrders->doRegisterScoreForExcell($mrk);
            }
        }
        echo json_encode($this->config->item('DBMessages')['SuccessAction']);
    }

}