<?php

class Admin_guests extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('guests_model');
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

//index
    // <editor-fold defaultstate="collapsed" desc="/*************Guest *************/">

    public function showguest() {//all the posts sent by the view
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
            if ($search_string) {
                if ($order) {
                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, $search_string, $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, $search_string, '', $order_type, $config['per_page'], $limit_end);
                }
            } else {
                if ($order) {
                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, '', $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, '', '', $order_type, $config['per_page'], $limit_end);
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
            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
            $data['count_guests'] = $this->guests_model->count_guests();
            $data['guests'] = $this->guests_model->get_guests('', '', '', $order_type, $config['per_page'], $limit_end);
            $config['total_rows'] = $data['count_guests'];
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        $this->pagination->initialize($config);

        //load the view

        $data['main_content'] = 'admin/guests/showguest';
        $this->load->view('includes/template', $data);
    }

    public function addguest() {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('share_type', 'share_type', 'required');
            $this->form_validation->set_rules('room_id', 'room_id', 'required');
            $this->form_validation->set_rules('guest_name', 'guest_name', 'required');
            $this->form_validation->set_rules('mobile', 'mobile', 'required|numeric');
            //$this->form_validation->set_rules('id_proof', 'id_proof', 'required');            
            $this->form_validation->set_rules('monthly_rent', 'monthly_rent', 'required');
            $this->form_validation->set_rules('joining_date', 'joining_date', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                // $head=$this->input->post('head');
                $data_guest = array(
                    'house_id' => $this->input->post('house_id'),
                    'share_type' => $this->input->post('share_type'),
                    'room_id' => $this->input->post('room_id'),
                    'guest_name' => $this->input->post('guest_name'),
                    'dob' => $this->input->post('dob'),
                    'sex' => $this->input->post('sex'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),
                    'father_name' => $this->input->post('father_name'),
                    'parmanent_address' => $this->input->post('parmanent_address'),
                    'house_mobile' => $this->input->post('house_mobile'),
                    'house_landline' => $this->input->post('house_landline'),
                    'comp_college' => $this->input->post('comp_college'),
                    'address' => $this->input->post('address'),
                    'notice_date' => $this->input->post('notice_date'),
//                    'photo' => $this->input->post('photo'),
                    'monthly_rent' => $this->input->post('monthly_rent'),
                    'joining_date' => $this->input->post('joining_date'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
//                 foreach($_FILES as $field => $file)
//                    {
//                       if( $file['name']!='')
//                        $data_guest[$field]= upload_document($field);
//                    }
                $file_status = 1;
                foreach ($_FILES as $field => $file) {
                    if ($file['name'] != '') {
                        $fileData = upload_document($field);
                        if ($fileData['status'] == 1) {
                            $data_guest[$field] = $fileData['name'];
                        } else {
                            $file_status = 0;
                            $data['flash_message']='file_size_excide';
                            break;
                        }
                    }
                }
                //print_r($data_guest);//exit;
                //if the insert has returned true then we show the flash message
                if ($file_status == 1) {
                    if ($this->guests_model->add_guest($data_guest)) {
                        $data['flash_message'] = 1;
                    } else {
                        $data['flash_message'] = 0;
                    }
                    redirect('admin/guests/showguest');
                }
            }
        }
        $data['houses'] = get_house_number();

        //$data['share_type'] = get_share_type_by_house_id();
        $data['amc_head'] = get_amc_exp_head();
        $data['annual_type'] = get_expense_type();
        $data['amc_type'] = get_expense_type();


        $data['main_content'] = 'admin/guests/addguest';
        $this->load->view('includes/template', $data);
    }

    public function updateguest() {
        $id = $this->uri->segment(4);
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('share_type', 'share_type', 'required');
            $this->form_validation->set_rules('room_id', 'room_id', 'required');
            $this->form_validation->set_rules('guest_name', 'guest_name', 'required');
            $this->form_validation->set_rules('mobile', 'mobile', 'required|numeric');
            //$this->form_validation->set_rules('id_proof', 'id_proof', 'required');            
            $this->form_validation->set_rules('monthly_rent', 'monthly_rent', 'required');
            $this->form_validation->set_rules('joining_date', 'joining_date', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                // $head=$this->input->post('head');
                $data_guest = array(
                    'house_id' => $this->input->post('house_id'),
                    'share_type' => $this->input->post('share_type'),
                    'room_id' => $this->input->post('room_id'),
                    'guest_name' => $this->input->post('guest_name'),
                    'dob' => $this->input->post('dob'),
                    'sex' => $this->input->post('sex'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),
                    'father_name' => $this->input->post('father_name'),
                    'parmanent_address' => $this->input->post('parmanent_address'),
                    'house_mobile' => $this->input->post('house_mobile'),
                    'house_landline' => $this->input->post('house_landline'),
                    'comp_college' => $this->input->post('comp_college'),
                    'address' => $this->input->post('address'),
                    'notice_date' => $this->input->post('notice_date'),
//                    'photo' => $this->input->post('photo'),
                    'monthly_rent' => $this->input->post('monthly_rent'),
                    'joining_date' => $this->input->post('joining_date'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                $file_status = 1;
                foreach ($_FILES as $field => $file) {
                    if ($file['name'] != '') {
                        $fileData = upload_document($field);
                        if ($fileData['status'] == 1) {
                            $data_guest[$field] = $fileData['name'];
                        } else {
                            $file_status = 0;
                            $data['flash_message']= 'file_size_excide';
                            break;
                        }
                    }
                }
                //print_r($file_status);//exit;
                //if the insert has returned true then we show the flash message
                if ($file_status == 1) {
                    if ($this->guests_model->update_guest($id, $data_guest)) {
                        $data['flash_message'] = 1;
                    } else {
                        $data['flash_message'] = 0;
                    }
                    redirect('admin/guests/showguest');
                }
            }
        }
        $data['houses'] = get_house_number();

//product data 
        $data['guest'] = $this->guests_model->get_guest_by_id($id);
        $house_id = $data['guest'][0]['house_id'];
        $data['share_types'] = $this->guests_model->getsharetypebyhouseid($house_id);
        $share_type = $data['guest'][0]['share_type'];
        $data['room_no'] = $this->guests_model->getroomnobyhouseidandsharetype($house_id, $share_type);


        $data['main_content'] = 'admin/guests/editguest';
        $this->load->view('includes/template', $data);
    }

    public function deleteguest() {
        $id = $this->uri->segment(4);
        $this->guests_model->delete_guest($id);
        redirect('admin/guests/showguest');
    }

    public function getsharetypebyhouseid() {
        // ECHO "ASHU";
        //$this->load->model('users_model');
        $house_id = $this->input->post('house_id');
        $share_types['lists'] = $this->guests_model->getsharetypebyhouseid($house_id);
        //print_r($share_types['lists']);
        if (count($share_types['lists']) > 0)
            $share_types['status'] = 1;
        else
            $share_types['status'] = 0;
        echo json_encode($share_types);
    }

    public function getroomnobyhouseidandsharetype() {
        // ECHO "ASHU";
        //$this->load->model('users_model');
        $house_id = $this->input->post('house_id');
        $share_type = $this->input->post('share_type');
        $room_no['lists'] = $this->guests_model->getroomnobyhouseidandsharetype($house_id, $share_type);
        //print_r($share_types['lists']);
        if (count($room_no['lists']) > 0)
            $room_no['status'] = 1;
        else
            $room_no['status'] = 0;
        echo json_encode($room_no);
    }

    //</editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="/*************Guest Meter *************/">

    public function showguestmeter() {//all the posts sent by the view
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
            if ($search_string) {
                if ($order) {
                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, $search_string, $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, $search_string, '', $order_type, $config['per_page'], $limit_end);
                }
            } else {
                if ($order) {
                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, '', $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['guests'] = $this->guests_model->get_guests($manufacture_id, '', '', $order_type, $config['per_page'], $limit_end);
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
            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
            $data['count_guests'] = $this->guests_model->count_guests();
            $data['guests'] = $this->guests_model->get_guests('', '', '', $order_type, $config['per_page'], $limit_end);
            $config['total_rows'] = $data['count_guests'];
        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)
        //initializate the panination helper 
        $this->pagination->initialize($config);

        //load the view

        $data['main_content'] = 'admin/guests/showguestmeter';
        $this->load->view('includes/template', $data);
    }

    public function addguestmeter() {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('room_id', 'room_id', 'required');
            $this->form_validation->set_rules('from_date', 'from_date', 'required');
            $this->form_validation->set_rules('to_date', 'to_date', 'required');
            $this->form_validation->set_rules('unit', 'unit', 'required|numeric');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                // $head=$this->input->post('head');
                $data_guest = array(
                    'house_id' => $this->input->post('house_id'),
                    'share_type' => $this->input->post('share_type'),
                    'room_id' => $this->input->post('room_id'),
                    'guest_name' => $this->input->post('guest_name'),
                    'dob' => $this->input->post('dob'),
                    'sex' => $this->input->post('sex'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),
                    'father_name' => $this->input->post('father_name'),
                    'parmanent_address' => $this->input->post('parmanent_address'),
                    'house_mobile' => $this->input->post('house_mobile'),
                    'house_landline' => $this->input->post('house_landline'),
                    'comp_college' => $this->input->post('comp_college'),
                    'address' => $this->input->post('address'),
                    'notice_date' => $this->input->post('notice_date'),
//                    'photo' => $this->input->post('photo'),
                    'monthly_rent' => $this->input->post('monthly_rent'),
                    'joining_date' => $this->input->post('joining_date'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
//                 foreach($_FILES as $field => $file)
//                    {
//                       if( $file['name']!='')
//                        $data_guest[$field]= upload_document($field);
//                    }
                $file_status = 1;
                foreach ($_FILES as $field => $file) {
                    if ($file['name'] != '') {
                        $fileData = upload_document($field);
                        if ($fileData['status'] == 1) {
                            $data_guest[$field] = $fileData['name'];
                        } else {
                            $file_status = 0;
                            $data['flash_message']='file_size_excide';
                            break;
                        }
                    }
                }
                //print_r($data_guest);//exit;
                //if the insert has returned true then we show the flash message
                if ($file_status == 1) {
                    if ($this->guests_model->add_guest($data_guest)) {
                        $data['flash_message'] = 1;
                    } else {
                        $data['flash_message'] = 0;
                    }
                    redirect('admin/guests/showguest');
                }
            }
        }
        $data['houses'] = get_house_number();

        //$data['share_type'] = get_share_type_by_house_id();
        $data['amc_head'] = get_amc_exp_head();
        $data['annual_type'] = get_expense_type();
        $data['amc_type'] = get_expense_type();


        $data['main_content'] = 'admin/guests/addguestmeter';
        $this->load->view('includes/template', $data);
    }

    public function updateguestmeter() {
        $id = $this->uri->segment(4);
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('house_id', 'house_id', 'required');
            $this->form_validation->set_rules('share_type', 'share_type', 'required');
            $this->form_validation->set_rules('room_id', 'room_id', 'required');
            $this->form_validation->set_rules('guest_name', 'guest_name', 'required');
            $this->form_validation->set_rules('mobile', 'mobile', 'required|numeric');
            //$this->form_validation->set_rules('id_proof', 'id_proof', 'required');            
            $this->form_validation->set_rules('monthly_rent', 'monthly_rent', 'required');
            $this->form_validation->set_rules('joining_date', 'joining_date', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                // $head=$this->input->post('head');
                $data_guest = array(
                    'house_id' => $this->input->post('house_id'),
                    'share_type' => $this->input->post('share_type'),
                    'room_id' => $this->input->post('room_id'),
                    'guest_name' => $this->input->post('guest_name'),
                    'dob' => $this->input->post('dob'),
                    'sex' => $this->input->post('sex'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),
                    'father_name' => $this->input->post('father_name'),
                    'parmanent_address' => $this->input->post('parmanent_address'),
                    'house_mobile' => $this->input->post('house_mobile'),
                    'house_landline' => $this->input->post('house_landline'),
                    'comp_college' => $this->input->post('comp_college'),
                    'address' => $this->input->post('address'),
                    'notice_date' => $this->input->post('notice_date'),
//                    'photo' => $this->input->post('photo'),
                    'monthly_rent' => $this->input->post('monthly_rent'),
                    'joining_date' => $this->input->post('joining_date'),
                    'added_by' => 2,
                    'added_date' => @date('Y-m-d')
                );
                $file_status = 1;
                foreach ($_FILES as $field => $file) {
                    if ($file['name'] != '') {
                        $fileData = upload_document($field);
                        if ($fileData['status'] == 1) {
                            $data_guest[$field] = $fileData['name'];
                        } else {
                            $file_status = 0;
                            $data['flash_message']= 'file_size_excide';
                            break;
                        }
                    }
                }
                //print_r($file_status);//exit;
                //if the insert has returned true then we show the flash message
                if ($file_status == 1) {
                    if ($this->guests_model->update_guest($id, $data_guest)) {
                        $data['flash_message'] = 1;
                    } else {
                        $data['flash_message'] = 0;
                    }
                    redirect('admin/guests/showguest');
                }
            }
        }
        $data['houses'] = get_house_number();

//product data 
        $data['guest'] = $this->guests_model->get_guest_by_id($id);
        $house_id = $data['guest'][0]['house_id'];
        $data['share_types'] = $this->guests_model->getsharetypebyhouseid($house_id);
        $share_type = $data['guest'][0]['share_type'];
        $data['room_no'] = $this->guests_model->getroomnobyhouseidandsharetype($house_id, $share_type);


        $data['main_content'] = 'admin/guests/editguestmeter';
        $this->load->view('includes/template', $data);
    }

    public function deleteguestmeter() {
        $id = $this->uri->segment(4);
        $this->guests_model->delete_guest($id);
        redirect('admin/guests/showguestmeter');
    }
    //</editor-fold>



    public function addguestrent() {
        //echo "ashu";
        $data['main_content'] = 'admin/guests/addguestrent';
        $this->load->view('includes/template', $data);
    }

}