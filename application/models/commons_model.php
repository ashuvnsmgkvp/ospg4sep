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
        //echo $this->db->last_query();
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

    
    public function get_banks($search_string = null, $limit_start, $limit_end) {

        $this->db->select('*');
        $this->db->from('bank_details');

        if ($search_string) {
            $this->db->like('account_holder', $search_string);
        }
$this->db->limit($limit_start, $limit_end);
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
            $this->db->like('account_holder', $search_string);
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
    // <editor-fold defaultstate="collapsed" desc="/*************Emp Details *************/">
    public function get_emp_by_id($id) {
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where('emp_id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function get_emp_by_house_id($id) {
        $this->db->select('emp_name,account_holder');
        $this->db->from('employee');
        $this->db->where('house_id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    
    public function get_emps($search_string = null, $limit_start, $limit_end) {

        $this->db->select('*');
        $this->db->from('employee');

        if ($search_string) {
            $this->db->like('emp_name', $search_string);
        }
        $this->db->limit($limit_start, $limit_end);
        $query = $this->db->get();
        //echo "<br><br><br><br><br>".$this->db->last_query();
        return $query->result_array();
    }

    function count_emps($search_string = null) {
        $this->db->select('*');
        $this->db->from('employee');
//		if($manufacture_id != null && $manufacture_id != 0){
//			$this->db->where('manufacture_id', $manufacture_id);
//		}
        if ($search_string) {
            $this->db->like('emp_name', $search_string);
        }
//		if($order){
//			$this->db->order_by($order, 'Asc');
//		}else{
//		    $this->db->order_by('id', 'Asc');
//		}
        $query = $this->db->get();
        return $query->num_rows();
    }

    function addemp($data) {
        $insert = $this->db->insert('employee', $data);
        return $insert;
    }

    function update_emp($id, $data) {
        $this->db->where('emp_id', $id);
        $this->db->update('employee', $data);
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

    function delete_emp($id) {
        $this->db->where('emp_id', $id);
        $this->db->delete('employee');
    }
// </editor-fold >
}

