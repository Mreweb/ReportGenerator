<?php
class ModelProfile extends CI_Model{
    public function doUpdateProfile($inputs)
    {
        $Array = array(
            'Password' => md5($inputs['inputNewPassword'])
        );
        $this->db->trans_start();
        $this->db->where('PersonId', $inputs['personId']);
        $this->db->update('person', $Array);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $this->config->item('DBMessages')['ErrorAction'];
        }
        else {
            return $this->config->item('DBMessages')['SuccessAction'];
        }
    }
}
?>