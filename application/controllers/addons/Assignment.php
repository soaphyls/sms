<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addons
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Assignment extends CI_Controller {

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
		$this->load->model('addons/Assignment_model', 'assignment_model');

		/*cache control*/
		$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache");

		/*SET DEFAULT TIMEZONE*/
		timezone();
	}

//-----------------TEACHER------------------//
	public function index($param1 = "", $param2 = "", $param3 = ""){
		$this->student_assignment($param1, $param2, $param3);
	}
	public function student_assignment($param1 = "", $param2 = "", $param3 = ""){
		if($this->session->userdata('teacher_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		if($param1 == 'create'){
			$response = $this->assignment_model->create_assignment();
			echo $response;
		}elseif($param1 == 'delete'){
			$response = $this->assignment_model->delete_assignment($param2);
			echo $response;
		}elseif($param1 == 'update'){
			$response = $this->assignment_model->update_assignment($param2);
			echo $response;
		}elseif ($param1 == 'list'){
			$page_data['assignment_type'] = $param2;
			$this->load->view('backend/teacher/assignment/list', $page_data);
		}else{
			$page_data['assignment_type'] = $param1;
			$page_data['folder_name'] = 'assignment';
			$page_data['page_title'] = 'assignments';
			$this->load->view('backend/index', $page_data);
		}
	}
	public function filter_student_assignment($param1 = ""){
		if($this->session->userdata('teacher_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		$page_data['selected_class_id'] = $this->input->post('class_id');
		$page_data['selected_section_id'] = $this->input->post('section_id');
		$page_data['selected_subject_id'] = $this->input->post('subject_id');
		$page_data['assignment_type'] = $param1;
		$this->load->view('backend/teacher/assignment/list', $page_data);
	}

	public function publish($id = ""){
		if($this->session->userdata('teacher_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		$response_json = $this->assignment_model->assignment_publish($id);
		$response = json_decode($response_json);
		if($response->status){
			echo $response_json;
		}else{
			$this->session->set_flashdata('error_message', get_phrase('assignment_published_failed'));
			redirect(site_url('addons/assignment/student_assignment/pending'), 'refresh');
		}
	}

	public function pending($id = ""){
		if($this->session->userdata('teacher_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		$response = $this->assignment_model->assignment_pending($id);
		$response = json_decode($response);
		if($response->status){
			$this->session->set_flashdata('flash_message', $response->notification);
			redirect(site_url('addons/assignment/student_assignment/published'), 'refresh');
		}else{
			$this->session->set_flashdata('error_message', get_phrase('assignment_status_updated_is_not_successfully'));
			redirect(site_url('addons/assignment/student_assignment/published'), 'refresh');
		}
	}

	public function questions($param1 = "", $param2 = "", $param3 = ""){
		if($this->session->userdata('teacher_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		if($param1 == 'create'){
			$response = $this->assignment_model->create_question($param2);
			echo $response;
		}

		if($param1 == 'update'){
			$response = $this->assignment_model->update_question($param2);
			echo $response;
		}

		if($param1 == 'delete'){
			$response = $this->assignment_model->delete_question($param2);
			echo $response;
		}

		if ($param1 == 'list') {
			$page_data['assignment_details'] = $this->assignment_model->get_assignments($param2)->row_array();
			$this->load->view('backend/teacher/assignment/question_list', $page_data);
		}
		if(empty($param2)){
			$page_data['folder_name'] = 'assignment';
			$page_data['page_title'] = 'assignment_question';
			$page_data['page_name'] = 'questions';
			$page_data['assignment_details'] = $this->assignment_model->get_assignments($param1)->row_array();
			$this->load->view('backend/index', $page_data);
		}
	}
	public function students($param1 = "", $param2 = "", $param3 = ""){
		if($this->session->userdata('teacher_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		if($param1 == 'update'){
			$response = $this->assignment_model->update_question($param2);
			echo $response;
		}

		if ($param1 == 'list') {
			$page_data['assignment_details'] = $this->assignment_model->get_assignments($param2)->row_array();
			$this->load->view('backend/teacher/assignment/student_list', $page_data);
		}else{
			$page_data['class_id'] = $param2;
			$page_data['section_id'] = $param3;
			$page_data['folder_name'] = 'assignment';
			$page_data['page_title'] = 'assignment_result';
			$page_data['page_name'] = 'students';
			$page_data['assignment_details'] = $this->assignment_model->get_assignments($param1)->row_array();
			$this->load->view('backend/index', $page_data);
		}
	}

	public function answer_and_mark($assignment_id = "", $student_id = ""){
		if($this->session->userdata('teacher_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		$page_data['folder_name'] = 'assignment';
		$page_data['page_title'] = 'answer_and_mark';
		$page_data['page_name'] = 'student_answer_and_mark';
		$page_data['student_id'] = $student_id;

		$page_data['assignment_details'] = $this->assignment_model->get_assignments($assignment_id)->row_array();
		$page_data['questions'] = $this->assignment_model->get_questions_by_assignment($assignment_id);
		$this->load->view('backend/index', $page_data);
	}

	public function save_obtained_mark($answer_id = ""){
		if($this->session->userdata('teacher_login') != 1){
			redirect(site_url('login'), 'refresh');
		}
		echo $this->assignment_model->save_obtained_mark($answer_id);
	}

	public function update_remark($assignment_id = "", $student_id = ""){
		if($this->session->userdata('teacher_login') != 1){
			redirect(site_url('login'), 'refresh');
		}
		$query = $this->db->get_where('assignment_remarks', array('assignment_id' => $assignment_id, 'student_id' => $student_id));
		$data['remark'] = $this->input->post('remark');
		$data['assignment_id'] = $assignment_id;
		$data['student_id'] = $student_id;
		if($query->num_rows() > 0){
			$this->db->where('assignment_id', $assignment_id);
			$this->db->where('student_id', $student_id);
			$this->db->update('assignment_remarks', $data);
		}else{
			$this->db->insert('assignment_remarks', $data);
		}
		$this->session->set_flashdata('success_message', get_phrase('remark_updated_successfully'));
		redirect(site_url('addons/assignment/answer_and_mark/'.$assignment_id.'/'.$student_id), 'refresh');

	}
//-----------------TEACHER END------------------//




//-----------------STUDENT------------------//
	public function my_active_assignment($param1 = "", $param2 = "", $param3 = ""){
		if($this->session->userdata('student_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		if ($param1 == 'list') {
			$this->load->view('backend/teacher/assignment/list');
		}

		if(empty($param1)){
			//student enrolment data
			$user_id = $this->session->userdata('user_id');
			$student_id = $this->db->get_where('students', array('user_id' => $user_id))->row('id');
			$this->db->where('student_id', $student_id);
			$enrolment = $this->db->get('enrols')->row_array();

			$page_data['assignments'] = $this->assignment_model->get_student_assignments($enrolment['class_id'], $enrolment['section_id'], 'active');
			$page_data['selected_subject'] = 'all';
			$page_data['selected_teacher'] = 'all';
			$page_data['class_id'] = $enrolment['class_id'];
			$page_data['deadline_status'] = 'active';
			$page_data['folder_name'] = 'assignment';
			$page_data['page_title'] = 'my_assignments';
			$this->load->view('backend/index', $page_data);
		}
	}

	public function filter_my_active_assignment(){
		if($this->session->userdata('student_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		$subject_id = $this->input->post('subject_id');
		$teacher_id = $this->input->post('teacher_id');

		$user_id = $this->session->userdata('user_id');
		$student_id = $this->db->get_where('students', array('user_id' => $user_id))->row('id');
		
		$this->db->where('student_id', $student_id);
		$enrolment = $this->db->get('enrols')->row_array();

		if($subject_id == 'all' && $teacher_id == 'all'){
			$page_data['assignments'] = $this->assignment_model->get_student_assignments($enrolment['class_id'], $enrolment['section_id'], 'active');
		}else{
			$page_data['assignments'] = $this->assignment_model->get_student_assignment_by_filter($enrolment['class_id'], $enrolment['section_id'], 'active');
		}
		$page_data['selected_subject'] = $subject_id;
		$page_data['selected_teacher'] = $teacher_id;
		$page_data['class_id'] = $enrolment['class_id'];
		$page_data['deadline_status'] = 'active';
		$this->load->view('backend/student/assignment/list', $page_data);
	}

	public function my_expired_assignment($param1 = "", $param2 = "", $param3 = ""){
		if($this->session->userdata('student_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		if ($param1 == 'list') {
			$this->load->view('backend/teacher/assignment/list');
		}

		if(empty($param1)){
			//student enrolment data
			$user_id = $this->session->userdata('user_id');
			$student_id = $this->db->get_where('students', array('user_id' => $user_id))->row('id');
			$this->db->where('student_id', $student_id);
			$enrolment = $this->db->get('enrols')->row_array();

			$page_data['assignments'] = $this->assignment_model->get_student_assignments($enrolment['class_id'], $enrolment['section_id'], 'expired');
			$page_data['selected_subject'] = 'all';
			$page_data['selected_teacher'] = 'all';
			$page_data['class_id'] = $enrolment['class_id'];
			$page_data['deadline_status'] = 'expired';
			$page_data['folder_name'] = 'assignment';
			$page_data['page_title'] = 'my_assignments';
			$this->load->view('backend/index', $page_data);
		}
	}

	public function filter_my_expired_assignment(){
		if($this->session->userdata('student_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		$subject_id = $this->input->post('subject_id');
		$teacher_id = $this->input->post('teacher_id');

		$user_id = $this->session->userdata('user_id');
		$student_id = $this->db->get_where('students', array('user_id' => $user_id))->row('id');

		$this->db->where('student_id', $student_id);
		$enrolment = $this->db->get('enrols')->row_array();

		if($subject_id == 'all' && $teacher_id == 'all'){
			$page_data['assignments'] = $this->assignment_model->get_student_assignments($enrolment['class_id'], $enrolment['section_id'], 'expired');
		}else{
			$page_data['assignments'] = $this->assignment_model->get_student_assignment_by_filter($enrolment['class_id'], $enrolment['section_id'], 'expired');
		}
		$page_data['selected_subject'] = $subject_id;
		$page_data['selected_teacher'] = $teacher_id;
		$page_data['class_id'] = $enrolment['class_id'];
		$page_data['deadline_status'] = 'expired';
		$this->load->view('backend/student/assignment/list', $page_data);
	}


	public function assignment_questions($param1 = "", $param2 = ""){
		if($this->session->userdata('student_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		$page_data['assignment_details'] = $this->assignment_model->get_assignments($param1)->row_array();
		$page_data['questions'] = $this->assignment_model->get_questions_by_assignment($param1);
		$page_data['folder_name'] = 'assignment';
		$page_data['page_name'] = 'questions';
		$page_data['page_title'] = 'questions';
		$this->load->view('backend/index', $page_data);
	}

	public function save_answers($question_id = "", $assignment_id = ""){
		if($this->session->userdata('student_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		$response = $this->assignment_model->save_answers($question_id, $assignment_id);
		echo $response;
	}

	public function submit_assignment($assignment_id = ""){
		if($this->session->userdata('student_login') != 1){
			redirect(site_url('login'), 'refresh');
		}
		$deadline = $this->assignment_model->get_assignments($assignment_id)->row('deadline');
		if($deadline >= strtotime(date('m/d/Y'))){
			$this->assignment_model->submit_assignment($assignment_id);
			$this->session->set_flashdata('flash_message', get_phrase('your_assignment_submitted_successfully'));
		}else{
			$this->session->set_flashdata('error_message', get_phrase('your_assignment_submitted_deadline_is_over'));
		}
		redirect(site_url('addons/assignment/my_active_assignment'), 'refresh');
	}

	public function my_assignment_result($assignment_id = ""){
		if($this->session->userdata('student_login') != 1){
			redirect(site_url('login'), 'refresh');
		}

		$page_data['assignment_details'] = $this->assignment_model->get_assignments($assignment_id)->row_array();
		$page_data['questions'] = $this->assignment_model->get_questions_by_assignment($assignment_id);
		$page_data['folder_name'] = 'assignment';
		$page_data['page_name'] = 'assignment_result';
		$page_data['page_title'] = 'assignment_result';
		$this->load->view('backend/index', $page_data);
	}
//-----------------STUDENT END------------------//


}