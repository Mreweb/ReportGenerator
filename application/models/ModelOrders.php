<?php

class ModelOrders extends CI_Model{
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('foundation_order');
        $this->db->order_by('OrderId', 'DESC');
        return $this->db->get()->result_array();
    }
    public function get($inputs)
    {
        $limit = $inputs['pageIndex'];
        $start = ($limit - 1) * $this->config->item('defaultPageSize');
        $end = $this->config->item('defaultPageSize');
        $this->db->select('* , foundation_order.IsActive as orderIsActive');
        $this->db->from('foundation_order');
        $this->db->join('foundation', 'foundation.FoundationId = foundation_order.FoundationId');
        if (isset($inputs['inputOrderTitle']) && $inputs['inputOrderTitle'] != '') {
            $this->db->like('OrderTitle', $inputs['inputOrderTitle']);
        }
        $this->db->order_by('OrderId', 'DESC');
        $tempDb = clone $this->db;
        $result['count'] = $tempDb->get()->num_rows();
        $this->db->limit($end, $start);
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            $result['data'] = $query;
            $result['startPage'] = $start;
        } else {
            $result['data'] = false;
        }
        return $result;
    }
    public function getOrderPersons($inputs){
        $limit = $inputs['pageIndex'];
         $start = ($limit - 1) * $this->config->item('defaultPageSize');
        $end = $this->config->item('defaultPageSize');
        $this->db->select('FirstName ,LastName , NationalCode , Tag , OrderId');
        $this->db->from('foundation_order_area_titles_scores');
        $this->db->join('foundation_order_area_titles' , 'foundation_order_area_titles.FATId = foundation_order_area_titles_scores.FATId');
        $this->db->join('foundation_order_area' , 'foundation_order_area.AreaId = foundation_order_area_titles.FATAreaId');
        $this->db->where_in('foundation_order_area_titles_scores.FATId', $inputs['inputOrderFATIds']);
        if (isset($inputs['inputLastName']) && $inputs['inputLastName'] != '') {
            $this->db->like('LastName', $inputs['inputLastName']);
        }
        if (isset($inputs['inputNationalCode']) && $inputs['inputNationalCode'] != '') {
            $this->db->where('NationalCode', $inputs['inputNationalCode']);
        }
        $this->db->group_by('NationalCode');
        $tempDb = clone $this->db;
        $result['count'] = $tempDb->get()->num_rows();
        $this->db->limit($end, $start);
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            $result['data'] = $query;
            $result['startPage'] = $start;
        } else {
            $result['data'] = false;
        }
        return $result;
    }
    public function getByManagerId($inputs)
    {
        $limit = $inputs['pageIndex'];
        $start = ($limit - 1) * $this->config->item('defaultPageSize');
        $end = $this->config->item('defaultPageSize');
        $this->db->select('*');
        $this->db->from('foundation_order');
        $this->db->join('foundation_customer', 'foundation_customer.CustomerId = foundation_order.CustomerId');
        $this->db->join('foundation', 'foundation.FoundationId = foundation_order.FoundationId');
        $this->db->join('foundation_manager', 'foundation_manager.ManagerId = foundation_order.ManagerId');
        if (isset($inputs['inputOrderTitle']) && $inputs['inputOrderTitle'] != '') {
            $this->db->like('OrderTitle', $inputs['inputOrderTitle']);
        }
        $this->db->where_in('foundation_order.ManagerId', $inputs['FoundationManagerIds']);
        $this->db->order_by('OrderId', 'DESC');
        $tempDb = clone $this->db;
        $result['count'] = $tempDb->get()->num_rows();
        $this->db->limit($end, $start);
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            $result['data'] = $query;
            $result['startPage'] = $start;
        } else {
            $result['data'] = false;
        }
        return $result;
    }
    public function getOrdersByFoundationIds($inputs)
    {
        $limit = $inputs['pageIndex'];
        $start = ($limit - 1) * $this->config->item('defaultPageSize');
        $end = $this->config->item('defaultPageSize');
        $this->db->select('*');
        $this->db->from('foundation_order');
        $this->db->join('foundation_customer', 'foundation_customer.CustomerId = foundation_order.CustomerId');
        $this->db->join('foundation', 'foundation.FoundationId = foundation_order.FoundationId');
        $this->db->join('foundation_manager', 'foundation_manager.ManagerId = foundation_order.ManagerId');
        if (isset($inputs['inputOrderTitle']) && $inputs['inputOrderTitle'] != '') {
            $this->db->like('OrderTitle', $inputs['inputOrderTitle']);
        }
        if (is_array($inputs['FoundationId'])) {
            $this->db->where_in('foundation_order.FoundationId', $inputs['FoundationId']);
        } else {
            $this->db->where('foundation_order.FoundationId', $inputs['FoundationId']);
        }
        $this->db->order_by('OrderId', 'DESC');
        $tempDb = clone $this->db;
        $result['count'] = $tempDb->get()->num_rows();
        $this->db->limit($end, $start);
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            $result['data'] = $query;
            $result['startPage'] = $start;
        } else {
            $result['data'] = false;
        }
        return $result;
    }
    public function getByOrderId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order');
        $this->db->where('OrderId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function doAdd($inputs){
        $UserArray = array(
            'OrderTitle' => $inputs['inputOrderTitle'],
            'BreakContent' => $inputs['inputBreakContent'],
            'BreakTable' => $inputs['inputBreakTable'],
            'FoundationId' => $inputs['inputFoundationId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doEdit($inputs)
    {
        $this->db->trans_start();
        $UserArray = array(
            'OrderTitle' => $inputs['inputOrderTitle'],
            'BreakContent' => $inputs['inputBreakContent'],
            'BreakTable' => $inputs['inputBreakTable'],
            'FoundationId' => $inputs['inputFoundationId'],
            'IsActive' => $inputs['inputIsActive'],
            'CreateDateTime' => time()
        );
        $this->db->where('OrderId', $inputs['inputOrderId']);
        $this->db->update('foundation_order', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDelete($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_order', array(
            'OrderId' => $inputs['inputOrderId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getAreaByOrderId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_area');
        $this->db->where('OrderId', $id);
        $this->db->order_by('Tanasob', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getAreaByAreaId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_area');
        $this->db->where('AreaId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }

    public function doAddArea($inputs){
        $UserArray = array(
            'AreaTitle' => $inputs['inputAbilityTitle'],
            'OrderId' => $inputs['inputOrderId'],
            'AreaContent' => $inputs['inputAreaContent'],
            'Tanasob' => $inputs['inputTanasob'],
            'BreakContent' => $inputs['inputBreakContent'],
            'BreakTable' => $inputs['inputBreakTable'],
            'BreakChart' => $inputs['inputBreakChart'],
            'CommonFeatures' => $inputs['inputCommonFeatures'],
            'CommonFeaturesCount' => $inputs['inputCommonFeaturesCount'],
            'AreaDataType' => $inputs['inputAreaDataType'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_area', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doEditArea($inputs){
        $this->db->trans_start();
        $UserArray = array(
            'AreaTitle' => $inputs['inputAreaTitle'],
            'AreaContent' => $inputs['inputAreaContent'],
            'Tanasob' => $inputs['inputTanasob'],
            'BreakContent' => $inputs['inputBreakContent'],
            'BreakTable' => $inputs['inputBreakTable'],
            'BreakChart' => $inputs['inputBreakChart'],
            'CommonFeatures' => $inputs['inputCommonFeatures'],
            'CommonFeaturesCount' => $inputs['inputCommonFeaturesCount'],
            'AreaDataType' => $inputs['inputAreaDataType'],
            'CreateDateTime' => time()
        );
        $this->db->where('AreaId', $inputs['inputAreaId']);
        $this->db->update('foundation_order_area', $UserArray);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }

    public function doDeleteArea($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_order_area', array(
            'AreaId' => $inputs['inputAreaId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }


    public function getAreaItemsByAreaId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_area_titles');
        $this->db->where('FATAreaId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getAreaItemByAreaItemId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_area_titles');
        $this->db->where('FATId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function doEditAreaItem($inputs)
    {
        $this->db->trans_start();
        $UserArray = array(
            'FATTitle' => $inputs['inputFATTitle'],
            'CreateDateTime' => time()
        );
        $this->db->where('FATId', $inputs['inputFATId']);
        $this->db->update('foundation_order_area_titles', $UserArray);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDeleteAreaItem($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_order_area_titles', array(
            'FATId' => $inputs['inputFATId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }

    public function getOrderAreaScore($inputs){

        $items = $this->getAreaItemsByAreaId($inputs['inputAreaId']);
        $fatIds = array();
        foreach ($items as $item) {
            array_push($fatIds , $item['FATId']);
        }
        $this->db->select('*');
        $this->db->from('foundation_order_area_titles_scores');
        if (isset($inputs['inputFirstName']) && $inputs['inputFirstName'] != '') {
            $this->db->like('FirstName', $inputs['inputFirstName']);
        }
        if (isset($inputs['inputLastName']) && $inputs['inputLastName'] != '') {
            $this->db->like('LastName', $inputs['inputLastName']);
        }
        if (isset($inputs['inputNationalCode']) && $inputs['inputNationalCode'] != '') {
            $this->db->like('NationalCode', $inputs['inputNationalCode']);
        }
        $this->db->where_in('FATId', $fatIds);

        $tempDb = clone $this->db;
        $result['count'] = $tempDb->get()->num_rows();
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            $result['data'] = $query;
            $result['startPage'] = 0;
        } else {
            $result['data'] = false;
        }
        return $result;
    }
    public function getOrderAreaScoreByNationalCode($NationalCode){
        $this->db->select('*');
        $this->db->from('foundation_order_area_titles_scores');
        $this->db->where('NationalCode', $NationalCode);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getPersonResultByNationalCode($nationalCode,$areaId){
        $items = $this->getAreaItemsByAreaId($areaId);
        $fatIds = array();
        foreach ($items as $item) {
            array_push($fatIds , $item['FATId']);
        }
        $this->db->select('*');
        $this->db->from('foundation_order_area_titles_scores');
        $this->db->where('NationalCode', $nationalCode);
        $this->db->where_in('FATId', $fatIds);
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function getOrganizationAVGResultByAreaId($areaId){
        $items = $this->getAreaItemsByAreaId($areaId);
        $index = 0;
        foreach ($items as $fatItem) {
            $this->db->select('AVG(FATScore)');
            $this->db->from('foundation_order_area_titles_scores');
            $this->db->where('FATId', $fatItem['FATId']);
            $items[$index]['AVG'] = $this->db->get()->result_array()[0]['AVG(FATScore)'];
            $index +=1;
        }
        return $items;
    }

}

?>