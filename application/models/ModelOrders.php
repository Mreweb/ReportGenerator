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
    public function doAdd($inputs)
    {
        $UserArray = array(
            'OrderTitle' => $inputs['inputOrderTitle'],
            'CustomerId' => $inputs['inputCustomerId'],
            'FoundationId' => $inputs['inputFoundationId'],
            'ManagerId' => $inputs['inputManagerId'],
            'IsAbilityBase' => $inputs['inputIsAbilityBase'],
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
    public function doEdit($inputs) {
        $this->db->trans_start();
        $UserArray = array(
            'OrderTitle' => $inputs['inputOrderTitle'],
            'CustomerId' => $inputs['inputCustomerId'],
            'FoundationId' => $inputs['inputFoundationId'],
            'ManagerId' => $inputs['inputManagerId'],
            'IsActive' => $inputs['inputIsActive'],
            'IsAbilityBase' => $inputs['inputIsAbilityBase'],
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
    public function getModelByOrderId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_model');
        $this->db->where('OrderId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function doModelEdit($inputs)
    {
        $this->db->trans_start();
        if ($inputs['inputModelId'] == '') {
            $UserArray = array(
                'ModelTitle' => $inputs['inputModelTitle'],
                'OrderId' => $inputs['inputOrderId'],
                'CreateDateTime' => time()
            );
            $this->db->insert('foundation_order_model', $UserArray);
        } else {
            $UserArray = array(
                'ModelTitle' => $inputs['inputModelTitle'],
                'CreateDateTime' => time()
            );
            $this->db->where('ModelId', $inputs['inputModelId']);
            $this->db->update('foundation_order_model', $UserArray);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getAbilityByModelId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_model_ability');
        $this->db->where('ModelId', $id);
        $this->db->order_by('Sort', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getAbilityByAbilityId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_model_ability');
        $this->db->where('AbilityId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function doAbilityAdd($inputs){

        $UserArray = array(
            'AbilityTitle' => $inputs['inputAbilityTitle'],
            'Low' => $inputs['inputLow'],
            'High' => $inputs['inputHigh'],
            'Min' => $inputs['inputMin'],
            'LowEditRange' => $inputs['inputLowEditRange'],
            'HighEditRange' => $inputs['inputHighEditRange'],
            'RandType' => $inputs['inputRandType'],
            'ModelId' => $inputs['inputModelId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_model_ability', $UserArray);
        $abilityId = $this->db->insert_id();
        if($inputs['inputIsAbilityBase']){
            $UserArray = array(
                'MarkerTitle' => randomString('alpha'),
                'AbilityId' => $abilityId,
                'CreateDateTime' => time()
            );
            $this->db->insert('foundation_order_model_ability_marker', $UserArray);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doUpdateAbilitySort($inputs)
    {
        $index = 1;
        foreach ($inputs['inputAbilitySort'] as $input) {

            $UserArray = array(
                'Sort' => $index++
            );
            $this->db->where('AbilityId', $input);
            $this->db->update('foundation_order_model_ability', $UserArray);
        }
        return $this->config->item('DBMessages')['SuccessAction'];
    }
    public function doAbilityDelete($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_order_model_ability', array(
            'AbilityId' => $inputs['inputAbilityId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doAbilityEdit($inputs)
    {
        $UserArray = array(
            'AbilityTitle' => $inputs['inputAbilityTitle'],
            'Low' => $inputs['inputLow'],
            'High' => $inputs['inputHigh'],
            'Min' => $inputs['inputMin'],
            'LowEditRange' => $inputs['inputLowEditRange'],
            'HighEditRange' => $inputs['inputHighEditRange'],
            'RandType' => $inputs['inputRandType'],
            'CreateDateTime' => time()
        );
        $this->db->where('AbilityId', $inputs['inputAbilityId']);
        $this->db->update('foundation_order_model_ability', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getMarkersByAbilityId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_model_ability_marker');
        $this->db->where('AbilityId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getMarkerByMarkerId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_model_ability_marker');
        $this->db->where('MarkerId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function doMarkerAdd($inputs)
    {
        $UserArray = array(
            'MarkerTitle' => $inputs['inputMarkerTitle'],
            'AbilityId' => $inputs['inputAbilityId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_model_ability_marker', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doMarkerDelete($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_order_model_ability_marker', array(
            'MarkerId' => $inputs['inputMarkerId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doMarkerEdit($inputs)
    {
        $UserArray = array(
            'MarkerTitle' => $inputs['inputMarkerTitle'],
            'CreateDateTime' => time()
        );
        $this->db->where('MarkerId', $inputs['inputMarkerId']);
        $this->db->update('foundation_order_model_ability_marker', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getModelOptionsByModelId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_model_options');
        $this->db->where('ModelId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getModelOptionByOptionId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_model_options');
        $this->db->where('OptionId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function getModelOptionByOptionValue($value)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_model_options');
        $this->db->where('OptionValue', $value);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function getModelMaxOptionValueByModelId($id)
    {
        $this->db->select('MAX(OptionValue) as maxOptionValue');
        $this->db->from('foundation_order_model_options');
        $this->db->where('ModelId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function doModelOptionAdd($inputs)
    {
        $UserArray = array(
            'OptionTitle' => $inputs['inputOptionTitle'],
            'OptionValue' => $inputs['inputOptionValue'],
            'ModelId' => $inputs['inputModelId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_model_options', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doInActiveModelOptionAdd($inputs)
    {
        $UserArray = array(
            'OptionTitle' => $inputs['inputOptionTitle'],
            'OptionValue' => $inputs['inputOptionValue'],
            'ModelId' => $inputs['inputModelId'],
            'IsVisible' => 0,
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_model_options', $UserArray);
        return $this->db->insert_id();
    }
    public function doModelOptionEdit($inputs)
    {
        $UserArray = array(
            'OptionTitle' => $inputs['inputOptionTitle'],
            'OptionValue' => $inputs['inputOptionValue'],
            'CreateDateTime' => time()
        );
        $this->db->where('OptionId', $inputs['inputOptionId']);
        $this->db->update('foundation_order_model_options', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doModelOptionDelete($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_order_model_options', array(
            'OptionId' => $inputs['inputOptionId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getToolsByOrderId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_tools');
        $this->db->where('OrderId ', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getCommonTools()
    {
        $this->db->select('*');
        $this->db->from('foundation_order_tools_common');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getToolByToolId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_tools');
        $this->db->where('ToolId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function doToolsAdd($inputs)
    {
        $UserArray = array(
            'ToolTitle' => $inputs['inputToolTitle'],
            'ToolGuideFile' => $inputs['inputToolGuideFile'],
            'ToolType' => $inputs['inputToolType'],
            'OrderId' => $inputs['inputOrderId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_tools', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doToolsEdit($inputs)
    {
        $UserArray = "";
        if ($inputs['inputToolGuideFile'] == '') {
            $UserArray = array(
                'ToolTitle' => $inputs['inputToolTitle'],
                'ToolType' => $inputs['inputToolType'],
                'CreateDateTime' => time()
            );
        } else {
            $UserArray = array(
                'ToolTitle' => $inputs['inputToolTitle'],
                'ToolGuideFile' => $inputs['inputToolGuideFile'],
                'ToolType' => $inputs['inputToolType'],
                'CreateDateTime' => time()
            );
        }
        $this->db->where('ToolId', $inputs['inputToolId']);
        $this->db->update('foundation_order_tools', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doToolsDelete($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_order_tools', array(
            'ToolId' => $inputs['inputToolId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getOARByOrderId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_ability_marker_tools_relation');
        $this->db->where('OrderId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getOARByToolId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_ability_marker_tools_relation');
        $this->db->where('ToolId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getToolUniqueAbilityByToolId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_ability_marker_tools_relation');
        $this->db->join('foundation_order_model_ability_marker', 'foundation_order_model_ability_marker.MarkerId = foundation_order_ability_marker_tools_relation.MarkerId');
        $this->db->join('foundation_order_model_ability', 'foundation_order_model_ability.AbilityId = foundation_order_ability_marker_tools_relation.AbilityId');
        $this->db->where('ToolId', $id);
        $this->db->order_by('foundation_order_model_ability.Sort', 'DESC');
        $this->db->group_by('foundation_order_model_ability.AbilityId');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getToolAbilityMarkersByToolAbilityId($toolId, $abilityId)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_ability_marker_tools_relation');
        $this->db->join('foundation_order_model_ability_marker', 'foundation_order_model_ability_marker.MarkerId = foundation_order_ability_marker_tools_relation.MarkerId');
        $this->db->join('foundation_order_model_ability', 'foundation_order_model_ability.AbilityId = foundation_order_ability_marker_tools_relation.AbilityId');
        $this->db->where('ToolId', $toolId);
        $this->db->where('foundation_order_ability_marker_tools_relation.AbilityId', $abilityId);
        $this->db->order_by('foundation_order_model_ability.AbilityId', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getFullOARByToolId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_ability_marker_tools_relation');
        $this->db->join('foundation_order_model_ability', 'foundation_order_model_ability.AbilityId = foundation_order_ability_marker_tools_relation.AbilityId');
        $this->db->join('foundation_order_model_ability_marker', 'foundation_order_model_ability_marker.MarkerId = foundation_order_ability_marker_tools_relation.MarkerId');
        $this->db->where('ToolId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function doUpdateAbilityToolsRelation($inputs)
    {
        $this->db->delete('foundation_order_ability_marker_tools_relation', array(
            'OrderId' => $inputs['inputData'][0]['inputOrderId']
        ));
        foreach ($inputs['inputData'] as $item) {
            $UserArray = array(
                'ToolId' => $item['inputToolId'],
                'MarkerId' => $item['inputMarkerId'],
                'AbilityId' => $item['inputAbilityId'],
                'OrderId' => $item['inputOrderId'],
                'CreateDateTime' => time()
            );
            $this->db->insert('foundation_order_ability_marker_tools_relation', $UserArray);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDeleteAbilityToolsRelation($inputs)
    {
        $this->db->delete('foundation_order_ability_marker_tools_relation', array(
            'AbilityId' => $inputs['inputAbilityId'],
            'MarkerId' => $inputs['inputMarkerId'],
            'ToolId' => $inputs['inputToolId'],
            'OrderId' => $inputs['inputOrderId'],
        ));
        return $this->config->item('DBMessages')['SuccessAction'];
    }
    public function doBindValuer($inputs)
    {
        $this->db->delete('foundation_order_valuer', array(
            'OrderId' => $inputs['inputOrderId'],
            'ValuerId' => $inputs['inputPersonId']
        ));
        $UserArray = array(
            'OrderId' => $inputs['inputOrderId'],
            'ValuerId' => $inputs['inputPersonId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_valuer', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doEditOrderValuer($inputs)
    {
        $UserArray = array(
            'ValuerId' => $inputs['inputValuerId']
        );
        $this->db->where('RowId', $inputs['inputRowId']);
        $this->db->update('foundation_order_valuer', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getOrderValuersByOrderId($orderId)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_valuer');
        $this->db->join('foundation_valuer', 'foundation_valuer.ValuerId = foundation_order_valuer.ValuerId');
        $this->db->join('person', 'foundation_valuer.PersonId = person.PersonId');
        $this->db->where('foundation_order_valuer.OrderId', $orderId);
        return $this->db->get()->result_array();
    }
    public function doDeleteOrderValuer($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_order_valuer', array(
            'RowId' => $inputs['inputRowId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getOrderPersonByOrderId($orderId){
        $this->db->select('*');
        $this->db->from('foundation_order_person');
        $this->db->join('person', 'person.PersonId = foundation_order_person.PersonId');
        $this->db->where('foundation_order_person.OrderId', $orderId);
        return $this->db->get()->result_array();
    }
    public function doAddOrderPerson($inputs)
    {
        $UserArray = array(
            'OrderId' => $inputs['inputOrderId'],
            'PersonId' => $inputs['inputPersonId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_person', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDeleteOrderPerson($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_order_person', array(
            'RowId' => $inputs['inputRowId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getOrderPlanByOrderId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan');
        $this->db->where('OrderId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getOrderPlanByPlanId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan');
        $this->db->where('OrderPlanId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function doOrderPlanAdd($inputs)
    {
        $UserArray = array(
            'OrderId' => $inputs['inputOrderId'],
            'OrderPlanTitle' => $inputs['inputOrderPlanTitle'],
            'OrderPlanPlace' => $inputs['inputOrderPlanPlace'],
            'StartDate' => $inputs['inputStartDate'],
            'EndDate' => $inputs['inputEndDate'],
            'PlanManagerId' => $inputs['inputPlanManagerId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_plan', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doOrderPlanEdit($inputs)
    {
        $UserArray = array(
            'OrderPlanTitle' => $inputs['inputOrderPlanTitle'],
            'OrderPlanPlace' => $inputs['inputOrderPlanPlace'],
            'StartDate' => $inputs['inputStartDate'],
            'EndDate' => $inputs['inputEndDate'],
            'PlanManagerId' => $inputs['inputPlanManagerId'],
            'CreateDateTime' => time()
        );
        $this->db->where('OrderPlanId', $inputs['inputOrderPlanId']);
        $this->db->update('foundation_order_plan', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doOrderPlanDelete($inputs)
    {
        $this->db->delete('foundation_order_plan', array(
            'OrderPlanId' => $inputs['inputOrderPlanId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getOrderPlanTimesByPlanId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan_times');
        $this->db->where('OrderPlanId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function doOrderPlanTimeAdd($inputs)
    {
        $UserArray = array(
            'TimeFrom' => $inputs['inputTimeFrom'],
            'TimeTo' => $inputs['inputTimeTo'],
            'OrderPlanId' => $inputs['inputOrderPlanId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_plan_times', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doOrderPlanTimeEdit($inputs)
    {
        if ($inputs['inputTimeType'] == 'From') {
            $UserArray = array(
                'TimeFrom' => $inputs['inputTimeContent'],
                'CreateDateTime' => time()
            );
        } else {
            $UserArray = array(
                'TimeTo' => $inputs['inputTimeContent'],
                'CreateDateTime' => time()
            );
        }
        $this->db->where('TimeId', $inputs['inputTimeId']);
        $this->db->update('foundation_order_plan_times', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doOrderPlanTimeDelete($inputs)
    {
        $this->db->delete('foundation_order_plan_times', array(
            'TimeId' => $inputs['inputTimeId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDeleteOrderPlanRecordPersonByRecordPerson($inputs)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan_records_score');
        $this->db->where('RecordId', $inputs['inputRecordId']);
        $this->db->where('OrderPersonId', $inputs['inputRecordPersonId']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $message = $this->config->item('DBMessages')['ErrorAction'];
            $message['content'] = 'نمره برای این ارزیاب ثبت شده است';
            return $message;
        } else {
            $this->db->delete('foundation_order_plan_records_person', array(
                'RecordId' => $inputs['inputRecordId'],
                'PersonId' => $inputs['inputRecordPersonId']
            ));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return $this->config->item('DBMessages')['ErrorAction'];
            } else {
                return $this->config->item('DBMessages')['SuccessAction'];
            }
        }
    }
    public function getOrderPlanRecordsByPlanId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan_records');
        $this->db->join('foundation_order_tools', 'foundation_order_tools.ToolId = foundation_order_plan_records.ToolId', 'left');
        $this->db->join('foundation_order_plan_times', 'foundation_order_plan_times.TimeId = foundation_order_plan_records.TimeId', 'left');
        $this->db->join('foundation_valuer', 'foundation_valuer.ValuerId = foundation_order_plan_records.ValuerId', 'left');
        $this->db->join('person', 'person.PersonId = foundation_valuer.PersonId', 'left');
        $this->db->where('PlanId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getOrderPlanRecordsByToolId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan_records');
        $this->db->where('ToolId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getRecordsPersonByRecordId($rid)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan_records_person');
        $this->db->join('person', 'person.PersonId = foundation_order_plan_records_person.PersonId', 'left');
        $this->db->where('RecordId', $rid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function doPlanTableRecordsAdd($inputs){

        /*$this->db->select('*');
        $this->db->from('foundation_order_plan_records');
        $this->db->where('ToolId', $inputs['inputToolId']);
        $this->db->where('ValuerId', $inputs['inputValuerId']);

        $insertId = 0;
        if ($this->db->get()->num_rows() > 0) {
            $this->db->select('*');
            $this->db->from('foundation_order_plan_records');
            $this->db->where('ToolId', $inputs['inputToolId']);
            $this->db->where('ValuerId', $inputs['inputValuerId']);
            $this->db->order_by('RecordId', 'ASC');
            $insertId = $this->db->get()->result_array()[0]['RecordId'];
        } else {*/
            $UserArray = array(
                'RecordTitle' => $inputs['inputRecordTitle'],
                'ToolId' => $inputs['inputToolId'],
                'TimeId' => $inputs['inputTimeId'],
                'PlanId' => $inputs['inputOrderPlanId'],
                'ValuerId' => $inputs['inputValuerId'],
                'CreateDateTime' => time()
            );
            $this->db->insert('foundation_order_plan_records', $UserArray);
            $insertId = $this->db->insert_id();
        /*}*/


        if(sizeof($inputs['inputPersonIds'])>1){
            foreach ($inputs['inputPersonIds'] as $pid) {
                $this->db->reset_query();
                $this->db->select('*');
                $this->db->from('foundation_order_plan_records');
                $this->db->join('foundation_order_plan_records_person' , 'foundation_order_plan_records_person.RecordId = foundation_order_plan_records.RecordId');
                $this->db->where('foundation_order_plan_records.ToolId', $inputs['inputToolId']);
                $this->db->where('foundation_order_plan_records.ValuerId', $inputs['inputValuerId']);
                $this->db->where('foundation_order_plan_records_person.PersonId', $pid);
                if ($this->db->get()->num_rows() == 0) {
                    $this->db->reset_query();
                    $UserArray = array(
                        'RecordId' => $insertId,
                        'PersonId' => $pid,
                        'CreateDateTime' => time()
                    );
                    $this->db->insert('foundation_order_plan_records_person', $UserArray);
                }
            }
        } else{
                $this->db->reset_query();
                $this->db->select('*');
                $this->db->from('foundation_order_plan_records');
                $this->db->join('foundation_order_plan_records_person' , 'foundation_order_plan_records_person.RecordId = foundation_order_plan_records.RecordId');
                $this->db->where('foundation_order_plan_records.ToolId', $inputs['inputToolId']);
                $this->db->where('foundation_order_plan_records.ValuerId', $inputs['inputValuerId']);
                $this->db->where('foundation_order_plan_records.PlanId', $inputs['inputOrderPlanId']);
                $this->db->where('foundation_order_plan_records_person.PersonId', $inputs['inputPersonIds'][0]);
                if ($this->db->get()->num_rows() == 0) {
                    $this->db->reset_query();
                    $UserArray = array(
                        'RecordId' => $insertId,
                        'PersonId' => $inputs['inputPersonIds'][0],
                        'CreateDateTime' => time()
                    );
                    $this->db->insert('foundation_order_plan_records_person', $UserArray);
                }  
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doPlanTableRecordsDelete($inputs)
    {
        $this->db->delete('foundation_order_plan_records', array(
            'RecordId' => $inputs['inputRecordId']
        ));
        $this->db->delete('foundation_order_plan_records_person', array(
            'RecordId' => $inputs['inputRecordId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function getScoresByRecordPersonId($recordId, $personId)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan_records_score');
        $this->db->join('foundation_order_model_options', 'foundation_order_model_options.OptionId = foundation_order_plan_records_score.OptionId');
        $this->db->where('RecordId', $recordId);
        $this->db->where('OrderPersonId', $personId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getScoresByRecordToolAbilityPersonId($recordId, $toolId, $abilityId, $personId)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan_records_score');
        $this->db->join('foundation_order_model_options', 'foundation_order_model_options.OptionId = foundation_order_plan_records_score.OptionId' , 'left');
        $this->db->where('RecordId', $recordId);
        $this->db->where('OrderPersonId', $personId);
        $this->db->where('ToolId', $toolId);
        $this->db->where('AbilityId', $abilityId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getValuerFinalScoresByRecordToolAbilityPersonId($recordId, $toolId, $abilityId, $personId)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan_records_ability_final_score');
        $this->db->where('RecordId', $recordId);
        $this->db->where('OrderPersonId', $personId);
        $this->db->where('ToolId', $toolId);
        $this->db->where('AbilityId', $abilityId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function getPersonAllScoresToolsByPersonId($personId)
    {
        $this->db->select('foundation_order_plan_records_score.ToolId , foundation_order_tools.ToolTitle');
        $this->db->from('foundation_order_plan_records_score');
        $this->db->join('foundation_order_tools', 'foundation_order_plan_records_score.ToolId = foundation_order_tools.ToolId');
        $this->db->where('foundation_order_plan_records_score.OrderPersonId', $personId);
        $this->db->group_by('foundation_order_plan_records_score.ToolId');
        return $this->db->get()->result_array();
    }
    public function getPersonAllScoresAbilityByToolPersonId($toolId, $personId)
    {
        $this->db->select('foundation_order_plan_records_score.AbilityId , foundation_order_model_ability.AbilityTitle');
        $this->db->from('foundation_order_plan_records_score');
        $this->db->join('foundation_order_model_ability', 'foundation_order_plan_records_score.AbilityId = foundation_order_model_ability.AbilityId');
        $this->db->where('foundation_order_plan_records_score.OrderPersonId', $personId);
        $this->db->where('foundation_order_plan_records_score.ToolId', $toolId);
        $this->db->group_by('foundation_order_plan_records_score.AbilityId');
        return $this->db->get()->result_array();
    }
    public function getPersonAllScoresMarkerByAbilityPersonId($toolId, $abilityId, $personId)
    {
        $this->db->select('*');
        $this->db->from('foundation_order_plan_records_score');
        $this->db->join('foundation_order_model_ability_marker', 'foundation_order_plan_records_score.MarkerId = foundation_order_model_ability_marker.MarkerId');
        $this->db->join('foundation_order_model_ability', 'foundation_order_plan_records_score.AbilityId = foundation_order_model_ability.AbilityId');
        $this->db->join('foundation_order_model_options', 'foundation_order_plan_records_score.OptionId = foundation_order_model_options.OptionId');
        $this->db->where('foundation_order_plan_records_score.OrderPersonId', $personId);
        $this->db->where('foundation_order_plan_records_score.AbilityId', $abilityId);
        $this->db->where('foundation_order_plan_records_score.ToolId', $toolId);
        return $this->db->get()->result_array();
    }
    public function getFinalScoresByToolAbilityPersonId($toolId, $abilityId, $personId){
        $this->db->select('PlanManagerAVGScore');
        $this->db->from('foundation_order_plan_records_ability_final_score');
        $this->db->where('OrderPersonId', $personId);
        $this->db->where('AbilityId', $abilityId);
        $this->db->where('ToolId', $toolId);
       $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return array();
        }
    }
    public function doRegisterScore($inputs){
        $this->db->delete('foundation_order_plan_records_score', array(
            'RecordId' => $inputs['inputData'][0]['inputRecordId'],
            'OrderPersonId' => $inputs['inputData'][0]['inputPersonId'],
        ));
        foreach ($inputs['inputData'] as $item) {
            if($item['inputOptionId'] != '') {
                $UserArray = array(
                    'RecordId' => $item['inputRecordId'],
                    'ToolId' => $item['inputToolId'],
                    'AbilityId' => $item['inputAbilityId'],
                    'MarkerId' => $item['inputMarkerId'],
                    'OptionId' => $item['inputOptionId'],
                    'Description' => $item['inputDescription'],
                    /*'ValuerLastScore' => $item['inputValuerLastScore'],*/
                    'OrderPersonId' => $item['inputPersonId'],
                    'CreateDateTime' => time()
                );
                $this->db->insert('foundation_order_plan_records_score', $UserArray);
            }
        }


        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doRegisterValuerFinalScore($inputs)
    {
        $this->db->delete('foundation_order_plan_records_ability_final_score', array(
            'RecordId' => $inputs['inputRecordId'],
            'ToolId' => $inputs['inputToolId'],
            'AbilityId' => $inputs['inputAbilityId'],
            'OrderPersonId' => $inputs['inputPersonId']
        ));
        $UserArray = array(
            'RecordId' => $inputs['inputRecordId'],
            'ToolId' => $inputs['inputToolId'],
            'AbilityId' => $inputs['inputAbilityId'],
            'OrderPersonId' => $inputs['inputPersonId'],
            'ValuerAVGScore' => $inputs['inputValuerAVGScore'],
            'ValuerPersonId' => $inputs['ValuerPersonId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_plan_records_ability_final_score', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDeleteRegisterScore($inputs){

        $this->db->delete('foundation_order_plan_records_score', array(
            'RecordId' => $inputs['inputRecordId'],
            'ToolId' => $inputs['inputToolId'],
            'OrderPersonId' => $inputs['inputPersonId'],
        ));
        return $this->config->item('DBMessages')['SuccessAction'];
    }
    public function doRegisterScoreForExcell($inputs)
    {

        $this->db->delete('foundation_order_plan_records_score', array(
            'MarkerId' => $inputs['MarkerId'],
            'AbilityId' => $inputs['AbilityId'],
            'ToolId' => $inputs['ToolId'],
            'OrderPersonId' => $inputs['PersonId'],
        ));
        $UserArray = array(
            'RecordId' => $inputs['RecordId'],
            'ToolId' => $inputs['ToolId'],
            'AbilityId' => $inputs['AbilityId'],
            'MarkerId' => $inputs['MarkerId'],
            'OptionId' => $inputs['OptionId'],
            'Description' => $inputs['Description'],
            'OrderPersonId' => $inputs['PersonId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_order_plan_records_score', $UserArray);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doRegisterWashUpScore($inputs){
        $UserArray = array('PlanManagerAVGScore' => $inputs['inputPlanManagerScore']);
        $this->db->where('AbilityId', $inputs['inputAbilityId']);
        $this->db->where('OrderPersonId', $inputs['inputPersonId']);
        $this->db->update('foundation_order_plan_records_ability_final_score', $UserArray);
        return $this->config->item('DBMessages')['SuccessAction'];
    }
    public function doEndScoring($inputs)
    {

        $UserArray = array(
            'IsFinished' => 1
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
    public function doStartScoring($inputs)
    {

        $UserArray = array(
            'IsFinished' => 0
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
    public function getToolComponent($toolId)
    {
        $this->db->select('*');
        $this->db->from('foundation_components');
        $this->db->where('ToolId', $toolId);
        return $this->db->get()->result_array();
    }
    public function getComponentByComponentTitle($title)
    {
        $this->db->select('*');
        $this->db->from('foundation_components');
        $this->db->where('ComponentTitle', $title);
        return $this->db->get()->result_array();
    }
    public function doAddToolComponent($componentTitle, $description, $toolId)
    {

        $this->db->trans_start();
        $UserArray = array(
            'ComponentTitle' => $componentTitle,
            'Description' => $description,
            'ToolId' => $toolId,
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_components', $UserArray);
        $insertId = $this->db->insert_id();

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDeleteComponent($inputs)
    {
        $this->db->delete('foundation_components', array(
            'ComponentId' => $inputs['inputComponentId']
        ));
        return $this->config->item('DBMessages')['SuccessAction'];
    }
    public function getComponentMarkerRelationByToolId($toolId)
    {
        $this->db->select('*');
        $this->db->from('foundation_components_markers');
        $this->db->join('foundation_components', 'foundation_components.ComponentId = foundation_components_markers.ComponentId');
        $this->db->where('foundation_components_markers.ToolId', $toolId);
        return $this->db->get()->result_array();
    }
    public function getComponentMarkerRelationByComponentId($componentId)
    {
        $this->db->select('*');
        $this->db->from('foundation_components_markers');
        $this->db->join('foundation_components', 'foundation_components.ComponentId = foundation_components_markers.componentId');
        $this->db->join('foundation_order_model_ability_marker', 'foundation_order_model_ability_marker.MarkerId = foundation_components_markers.MarkerId');
        $this->db->where('foundation_components_markers.ComponentId', $componentId);
        return $this->db->get()->result_array();
    }
    public function doAddComponentMarkerRelation($inputs)
    {
        $this->db->trans_start();
        $UserArray = array(
            'MarkerId' => $inputs['inputAbilityMarker'],
            'AbilityId' => $inputs['inputAbilityId'],
            'ToolId' => $inputs['inputToolId'],
            'ComponentId' => $inputs['inputComponentId'],
            'Weight' => $inputs['inputWeight'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_components_markers', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDeleteComponentMarker($inputs)
    {
        $this->db->delete('foundation_components_markers', array(
            'RowId' => $inputs['inputRowId']
        ));
        return $this->config->item('DBMessages')['SuccessAction'];
    }
    public function getAbilityAvg($abilityId)
    {
        $this->db->select('AVG(PlanManagerAVGScore) as AVG');
        $this->db->from('foundation_order_plan_records_ability_final_score');
        $this->db->where('AbilityId', $abilityId);
        return $this->db->get()->result_array();
    }
    public function getAbilityMax($abilityId)
    {
        $this->db->select('MAX(PlanManagerAVGScore) as MAX');
        $this->db->from('foundation_order_plan_records_ability_final_score');
        $this->db->where('AbilityId', $abilityId);
        return $this->db->get()->result_array();
    }
    public function getAbilityMin($abilityId)
    {
        $this->db->select('MIN(PlanManagerAVGScore) as MIN');
        $this->db->from('foundation_order_plan_records_ability_final_score');
        $this->db->where('AbilityId', $abilityId);
        return $this->db->get()->result_array();
    }
    public function doChangeWashUpScore($inputs){
        $UserArray = array( 'OptionId' => $inputs['inputNewOptionId']);
        $this->db->where('RecordId', $inputs['inputRecordId']);
        $this->db->where('ToolId', $inputs['inputToolId']);
        $this->db->where('AbilityId', $inputs['inputAbilityId']);
        $this->db->where('MarkerId', $inputs['inputMarkerId']);
        $this->db->where('OrderPersonId', $inputs['inputPersonId']);
        //$this->db->where('OptionId', $inputs['inputOptionId']);
        $this->db->update('foundation_order_plan_records_score', $UserArray);
        return $this->config->item('DBMessages')['SuccessAction'];
    }
    public function doApplyCoefficient($inputs){
        $UserArray = array( 'OptionId' => $inputs['OptionNewId']);
        $this->db->where('ToolId', $inputs['ToolId']);
        $this->db->where('AbilityId', $inputs['AbilityId']);
        $this->db->where('MarkerId', $inputs['MarkerId']);
        $this->db->where('OptionId', $inputs['OptionId']);
        $this->db->where('OrderPersonId', $inputs['OrderPersonId']);
        $this->db->update('foundation_order_plan_records_score',$UserArray);
        return $this->config->item('DBMessages')['SuccessAction'];
    }
    public function getPersonToolsScore($inputs){
        $this->db->select('*');
        $this->db->from('foundation_order_plan_records_score');
        $this->db->where('ToolId', $inputs['ToolId']);
        $this->db->where('OrderPersonId', $inputs['PersonId']);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return "yes";
        } else{
            return "no";
        }
    }
}
?>