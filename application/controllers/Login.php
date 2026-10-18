<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addons
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Login extends CI_Controller {


	public function __construct(){
		parent::__construct();

		$this->load->database();
		$this->load->library('session');

		/*LOADING ALL THE MODELS HERE*/
		$this->load->model('Crud_model',     'crud_model');
		$this->load->model('User_model',     'user_model');
		$this->load->model('Settings_model', 'settings_model');
		$this->load->model('Payment_model',  'payment_model');
		$this->load->model('Email_model',    'email_model');
		$this->load->model('Addon_model',    'addon_model');
		$this->load->model('Frontend_model', 'frontend_model');

		/*cache control*/
		$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache");

		/*SET DEFAULT TIMEZONE*/
		timezone();
		
	}

	public function index(){
		if($this->session->userdata('superadmin_login') ==  true){
			redirect(route('dashboard'), 'refresh');
		}elseif($this->session->userdata('admin_login') ==  true){
			redirect(route('dashboard'), 'refresh');
		}elseif($this->session->userdata('owner_login') ==  true){
			redirect(route('dashboard'), 'refresh');
		}elseif($this->session->userdata('teacher_login') ==  true){
			redirect(route('dashboard'), 'refresh');
		}elseif($this->session->userdata('parent_login') ==  true){
			redirect(route('dashboard'), 'refresh');
		}elseif($this->session->userdata('student_login') ==  true){
			redirect(route('dashboard'), 'refresh');
		}elseif($this->session->userdata('accountant_login') ==  true){
			redirect(route('dashboard'), 'refresh');
		}elseif($this->session->userdata('librarian_login') ==  true){
			redirect(route('dashboard'), 'refresh');
		}else{
			$this->load->view('login');
		}

	}

	public function validate_login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        // Normalize phone: if +234..., convert to 0... for DB check
        if (strpos($phone, '+234') === 0) {
            $phone = '0' . substr($phone, 4);
        }
        $credential = array('email' => $email, 'password' => sha1($password), 'phone' => $phone);
        // Checking login credential for user with phone
        $query = $this->db->get_where('users', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('user_login_type', true);
            if($row->role == 'superadmin'){
				$this->session->set_userdata('superadmin_login', true);
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('school_id', $row->school_id);
				$this->session->set_userdata('user_name', $row->name);
				$this->session->set_userdata('user_type', 'superadmin');
				$this->session->set_flashdata('flash_message', get_phrase('welcome_back'));
				redirect(site_url('superadmin/dashboard'), 'refresh');
			}
			elseif($row->role == 'admin'){
				$this->session->set_userdata('admin_login', true);
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('school_id', $row->school_id);
				$this->session->set_userdata('user_name', $row->name);
				$this->session->set_userdata('user_type', 'admin');
				$this->session->set_flashdata('flash_message', get_phrase('welcome_back'));
				redirect(site_url('admin/dashboard'), 'refresh');
			}
			elseif($row->role == 'owner'){
				$this->session->set_userdata('owner_login', true);
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('school_id', $row->school_id);
				$this->session->set_userdata('user_name', $row->name);
				$this->session->set_userdata('user_type', 'owner');
				$this->session->set_flashdata('flash_message', get_phrase('welcome_back'));
				redirect(site_url('owner/dashboard'), 'refresh');
			}
			elseif($row->role == 'teacher'){
				$this->session->set_userdata('teacher_login', true);
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('school_id', $row->school_id);
				$this->session->set_userdata('user_name', $row->name);
				$this->session->set_userdata('user_type', 'teacher');
				$this->session->set_flashdata('flash_message', get_phrase('welcome_back'));
				redirect(site_url('teacher/dashboard'), 'refresh');
			}
			elseif($row->role == 'student'){
				$this->session->set_userdata('student_login', true);
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('school_id', $row->school_id);
				$this->session->set_userdata('user_name', $row->name);
				$this->session->set_userdata('user_type', 'student');
				$this->session->set_flashdata('flash_message', get_phrase('welcome_back'));
				redirect(site_url('student/dashboard'), 'refresh');
			}
			elseif($row->role == 'parent'){
				$this->session->set_userdata('parent_login', true);
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('school_id', $row->school_id);
				$this->session->set_userdata('user_name', $row->name);
				$this->session->set_userdata('user_type', 'parent');
				$this->session->set_flashdata('flash_message', get_phrase('welcome_back'));
				redirect(site_url('parents/dashboard'), 'refresh');
			}
			elseif($row->role == 'librarian'){
				$this->session->set_userdata('librarian_login', true);
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('school_id', $row->school_id);
				$this->session->set_userdata('user_name', $row->name);
				$this->session->set_userdata('user_type', 'librarian');
				$this->session->set_flashdata('flash_message', get_phrase('welcome_back'));
				redirect(site_url('librarian/dashboard'), 'refresh');
			}
			elseif($row->role == 'accountant'){
				$this->session->set_userdata('accountant_login', true);
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('school_id', $row->school_id);
				$this->session->set_userdata('user_name', $row->name);
				$this->session->set_userdata('user_type', 'accountant');
				$this->session->set_flashdata('flash_message', get_phrase('welcome_back'));
				redirect(site_url('accountant/dashboard'), 'refresh');
			}
        } else {
            $this->session->set_flashdata('error_message', 'Invalid login credentials or phone number.');
            redirect(site_url('login'), 'refresh');
        }
    }

	public function logout() {
		$this->session->sess_destroy();
		$this->session->set_flashdata('info_message', get_phrase('logged_out'));
		redirect(site_url('login'), 'refresh');
	}

	// RETREIVE PASSWORD
	public function retrieve_password() {
		$email = $this->input->post('email');
		$query = $this->db->get_where('users', array('email' => $email));
		if ($query->num_rows() > 0) {
			$query = $query->row_array();
			$new_password = substr( md5( rand(100000000,20000000000) ) , 0,7);

			// updating the database
			$updater = array(
				'password' => sha1($new_password)
			);
			$this->db->where('id', $query['id']);
			$this->db->update('users', $updater);

			// sending mail to user
			$this->email_model->password_reset_email($new_password, $query['id']);

			$this->session->set_flashdata('flash_message', get_phrase('please_check_your_mail_inbox'));
			redirect(site_url('login'), 'refresh');
		}else{
			$this->session->set_flashdata('error_message', get_phrase('wrong_credential'));
			redirect(site_url('login'), 'refresh');
		}
	}
}
