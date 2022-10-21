<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Orders extends CI_Controller{
    private $loginInfo;
    public function __construct(){
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
        if (isFoundationRole()) {
            $data['foundation'] = $this->ModelFoundation->getByFoundationId(getLoggedFoundationId());
            if (!$data['foundation']['IsActive']) {
                redirect(base_url('Panel/Home?error=1&errorContent=موسسه ارزیابی توسط مدیر سیستم غیرفعال شده است'));
            }
        }
        $this->load->view('customer/static/header', $data);
        $this->load->view('customer/orders/home/index');
        $this->load->view('customer/orders/home/index_css');
        $this->load->view('customer/orders/home/index_js');
        $this->load->view('customer/static/footer');
    }
    public function doPagination()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $inputs['FoundationId'] = getLoggedFoundationId();
        $data = $this->ModelOrders->get($inputs);
        $data['htmlResult'] = $this->load->view('customer/orders/home/pagination', $data, TRUE);
        unset($data['data']);
        echo json_encode($data);
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
        //var_dump($data['orderModelAbility']);
        //echo "============================Order Tools";
        $data['orderTools'] = $this->ModelOrders->getToolsByOrderId($orderId);
        //var_dump($data['orderTools']);
        //echo "============================Order Person";
        $data['orderPerson'] = $this->ModelOrders->getOrderPersonByOrderId($orderId);
        $data['orderPersons'] = $this->ModelOrders->getOrderPersonByOrderId($orderId);
        //var_dump($data['orderPerson']);
        //echo "============================Order Plans";
        $data['orderPlans'] = $this->ModelOrders->getOrderPlanByOrderId($orderId);
        //var_dump($data['orderPlans']);
        //echo "============================Order Person Records";
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
                    }
                    else {
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
            $index +=1;
        }

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/result/index', $data);
        $this->load->view('panel/orders/result/index_css');
        $this->load->view('panel/orders/result/index_js', $data);
        $this->load->view('panel/static/footer');
    }
}