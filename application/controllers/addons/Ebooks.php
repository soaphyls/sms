<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addons
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Ebooks extends CI_Controller {
	//protected $unique_identifier = "Eliberary";
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
	$this->load->model('addons/Ebook_model', 'ebook_model');
    
        
        
        /*cache control*/
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");

        /*SET DEFAULT TIMEZONE*/
       // timezone();

        // CHECK IF THE ADDON IS ACTIVE OR NOT
       // $this->check_addon_status();

    // $superadmin_login = $this->session->userdata('superadmin_login');
    // $admin_login = $this->session->userdata('admin_login');
    // $teacher_login = $this->session->userdata('teacher_login');
	  // $librarian_login = $this->session->userdata('librarian_login');
    // $student_login = $this->session->userdata('student_login');
    // if($teacher_login == 1 || $superadmin_login == 1 || $admin_login == 1 || $student_login == 1|| $librarian_login == 1){

    // }else{
      // redirect(site_url('login'), 'refresh');
    // }
	//$this->check_addon_status();
     }

    // showing the list of book
public function index($param1 = "", $param2 = ""){
        // if ($this->session->userdata('librarian_login') != 1 && $this->session->userdata('student_login') != 1) {
            // redirect(site_url('login'), 'refresh');
        // }
		
	//$this->liberian_access($param2);
    if($param1 == 'create'){
		
	 $response = $this->ebook_model->create_ebook();
	 if ($response){
	 echo $response;
	 $this->session->set_flashdata('flash_message', get_phrase('ebook_added_successfully'));
	 } else {
      $this->session->set_flashdata('flash_message', get_phrase('ebook_not_successful'));
	 }
	  redirect(site_url('addons/ebooks'));
    }
     if($param1 == 'edit'){
		
	 $response = $this->ebook_model->edit_ebook();
	 if ($response){
	 echo $response;
	  $this->session->set_flashdata('flash_message', get_phrase('ebook_updated_successfully'));
	  } else {
       $this->session->set_flashdata('flash_message', get_phrase('ebook_edit_not_successful'));
	  }
	  redirect(site_url('addons/ebooks'));
    } 

	if($param1 == 'delete'){
		
	   $response = $this->ebook_model->delete_ebook($param2 );
	 echo $response;
	
    }  
	
	if($param1 == 'list'){
		
	 $this->load->view('backend/ebook/list');
	
    }  
       
		if(empty($param1)){
		$page_data['page_title'] = 'Your ebooks';
		$page_data['folder_name'] = 'ebook';
		$this->load->view('backend/index', $page_data);
		
		
		
	}

	
    }
	public function ebook_add(){
    $this->student_access_denied();
   // $page_data['all_teachers']    = $this->user_model->get_all_teachers();
    $page_data['classes']     = $this->crud_model->get_classes();
    $page_data['folder_name'] = 'ebook';
    $page_data['page_title']  = 'Add_ebook';
    $page_data['page_name']   = 'create';

    $this->load->view('backend/ebook/create', $page_data);
	}
	
	public function ebook_edit($id){
    $page_data['id'] = $id;
    $this->load->view('backend/ebook/edit', $page_data);
	}
	
	public function read_doc($file_name){
    $page_data['folder_name'] = 'ebook';
	$page_data['file_name'] = $file_name;
    $page_data['page_title']  = 'Read_ebook';
    $page_data['page_name']   = 'get-single-read-ebook';
	$this->load->view('backend/ebook/get-single-read-ebook', $page_data);
	}
	public function deletenow($id){
    $response = $this->ebook_model->delete_ebook($id );
	 if ($response){
	 echo $response;
	 $this->session->set_flashdata('flash_message', get_phrase('ebook_deleted_successfully'));
	 } else {
      $this->session->set_flashdata('flash_message', get_phrase('ebook_deleted_not_successful'));
	 }
	  redirect(site_url('addons/ebooks'));
}
	
	
	public function student_access_denied(){
    if($this->session->userdata('student_login') == 1){
      $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_access_to_this_course'));
      redirect(site_url('addons/ebooks'), 'refresh');
    }
  }
  
  
  public function liberian_access(){
       if($this->session->userdata('librarian_login') != 1 ){
        $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_access_to_this_course'));
        redirect(site_url('addons/ebooks'), 'refresh');
      
    }
  }
  
  
  public function subject($param1 = '', $param2 = ''){
	if($param1 == 'list'){
      $page_data['class_id'] = $param2;
	  $page_data['folder_name'] = 'ebook';
      $this->load->view('backend/ebook/list_subject', $page_data);
	 // echo "Hello";
  } 
	 




	 
  }
  
}