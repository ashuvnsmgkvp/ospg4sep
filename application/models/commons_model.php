<?php

class Commons_model extends CI_Model {

    /**
     * Responsable for auto load the database
     * @return void
     */
    public function __construct() {
        $this->load->database();
    }
// <editor-fold defaultstate="collapsed" desc="/*************Bank Details *************/">
    public function get_bank_by_id($id) {
        $this->db->select('*');
        $this->db->from('bank_details');
        $this->db->where('bank_id', $id);
        $query = $this->db->get();
        echo $this->db->last_query();
        return $query->result_array();
    }
public function get_bank_by_house_id($id) {
        $this->db->select('bank_name,account_holder');
        $this->db->from('bank_details');
        $this->db->where('house_id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    
    public function get_banks($search_string = null) {

        $this->db->select('*');
        $this->db->from('bank_details');

        if ($search_string) {
            $this->db->like('description', $search_string);
        }

        $query = $this->db->get();
        //echo "<br><br><br><br><br>".$this->db->last_query();
        return $query->result_array();
    }

    function count_banks($search_string = null) {
        $this->db->select('*');
        $this->db->from('bank_details');
//		if($manufacture_id != null && $manufacture_id != 0){
//			$this->db->where('manufacture_id', $manufacture_id);
//		}
        if ($search_string) {
            $this->db->like('description', $search_string);
        }
//		if($order){
//			$this->db->order_by($order, 'Asc');
//		}else{
//		    $this->db->order_by('id', 'Asc');
//		}
        $query = $this->db->get();
        return $query->num_rows();
    }

    function addbank($data) {
        $insert = $this->db->insert('bank_details', $data);
        return $insert;
    }

    function update_bank($id, $data) {
        $this->db->where('bank_id', $id);
        $this->db->update('bank_details', $data);
        //echo $this->db->last_query();  
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete_bank($id) {
        $this->db->where('bank_id', $id);
        $this->db->delete('bank_details');
    }
// </editor-fold >
}

