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
        $this->load->model('ModelPerson');
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
    public function add()
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'افزودن سفارش';
        $data['foundation'] = $this->ModelFoundation->getAll();

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
        $result = $this->ModelOrders->doAdd($inputs);
        echo json_encode($result);
    }
    public function edit($id)
    {
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش سفارش';
        $data['order'] = $this->ModelOrders->getByOrderId($id);
        $data['foundation'] = $this->ModelFoundation->getAll();
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
    public function persons($orderId){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'سفارشات';
        $inputs['pageIndex'] = 1;
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderArea'] = $this->ModelOrders->getAreaByOrderId($orderId);
        $data['FATIds'] = array();
        foreach ($data['orderArea'] as $item) {
            $areaItems= $this->ModelOrders->getAreaItemsByAreaId($item['AreaId']);
            foreach ($areaItems as $areaItem) {
                array_push( $data['FATIds'] , $areaItem['FATId']);
            }
        }
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/persons/index');
        $this->load->view('panel/orders/persons/index_css');
        $this->load->view('panel/orders/persons/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doOrderPersonsPagination(){
        $inputs = $this->input->post(NULL, TRUE); 
        $data = $this->ModelOrders->getOrderPersons($inputs);
        $data['htmlResult'] = $this->load->view('panel/orders/persons/pagination', $data, TRUE);
        unset($data['data']);
        echo json_encode($data);
    }
    public function area($orderId){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['Enum'] = $this->config->item('Enum');
        $data['pageTitle'] = 'فهرست شایستگی';
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['orderArea'] = $this->ModelOrders->getAreaByOrderId($orderId);

        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/ability/index', $data);
        $this->load->view('panel/orders/ability/index_css');
        $this->load->view('panel/orders/ability/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doAddArea()
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
        $result = $this->ModelOrders->doAddArea($inputs);
        echo json_encode($result);
    }
    public function editArea($id){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش سفارش';
        $data['Enum'] = $this->config->item('Enum');
        $data['area'] = $this->ModelOrders->getAreaByAreaId($id);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/ability_edit/index', $data);
        $this->load->view('panel/orders/ability_edit/index_css');
        $this->load->view('panel/orders/ability_edit/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doEditArea()
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
        $result = $this->ModelOrders->doEditArea($inputs);
        echo json_encode($result);
    }
    public function doDeleteArea()
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
        $result = $this->ModelOrders->doDeleteArea($inputs);
        echo json_encode($result);
    }
    public function uploadItems($id){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش سفارش';
        $data['Enum'] = $this->config->item('Enum');
        $data['area'] = $this->ModelOrders->getAreaByAreaId($id);
        $data['areaItems'] = $this->ModelOrders->getAreaItemsByAreaId($id);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/upload_area_items/index', $data);
        $this->load->view('panel/orders/upload_area_items/index_css');
        $this->load->view('panel/orders/upload_area_items/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doUploadItems()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $inputFileName = $_FILES["file"]['tmp_name'];
        $AreaId = $inputs['inputAreaId'];
        require 'vendor/autoload.php';
        $spreadsheet = new Spreadsheet();
        $inputFileType = 'Xlsx';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        $this->db->delete('foundation_order_area_titles', array(
            'FATAreaId' => $AreaId
        ));
        for ($i = 1; $i < sizeof($data); $i++) {
            if ($data[$i][0] != '' && $data[$i][0] != null) {
                $this->db->insert('foundation_order_area_titles',
                    array(
                        'FATTitle' => $data[$i][0],
                        'FATAreaId' => $AreaId,
                        'CreateDateTime' => time()
                    )
                );
            }
        }
        $result = $this->config->item('DBMessages')['SuccessAction'];
        echo json_encode($result);
    }
    public function editAreaItem($id){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش سفارش';
        $data['Enum'] = $this->config->item('Enum');
        $data['areaItem'] = $this->ModelOrders->getAreaItemByAreaItemId($id);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/area_item_edit/index', $data);
        $this->load->view('panel/orders/area_item_edit/index_css');
        $this->load->view('panel/orders/area_item_edit/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doEditAreaItem()
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
        $result = $this->ModelOrders->doEditAreaItem($inputs);
        echo json_encode($result);
    }
    public function doDeleteAreaItem()
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
        $result = $this->ModelOrders->doDeleteAreaItem($inputs);
        echo json_encode($result);
    }
    public function uploadItemsScore($id){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش سفارش';
        $data['Enum'] = $this->config->item('Enum');
        $data['area'] = $this->ModelOrders->getAreaByAreaId($id);
        $data['areaItems'] = $this->ModelOrders->getAreaItemsByAreaId($id);
        $this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/upload_area_items_score/index', $data);
        $this->load->view('panel/orders/upload_area_items_score/index_css');
        $this->load->view('panel/orders/upload_area_items_score/index_js');
        $this->load->view('panel/static/footer');
    }
    public function doOrderAreaScorePagination(){
        $inputs = $this->input->post(NULL, TRUE);
        $data = $this->ModelOrders->getOrderAreaScore($inputs);
        $data['inputAreaId'] = $inputs['inputAreaId'];
        $data['area'] = $this->ModelOrders->getAreaByAreaId( $inputs['inputAreaId']);
        $data['order'] = $this->ModelOrders->getByOrderId($data['area']['OrderId']);
        $data['itemCount'] = $inputs['inputAreaItemsCount'];
        $data['htmlResult'] = $this->load->view('panel/orders/upload_area_items_score/pagination', $data, TRUE);
        unset($data['data']);
        echo json_encode($data);
    }
    public function doExportAreaScoreFile()
    {
        $inputs = $this->input->post(NULL, TRUE);
        $areaItems = $this->ModelOrders->getAreaItemsByAreaId($inputs['inputAreaId']);
        require 'vendor/autoload.php';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $indexCharacter = 0;
        $indexNumber = 1;
        $sheet->setCellValue(columnFromIndex($indexCharacter++) . $indexNumber, 'نام');
        $sheet->setCellValue(columnFromIndex($indexCharacter++) . $indexNumber, 'نام خانوادگی');
        $sheet->setCellValue(columnFromIndex($indexCharacter++) . $indexNumber, 'کد ملی');
        $sheet->setCellValue(columnFromIndex($indexCharacter++) . $indexNumber, 'تگ');
        foreach ($areaItems as $ai) {
            $sheet->setCellValue(columnFromIndex($indexCharacter++) . $indexNumber, $ai['FATTitle']);
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'Score_' . randomString() . '.xlsx';
        $writer->save('uploads/' . $filename);
        echo json_encode(
            array(
                'fileName' => base_url('uploads/' . $filename)
            )
        );
    }
    public function doImportAreaScoreFile(){
        $inputs = $this->input->post(NULL, TRUE);
        $areaItems = $this->ModelOrders->getAreaItemsByAreaId($inputs['inputAreaId']);
        $inputFileName = $_FILES["file"]['tmp_name'];
        $AreaId = $inputs['inputAreaId'];
        require 'vendor/autoload.php';
        $spreadsheet = new Spreadsheet();
        $inputFileType = 'Xlsx';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        $data = array_filter($data);
        for($i=0;$i<sizeof($data);$i++){
            $data[$i] = array_filter($data[$i]);
        }


        if (sizeof($data[0]) - 4 != sizeof($areaItems)) {
            $msg = $this->config->item('DBMessages')['ErrorAction'];
            $msg['content'] = 'فایل اکسل منطبق بر تعداد مولفه ها نیست';
            echo json_encode($msg);
            die();
        }
        $totalSizeItems = sizeof($areaItems);
        for ($i = 1; $i < sizeof($data); $i++) {
            for($j=0;$j<$totalSizeItems;$j++){
                $this->db->delete('foundation_order_area_titles_scores',  array( 'NationalCode' => $data[$i][2],  'FATId' => $areaItems[$j]['FATId']));
                $this->db->insert('foundation_order_area_titles_scores',
                    array(
                        'FirstName' => $data[$i][0],
                        'LastName' => $data[$i][1],
                        'NationalCode' => $data[$i][2],
                        'Tag' => $data[$i][3],
                        'FATScore' => $data[$i][$j+4],
                        'FATId' => $areaItems[$j]['FATId'],
                        'CreateDateTime' => time()
                    )
                );
            }
        }
        $result = $this->config->item('DBMessages')['SuccessAction'];
        echo json_encode($result);
    }
    public function report($nationalCode,$areaId){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش سفارش';
        $data['Enum'] = $this->config->item('Enum');

        $data['area'] = $this->ModelOrders->getAreaByAreaId($areaId);
        $data['order'] = $this->ModelOrders->getByOrderId($data['area']['OrderId']);

        $data['areaItems'] = $this->ModelOrders->getAreaItemsByAreaId($areaId);

        $data['person'] = $this->ModelPerson->getPersonByNationalCode($nationalCode);
        if(isset($data['person'][0])){
            $data['person'] = $data['person'][0];
        }
        $data['personResult'] = $this->ModelOrders->getPersonResultByNationalCode($nationalCode,$areaId);
        $data['Result'] = $this->ModelOrders->getOrganizationAVGResultByAreaId($areaId);

         if(count($data['personResult']) < 7){
            $partCount = 1;
        } else{
            $partCount = round(count($data['personResult']) / 6) + 1;
        }

        $data['personResultChunk'] = array_chunk($data['personResult'], (ceil(count($data['personResult'])/$partCount)));
        $data['ResultChunk'] = array_chunk($data['Result'], (ceil(count($data['Result'])/$partCount)));
        $data['areaItemsChunk'] = array_chunk($data['areaItems'], (ceil(count($data['areaItems'])/$partCount)));
        $data['TableCount'] = sizeof($data['personResultChunk']);


        //$this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/report/index', $data);
        $this->load->view('panel/orders/report/index_css');
        $this->load->view('panel/orders/report/index_js', $data);
        //$this->load->view('panel/static/footer');

    }
    public function reportFull($nationalCode , $orderId){
        $data['noImg'] = $this->config->item('defaultImage');
        $data['pageTitle'] = 'ویرایش سفارش';
        $data['Enum'] = $this->config->item('Enum');
        $data['person'] = $this->ModelPerson->getPersonByNationalCode($nationalCode);
        if(isset($data['person'][0])){
            $data['person'] = $data['person'][0];
        }
        $data['order'] = $this->ModelOrders->getByOrderId($orderId);
        $data['area'] = $this->ModelOrders->getAreaByOrderId($orderId);
        $totalResult  = array();
        foreach ($data['area'] as $area){
            $temp = array();
            $temp['areaItems'] = $this->ModelOrders->getAreaItemsByAreaId($area['AreaId']);
            $temp['personResult'] = $this->ModelOrders->getPersonResultByNationalCode($nationalCode,$area['AreaId']);
            if(!empty($temp['personResult'])) {
                $temp['Result'] = $this->ModelOrders->getOrganizationAVGResultByAreaId($area['AreaId']);
                if(count($temp['personResult']) < 7){
                    $partCount = 1;
                } else{
                    $partCount = round(count($temp['personResult']) / 7) + 1;
                }
                $temp['personResultChunk'] = array_chunk($temp['personResult'], (ceil(count($temp['personResult']) / $partCount)));
                $temp['ResultChunk'] = array_chunk($temp['Result'], (ceil(count($temp['Result']) / $partCount)));
                $temp['areaItemsChunk'] = array_chunk($temp['areaItems'], (ceil(count($temp['areaItems']) / $partCount)));
                $temp['TableCount'] = sizeof($temp['personResultChunk']);
                $temp['area'] = $area;
                $temp['partCount'] = $partCount;
                $temp['uuid'] = randomString();
                array_push($totalResult, $temp);
            } else{
                array_push($totalResult, $temp);
            }
        }
        $data['TotalResult'] = $totalResult;
        //$this->load->view('panel/static/header', $data);
        $this->load->view('panel/orders/report/full/index', $data);
        $this->load->view('panel/orders/report/full/index_css');
        $this->load->view('panel/orders/report/full/index_js', $data);
        //$this->load->view('panel/static/footer');
    }
}