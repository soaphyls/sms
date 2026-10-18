<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebook_model extends CI_Model {

  // constructor
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        
    }
    
     // public function get_ebook_list($class_id = null){
        
        // if($this->session->userdata('role_id') == STUDENT){
           // $class_id = $this->session->userdata('class_id');
        // }
         
        // $this->db->select('B.*, C.name AS class_name, S.name AS subject');
        // $this->db->from('ebooks AS B');
        // $this->db->join('classes AS C', 'C.id = B .class_id', 'left');
        // $this->db->join('subjects AS S', 'S.id = B.subject_id', 'left');
        
        // if($this->session->userdata('role_id') == TEACHER){
            // $this->db->where('S.teacher_id', $this->session->userdata('profile_id'));
        // }
        
        // if($class_id){
            // $this->db->where('B.class_id', $class_id);
        // }
            
        // return $this->db->get()->result();
        
    // }
    
    public function get_single_ebook($id){
        
        $this->db->select('B.*, C.name AS class_name, S.name AS subject');
        $this->db->from('ebooks AS B');
        $this->db->join('classes AS C', 'C.id = B .class_id', 'left');
        $this->db->join('subjects AS S', 'S.id = B.subject_id', 'left');
        $this->db->where('B.id', $id);
        return $this->db->get()->row();
        
    }
// eBook Manager
	public function get_student_ebooks($class_id="") {
		$checker = array(
			'session' => active_session(),
			'school_id' => school_id(),
			'class_id' => $class_id
		);
		return $this->db->get_where('ebooks', $checker);
	}
	
// eBook Manager
	public function get_ebooks() {
		$checker = array(
			'session' => active_session(),
			'school_id' => school_id()
		);
		return $this->db->get_where('ebooks', $checker);
	}
// eBook Manager by id
	public function get_ebook_by_id($id = "") {
		return $this->db->get_where('ebooks', array('id' => $id))->row_array();
	}
	
	public function get_class_id() {
		$student_id = $this->session->userdata('user_id');
		return $this->db->get_where('enrols', array('student_id' => $student_id, 'school_id' => $school_id, 'session' => active_session()))->row()->class_id;
    
	}

public function create_ebook() {
		$data['name']      = $this->input->post('name');
		$data['author']    = $this->input->post('author');
		$data['class_id']    = $this->input->post('class_id');
		$data['subject_id']    = $this->input->post('subject_id');
		$data['staff_type']    = $this->input->post('staff_type');
		$data['edition']    = $this->input->post('edition');
		$data['language']    = $this->input->post('language');
		$data['school_id'] = school_id();
		$data['status'] = 1;
		$data['created_at'] = date('Y-m-d H:i:s');
	    $data['created_by'] = logged_in_user_id();
		$data['session']   = active_session();
		
		if(!empty($_FILES['cover_image'])){  
           $data['cover_image'] = $this->_upload_cover_image();
        }
        if(!empty($_FILES['file_name'])){  
           $data['file_name'] = $this->_upload_file_name();
        }
		
		$this->db->insert('ebooks', $data);

		$response = array(
			'status' => true,
			'notification' => get_phrase('ebook_added_successfully')
		);
		return json_encode($response);
	}
	
	
	public function edit_ebook() {
		$data['name']      = $this->input->post('name');
		$data['author']    = $this->input->post('author');
		$data['class_id']    = $this->input->post('class_id');
		$data['subject_id']    = $this->input->post('subject_id');
		$data['staff_type']    = $this->input->post('staff_type');
		$data['edition']    = $this->input->post('edition');
		$data['language']    = $this->input->post('language');
		$data['school_id'] = school_id();
		$data['status'] = 1;
		$data['modified_at'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = logged_in_user_id();
		$data['session']   = active_session();
		
		if(!empty($_FILES['cover_image'])){  
           $data['cover_image'] = $this->_upload_cover_image();
        }
       if(!empty($_FILES['file_name'])){  
           $data['file_name'] = $this->_upload_file_name();
        }
		
		
		if($_FILES['course_thumbnail']['tmp_name']){
            unlink('uploads/course_thumbnail/'.html_escape($this->input->post('current_thumbnail')));
            $data['thumbnail'] = rand().'.jpg';
            move_uploaded_file($_FILES['course_thumbnail']['tmp_name'], 'uploads/course_thumbnail/'.$data['thumbnail']);
        }
		$this->db->update('ebooks', $data,array('id' => $this->input->post('id')));

		$response = array(
			'status' => true,
			'notification' => get_phrase('ebook_updated_successfully')
		);
		return json_encode($response);
	}

/*****************Function file_name**********************************
     * @type            : Function
     * @function name   : file_name
     * @description     : Process "Ebook" file upload to server and 
     *                      return file to store into database                  
     * @param           : null
     * @return          : $return_ebook string value 
     * ********************************************************** */
    private function _upload_file_name(){
           
        $prev_ebook     = $this->input->post('prev_file_name');
        $ebook          = $_FILES['file_name']['name'];
        $ebook_type     = $_FILES['file_name']['type'];
        $return_ebook   = '';

        if ($ebook != "") {
            if ($ebook_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || 
                    $ebook_type == 'application/msword' || $ebook_type == 'text/plain' ||
                    $ebook_type == 'application/vnd.ms-office' || $ebook_type == 'application/pdf') {


                $destination = 'uploads/ebook/';               

                $file_type  = explode(".", $ebook);
                $extension  = strtolower($file_type[count($file_type) - 1]);
                $ebook_path = 'ebook-'.time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['file_name']['tmp_name'], $destination . $ebook_path);

                // need to unlink previous ebook
                if ($prev_ebook != "") {
                    if (file_exists($destination . $prev_ebook)) {
                        @unlink($destination . $prev_ebook);
                    }
                }

                $return_ebook = $ebook_path;
            }
        } else {
            $return_ebook = $prev_ebook;
        }

        return $return_ebook;
    }

    
    
    
    
    /*****************Function _upload_cover_image**********************************
    * @type            : Function
    * @function name   : _upload_cover_image
    * @description     : Process to to upload _upload_cove image in the server
    *                    and return image name                   
    *                       
    * @param           : null
    * @return          : $return_image string value 
    * ********************************************************** */
    private function _upload_cover_image() {

        $prev_image = $this->input->post('prev_cover_image');
        $image = $_FILES['cover_image']['name'];
        $image_type = $_FILES['cover_image']['type'];
        $return_image = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' ||
                    $image_type == 'image/jpg' || $image_type == 'image/png' ||
                    $image_type == 'image/x-png' || $image_type == 'image/gif') {

                $destination = 'uploads/book_cover/';

                $file_type = explode(".", $image);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $image_path = 'cover-image-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['cover_image']['tmp_name'], $destination . $image_path);

                // need to unlink previous image
                if ($prev_image != "") {
                    if (file_exists($destination . $prev_image)) {
                        @unlink($destination . $prev_image);
                    }
                }

                $return_image = $image_path;
            }
        } else {
            $return_image = $prev_image;
        }

        return $return_image;
    }

 public function delete_ebook($id = null) {
         
		$ebook = $this->get_ebook_by_id($id);	
      if ($this->db->delete('ebooks', array('id' => $id))) {
                // $ebook = $this->get_ebook_by_id($id);                               
          //  delete ebook file
           //return $ebook['file_name'];
			 $destination = 'uploads/'; 
			 $destination1 = 'uploads/book_cover/';
			
            if (file_exists( $destination.'ebook/'.$ebook['file_name'])) {
               @unlink($destination.'ebook/'.$ebook['file_name']);
			 
            }
            if (file_exists( $destination1.$ebook['cover_image'])) {
            @unlink($destination1.$ebook['cover_image']);
			   
			  
				}
            
            $response = array(
			'status' => true,
			'notification' => get_phrase('ebook_deleted_successfully')
		);
		return json_encode($response);
            
     } 
    }
    
	
	

	
}
