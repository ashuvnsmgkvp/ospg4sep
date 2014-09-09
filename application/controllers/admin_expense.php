<?php

class Admin_expense extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('expenses2_model');
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
            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();

            $data['count_houses'] = $this->houses_model->count_houses($manufacture_id, $search_string, $order);
            $config['total_rows'] = $data['count_houses'];

            //fetch sql data into arrays
            if ($search_string) {
                if ($order) {
                    $data['houses'] = $this->houses_model->get_houses($manufacture_id, $search_string, $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['houses'] = $this->houses_model->get_houses($manufacture_id, $search_string, '', $order_type, $config['per_page'], $limit_end);
                }
            } else {
                if ($order) {
                    $data['houses'] = $this->houses_model->get_houses($manufacture_id, '', $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['houses'] = $this->houses_model->get_houses($manufacture_id, '', '', $order_type, $config['per_page'], $limit_end);
                }
            }
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
            //$data['count_houses']= $this->houses_model->count_houses();
            //$data['houses'] = $this->houses_model->get_houses('', '', '', $order_type, $config['per_page'],$limit_end);        
            //$config['total_rows'] = $data['count_houses'];
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        $this->pagination->initialize($config);

        //load the view
        $data['main_content'] = 'admin/houses/list';
        $this->load->view('includes/template', $data);
    }

     // <editor-fold defaultstate="collapsed" desc="/*************Salary *************/">
    public function showsalary(){
        $search_string = $this->input->post('search_string');
        //pagination settings
        $config['per_page'] = 2;
        $config['base_url'] = base_url() . 'admin/expense/showsalary';
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment']=4;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        //limit end
        $page = $this->uri->segment(4);
        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0) {
            $limit_end = 0;
        }
        if ($search_string !== '' || $this->uri->segment(4) == true) {
           
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
            $data['count_salaries'] = $this->expenses2_model->count_salaries($search_string);
            $config['total_rows'] = $data['count_salaries'];
            //fetch sql data into arrays
            if ($search_string) {
                $data['salaries'] = $this->expenses2_model->get_salaries($search_string, $config['per_page'], $limit_end);
            } else {
                $data['salaries'] = $this->expenses2_model->get_salaries('', $config['per_page'], $limit_end);
            }
            //echo "<pre>";print_r($data['salaries']);echo "</pre>";
        } else {
            $filter_session_data['search_string_selected'] = null;
            $this->session->set_userdata($filter_session_data);
            //pre selected options
            $data['search_string_selected'] = '';
            $data['count_salaries'] = $this->expenses2_model->count_salaries();
            $data['salaries'] = $this->expenses2_model->get_salaries('', $config['per_page'], $limit_end);
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        //echo "<pre>";print_r( $data['salaries']);echo "</pre>";
        $this->pagination->initialize($config);
        $data['houses'] = get_house_number();
        $data['main_content'] = 'admin/expense/listsalary';
        $this->load->view('includes/template', $data);

    }
    public function addsalary(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('employee_name', 'employee_name', 'required');
            $this->form_validation->set_rules('function', 'function', 'required|numeric');
            $this->form_validation->set_rules('salary_amount', 'salary_amount', 'required');
            $this->form_validation->set_rules('salary_date', 'salary_date', 'required');
            $this->form_validation->set_rules('from_date', 'from_date', 'required');
            $this->form_validation->set_rules('to_date', 'to_date', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_salary = array(
                    'house_id' => $this->input->post('house_id'),
                    'employee_name' => $this->input->post('employee_name'),
                    'function' => $this->input->post('function'),
                    'salary_amount' => $this->input->post('salary_amount'),
                    'from_date' => $this->input->post('from_date'),
                    'to_date' => $this->input->post('to_date'),
                    'advance_paid' => $this->input->post('advance_paid'),
                    'advance_date' => $this->input->post('advance_date'),
                    'salary_paid' => $this->input->post('salary_paid'),
                    'salary_date' => $this->input->post('salary_date'),
                    'next_due_date' => '',//$this->input->post('next_due_date'),
                    'next_due_amount' =>0//$this->input->post('next_due_amount')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->addsalary($data_to_salary)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                redirect('admin/expense/showsalary/');
            }
        }
        $data['houses'] = get_house_number();
        $data['employees'] = get_employee_list();
        $data['main_content'] = 'admin/expense/addsalary';
        $this->load->view('includes/template', $data);
    }
    public function updatesalary(){
        //if save button was clicked, get the data sent via post
    $id = $this->uri->segment(4);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('employee_name', 'employee_name', 'required');
            $this->form_validation->set_rules('function', 'function', 'required|numeric');
            $this->form_validation->set_rules('salary_amount', 'salary_amount', 'required');
            $this->form_validation->set_rules('from_date', 'from_date', 'required');
            $this->form_validation->set_rules('to_date', 'to_date', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_salary = array(
                    'house_id' => $this->input->post('house_id'),
                    'employee_name' => $this->input->post('employee_name'),
                    'function' => $this->input->post('function'),
                    'salary_amount' => $this->input->post('salary_amount'),
                    'from_date' => $this->input->post('from_date'),
                    'to_date' => $this->input->post('to_date'),
                    'advance_paid' => $this->input->post('advance_paid'),
                    'advance_date' => $this->input->post('advance_date'),
                    'salary_paid' => $this->input->post('salary_paid'),
                    'salary_date' => $this->input->post('salary_date'),
                    'next_due_date' => $this->input->post('next_due_date'),
                    'next_due_amount' => $this->input->post('next_due_amount')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->update_salary($id, $data_to_salary)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                redirect('admin/expense/showsalary/');
            }
        }
        $data['salery'] = $this->expenses2_model->get_salary_by_id($id);
        $data['houses'] = $this->expenses2_model->get_house_number();
        $data['main_content'] = 'admin/expense/editsalary';
        $this->load->view('includes/template', $data);
    }
        public function deletesalary() {
            
        $id = $this->uri->segment(4);
        $this->expenses2_model->delete_salary($id);
        redirect('admin/expense/showsalary/');
    }
    // </editor-fold>
   
     // <editor-fold defaultstate="collapsed" desc="/*************Monthly Exp *************/">
    public function showmonthlyexp() {
        $search_string = $this->input->post('search_string');
        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url() . 'admin/expense';
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
            $data['count_mexp'] = $this->expenses2_model->count_mexp($search_string);
            $config['total_rows'] = $data['count_mexp'];
            //fetch sql data into arrays
            if ($search_string) {
                $data['mexp'] = $this->expenses2_model->get_mexp($search_string, $config['per_page'], $limit_end);
            } else {
                $data['mexp'] = $this->expenses2_model->get_mexp('', $config['per_page'], $limit_end);
            }
            //echo "<pre>";print_r($data['salaries']);echo "</pre>";
        } else {
            $filter_session_data['search_string_selected'] = null;
            $this->session->set_userdata($filter_session_data);
            //pre selected options
            $data['search_string_selected'] = '';
            $data['count_mexp'] = $this->expenses2_model->count_mexp();
            $data['mexp'] = $this->expenses2_model->get_mexp('', $config['per_page'], $limit_end);
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        //echo "<pre>";print_r( $data['salaries']);echo "</pre>";
        $this->pagination->initialize($config);
        $data['main_content'] = 'admin/expense/monthaly/show_mexp';
        $this->load->view('includes/template', $data);
    }

    public function addmonthlyexp() {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('type', 'type', 'required');
            $this->form_validation->set_rules('period_from', 'period_from', 'required');
            $this->form_validation->set_rules('period_to', 'period_to', 'required');
            $this->form_validation->set_rules('payment_date', 'payment_date', 'required');
            $this->form_validation->set_rules('paid_amount', 'paid_amount', 'required|numeric');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_monthly_exp = array(
                    'house_id' => $this->input->post('house_id'),
                    'type' => $this->input->post('type'),
                    'period_from' => $this->input->post('period_from'),
                    'period_to' => $this->input->post('period_to'),
                    'payment_date' => $this->input->post('payment_date'),
                    'paid_amount' => $this->input->post('paid_amount'),
                    'balance_amount' => $this->input->post('balance_amount'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->add_mexp($data_monthly_exp)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                redirect('admin/expense/showmonthlyexp');   
            }
        }
        $data['houses'] = get_house_number();
        $data['main_content'] = 'admin/expense/monthaly/addmonthlyexp';
        $this->load->view('includes/template', $data);
    }

    public function updatemonthlyexp() {
        //if save button was clicked, get the data sent via post
        $id = $this->uri->segment(4);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('type', 'type', 'required');
            $this->form_validation->set_rules('period_from', 'period_from', 'required');
            $this->form_validation->set_rules('period_to', 'period_to', 'required');
            $this->form_validation->set_rules('payment_date', 'payment_date', 'required');
            $this->form_validation->set_rules('paid_amount', 'paid_amount', 'required|numeric');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_monthly_exp = array(
                    'house_id' => $this->input->post('house_id'),
                    'type' => $this->input->post('type'),
                    'period_from' => $this->input->post('period_from'),
                    'period_to' => $this->input->post('period_to'),
                    'payment_date' => $this->input->post('payment_date'),
                    'paid_amount' => $this->input->post('paid_amount'),
                    'balance_amount' => $this->input->post('balance_amount'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->update_mexp($id, $data_monthly_exp)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                redirect('admin/expense/showmonthlyexp');   
            }
        }
        $data['mexp'] = $this->expenses2_model->get_mexp_by_id($id);
        $data['houses'] = $this->expenses2_model->get_house_number();
        $data['main_content'] = 'admin/expense/monthaly/editmonthlyexp';
        $this->load->view('includes/template', $data);
    }

    public function deletemonthlyexp() {
        $id = $this->uri->segment(4);
        $this->expenses2_model->delete_mexp($id);
        redirect('admin/expense/showmonthlyexp');   
        
    }

    // </editor-fold>

     // <editor-fold defaultstate="collapsed" desc="/*************Daily Exp *************/">
    public function showdailyexp() {
        $search_string = $this->input->post('search_string');
        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url() . 'admin/expense';
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
            $data['count_dexp'] = $this->expenses2_model->count_dexp($search_string);
            $config['total_rows'] = $data['count_dexp'];
            //fetch sql data into arrays
            if ($search_string) {
                $data['dexp'] = $this->expenses2_model->get_dexp($search_string, $config['per_page'], $limit_end);
            } else {
                $data['dexp'] = $this->expenses2_model->get_dexp('', $config['per_page'], $limit_end);
            }
            //echo "<pre>";print_r($data['salaries']);echo "</pre>";
        } else {
            $filter_session_data['search_string_selected'] = null;
            $this->session->set_userdata($filter_session_data);
            //pre selected options
            $data['search_string_selected'] = '';
            $data['count_dexp'] = $this->expenses2_model->count_dexp();
            $data['dexp'] = $this->expenses2_model->get_dexp('', $config['per_page'], $limit_end);
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        //echo "<pre>";print_r( $data['salaries']);echo "</pre>";
        $this->pagination->initialize($config);
        $data['head'] = get_expense_head();
        $data['type'] = get_expense_type();
        $data['main_content'] = 'admin/expense/daily/show_dexp';
        $this->load->view('includes/template', $data);
    }

    public function adddailyexp() {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('type', 'type', 'required');
           
            $this->form_validation->set_rules('payment_date', 'payment_date', 'required');
            $this->form_validation->set_rules('paid_amount', 'paid_amount', 'required|numeric');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_daily_exp = array(
                    'house_id' => $this->input->post('house_id'),
                    'head' => $this->input->post('head'),
                    'type' => $this->input->post('type'),
                    'payment_date' => $this->input->post('payment_date'),
                    'paid_amount' => $this->input->post('paid_amount'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->add_dexp($data_daily_exp)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
            }
        }
        $data['houses'] = get_house_number();
        $data['head'] = get_expense_head();
        $data['type'] = get_expense_type();
        
        $data['main_content'] = 'admin/expense/daily/adddailyexp';
        $this->load->view('includes/template', $data);
    }

    public function updatedailyexp() {
        //if save button was clicked, get the data sent via post
        $id = $this->uri->segment(4);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('type', 'type', 'required');
           
            $this->form_validation->set_rules('payment_date', 'payment_date', 'required');
            $this->form_validation->set_rules('paid_amount', 'paid_amount', 'required|numeric');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_daily_exp = array(
                    'house_id' => $this->input->post('house_id'),
                    'head' => $this->input->post('head'),
                    'type' => $this->input->post('type'),
                    'payment_date' => $this->input->post('payment_date'),
                    'paid_amount' => $this->input->post('paid_amount'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->update_dexp($id, $data_daily_exp)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
            }
        }
        $data['dexp'] = $this->expenses2_model->get_dexp_by_id($id);
        $data['houses'] = $this->expenses2_model->get_house_number();
        $data['head'] = get_expense_head();
        $data['type'] = get_expense_type();
        $data['main_content'] = 'admin/expense/daily/editdailyexp';
        $this->load->view('includes/template', $data);
    }

    public function deletedailyexp() {
        $id = $this->uri->segment(4);
        $this->expenses2_model->delete_dexp($id);
        redirect('admin/expense/showdailyexp');
    }
public function getexpensetypebyhead()
{
     $exp_head = $this->input->post('exp_head');
        $share_types['lists'] = $this->expenses2_model->get_expense_type_byhead($exp_head);
        //print_r($share_types['lists']);
        if (count($share_types['lists']) > 0)
            $share_types['status'] = 1;
        else
            $share_types['status'] = 0;
        echo json_encode($share_types);
}
    // </editor-fold>
   
     // <editor-fold defaultstate="collapsed" desc="/*************Annual Exp *************/">
    public function showannualexp() {
        $search_string = $this->input->post('search_string');
        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url() . 'admin/expense';
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
            $data['count_aexp'] = $this->expenses2_model->count_aexp($search_string);
            $config['total_rows'] = $data['count_aexp'];
            //fetch sql data into arrays
            if ($search_string) {
                $data['aexp'] = $this->expenses2_model->get_aexp($search_string, $config['per_page'], $limit_end);
            } else {
                $data['aexp'] = $this->expenses2_model->get_aexp('', $config['per_page'], $limit_end);
            }
            //echo "<pre>";print_r($data['salaries']);echo "</pre>";
        } else {
            $filter_session_data['search_string_selected'] = null;
            $this->session->set_userdata($filter_session_data);
            //pre selected options
            $data['search_string_selected'] = '';
            $data['count_aexp'] = $this->expenses2_model->count_aexp();
            $data['aexp'] = $this->expenses2_model->get_aexp('', $config['per_page'], $limit_end);
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        //echo "<pre>";print_r( $data['salaries']);echo "</pre>";
        $this->pagination->initialize($config);
        $data['annual_head'] = get_annual_exp_head();
        $data['amc_head'] = get_amc_exp_head();
        $data['annual_type'] = get_expense_type();
        $data['amc_type'] = get_expense_type();
        $data['main_content'] = 'admin/expense/annual/show_aexp';
        $this->load->view('includes/template', $data);
    }

    public function addannualexp() {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('exp_or_amc', 'exp_or_amc', 'required');
            $this->form_validation->set_rules('head', 'head', 'required');
            $this->form_validation->set_rules('period_from', 'period_from', 'required');
            $this->form_validation->set_rules('period_to', 'period_to', 'required');
            $this->form_validation->set_rules('balance_amount', 'balance_amount', 'required');            
            $this->form_validation->set_rules('payment_date', 'payment_date', 'required');
            $this->form_validation->set_rules('paid_amount', 'paid_amount', 'required|numeric');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $this->input->post('exp_or_amc');
                $head=$this->input->post('head');
                $data_annual_exp = array(
                    'house_id' => $this->input->post('house_id'),
                    'exp_or_amc' => $this->input->post('exp_or_amc'),
                    'head' => $head,
                    'period_from' => $this->input->post('period_from'),
                    'period_to' => $this->input->post('period_to'),
                    'payment_date' => $this->input->post('payment_date'),
                    'paid_amount' => $this->input->post('paid_amount'),
                    'balance_amount' => $this->input->post('balance_amount'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->add_aexp($data_annual_exp)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
             redirect('admin/expense/showannualexp');   
            }
        }
        $data['houses'] = get_house_number();
        $data['annual_head'] = get_annual_exp_head();
        $data['amc_head'] = get_amc_exp_head();
        $data['annual_type'] = get_expense_type();
        $data['amc_type'] = get_expense_type();
        
        $data['main_content'] = 'admin/expense/annual/addannualexp';
        $this->load->view('includes/template', $data);
    }

    public function updateannualexp() {
        //if save button was clicked, get the data sent via post
        $id = $this->uri->segment(4);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            //$this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('head', 'head', 'required');
            $this->form_validation->set_rules('exp_or_amc', 'exp_or_amc', 'required');
           
            $this->form_validation->set_rules('payment_date', 'payment_date', 'required');
            $this->form_validation->set_rules('paid_amount', 'paid_amount', 'required|numeric');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                 $head =$this->input->post('head');
                $data_annual_exp = array(
                    'house_id' => $this->input->post('house_id'),
                    'exp_or_amc' => $this->input->post('exp_or_amc'),
                    'head' => $head,
                    'period_from' => $this->input->post('period_from'),
                    'period_to' => $this->input->post('period_to'),
                    'payment_date' => $this->input->post('payment_date'),
                    'paid_amount' => $this->input->post('paid_amount'),
                    'balance_amount' => $this->input->post('balance_amount'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->update_aexp($id, $data_annual_exp)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                redirect('admin/expense/showannualexp');   
            }
        }
        $data['aexp'] = $this->expenses2_model->get_aexp_by_id($id);
        $data['houses'] = get_house_number();
        $data['annual_head'] = get_annual_exp_head();
        $data['amc_head'] = get_amc_exp_head();
        $data['annual_type'] = get_expense_type();
        $data['amc_type'] = get_expense_type();
        $data['main_content'] = 'admin/expense/annual/editannualexp';
        $this->load->view('includes/template', $data);
    }

    public function deleteannualexp() {
        $id = $this->uri->segment(4);
        $this->expenses2_model->delete_aexp($id);
        redirect('admin/expense/showannualexp'); 
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="/*************Inventory  *************/">
    public function showinventory() {
        $search_string = $this->input->post('search_string');
        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url() . 'admin/expense';
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
            $data['count_inventory'] = $this->expenses2_model->count_inventory($search_string);
            $config['total_rows'] = $data['count_inventory'];
            //fetch sql data into arrays
            if ($search_string) {
                $data['inventory'] = $this->expenses2_model->get_inventory($search_string, $config['per_page'], $limit_end);
            } else {
                $data['inventory'] = $this->expenses2_model->get_inventory('', $config['per_page'], $limit_end);
            }
            //echo "<pre>";print_r($data['salaries']);echo "</pre>";
        } else {
            $filter_session_data['search_string_selected'] = null;
            $this->session->set_userdata($filter_session_data);
            //pre selected options
            $data['search_string_selected'] = '';
            $data['count_inventory'] = $this->expenses2_model->count_inventory();
            $data['inventory'] = $this->expenses2_model->get_inventory('', $config['per_page'], $limit_end);
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        //echo "<pre>";print_r( $data['salaries']);echo "</pre>";
        $this->pagination->initialize($config);
        //$data['inventory_head'] = get_inventory_exp_head();
        //$data['amc_head'] = get_amc_exp_head();
        //$data['inventory_type'] = get_expense_type();

        $data['inventory_items'] = get_inventory_item();
        $data['main_content'] = 'admin/expense/inventory/show_inventory';
        $this->load->view('includes/template', $data);
    }

    public function addinventory() {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('inv_item', 'inv_item', 'required');

            $this->form_validation->set_rules('make', 'make', 'required');
            $this->form_validation->set_rules('model', 'model', 'required');            
            $this->form_validation->set_rules('purchase_date', 'purchase_date', 'required');
            $this->form_validation->set_rules('purchase_amount', 'purchase_amount', 'required|numeric');
            $this->form_validation->set_rules('vendor_name', 'vendor_name', 'required'); 
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $this->input->post('exp_or_amc');
                $head=$this->input->post('head');
                $data_inventory_exp = array(
                    'house_id' => $this->input->post('house_id'),
                    'inv_item' => $this->input->post('inv_item'),
                    'make' => $this->input->post('make'),
                    'model' => $this->input->post('model'),
                    'capacity'=>$this->input->post('capacity'),
                    'purchase_date' => $this->input->post('purchase_date'),
                    'purchase_amount' => $this->input->post('purchase_amount'),
                    'vendor_name' => $this->input->post('vendor_name'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->add_inventory($data_inventory_exp)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
             redirect('admin/expense/showinventory');   
            }
        }
        $data['houses'] = get_house_number();
        $data['inventory_items'] = get_inventory_item();
        
        $data['main_content'] = 'admin/expense/inventory/addinventory';
        $this->load->view('includes/template', $data);
    }

    public function updateinventory() {
        //if save button was clicked, get the data sent via post
        $id = $this->uri->segment(4);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('inv_item', 'inv_item', 'required');

            $this->form_validation->set_rules('make', 'make', 'required');
            $this->form_validation->set_rules('model', 'model', 'required');            
            $this->form_validation->set_rules('purchase_date', 'purchase_date', 'required');
            $this->form_validation->set_rules('purchase_amount', 'purchase_amount', 'required|numeric');
            $this->form_validation->set_rules('vendor_name', 'vendor_name', 'required'); 

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                 $head =$this->input->post('head');
               $data_inventory_exp = array(
                    'house_id' => $this->input->post('house_id'),
                    'inv_item' => $this->input->post('inv_item'),
                    'make' => $this->input->post('make'),
                    'model' => $this->input->post('model'),
                    'capacity'=>$this->input->post('capacity'), 
                    'purchase_date' => $this->input->post('purchase_date'),
                    'purchase_amount' => $this->input->post('purchase_amount'),
                    'vendor_name' => $this->input->post('vendor_name'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                //if the insert has returned true then we show the flash message
                if ($this->expenses2_model->update_inventory($id, $data_inventory_exp)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                redirect('admin/expense/showinventory');   
            }
        }
        $data['inventory'] = $this->expenses2_model->get_inventory_by_id($id);
        $data['houses'] = get_house_number();
        $data['inventory_items'] = get_inventory_item();
        $data['main_content'] = 'admin/expense/inventory/editinventory';
        $this->load->view('includes/template', $data);
    }

    public function deleteinventory() {
        $id = $this->uri->segment(4);
        $this->expenses2_model->delete_inventory($id);
        redirect('admin/expense/showinventory'); 
    }

    // </editor-fold>
    
     // <editor-fold defaultstate="collapsed" desc="/*************Others *************/">
   

   
    public function add() {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //form validation
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_rules('stock', 'stock', 'required|numeric');
            $this->form_validation->set_rules('cost_price', 'cost_price', 'required|numeric');
            $this->form_validation->set_rules('sell_price', 'sell_price', 'required|numeric');
            $this->form_validation->set_rules('manufacture_id', 'manufacture_id', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_store = array(
                    'description' => $this->input->post('description'),
                    'stock' => $this->input->post('stock'),
                    'cost_price' => $this->input->post('cost_price'),
                    'sell_price' => $this->input->post('sell_price'),
                    'manufacture_id' => $this->input->post('manufacture_id')
                );
                //if the insert has returned true then we show the flash message
                if ($this->houses_model->store_product($data_to_store)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
            }
        }
        //fetch manufactures data to populate the select field
        //$data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/houses/add';
        $this->load->view('includes/template', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function update() {
        //product id 
        $id = $this->uri->segment(4);

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_rules('stock', 'stock', 'required|numeric');
            $this->form_validation->set_rules('cost_price', 'cost_price', 'required|numeric');
            $this->form_validation->set_rules('sell_price', 'sell_price', 'required|numeric');
            $this->form_validation->set_rules('manufacture_id', 'manufacture_id', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'description' => $this->input->post('description'),
                    'stock' => $this->input->post('stock'),
                    'cost_price' => $this->input->post('cost_price'),
                    'sell_price' => $this->input->post('sell_price'),
                    'manufacture_id' => $this->input->post('manufacture_id')
                );
                //if the insert has returned true then we show the flash message
                if ($this->houses_model->update_product($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/houses/update/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //product data 
        $data['product'] = $this->houses_model->get_product_by_id($id);
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/houses/edit';
        $this->load->view('includes/template', $data);
    }

//update

    /**
     * Delete product by his id
     * @return void
     */
    public function delete() {
        //product id 
        $id = $this->uri->segment(4);
        $this->houses_model->delete_product($id);
        redirect('admin/houses');
    }

//edit
    // </editor-fold>
}