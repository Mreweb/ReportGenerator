<?php
class ModelCustomer extends CI_Model
{
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('foundation_customer');
        $this->db->order_by('CustomerId', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get($inputs)
    {
        $limit = $inputs['pageIndex'];
        $start = ($limit - 1) * $this->config->item('defaultPageSize');
        $end = $this->config->item('defaultPageSize');
        $this->db->select('*');
        $this->db->from('foundation_customer');
        $this->db->join('foundation', 'foundation.FoundationId = foundation_customer.FoundationId');
        if (isset($inputs['inputCustomerTitle']) && $inputs['inputCustomerTitle'] != '') {
            $this->db->like('CustomerTitle', $inputs['inputCustomerTitle']);
        }
        $this->db->where('foundation.FoundationId', $inputs['FoundationId']);
        $this->db->order_by('CustomerId', 'DESC');
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

    public function getByCustomerId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_customer');
        $this->db->where('CustomerId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0];
        }
        return array();
    }
    public function getFilesByCustomerId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_customer_docs');
        $this->db->where('CustomerId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    public function getByFoundationId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_customer');
        $this->db->where('FoundationId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    public function getAdminByCustomerId($id)
    {
        $this->db->select('*');
        $this->db->from('foundation_customer_admin');
        $this->db->join('person', 'person.PersonId = foundation_customer_admin.PersonId');
        $this->db->where('CustomerId', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    public function doAdd($inputs)
    {
        $UserArray = array(
            'CustomerTitle' => $inputs['inputCustomerTitle'],
            'CustomerAddress' => $inputs['inputCustomerAddress'],
            'Description' => $inputs['inputDescription'],
            'FoundationId' => $inputs['FoundationId'],
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_customer', $UserArray);
        $customerId = $this->db->insert_id();

        $UserArray = array(
            'PersonId' => $inputs['inputPersonId'],
            'CustomerId' => $customerId,
            'CreateDateTime' => time()
        );
        $this->db->insert('foundation_customer_admin', $UserArray);

        if ($inputs['inputDescriptionFile'] != '') {
            $UserArray = array(
                'CustomerId' => $customerId,
                'File' => $inputs['inputDescriptionFile'],
                'CreateDateTime' => time()
            );
            $this->db->insert('foundation_customer_docs', $UserArray);
        }


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
            'CustomerTitle' => $inputs['inputCustomerTitle'],
            'CustomerAddress' => $inputs['inputCustomerAddress'],
            'Description' => $inputs['inputDescription'],
            'FoundationId' => $inputs['FoundationId'],
            'CreateDateTime' => time()
        );
        $this->db->where('CustomerId', $inputs['inputCustomerId']);
        $this->db->where('FoundationId', $inputs['FoundationId']);
        $this->db->update('foundation_customer', $UserArray);


        if ($inputs['inputDescriptionFile'] != '') {
            $UserArray = array(
                'CustomerId' => $inputs['inputCustomerId'],
                'File' => $inputs['inputDescriptionFile'],
                'CreateDateTime' => time()
            );
            $this->db->insert('foundation_customer_docs', $UserArray);
        }


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
        $this->db->delete('foundation_customer', array(
            'CustomerId' => $inputs['inputCustomerId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
    public function doDeleteFile($inputs)
    {
        $this->db->trans_start();
        $this->db->delete('foundation_customer_docs', array(
            'RowId' => $inputs['inputRowId']
        ));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        } else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }

    public function doEditCustomerAdmin($inputs)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('foundation_customer_admin');
        $this->db->where('CustomerId', $inputs['inputCustomerId']);
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


    public function getOrdersByCustomerId($inputs)
    {
        $limit = $inputs['pageIndex'];
        $start = ($limit - 1) * $this->config->item('defaultPageSize');
        $end = $this->config->item('defaultPageSize');
        $this->db->select('* , foundation_order.IsActive as orderIsActive');
        $this->db->from('foundation_order');
        $this->db->join('foundation_customer', 'foundation_customer.CustomerId = foundation_order.CustomerId');
        $this->db->join('foundation', 'foundation.FoundationId = foundation_order.FoundationId');
        if (isset($inputs['inputOrderTitle']) && $inputs['inputOrderTitle'] != '') {
            $this->db->like('OrderTitle', $inputs['inputOrderTitle']);
        }
        $this->db->where('foundation_order.CustomerId', $inputs['CustomerId']);
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



}
?>