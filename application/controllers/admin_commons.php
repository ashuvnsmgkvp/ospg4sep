<?php

class Admin_commons extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('commons_model');
        $this->load->helper('custom_functions_helper');
        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin/login');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {

        //all the posts sent by the view
        $manufacture_id = $this->input->post('manufacture_id');
        $search_string = $this->input->post('search_string');
        $order = $this->input->post('order');
        $order_type = $this->input->post('order_type');

        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url() . 'admin/guests';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0) {
            $limit_end = 0;
        }

        //if order type was changed
        if ($order_type) {
            $filter_session_data['order_type'] = $order_type;
        } else {
            //we have something stored in the session? 
            if ($this->session->userdata('order_type')) {
                $order_type = $this->session->userdata('order_type');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data
        //filtered && || paginated
        if ($manufacture_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true) {

            /*
              The comments here are the same for line 79 until 99

              if post is not null, we store it in session data array
              if is null, we use the session data already stored
              we save order into the the var to load the view with the param already selected
             */

            if ($manufacture_id !== 0) {
                $filter_session_data['manufacture_selected'] = $manufacture_id;
            } else {
                $manufacture_id = $this->session->userdata('manufacture_selected');
            }
            $data['manufacture_selected'] = $manufacture_id;

            if ($search_string) {
                $filter_session_data['search_string_selected'] = $search_string;
            } else {
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if ($order) {
                $filter_session_data['order'] = $order;
            } else {
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            //fetch manufacturers data into arrays
            //$data['manufactures'] = $this->manufacturers_model->get_manufacturers();
            //$data['count_guests']= $this->guests_model->count_guests($manufacture_id, $search_string, $order);
            // $config['total_rows'] = $data['count_guests'];
            //fetch sql data into arrays
//            if($search_string){
//                if($order){
//                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, $search_string, $order, $order_type, $config['per_page'],$limit_end);        
//                }else{
//                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, $search_string, '', $order_type, $config['per_page'],$limit_end);           
//                }
//            }else{
//                if($order){
//                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, '', $order, $order_type, $config['per_page'],$limit_end);        
//                }else{
//                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, '', '', $order_type, $config['per_page'],$limit_end);        
//                }
//            }
        } else {

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['manufacture_selected'] = 0;
            $data['order'] = 'id';

            //fetch sql data into arrays
            //$data['manufactures'] = $this->manufacturers_model->get_manufacturers();
            //$data['count_guests']= $this->guests_model->count_guests();
            //$data['guests'] = $this->guests_model->get_guests('', '', '', $order_type, $config['per_page'],$limit_end);        
            //$config['total_rows'] = $data['count_guests'];
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        $this->pagination->initialize($config);

        //load the view
        $data['main_content'] = 'admin/guests/list';
        $this->load->view('includes/template', $data);
    }
    // <editor-fold defaultstate="collapsed" desc="/*************Bank Details *************/">

    public function addbank() {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('type', 'type', 'required');
            $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
            $this->form_validation->set_rules('account_holder', 'account_holder', 'required');
            $this->form_validation->set_rules('account_no', 'account_no', 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_bank = array(
                    'house_id'=>$this->input->post('house_id'),
                    'type' => $this->input->post('type'),
                    'bank_name' => $this->input->post('bank_name'),
                    'account_holder' => $this->input->post('account_holder'),
                    'account_no' => $this->input->post('account_no'),
                    'status' => 1
                );
                //if the insert has returned true then we show the flash message
                if ($this->commons_model->addbank($data_to_bank)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                 redirect('admin/commons/showbank/');
            }
        }
        $data['houses'] = get_house_number();
        $data['main_content'] = 'admin/commons/addbank';
        $this->load->view('includes/template', $data);
    }

    public function showbank() {
        $search_string = $this->input->post('search_string');
        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url() . 'admin/houses';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        //limit end
        $page = $this->uri->segment(3);
        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0) {
            $limit_end = 0;
        }
        if ($search_string !== false || $this->uri->segment(3) == true) {
            if ($search_string) {
                $filter_session_data['search_string_selected'] = $search_string;
            } else {
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            //save session data into the session
            $this->session->set_userdata(@$filter_session_data);
            //fetch manufacturers data into arrays
            //$data['manufactures'] = $this->manufacturers_model->get_manufacturers();
            $data['count_banks'] = $this->commons_model->count_banks($search_string);
            $config['total_rows'] = $data['count_banks'];
            //fetch sql data into arrays
            if ($search_string) {
                $data['banks'] = $this->commons_model->get_banks($search_string, $config['per_page'], $limit_end);
            } else {
                $data['banks'] = $this->commons_model->get_banks('', $config['per_page'], $limit_end);
            }
            //echo "<pre>";print_r($data['banks']);echo "</pre>";
        } else {
            $filter_session_data['search_string_selected'] = null;
            $this->session->set_userdata($filter_session_data);
            //pre selected options
            $data['search_string_selected'] = '';
            $data['count_banks'] = $this->commons_model->count_banks();
            $data['banks'] = $this->commons_model->get_banks('', $config['per_page'], $limit_end);
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        //echo "<pre>";print_r( $data['banks']);echo "</pre>";
        $this->pagination->initialize($config);
        $data['main_content'] = 'admin/commons/listbank';
        $this->load->view('includes/template', $data);
    }

    public function updatebank() {

        $id = $this->uri->segment(4);
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            // echo "ashu";
            $this->form_validation->set_rules('type', 'type', 'required');
            $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
            $this->form_validation->set_rules('account_holder', 'account_holder', 'required');
            $this->form_validation->set_rules('account_no', 'account_no', 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_bank = array(
                    'type' => $this->input->post('type'),
                    'bank_name' => $this->input->post('bank_name'),
                    'account_holder' => $this->input->post('account_holder'),
                    'account_no' => $this->input->post('account_no'),
                    'status' => 1
                );
                // echo "ashu3";
                if ($this->commons_model->update_bank($id, $data_to_bank) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

                redirect('admin/commons/showbank/');
            }//validation run
        }

        //product data 
        $data['bank'] = $this->commons_model->get_bank_by_id($id);
        $data['houses'] = get_house_number();
        $data['main_content'] = 'admin/commons/editbank';
        $this->load->view('includes/template', $data);
    }

    public function deletebank() {
        $id = $this->uri->segment(4);
        $this->commons_model->delete_bank($id);
        redirect('admin/commons/showbank');
    }
   function getbankdetailbyhouseid() {
        $this->load->model('users_model');
        $house_id = $this->input->post('house_id');
        $data1= $this->commons_model->get_bank_by_house_id($house_id);
        $data['bank']=$data1[0];
       // print_r($data['bank']);
        if (count($data['bank']) > 0)
            $data['status'] = 1;
        else
            $data['status'] = 0;

        echo json_encode($data);
    }

    public function addguestrent() {

        $data['main_content'] = 'admin/guests/addguestrent';
        $this->load->view('includes/template', $data);
    }

// </editor-fold >
}