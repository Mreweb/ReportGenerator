<?php
class ModelFoundation extends CI_Model{
    public function getAll(){
        $this->db->select('*');
        $this->db->from('foundation');
        $this->db->order_by('FoundationId', 'DESC');
        return $this->db->get()->result_array();
    }
    public function get($inputs){
        $limit = $inputs['pageIndex'];
        $start = ($limit - 1) * $this->config->item('defaultPageSize');
        $end = $this->config->item('defaultPageSize');
        $this->db->select('*');
        $this->db->from('foundation');
        if (isset($inputs['inputFoundationTitle']) && $inputs['inputFoundationTitle'] != '') {
            $this->db->like('FoundationTitle', $inputs['inputFoundationTitle']);
        }
        if (isset($inputs['inputIsActive']) && $inputs['inputIsActive'] != '') {
            $this->db->where('IsActive', $inputs['inputIsActive']);
        }
        $this->db->order_by('FoundationId', 'DESC');
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
    public function getByFoundationId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation');
        $this->db->where('FoundationId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function getAdminByFoundationId($id){
        $this->db->select('*');
        $this->db->from('foundation_admin');
        $this->db->join('person' , 'person.PersonId = foundation_admin.PersonId');
        $this->db->where('FoundationId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function doAdd($inputs){
        $UserArray = array(
            'FoundationTitle' => $inputs['inputFoundationTitle'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation', $UserArray);
        $foundationId = $this->db->insert_id();
        $UserArray = array(
            'PersonId' => $inputs['inputPersonId'],
            'FoundationId' => $foundationId,
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_admin', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        }
        else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doEdit($inputs){
        $this->db->trans_start();
        $UserArray = array(
            'FoundationTitle' => $inputs['inputFoundationTitle'],
            'IsActive' => $inputs['inputIsActive'],
            'CreateDateTime' => time()
        );
        $this->db->where('FoundationId', $inputs['inputFoundationId']);
        $this->db->update('foundation', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        }
        else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDelete($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation', array(
            'FoundationId' => $inputs['inputFoundationId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        }
        else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doEditFoundationAdmin($inputs){
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('foundation_admin');
        $this->db->where('FoundationId', $inputs['inputFoundationId']);
        $this->db->where('PersonId', $inputs['inputPersonId']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if (isset($inputs['inputPassword']) && trim($inputs['inputPassword'] != '')) {
                $UserArray = array(
                    'PersonFirstName' => $inputs['inputPersonFirstName'],
                    'PersonLastName' => $inputs['inputPersonLastName'],
                    'PersonPhone' => $inputs['inputPersonPhone'],
                    'PersonNationalCode' => $inputs['inputPersonNationalCode'],
                    'Username' => $inputs['inputUsername'],
                    'Password' => md5($inputs['inputPassword'])
                );
            } else {
                $UserArray = array(
                    'PersonFirstName' => $inputs['inputPersonFirstName'],
                    'PersonLastName' => $inputs['inputPersonLastName'],
                    'PersonPhone' => $inputs['inputPersonPhone'],
                    'PersonNationalCode' => $inputs['inputPersonNationalCode'],
                    'Username' => $inputs['inputUsername']
                );
            }
            $this->db->where('PersonId', $inputs['inputPersonId']);
            $this->db->update('person', $UserArray);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return $this->config->item('DBMessages')['ErrorAction'];
            } else {
                return $this->config->item('DBMessages')['SuccessAction'];
            }
        }
        return $this->config->item('DBMessages')['ErrorAction'];
    }

    /* Foundation Plan Manager */
    public function getFoundationAllPlanManager(){
        $this->db->select('*');
        $this->db->from('foundation_plan_manager');
        $this->db->join('person' , 'person.PersonId = foundation_plan_manager.PersonId');
        $this->db->join('foundation' , 'foundation.FoundationId = foundation_plan_manager.FoundationId');
        $this->db->order_by('ManagerId', 'DESC');
        return $this->db->get()->result_array();
    }
    public function getFoundationPlanManager($inputs){
        $limit = $inputs['pageIndex'];
        $start = ($limit - 1) * $this->config->item('defaultPageSize');
        $end = $this->config->item('defaultPageSize');
        $this->db->select('*');
        $this->db->from('foundation_plan_manager');
        $this->db->join('person' , 'person.PersonId = foundation_plan_manager.PersonId');
        $this->db->join('foundation' , 'foundation.FoundationId = foundation_plan_manager.FoundationId');
        if (isset($inputs['inputFoundationTitle']) && $inputs['inputFoundationTitle'] != '') {
            $this->db->like('FoundationTitle', $inputs['inputFoundationTitle']);
        }
        if (isset($inputs['inputPersonNationalCode']) && $inputs['inputPersonNationalCode'] != '') {
            $this->db->like('PersonNationalCode', $inputs['inputPersonNationalCode']);
        }
        $this->db->where_in('foundation.FoundationId',$inputs['FoundationIds']);
        $this->db->order_by('PlanManagerId', 'DESC');
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
    public function getFoundationPlanManagerByFoundationPlanManagerId($id){
        $this->db->select('*');
        $this->db->from('foundation_plan_manager');
        $this->db->join('person' , 'person.PersonId = foundation_plan_manager.PersonId');
        $this->db->where('PlanManagerId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    public function doAddFoundationPlanManager($inputs){
        $UserArray = array(
            'PersonId' => $inputs['inputPersonId'],
            'FoundationId' => $inputs['inputFoundationId'],
            'ManagerId' => $inputs['inputManagerId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_plan_manager', $UserArray);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        }
        else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doEditFoundationPlanManager($inputs){
        $this->db->trans_start();
        $UserArray = array(
            'FoundationId' => $inputs['inputFoundationId'],
            'ManagerId' => $inputs['inputManagerId'],
            'CreateDateTime' => time()
        );
        $this->db->where('PlanManagerId', $inputs['inputPlanManagerId']);
        $this->db->update('foundation_plan_manager', $UserArray);


        $this->db->select('*');
        $this->db->from('foundation_plan_manager');
        $this->db->where('PlanManagerId', $inputs['inputPlanManagerId']);
        $this->db->where('PersonId', $inputs['inputPersonId']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if (isset($inputs['inputPassword']) && trim($inputs['inputPassword'] != '')) {
                $UserArray = array(
                    'PersonFirstName' => $inputs['inputPersonFirstName'],
                    'PersonLastName' => $inputs['inputPersonLastName'],
                    'PersonPhone' => $inputs['inputPersonPhone'],
                    'PersonNationalCode' => $inputs['inputPersonNationalCode'],
                    'Username' => $inputs['inputUsername'],
                    'Password' => md5($inputs['inputPassword'])
                );
            }
            else {
                $UserArray = array(
                    'PersonFirstName' => $inputs['inputPersonFirstName'],
                    'PersonLastName' => $inputs['inputPersonLastName'],
                    'PersonPhone' => $inputs['inputPersonPhone'],
                    'PersonNationalCode' => $inputs['inputPersonNationalCode'],
                    'Username' => $inputs['inputUsername']
                );
            }
            $this->db->where('PersonId', $inputs['inputPersonId']);
            $this->db->update('person', $UserArray);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return $this->config->item('DBMessages')['ErrorAction'];
            } else {
                return $this->config->item('DBMessages')['SuccessAction'];
            }
        }
        return $this->config->item('DBMessages')['ErrorAction'];
    }
    public function doDeleteFoundationPlanManager($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_plan_manager', array(
            'PlanManagerId' => $inputs['inputPlanManagerId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        }
        else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    /* End Foundation Plan Manager */

}
?>