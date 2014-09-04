<?php

class Guests_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // <editor-fold defaultstate="collapsed" desc="/*************Guest *************/">
    public function get_guest_by_id($id) {
        $this->db->select('guest_details.*,house_room.room_id,house_room.room_no');
        $this->db->from('guest_details');
        $this->db->join('house', 'house.house_id = guest_details.house_id', 'left');
        $this->db->join('house_room', 'house_room.room_id = guest_details.room_id', 'left');
        $this->db->where('guest_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guests($search_string = null, $order = null, $order_type = 'Asc', $limit_start, $limit_end) {
        $this->db->select('guest_details.*,house.house_no,house_room.room_no');
        $this->db->from('guest_details');
        $this->db->join('house', 'house.house_id = guest_details.house_id', 'left');
        $this->db->join('house_room', 'house_room.room_id = guest_details.room_id', 'left');

        if ($search_string) {
            $this->db->like('guest_name', $search_string);
        }

        $query = $this->db->get();
        //echo "<br><br><br><br><br>".$this->db->last_query();
        return $query->result_array();
    }

    function count_guests($manufacture_id = null, $search_string = null, $order = null) {
        $this->db->select('*');
        $this->db->from('guest_details');
//		if($manufacture_id != null && $manufacture_id != 0){
//			$this->db->where('manufacture_id', $manufacture_id);
//		}
//		if($search_string){
//			$this->db->like('description', $search_string);
//		}
        if ($order) {
            $this->db->order_by($order, 'Asc');
        } else {
            $this->db->order_by('guest_id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function add_guest($data) {
        $insert = $this->db->insert('guest_details', $data);
        return $insert;
    }

    function update_guest($id, $data) {
        $this->db->where('guest_id', $id);
        $this->db->update('guest_details', $data);
       // echo $this->db->last_query(); exit;
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete_guest($id) {
        $this->db->where('guest_id', $id);
        $this->db->delete('guest_details');
    }

    function getsharetypebyhouseid($house_id = null) {
        $sql = "select share_type, case when share_type=1 then 'Single'
                when share_type=2 then 'Double'
                when share_type=3 then 'Triple'
                when share_type=4 then 'Four'
                when share_type=5 then 'Five'
                when share_type=6 then 'Six' end as sharetype FROM
                house_room
                WHERE
                house_id =  $house_id";

        $query = $this->db->query($sql);
        //  echo $this->db->last_query();

        $typeoption = array();
        $typeoption['0'] = '--Select--';
        foreach ($query->result() as $row) {
            $typeoption[$row->share_type] = $row->sharetype;
        }
        return $typeoption;
    }

    function getroomnobyhouseidandsharetype($house_id = null, $share_type = NULL) {
        $sql = "select room_id, room_no FROM house_room WHERE house_id =  $house_id AND share_type=$share_type";
        $query = $this->db->query($sql);
        $roomoption = array();
        $roomoption['0'] = '--Select--';
        foreach ($query->result() as $row) {
            $roomoption[$row->room_id] = $row->room_no;
        }
        return $roomoption;
    }

    // </editor-fold >
}

