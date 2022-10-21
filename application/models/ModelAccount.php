<?php
class ModelAccount extends CI_Model{
    public function doLogin($inputs){
        $this->db->select('*');
        $this->db->from('person');
        $this->db->where(array('UserName' => $inputs['inputUserName']));
        $this->db->where(array('Password' => md5($inputs['inputPassword'])));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array()[0];
            $personId = $result['PersonId'];
            $LoginInfo['PersonInfo'] = $this->ModelPerson->getPersonById($personId)[0];
            $LoginInfo['PersonId'] = $result['PersonId'];
            $this->session->set_userdata('IsLogged', TRUE);
            $this->session->set_userdata('LoginInfo', $LoginInfo);
            $UserArray = array(
                'CreatorPersonId' => $result['PersonId'],
                'CreatorUserName' =>$inputs['inputUserName'],
                'IsSuccess' => 1,
                'CreateDateTime' => time()
            );
            loginRecord($UserArray);
            $arr = array(
                'type' => "green",
                'content' => "ورود با موفقیت انجام شد",
                'success' => true
            );
            return $arr;
        }
        $UserArray = array(
            'CreatorPersonId' => 0,
            'CreatorUserName' =>$inputs['inputUserName'],
            'IsSuccess' => 0,
            'CreateDateTime' => time()
        );
        loginRecord($UserArray);
        $arr = array(
            'type' => "red",
            'content' => "اطلاعات نامعتبر است",
            'success' => false
        );
        return $arr;
    }
}
?>