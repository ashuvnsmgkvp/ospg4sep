<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_house_number')) {
       function get_house_number() {
           $CI = & get_instance();
        
		$CI->db->select('*');
		$CI->db->from('house');
		$query = $CI->db->get();
               // echo $CI->db->last_query();
		//return $query->result_array(); 
    if ($query->num_rows() > 0) {
        return $query->result_array(); 
    
        }
        else
            return NULL;
    }
}

if (!function_exists('get_expense_head')) {
       function get_expense_head($head='') {//
$str_head="Gas Cylinder, Mali, Invertor, Laundry, Electricity, Plumber, Milk, Mishtri, Carpenter, Boring Pump, Painter, Kitchen Material, Rashan, CCTV, Invertor, Chimney, Stabilizer, FAN, Telephone Repair, Reddy/Thela, Autorikshaw,Almari, Table, Chair, Mattress, Bed, Bedsheet, Pillow, Pillow Cover, Kitchen Material, FAN, Cooler, AC,Food,Car,Bike,Scooty";
    
     $CI = & get_instance();
                $CI->db->select('*');
                $CI->db->from('expense_head');
                //$CI->db->where("exp_type", $head);
                $CI->db->where_in("exp_type", array('Daily Expe','Goods Purc','Food','Vehicle'));
                $query = $CI->db->get();

                if ($query->num_rows() > 0) {
                    $head = array();
                    
                    foreach ($query->result('array') as $key => $row) {//$row['col1']
                        $head[$row['exp_type']][$row['head_id']] = $row['head_name'];
                    }
                   // print_r($head);
                    return $head;
                }
                else
                    return NULL;
                   // return $arr_head= explode(',', $str_head);

    }
}

if (!function_exists('get_expense_type')) {
       function get_expense_type($type='') {
//$str_type="Service Repair, Material Purchase,Bread, Pav, Kulcha, Paneer, IDLI Ghol, Chowmin, Vegetable, Aloo, Pyaz,CNG, Petrol, Diesal, Service, Challan";
//    return $arr_head= explode(',', $str_type);
    $CI = & get_instance();
                $CI->db->select('*');
                $CI->db->from('expense_type');
                $CI->db->where_in("exp_type", array('Daily Expe','Goods Purc','Food','Vehicle'));
                $query = $CI->db->get();

                if ($query->num_rows() > 0) {
                    $type = array();
                    foreach ($query->result('array') as $key => $row) {//$row['col1']
                        $type[$row['exp_type']][$row['type_id']] = $row['type_name'];
                    }
                    //print_r($type);
                    return $type;
                }
                else
                    return NULL;

    }
}

if (!function_exists('get_annual_exp_head')) {
       function get_annual_exp_head() {
        //$str_type="Society,Water";
        //    return $arr_head= explode(',', $str_type);
                $CI = & get_instance();
                $CI->db->select('*');
                $CI->db->from('expense_head');
                $CI->db->where("exp_type", 'annual');
                $query = $CI->db->get();

                if ($query->num_rows() > 0) {
                    $head = array();
                    foreach ($query->result('array') as $key => $row) {//$row['col1']
                        $head[$row['head_id']] = $row['head_name'];
                    }
                    return $head;
                }
                else
                    return NULL;
            }
}
if (!function_exists('get_amc_exp_head')) {
       function get_amc_exp_head() {
//$str_type="RO,Refrigrator,Washing Machine,Water Cooler,AC,Water Softner,Chimney,Invertor,Battery,Gyser,Vehicle Insurance,CCTV,";
//    return $arr_head= explode(',', $str_type);
           
            $CI = & get_instance();
                $CI->db->select('*');
                $CI->db->from('expense_head');
                $CI->db->where("exp_type", 'AMC');
                $query = $CI->db->get();

                if ($query->num_rows() > 0) {
                    $head = array();
                    foreach ($query->result('array') as $key => $row) {//$row['col1']
                        $head[$row['head_id']] = $row['head_name'];
                    }
                    return $head;
                }
                else
                    return NULL;
            }

    }
    
    if (!function_exists('get_employee_list')) {
       function get_employee_list() {
           $CI = & get_instance();
        
		$CI->db->select('*');
		$CI->db->from('employee');
		$query = $CI->db->get();
		return $query->result_array(); 
    if ($query->num_rows() > 0) {
        return $query->result_array(); 
    
        }
        else
            return NULL;
    }
}

if (!function_exists('get_inventory_item')) {
       function get_inventory_item($type='') {
//$str_type="Service Repair, Material Purchase,Bread, Pav, Kulcha, Paneer, IDLI Ghol, Chowmin, Vegetable, Aloo, Pyaz,CNG, Petrol, Diesal, Service, Challan";
//    return $arr_head= explode(',', $str_type);
    $CI = & get_instance();
                $CI->db->select('*');
                $CI->db->from('expense_head');
                $CI->db->where_in("exp_type", array('AMC'));
                $query = $CI->db->get();
                if ($query->num_rows() > 0) {
                    $type = array();
                    foreach ($query->result('array') as $key => $row) {//$row['col1']
                        $type[$row['head_id']] = $row['head_name'];
                    }
                    return $type;
                }
                else
                    return NULL;

    }
}

if (!function_exists('upload_document')) {
function upload_document($filename){
 
    $CI = & get_instance();
//$CI->load->helper('date');
    $time = time();
    $arr_name= explode(".", $_FILES[$filename]["name"]);
    $name = $arr_name[0];
    $ext = $arr_name[1];

        $config['upload_path'] = './assets/img/house/documents';
        //$config['allowed_types'] = 'gif|jpg|png';
        $config['allowed_types'] = '*';
        $config['file_name'] = $time .'_image_' .$name.  '.' . $ext;
        $config['max_size'] = '10240';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['quality'] = '100%';
        $CI->load->library('upload');
        $CI->load->library('image_lib');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload($filename)){
                $file_upload['status']=0;
               echo $file_upload['file_msg']= $CI->upload->display_errors();
                $file_upload['name'] ="";
            
        }else{
                $file_upload['status']=1;
                $file_upload['file_msg']="uploaded";
                $file_upload['name'] = resize_upload_document($filename, $config['file_name']);
             }
        return $file_upload ; 
	}

}
if (!function_exists('resize_upload_document')) {
function resize_upload_document($fieldName, $filename){
     $CI = & get_instance();
     $upload_path = './assets/img/house/documents';
     $upload_data = $CI->upload->data();
     $configresize_image = array();
                        $configresize_image['image_library'] = 'gd2';
                        //$configresize_image['library_path'] =
                        $configresize_image['source_image'] = $upload_path.'/'.$filename ;//'./assets/img/house/documents/doc1_image_' . $time . '.' . $ext;
                        $configresize_image['new_image'] = $upload_path.'/'.$filename ;// './assets/img/house/documents/doc1_image_' . $time . '.' . $ext;
                        // $configresize_image['create_thumb'] = FALSE;
                        $configresize_image['maintain_ratio'] = TRUE;
                        $configresize_image['create_thumb']=TRUE;
                        $configresize_image['thumb_marker']='_thumb' ;
                        $configresize_image['quality'] = '100';
                        $configresize_image['width'] = '70';
                        $configresize_image['height'] = '70';
                        $configresize_image['master_dim'] = 'width';
                        $configresize_image['wm_opacity'] = 100;

                        $CI->image_lib->initialize($configresize_image);
                        if (!$CI->image_lib->resize()) {
                            $data['error'] = $CI->image_lib->display_errors();
                        }
                        $CI->image_lib->clear();
                        $filename_thumb = $upload_data['file_name'];
                       return  $filename_thumb ;
}
}

if (!function_exists('get_share_type_by_house_id')) {
       function get_share_type_by_house_id($house_id='') {

    $CI = & get_instance();
                $CI->db->select("case when share_type=1 then 'Single'
when share_type=2 then 'Double'
when share_type=3 then 'Triple'
when share_type=4 then 'Four'
when share_type=5 then 'Five'
when share_type=6 then 'Six' end as share_type");
                $CI->db->from('house_room');
                $CI->db->where("house_id",$house_id);
                $query = $CI->db->get();
                if ($query->num_rows() > 0) {
                    $type = array();
                    foreach ($query->result('array') as $key => $row) {//$row['col1']
                        $type[$row['share_type']] = $row['head_name'];
                    }
                    return $type;
                }
                else
                    return NULL;

    }
}