<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
*  @author   : Creativeitem
*  date    : 6 July, 2020
*  Academy
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/
class Live_class_model extends CI_Model {

	protected $school_id;
	protected $active_session;

	public function __construct()
	{
		parent::__construct();
		$this->school_id = school_id();
		$this->active_session = active_session();
	}

	// STORE LIVE CLASS DATA
	public function store() {

		$data['class_id'] = html_escape($this->input->post('class_id'));
		$data['subject_id'] = html_escape($this->input->post('subject_id'));
		$data['date'] 		= html_escape(strtotime($this->input->post('date')));
		$data['time'] 		= html_escape(strtotime($this->input->post('time')));
		$data['teacher_id'] = $this->session->userdata('user_id');
		$zoom_meeting_id = html_escape($this->input->post('zoom_meeting_id'));
		$trimmed_meeting_id = preg_replace('/\s+/', '', $zoom_meeting_id);
		$data['zoom_meeting_id']       = str_replace("-", "", $trimmed_meeting_id);
		$data['zoom_meeting_password'] = html_escape($this->input->post('zoom_meeting_password'));
		$data['topic'] = html_escape($this->input->post('topic'));
		$data['session'] = $this->active_session;
		$data['created_at'] = strtotime(date('d-M-Y'));

		if ($_FILES['attachment']['name']) {
			if (!file_exists('uploads/live_class')) {
				mkdir('uploads/live_class', 0777, true);
			}
			$file_ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
			$data['attachment'] = md5(rand(10000000, 20000000)).'.'.$file_ext;
			move_uploaded_file($_FILES['attachment']['tmp_name'], 'uploads/live_class/'.$data['attachment']);
		}

		$data['school_id'] = $this->school_id;

		$this->db->insert('live_classes', $data);

		$response = array(
			'status' => true,
			'notification' => get_phrase('live_class_added_successfully')
		);
		return json_encode($response);
	}

	// UPDATE LIVE CLASS DATA
	public function update() {
		$id = $this->input->post('id');
		$previous_data = $this->get_live_class_by_id($id)->num_rows();
		if ($previous_data) {
			$data['class_id'] = html_escape($this->input->post('class_id'));
			$data['subject_id'] = html_escape($this->input->post('subject_id'));
			$data['date'] 		= html_escape(strtotime($this->input->post('date')));
			$data['time'] 		= html_escape(strtotime($this->input->post('time')));
			$data['teacher_id'] = $this->session->userdata('user_id');
			$zoom_meeting_id = html_escape($this->input->post('zoom_meeting_id'));
			$trimmed_meeting_id = preg_replace('/\s+/', '', $zoom_meeting_id);
			$data['zoom_meeting_id']       = str_replace("-", "", $trimmed_meeting_id);
			$data['zoom_meeting_password'] = html_escape($this->input->post('zoom_meeting_password'));
			$data['topic'] = html_escape($this->input->post('topic'));
			$data['session'] = $this->active_session;
			if ($_FILES['attachment']['name']) {
				if (!file_exists('uploads/live_class')) {
					mkdir('uploads/live_class', 0777, true);
				}
				$file_ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
				$data['attachment'] = md5(rand(10000000, 20000000)).'.'.$file_ext;
				move_uploaded_file($_FILES['attachment']['tmp_name'], 'uploads/live_class/'.$data['attachment']);
			}

			$data['school_id'] = $this->school_id;

			$this->db->where('id', $id);
			$this->db->update('live_classes', $data);

			$response = array(
				'status' => true,
				'notification' => get_phrase('live_class_updated_successfully')
			);
		}else{
			$response = array(
				'status' => false,
				'notification' => get_phrase('error_occurred')
			);
		}

		return json_encode($response);
	}

	// GET ALL THE LIVE CLASSES CREATED BY LOGGED IN TEACHER
	public function get_all_live_class_by_teacher() {
		$this->db->order_by('id', 'DESC');
		$this->db->where(['school_id'=>$this->school_id, 'teacher_id' => $this->session->userdata('user_id'), 'session' => $this->active_session]);
		$data = $this->db->get('live_classes');
		return $data;
	}

	// GET ALL THE LIVE CLASSES CREATED BY LOGGED IN STUDENT
	public function get_all_live_class_by_student() {
		$this->db->order_by('id', 'DESC');
		$student_data = $this->user_model->get_logged_in_student_details();
		$this->db->where(['school_id'=>$this->school_id, 'class_id' => $student_data['class_id'], 'session' => $this->active_session]);
		$data = $this->db->get('live_classes');
		return $data;
	}

	// GET THE SETTINGS DATA
	public function get_live_class_settings($user_id = "") {
		if($user_id == ""){
			$user_id = $this->session->userdata('user_id');
		}
		
		$settings_data = $this->db->get_where('live_class_settings',['school_id'=>$this->school_id, 'user_id'=>$user_id])->row_array();
		return $settings_data;
	}

	// GET LIVE CLASS BY ID
	public function get_live_class_by_id($id) {
		$checker = array();
		if ($this->session->userdata('teacher_login') == 1) {
			$checker = ['id' => $id, 'school_id' => $this->school_id, 'teacher_id' => $this->session->userdata('user_id'), 'session' => $this->active_session];
		} elseif ($this->session->userdata('student_login') == 1) {
			$student_data = $this->user_model->get_logged_in_student_details();
			$checker = ['id' => $id, 'school_id' => $this->school_id, 'class_id' => $student_data['class_id'], 'session' => $this->active_session];
		}

		$data = $this->db->get_where('live_classes', $checker);
		return $data;
	}

	// UPDATE SETTINGS DATA
	public function update_settings() {
		$user_id = $this->session->userdata('user_id');

		$data['zoom_api_key'] = html_escape($this->input->post('zoom_api_key'));
		$data['zoom_secret_key'] = html_escape($this->input->post('zoom_secret_key'));
		$data['school_id'] = $this->school_id;
		$data['user_id'] = $user_id;

		$previous_data = $this->db->get_where('live_class_settings', ['school_id' => $this->school_id,'user_id'=>$user_id]);
		if ($previous_data->num_rows()) {
			$this->db->where('user_id', $user_id);
			$this->db->where('school_id', $this->school_id);
			$this->db->update('live_class_settings', $data);
		}else {
			$this->db->insert('live_class_settings', $data);
		}

		$response = array(
			'status' => true,
			'notification' => get_phrase('live_class_settings_updated_successfully')
		);
		return json_encode($response);
	}

	// DELETE LIVE CLASS DATA
	public function delete($id) {
		$previous_data = $this->get_live_class_by_id($id)->num_rows();
		if ($previous_data) {


			$this->db->where('id', $id);
			$this->db->delete('live_classes');

			$response = array(
				'status' => true,
				'notification' => get_phrase('live_class_updated_successfully')
			);
		}else{
			$response = array(
				'status' => false,
				'notification' => get_phrase('error_occurred')
			);
		}

		return json_encode($response);
	}

	//SENDING MAIL TO SPECIFIC CLASS STUDENTS
	public function sendmail() {
		$class_id = $this->input->post('class_id');
		$email_sub = $this->input->post('subject');
		$email_msg = $this->input->post('message');

		if (empty($class_id)) {
			$response = array(
				'status' => false,
				'notification' => get_phrase('error_occurred')
			);
		}else{
			$enrols = $this->db->get_where('enrols', array('class_id' => $class_id, 'school_id' => $this->school_id, 'session' => $this->active_session))->result_array();
			foreach($enrols as $enroll){
				$student = $this->db->get_where('students', array('id' => $enroll['student_id']))->row_array();
				$user_details = $this->user_model->get_user_details($student['user_id']);
				if (!empty($user_details['email'])) {
					$email_to = $user_details['email'];
					if (get_smtp('mail_sender') == 'php_mailer') {
						$this->email_model->send_mail_using_php_mailer($email_msg , $email_sub , $email_to);
					}else{
						$this->email_model->send_mail_using_smtp($email_msg , $email_sub , $email_to);
					}
				}
			}
			$response = array(
				'status' => true,
				'notification' => get_phrase('mail_sent')
			);
		}

		return json_encode($response);
	}
}
