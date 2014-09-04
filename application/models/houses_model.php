<?php

class Houses_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // <editor-fold defaultstate="collapsed" desc="/*************House Details *************/">
    public function get_house_by_id($id) {
        $this->db->select('*');
        $this->db->from('house');
        $this->db->where('house_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_house_number() {
        $this->db->select('*');
        $this->db->from('house');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_houses($search_string = null, $limit_start, $limit_end) {

        $this->db->select('*');
//		$this->db->select('house.description');
//		$this->db->select('house.stock');
//		$this->db->select('house.cost_price');
//		$this->db->select('house.sell_price');
//		$this->db->select('house.manufacture_id');
        //$this->db->select('manufacturers.name as manufacture_name');
        $this->db->from('house');
//		if($manufacture_id != null && $manufacture_id != 0){
//			$this->db->where('manufacture_id', $manufacture_id);
//		}
        if ($search_string) {
            $this->db->like('house_address', $search_string);
        }

//		$this->db->join('manufacturers', 'houses.manufacture_id = manufacturers.id', 'left');
//
//		$this->db->group_by('houses.id');
//		if($order){
//			$this->db->order_by($order, $order_type);
//		}else{
//		    $this->db->order_by('id', $order_type);
//		}


        $this->db->limit($limit_start, $limit_end);
        //$this->db->limit('4', '4');


        $query = $this->db->get();
        $this->db->last_query();
        return $query->result_array();
    }

    function count_houses($search_string = null) {
        $this->db->select('*');
        $this->db->from('house');

        if ($search_string) {
            $this->db->like('house_address', $search_string);
        }

        $query = $this->db->get();
        //ECHO $this->db->last_query();
        return $query->num_rows();
    }

    function addhouse($data) {
        $insert = $this->db->insert('house', $data);
        return $insert;
    }

    function update_house($id, $data) {
        $this->db->where('house_id', $id);
        $this->db->update('house', $data);
        $report = array();
        //echo $this->db->last_query();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete_house($id) {
        $this->db->where('house_id', $id);
        $this->db->delete('house');
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="/*************House Rent Details *************/">
    public function get_house_rent_by_id($id) {
        $this->db->select('house_rent.*,house.house_no,house.house_address');
        $this->db->from('house_rent');
        $this->db->join('house', 'house.house_id = house_rent.house_id', 'left');
        $this->db->where('houserent_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_rents($search_string = null, $limit_start, $limit_end) {

        $this->db->select('house_rent.*,house.house_no,house.house_address');
//		$this->db->select('house.description');
//		$this->db->select('house.stock');
//		$this->db->select('house.cost_price');
//		$this->db->select('house.sell_price');
//		$this->db->select('house.manufacture_id');
        //$this->db->select('manufacturers.name as manufacture_name');
        $this->db->from('house_rent');
//		if($manufacture_id != null && $manufacture_id != 0){
//			$this->db->where('manufacture_id', $manufacture_id);
//		}
        if ($search_string) {
            $this->db->like('account_holder', $search_string);
            $this->db->or_like('house_address', $search_string);
        }

        $this->db->join('house', 'house_rent.house_id = house.house_id', 'left');
//
//		$this->db->group_by('houses.id');
//		if($order){
//			$this->db->order_by($order, $order_type);
//		}else{
//		    $this->db->order_by('id', $order_type);
//		}


        $this->db->limit($limit_start, $limit_end);
        //$this->db->limit('4', '4');


        $query = $this->db->get();
        //echo "<br><br><br>".$this->db->last_query();
        return $query->result_array();
    }

    function count_rents($search_string = null) {
        $this->db->select('*');
        $this->db->from('house_rent');

        if ($search_string) {
            $this->db->like('account_holder', $search_string);
        }

        $query = $this->db->get();
        //ECHO $this->db->last_query();
        return $query->num_rows();
    }

    function addhouserent($data) {
        $insert = $this->db->insert('house_rent', $data);
        //echo $this->db->last_query(); exit;
        return $insert;
    }

    function update_rent($id, $data) {
        $this->db->where('houserent_id', $id);
        $this->db->update('house_rent', $data);
        $report = array();
        $this->db->last_query();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }
    function delete_house_rent($id) {
        $this->db->where('houserent_id', $id);
        $this->db->delete('house_rent');
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="/*************House Room Details *************/">
    public function get_house_room_by_id($id) {
        $this->db->select('*');
        $this->db->from('house_room');
        $this->db->join('house', 'house.house_id = house_room.house_id', 'left');
        $this->db->where('room_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_rooms($search_string = null, $limit_start, $limit_end) {

        $this->db->select('*');
        $this->db->from('house_room');
        if ($search_string) {
            $this->db->like('account_holder', $search_string);
            $this->db->or_like('house_address', $search_string);
        }
        $this->db->join('house', 'house_room.house_id = house.house_id', 'left');
        $this->db->limit($limit_start, $limit_end);
        $query = $this->db->get();
        //echo "<br><br><br>".$this->db->last_query();
        return $query->result_array();
    }

    function count_rooms($search_string = null) {
        $this->db->select('*');
        $this->db->from('house_room');
        if ($search_string) {
            $this->db->like('account_holder', $search_string);
        }
        $query = $this->db->get();
        //ECHO $this->db->last_query();
        return $query->num_rows();
    }

    function addhouseroom($data) {
        $insert = $this->db->insert('house_room', $data);
        return $insert;
    }

    function update_room($id, $data) {
        $this->db->where('room_id', $id);
        $this->db->update('house_room', $data);
        $report = array();
        //echo $this->db->last_query();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }
 function delete_room($id) {
        $this->db->where('room_id', $id);
        $this->db->delete('house_room');
    }
// </editor-fold>
}

