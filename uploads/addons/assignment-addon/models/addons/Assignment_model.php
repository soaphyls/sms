<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addon
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Assignment_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_assignments($id = ""){
		if($id > 0){
			$this->db->where('id', $id);
		}
		return $this->db->get('assignments');
	}
	public function create_assignment(){
		$user_id = $this->session->userdata('user_id');
		$data['title'] = htmlspecialchars($this->input->post('title'));
		$data['class_id'] = htmlspecialchars($this->input->post('class_id'));
		$data['section_id'] = htmlspecialchars($this->input->post('section_id'));
		$data['subject_id'] = htmlspecialchars($this->input->post('subject_id'));
		$data['deadline'] = htmlspecialchars(strtotime($this->input->post('deadline')));
		$data['teacher_id'] = $user_id;
		$data['school_id'] = school_id();
		$data['status'] = 0;
		$data['date_added'] = strtotime(date('d M Y'));
		$this->db->insert('assignments', $data);
		$response = array(
			'status' => true,
			'notification' => get_phrase('assignment_added_successfully')
		);
		return json_encode($response);
	}

	public function update_assignment($id = ""){
		$data['title'] = htmlspecialchars($this->input->post('title'));
		$data['class_id'] = htmlspecialchars($this->input->post('class_id'));
		$data['section_id'] = htmlspecialchars($this->input->post('section_id'));
		$data['subject_id'] = htmlspecialchars($this->input->post('subject_id'));
		$data['deadline'] = htmlspecialchars(strtotime($this->input->post('deadline')));
		$this->db->where('id', $id);
		$this->db->update('assignments', $data);
		$response = array(
			'status' => true,
			'notification' => get_phrase('assignment_updated_successfully')
		);
		return json_encode($response);
	}

	public function delete_assignment($id = ""){
		$this->db->where('id', $id);
		$this->db->delete('assignments');
		$response = array(
			'status' => true,
			'notification' => get_phrase('assignment_deleted_successfully')
		);
		return json_encode($response);
	}

	public function assignment_publish($id = ""){
		$data['status'] = 1;
		$this->db->where('id', $id);
		$this->db->update('assignments', $data);
		$response = array(
			'status' => true,
			'notification' => get_phrase('the_assignment_has_been_published_successfully')
		);
		return json_encode($response);
	}

	public function assignment_pending($id = ""){
		$data['status'] = 0;
		$this->db->where('id', $id);
		$this->db->update('assignments', $data);
		$response = array(
			'status' => true,
			'notification' => get_phrase('assignment_status_updated_successfully')
		);
		return json_encode($response);
	}


	public function get_questions($question_id = ""){
		if($question_id > 0){
			$this->db->where('id', $question_id);
		}
		return $this->db->get('assignment_questions');
	}

	public function get_questions_by_assignment($assignment_id = ""){
		$this->db->where('assignment_id', $assignment_id);
		return $this->db->get('assignment_questions');
	}
	public function create_question($assignment_id = ""){
		$data['assignment_id'] = $assignment_id;
		$data['question'] = htmlspecialchars($this->input->post('question'));
		$data['question_type'] = htmlspecialchars($this->input->post('question_type'));
		$data['mark'] = htmlspecialchars($this->input->post('mark'));
		$data['date_added'] = strtotime(date('d M Y'));
		$this->db->insert('assignment_questions', $data);
		$response = array(
			'status' => true,
			'notification' => get_phrase('question_added_successfully')
		);
		return json_encode($response);
	}

	public function update_question($question_id = ""){
		$data['question'] = htmlspecialchars($this->input->post('question'));
		$data['question_type'] = htmlspecialchars($this->input->post('question_type'));
		$data['mark'] = htmlspecialchars($this->input->post('mark'));
		$this->db->where('id', $question_id);
		$this->db->update('assignment_questions', $data);
		$response = array(
			'status' => true,
			'notification' => get_phrase('question_updated_successfully')
		);
		return json_encode($response);
	}

	public function delete_question($question_id = ""){
		$this->db->where('id', $question_id);
		$this->db->delete('assignment_questions');
		$response = array(
			'status' => true,
			'notification' => get_phrase('question_deleted_successfully')
		);
		return json_encode($response);
	}

	function save_obtained_mark($answer_id = ""){
		$obtained_mark = htmlspecialchars($this->input->post('obtained_mark'));
		$this->db->where('id', $answer_id);
		$this->db->update('assignment_answers', array('obtained_mark' => $obtained_mark));


		$answer_details = $this->db->get_where('assignment_answers', array('id' => $answer_id))->row_array();

		$this->db->select_sum('obtained_mark');
        $this->db->where('assignment_id', $answer_details['assignment_id']);
		$this->db->where('student_id', $answer_details['student_id']);
        $this->db->where('status', 1);
        $student_answers = $this->db->get('assignment_answers');
        $student_obtained_marks = $student_answers->row('obtained_mark');
        if($student_obtained_marks > 0){
            $student_obtained_marks;
        }else{
            $student_obtained_marks = 0;
        }
		$response = array(
			'status' => true,
			'message' => get_phrase('obtained_mark_provided_successfully'),
			'student_obtained_marks' => $student_obtained_marks
		);
		return json_encode($response);
	}





//-----------------STUDENT------------------//
	public function get_student_assignments($class_id = "", $section_id = "", $deadline = ""){
		if($deadline == 'active'){
			$this->db->where('deadline >=', strtotime(date('m/d/Y')));
		}else{
			$this->db->where('deadline <', strtotime(date('m/d/Y')));
		}
		$this->db->where('status', 1);
		$this->db->where('class_id', $class_id);
		$this->db->where('section_id', $section_id);
		$this->db->where('school_id', school_id());
		return $this->db->get('assignments');
	}

	public function get_student_assignment_by_filter($class_id = "", $section_id = "", $deadline = ""){
		$subject_id = htmlspecialchars($this->input->post('subject_id'));
		$teacher_id = htmlspecialchars($this->input->post('teacher_id'));

		if($deadline == 'active'){
			$this->db->where('deadline >=', strtotime(date('m/d/Y')));
		}else{
			$this->db->where('deadline <', strtotime(date('m/d/Y')));
		}
		if($subject_id != 'all'){
			$this->db->where('subject_id', $subject_id);
		}
		if($teacher_id != 'all'){
			$this->db->where('teacher_id', $teacher_id);
		}
		$this->db->where('status', 1);
		$this->db->where('class_id', $class_id);
		$this->db->where('section_id', $section_id);
		$this->db->where('school_id', school_id());
		return $this->db->get('assignments');
	}

	public function save_answers($question_id = "", $assignment_id = ""){
		$error_message = null;
		$student_id = $this->session->userdata('user_id');
		$question_type = $this->get_questions($question_id)->row('question_type');
		$question_answer = $this->db->get_where('assignment_answers', array('question_id' => $question_id, 'student_id' => $student_id));


		if($question_type == 'file'){
			if(!empty($_FILES['question_answer']['name'])){
				$file_extension = pathinfo($_FILES['question_answer']['name'], PATHINFO_EXTENSION);
				$data['answer'] = md5(rand(10000000, 20000000)).'.'.$file_extension;
	            move_uploaded_file($_FILES['question_answer']['tmp_name'], 'uploads/assignment_files/' . $data['answer']);
            }else{
            	$error_message = get_phrase('first_choose_a_file');
            }
		}elseif($question_type == 'text'){
			if(!empty(htmlspecialchars($this->input->post('question_answer')))){
				$data['answer'] = htmlspecialchars($this->input->post('question_answer'));
			}else{
				$error_message = get_phrase('first_write_your_answer');
			}
		}

		$data['date_updated'] = strtotime(date('d M Y'));
		$data['answer_type'] = $question_type;

		if($question_answer->num_rows() > 0 && $error_message == null){
			$previews_uploaded_file = 'uploads/assignment_files/'.$question_answer->row('answer');
			if(file_exists($previews_uploaded_file)){
				unlink($previews_uploaded_file);
			}
			$this->db->where('question_id', $question_id);
			$this->db->update('assignment_answers', $data);
			$response['status'] = true;
			$response['message'] = get_phrase('your_answer_has_been_saved');
		}elseif($error_message == null){
			$data['status'] = 0;
			$data['assignment_id'] = $assignment_id;
			$data['question_id'] = $question_id;
			$data['student_id'] = $student_id;
			$this->db->insert('assignment_answers', $data);
			$response['status'] = true;
			$response['message'] = get_phrase('your_answer_has_been_saved');
		}else{
			$response['status'] = false;
			$response['message'] = $error_message;
		}
			
		return json_encode($response);
	}

	public function submit_assignment($assignment_id = ""){
		$student_id = $this->session->userdata('user_id');

		$this->db->where('assignment_id', $assignment_id);
		$this->db->where('student_id', $student_id);
		$this->db->update('assignment_answers', array('status' => 1));
	}
//-----------------STUDENT END------------------//
}