<?php
class Signalactivity extends CI_Model{
    public function Update($data = array()){
        $Updatedata = array();
        $Updatedata = [
            'priority' => $data['signalA'],
        ];
        $this->db->where('signals','A');
        $this->db->update('tbl_priority',$Updatedata);

        $Updatedata = array();
        $Updatedata = [
            'priority' => $data['signalB'],
        ];
        $this->db->where('signals','B');
        $this->db->update('tbl_priority',$Updatedata);

        $Updatedata = array();
        $Updatedata = [
            'priority' => $data['signalC'],
        ];
        $this->db->where('signals','C');
        $this->db->update('tbl_priority',$Updatedata);

        $Updatedata = array();
        $Updatedata = [
            'priority' => $data['signalD'],
        ];
        $this->db->where('signals','D');
        $this->db->update('tbl_priority',$Updatedata);

        $Updatedata = array();
        $Updatedata = [
            'greenlight' => $data['greentime'],
        ];
        $this->db->update('tbl_priority',$Updatedata);

        $Updatedata = array();
        $Updatedata = [
            'yellowlight' => $data['yellowtime'],
        ];
        $this->db->update('tbl_priority',$Updatedata);
        return $this->db->affected_rows();
    }
    public function getdata($data = array()){
        $response = array();
		$response['status'] = false;
        
        $this->db->select('*');
        $this->db->from('tbl_priority');
        $this->db->order_by('priority');
        $query = $this->db->get();
        $result = $query->result();
        if($query->num_rows() >= 1){
            $response['status'] = true;
            $response['data'] = $result;
        }
        return json_encode($response);
    }
}
?>