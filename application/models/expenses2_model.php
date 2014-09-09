<?php
class Expenses2_model extends CI_Model {
 
  
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
    public function get_house_number()
    {
		$this->db->select('*');
		$this->db->from('house');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get house by his is
    * @param int $house_id 
    * @return array
    */
    public function get_house_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('houses');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch houses data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_houses($manufacture_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
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
//		if($search_string){
//			$this->db->like('description', $search_string);
//		}

//		$this->db->join('manufacturers', 'houses.manufacture_id = manufacturers.id', 'left');
//
//		$this->db->group_by('houses.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		//echo 'ashu'.$this->db->last_query();
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_houses($manufacture_id=null, $search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('houses');
		if($manufacture_id != null && $manufacture_id != 0){
			$this->db->where('manufacture_id', $manufacture_id);
		}
		if($search_string){
			$this->db->like('description', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
   // <editor-fold defaultstate="collapsed" desc="/*************Monthaly Expense*************/">
    function count_mexp($search_string = null) {
        $this->db->select('*');
        $this->db->from('manthly_expense');

//        if ($search_string) {
//            $this->db->like('employee_name', $search_string);
//        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_mexp($search_string = null) {

        $this->db->select('*');
        $this->db->from('manthly_expense');
        $this->db->join('house', 'house.house_id = manthly_expense.house_id', 'left');

//        if ($search_string) {
//            $this->db->like('employee_name', $search_string);
//        }

        $query = $this->db->get();
        //echo "<br><br><br><br><br>".$this->db->last_query();
        return $query->result_array();
    }

    public function get_mexp_by_id($id) {
        $this->db->select('*');
        $this->db->from('manthly_expense');
        $this->db->where('mexp_id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    function add_mexp($data) {
        $insert = $this->db->insert('manthly_expense', $data);
        return $insert;
    }

    function update_mexp($id, $data) {
        $this->db->where('mexp_id', $id);
        $this->db->update('manthly_expense', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete_mexp($id) {
        $this->db->where('mexp_id', $id);
        $this->db->delete('manthly_expense');
    }

    // </editor-fold>

   // <editor-fold defaultstate="collapsed" desc="/*************Daily Expense*************/">
    function count_dexp($search_string = null) {
        $this->db->select('*');
        $this->db->from('daily_expense');

//        if ($search_string) {
//            $this->db->like('employee_name', $search_string);
//        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_dexp($search_string = null) {

        $this->db->select('*');
        $this->db->from('daily_expense');
        $this->db->join('house', 'house.house_id = daily_expense.house_id', 'left');
        $this->db->join('expense_head', 'expense_head.head_id = daily_expense.head', 'left');

//        if ($search_string) {
//            $this->db->like('employee_name', $search_string);
//        }

        $query = $this->db->get();
        //echo "<br><br><br><br><br>".$this->db->last_query();
        return $query->result_array();
    }

    public function get_dexp_by_id($id) {
        $this->db->select('*');
        $this->db->from('daily_expense');
        $this->db->where('dexp_id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    function add_dexp($data) {
        $insert = $this->db->insert('daily_expense', $data);
        return $insert;
    }

    function update_dexp($id, $data) {
        $this->db->where('dexp_id', $id);
        $this->db->update('daily_expense', $data);
        //echo $this->db->last_query();exit;
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete_dexp($id) {
        $this->db->where('dexp_id', $id);
        $this->db->delete('daily_expense');
    }
function get_expense_type_byhead($exp_head='')
{
     $CI = & get_instance();
                $CI->db->select('*');
                $CI->db->from('expense_type');
                $CI->db->where("exp_type", $exp_head);
                $query = $CI->db->get();
//echo $CI->db->last_query();
                if ($query->num_rows() > 0) {
                    $type = array();
                    $type['0']='--Select--';
                    foreach ($query->result('array') as $key => $row) {//$row['col1']
                        $type[$row['type_id']] = $row['type_name'];
                    }
                    //print_r($type);
                    return $type;
                }
                else
                    return NULL;
}
    // </editor-fold>  

   // <editor-fold defaultstate="collapsed" desc="/*************annual Expense*************/">
    function count_aexp($search_string = null) {
        $this->db->select('*');
        $this->db->from('annual_expense');

//        if ($search_string) {
//            $this->db->like('employee_name', $search_string);
//        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_aexp($search_string = null) {

        $this->db->select('*');
        $this->db->from('annual_expense');
        $this->db->join('house', 'house.house_id = annual_expense.house_id', 'left');

//        if ($search_string) {
//            $this->db->like('employee_name', $search_string);
//        }

        $query = $this->db->get();
        //echo "<br><br><br><br><br>".$this->db->last_query();
        return $query->result_array();
    }

    public function get_aexp_by_id($id) {
        $this->db->select('*');
        $this->db->from('annual_expense');
        $this->db->where('aexp_id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    function add_aexp($data) {
        $insert = $this->db->insert('annual_expense', $data);
        $this->db->last_query();
        return $insert;
    }

    function update_aexp($id, $data) {
        $this->db->where('aexp_id', $id);
        $this->db->update('annual_expense', $data);
        //echo $this->db->last_query();exit;
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete_aexp($id) {
        $this->db->where('aexp_id', $id);
        $this->db->delete('annual_expense');
    }

    // </editor-fold>
    
   // <editor-fold defaultstate="collapsed" desc="/*************Inventory*************/">
    function count_inventory($search_string = null) {
        $this->db->select('*');
        $this->db->from('inventory');

//        if ($search_string) {
//            $this->db->like('employee_name', $search_string);
//        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_inventory($search_string = null) {

        $this->db->select('*');
        $this->db->from('inventory');
        $this->db->join('house', 'house.house_id = inventory.house_id', 'left');

//        if ($search_string) {
//            $this->db->like('employee_name', $search_string);
//        }

        $query = $this->db->get();
        //echo "<br><br><br><br><br>".$this->db->last_query();
        return $query->result_array();
    }

    public function get_inventory_by_id($id) {
        $this->db->select('*');
        $this->db->from('inventory');
        $this->db->where('inv_id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    function add_inventory($data) {
        $insert = $this->db->insert('inventory', $data);
        $this->db->last_query();
        return $insert;
    }

    function update_inventory($id, $data) {
        $this->db->where('inv_id', $id);
        $this->db->update('inventory', $data);
        //echo $this->db->last_query();exit;
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete_inventory($id) {
        $this->db->where('inv_id', $id);
        $this->db->delete('inventory');
    }

    // </editor-fold>
   
   // <editor-fold defaultstate="collapsed" desc="/*************Salary*************/">
    function count_salaries($search_string = null) {
        $this->db->select('*');
        $this->db->from('salary_details');

        if ($search_string) {
            $this->db->like('employee_name', $search_string);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_salaries($search_string = null, $limit_start, $limit_end) {

        $this->db->select('*');
        $this->db->from('salary_details');
        $this->db->join('house', 'house.house_id = salary_details.house_id', 'left');

        if ($search_string) {
            $this->db->like('employee_name', $search_string);
        }
         $this->db->limit($limit_start, $limit_end);
        $query = $this->db->get();
        //echo "<br><br><br><br><br>".$this->db->last_query();
        return $query->result_array();
    }
 public function get_salary_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('salary_details');
		$this->db->where('salary_id', $id);
		$query = $this->db->get();
               // echo $this->db->last_query();
		return $query->result_array(); 
    }
    function addsalary($data) {
        $insert = $this->db->insert('salary_details', $data);
        return $insert;
    }
function update_salary($id, $data)
    {
		$this->db->where('salary_id', $id);
		$this->db->update('salary_details', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
        function delete_salary($id) {
        $this->db->where('salary_id', $id);
        $this->db->delete('salary_details');
       // echo $this->db->last_query();
    }

    // </editor-fold>
    
   // <editor-fold defaultstate="collapsed" desc="/*************Employee*************/">
    function count_employee($search_string = null) {
        $this->db->select('*');
        $this->db->from('employee');

        if ($search_string) {
            $this->db->like('employee_name', $search_string);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_employee($search_string = null) {

        $this->db->select('*');
        $this->db->from('employee');
        $this->db->join('house', 'house.house_id = employee.house_id', 'left');

        if ($search_string) {
            $this->db->like('employee_name', $search_string);
        }

        $query = $this->db->get();
        //echo "<br><br><br><br><br>".$this->db->last_query();
        return $query->result_array();
    }
 public function get_employee_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('emp_id', $id);
		$query = $this->db->get();
               // echo $this->db->last_query();
		return $query->result_array(); 
    }
    function addemployee($data) {
        $insert = $this->db->insert('employee', $data);
        return $insert;
    }
function update_employee($id, $data)
    {
		$this->db->where('emp_id', $id);
		$this->db->update('employee', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
        function delete_employee($id) {
        $this->db->where('emp_id', $id);
        $this->db->delete('employee');
       // echo $this->db->last_query();
    }

    // </editor-fold>
    function addhouserent($data)
    {
		$insert = $this->db->insert('house_rent', $data);
	    return $insert;
	}
         function addhouseroom($data)
    {
		$insert = $this->db->insert('house_room', $data);
	    return $insert;
	}
    /**
    * Update house
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_house($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('houses', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete house
    * @param int $id - house id
    * @return boolean
    */
	function delete_house($id){
		$this->db->where('id', $id);
		$this->db->delete('houses'); 
	}
 
 
}
	
