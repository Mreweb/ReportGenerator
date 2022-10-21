<?php

class ModelPerson extends CI_Model{
    public function doAdd($inputs){
        $this->db->select('*');
        $this->db->from('person');
        if($inputs['inputPersonNationalCode'] != ''){
            $this->db->where('PersonNationalCode' , $inputs['inputPersonNationalCode']);
            $this->db->where('PersonNationalCode IS NOT NULL', NULL, FALSE);
        }
        $data = $this->db->get()->result_array();
        if (!empty($data)) {
            return $data[0]['PersonId'];
        } else {
            $userArray = array(
                'PersonFirstName' => $inputs['inputPersonFirstName'],
                'PersonLastName' => $inputs['inputPersonLastName'],
                'PersonNationalCode' => $inputs['inputPersonNationalCode'],
                'PersonPhone' => $inputs['inputPersonPhone'],
                'PersonCode' => $inputs['inputPersonCode'],
                'Username' => $inputs['inputUsername'],
                'Password' => md5($inputs['inputPassword'])
            );
            $this->db->insert('person', $userArray);
            return $this->db->insert_id();
        }
    }

    public function doEditByColumn($inputs)
    {
        $userArray = array(
            $inputs['inputColumn'] => $inputs['inputValue']
        );
        $this->db->where('PersonId', $inputs['inputPersonId']);
        $this->db->update('person', $userArray);

    }

    public function getPersonById($personId)
    {
        $this->db->select('*');
        $this->db->from('person');
        $this->db->where(array('PersonId' => $personId));
        return $this->db->get()->result_array();
    }

    public function getPersonByNationalCode($NationalCode)
    {
        $this->db->select('*');
        $this->db->from('person');
        $this->db->where(array('PersonNationalCode' => $NationalCode));
        $this->db->or_where(array('PersonCode' => $NationalCode));
        return $this->db->get()->result_array();
    }

    public function getPersonRolesById($personId)
    {
        $this->db->select('Role');
        $this->db->from('person_role');
        $this->db->where(array('PersonId' => $personId));
        return $this->db->get()->result_array();
    }

}

?>