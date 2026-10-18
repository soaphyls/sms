<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addons
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

if (! function_exists('get_settings')) {
  function get_settings($type = '') {
    $CI	=&	get_instance();
    $CI->load->database();
    $result = $CI->db->get_where('settings', array('id' => 1))->row_array();
    return $result[$type];
  }
}

if (! function_exists('get_common_settings')) {
  function get_common_settings($type = '') {
    $CI =&  get_instance();
    $CI->load->database();

    $CI->db->where('type', $type);
    $result = $CI->db->get('common_settings')->row('description');
    return $result;
  }
}

if (! function_exists('get_payment_settings')) {
  function get_payment_settings($key = '') {
      $CI =&  get_instance();
      $CI->load->database();

      $CI->db->where('key', $key);
      $result = $CI->db->get('payment_settings')->row('value');
      return $result;
  }
}

if (! function_exists('timezone')) {
  function timezone($type = '') {
    $CI	=&	get_instance();
    $CI->load->database();
    $result = $CI->db->get_where('settings', array('id' => 1))->row_array();
    date_default_timezone_set($result['timezone']);
  }
}

if (! function_exists('get_frontend_settings')) {
  function get_frontend_settings($type = '') {
    $CI	=&	get_instance();
    $CI->load->database();
    $result = $CI->db->get_where('frontend_settings', array('id' => 1))->row_array();
    if ($type == 'facebook' || $type == 'twitter' || $type == 'linkedin' || $type == 'google' || $type == 'youtube' || $type == 'instagram') {
      $social = $result['social_links'];
      $links = json_decode($social);
      return $links[0]->$type;
    }
    return $result[$type];
  }
}

if (! function_exists('get_current_school_data')) {
  function get_current_school_data($type = '') {
    $CI	=&	get_instance();
    $CI->load->database();
    $result = $CI->settings_model->get_current_school_data();
    return $result[$type];
  }
}


if (! function_exists('get_smtp')) {
  function get_smtp($type = '') {
    $CI	=&	get_instance();
    $CI->load->database();
    $result = $CI->db->get_where('smtp_settings', array('id' => 1))->row_array();
    return $result[$type];
  }
}


if (! function_exists('get_sms')) {
  function get_sms($type = '') {
    $CI	=&	get_instance();
    $CI->load->database();
    $result = $CI->db->get_where('sms_settings', array('id' => 1))->row_array();
    return $result[$type];
  }
}

if (! function_exists('route')) {
  function route($path = '') {
    $CI	=&	get_instance();
    $controller = "";
    if ($CI->session->userdata('user_type') == 'parent') {
      $controller = 'parents';
    }else{
      $controller = $CI->session->userdata('user_type');
    }
    return site_url($controller.'/'.$path);
  }
}

if ( ! function_exists('trimmer'))
{
  function trimmer($text) {
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    if (empty($text))
    return 'n-a';
    return $text;
  }
}

if ( ! function_exists('get_menu'))
{
  function get_menu($menu_id, $parameter) {
    $CI	=&	get_instance();
    if ($lookup_value == 'parent') {
      $menu_detail = $CI->db->get_where('menus', array('id' => $menu_id))->row_array();
      return $menu_detail['parent'];
    }
  }
}

if ( ! function_exists('slugify'))
{
  function slugify($text) {
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    if (empty($text))
    return 'n-a';
    return $text;
  }
}

// Currency helpers
if (! function_exists('currency')) {
  function currency($price = "") {
    $CI	=&	get_instance();
    $CI->load->database();
    $settings_data = $CI->db->get_where('settings', array('id' => 1))->row_array();
    $currency_code = $settings_data['system_currency'];

    $CI->db->where('code', $currency_code);
    $symbol = $CI->db->get('currencies')->row()->symbol;

    $position = $settings_data['currency_position'];

    if ($position == 'right') {
      return $price.$symbol;
    }elseif ($position == 'right-space') {
      return $price.' '.$symbol;
    }elseif ($position == 'left') {
      return $symbol.$price;
    }elseif ($position == 'left-space') {
      return $symbol.' '.$price;
    }
  }
}

if (! function_exists('currency_code_and_symbol')) {
  function currency_code_and_symbol($type = "") {
    $CI	=&	get_instance();
    $CI->load->database();

    $settings_data = $CI->db->get_where('settings', array('id' => 1))->row_array();
    $currency_code = $settings_data['system_currency'];

    $CI->db->where('code', $currency_code);
    $symbol = $CI->db->get('currencies')->row()->symbol;
    if ($type == "") {
      return $symbol;
    }else {
      return $currency_code;
    }
  }
}


//SCHOOL ID
if (! function_exists('school_id')) {
  function school_id() {
    $CI =&  get_instance();
    if ($CI->session->userdata('user_type') == 'superadmin') {
      return get_settings('school_id');
    }else{
      if ($CI->session->userdata('school_id') > 0) {
        return $CI->session->userdata('school_id');
      }
      else{
        return get_settings('school_id');
      }
    }
  }
}

//ACTIVE USER

if (!function_exists('logged_in_user_id')) {

    function logged_in_user_id() {
        $logged_in_id = 0;
        $CI = & get_instance();
        if ($CI->session->userdata('user_id')):
            $logged_in_id = $CI->session->userdata('user_id');
        endif;
        return $logged_in_id;
    }

}

//ACTIVE SESSION
if (! function_exists('active_session')) {
  function active_session($param1 = '') {
    $CI =&  get_instance();
    $CI->load->database();
    if($param1 == ''){
      $session_details = $CI->db->get_where('sessions', array('status' => 1))->row_array();
      return $session_details['id'];
    }else{
      $session_details = $CI->db->get_where('sessions', array('status' => 1))->row_array();
      return $session_details[$param1];
    }
  }
}


// TEACHER PERMISSION. PROVIDE MODULE NAME AND TEACHERS ID
if (! function_exists('has_permission')) {
  function has_permission($class_id = "", $section_id = "",$subject_id = "", $module = "", $teacher_id = "") {
    $CI =&  get_instance();
    $CI->load->database();
    if (empty($teacher_id)) {
      $user_id = $CI->session->userdata('user_id');
      $teacher_details = $CI->db->get_where('teachers', array('user_id' => $user_id))->row_array();
      $teacher_id = $teacher_details['id'];
    }
    $school_id = school_id();
    $permission_details = $CI->db->get_where('teacher_permissions', array('class_id' => $class_id, 'section_id' => $section_id,'subject_id' => $subject_id, 'teacher_id' => $teacher_id));
    if ($permission_details->num_rows() > 0) {
      $permission_details = $permission_details->row_array();
      return $permission_details[$module];
    }else{
      return 0;
    }

  }
}

// FORM TEACHER PERMISSION. PROVIDE MODULE NAME AND TEACHERS ID
if (! function_exists('has_ft_permission')) {
  function has_ft_permission($class_id = "", $section_id = "", $module = "", $teacher_id = "") {
    $CI =&  get_instance();
    $CI->load->database();
    if (empty($teacher_id)) {
      $user_id = $CI->session->userdata('user_id');
      $teacher_details = $CI->db->get_where('teachers', array('user_id' => $user_id))->row_array();
      $teacher_id = $teacher_details['id'];
    }
    $school_id = school_id();
    $ft_permission_details = $CI->db->get_where('ft_permissions', array('class_id' => $class_id, 'section_id' => $section_id, 'teacher_id' => $teacher_id));
    if ($ft_permission_details->num_rows() > 0) {
      $ft_permission_details = $ft_permission_details->row_array();
      return $ft_permission_details[$module];
    }else{
      return 0;
    }

  }
}



// TEACHER PERMISSION. PROVIDE MODULE NAME AND TEACHERS ID
if (! function_exists('null_checker')) {
  function null_checker($value = "") {
    if (trim($value, "") == "") {
      return '('.get_phrase('not_found').')';
    }else{
      return $value;
    }
  }
}

// RANDOM NUMBER GENERATOR FOR STUDENT CODE
if (! function_exists('student_code')) {
  function student_code($length_of_string = 8) {
    // String of all numeric character
    $str_result = '0123456789';
    // Shufle the $str_result and returns substring of specified length
    $unique_id = substr(str_shuffle($str_result), 0, $length_of_string);
    $splited_unique_id = str_split($unique_id, 4);
    $running_year = date('Y');
    $student_code = $running_year.'-'.$splited_unique_id[0].'-'.$splited_unique_id[1];
    return $student_code;
  }
}

// RANDOM NUMBER GENERATOR FOR ELSEWHERE
if (! function_exists('random')) {
  function random($length_of_string) {
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    // Shufle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result), 0, $length_of_string);
  }
}

// ELLIPSIS A TEXT
if ( ! function_exists('ellipsis'))
{
  // Checks if a video is youtube, vimeo or any other
  function ellipsis($long_string, $max_character = 30) {
    $short_string = strlen($long_string) > $max_character ? substr($long_string, 0, $max_character)."..." : $long_string;
    return $short_string;
  }
}


// GET GRADE
if ( ! function_exists('get_grade'))
{
  function get_grade($acquired_number = "", $type = "") {
    $CI =&  get_instance();
    $CI->load->database();
    if (empty($acquired_number)) {
      return "N/A";
    }else{
      $CI->db->where('school_id', school_id());
      $acquired_grade = $CI->db->get('grades');
      if ($acquired_grade->num_rows() > 0) {
        $acquired_grade = $acquired_grade->result_array();
        $founder = false;
        foreach ($acquired_grade as $grade) {
          if ($acquired_number >= $grade['mark_from'] && $acquired_number <= $grade['mark_upto']) {
            $founder = true;
            if (!empty($type)) {
              return $grade[$type];
            }else{
              return $grade['name'].'('.$grade['grade_point'].')';
            }
          }
        }
        if(!$founder){
          return "N/A";
        }
      }else{
        return "N/A";
      }
    }
  }
}

// CHECKING FOR HIGHEST MARK
if (! function_exists('get_highest_marks')) {
  function get_highest_marks( $exam_id , $class_id , $subject_id ) {
	  $CI =&  get_instance();
      $CI->load->database();
        $CI->db->where('exam_id' , $exam_id);
        $CI->db->where('class_id' , $class_id);
        $CI->db->where('subject_id' , $subject_id);
        $CI->db->select_max('mark_total');
        $highest_marks = $CI->db->get('marks')->result_array();
        foreach($highest_marks as $row) {
            echo $row['mark_total'];
        }
    }
}


// CHECKING FOR LOWEST MARK
if (! function_exists('get_lowest_marks')) {
  function get_lowest_marks( $exam_id , $class_id , $subject_id ) {
	  $CI =&  get_instance();
      $CI->load->database();
        $CI->db->where('exam_id' , $exam_id);
        $CI->db->where('class_id' , $class_id);
        $CI->db->where('subject_id' , $subject_id);
        $CI->db->select_min('mark_total');
        $lowest_mark = $CI->db->get('marks')->result_array();
        foreach($lowest_mark as $row) {
            echo $row['mark_total'];
        }
    }
}

if (!function_exists('get_group_by_type')) {

    function get_group_by_type() {
        $ci = & get_instance();
        return array(
            'daily' => $ci->lang->line('daily'),
            'monthly' => $ci->lang->line('monthly'),
            'yearly' => $ci->lang->line('yearly')
        );
    }

}


if (!function_exists('get_template_tags')) {

    function get_template_tags($role_id) {
        $tags = array();
        $tags[] = '[name]';
        $tags[] = '[email]';
        $tags[] = '[phone]';

        if ($role_id == student) {

            $tags[] = '[class_name]';
            $tags[] = '[section]';
            $tags[] = '[roll_no]';
            $tags[] = '[dob]';
            $tags[] = '[gender]';
            $tags[] = '[religion]';
            $tags[] = '[blood_group]';
            $tags[] = '[registration_no]';
            $tags[] = '[group]';
            $tags[] = '[created_at]';
            $tags[] = '[parent]';
            
        } else if ($role_id == GUARDIAN) {
            $tags[] = '[profession]';
        } else if ($role_id == TEACHER) {
            $tags[] = '[responsibility]';
            $tags[] = '[gender]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';
            $tags[] = '[joining_date]';
        } else {
            $tags[] = '[designation]';
            $tags[] = '[gender]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';
            $tags[] = '[joining_date]';
        }

        $tags[] = '[present_address]';
        $tags[] = '[permanent_address]';

        return $tags;
    }

}


if (!function_exists('get_user_by_role')) {

    function get_user_by_role($role_id, $user_id) {

        $CI =&  get_instance();
		$CI->load->database();

        if ($role_id == student) {

            $CI->db->select('S.*, E.id, E.section_id, E.class_id,U.gender, U.email, U.role,U.name, C.name AS class_name, SE.name AS section');
            $CI->db->from('enrols AS E');
            $CI->db->join('students AS S', 'S.id = E.student_id', 'left');
            $CI->db->join('parents AS P', 'P.id = S.parent_id', 'left');
            $CI->db->join('users AS U', 'U.id = S.user_id', 'left');
            $CI->db->join('classes AS C', 'C.id = E.class_id', 'left');
            $CI->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
            $CI->db->where('S.user_id', $user_id);
            return $CI->db->get()->row();
			//echo $role_id;
            
        } 
        $CI->db->last_query(); 
    }

}




if (!function_exists('get_formatted_body')) {

    function get_formatted_body($body, $role_id, $user_id) {

        $tags = get_template_tags($role_id);
        $user = get_user_by_role($role_id, $user_id);
        $arr = array('[', ']');
        foreach ($tags as $tag) {
            $field = str_replace($arr, '', $tag);
            
            if($field == 'created_at'){                
                $body = str_replace($tag, date('M-d-Y', strtotime($user->created_at)), $body);                
            }else{
                $body = str_replace($tag, $user->{$field}, $body);
            }            
            
        }

        return $body;
    }
}

if (!function_exists('get_formatted_certificate_text')) {

    function get_formatted_certificate_text($body, $role_id, $user_id) {
		$CI = & get_instance();
		//$CI->load->model('user_model');
                            //if (empty($user_id)){echo "hello";}else {echo "You got it";}
        $tags = get_template_tags($role_id);
		$user = get_user_by_role($role_id, $user_id);
       // $user = $CI->user_model->get_user_by_role($role_id, $user_id);
        //if (!empty($user)){echo $role_id."Hello there";}else {echo "You got it";}
        $arr = array('[', ']');
        foreach ($tags as $tag) {
            $field = str_replace($arr, '', $tag);
                  
            if($field == 'created_at'){                
                $body = str_replace($tag, '<span>'.date('M-d-Y', strtotime($user->created_at)).'</span>', $body);                
            }else{
                $body = str_replace($tag, '<span>'.$user->{$field}.'</span>', $body);
            }            
        }

        return $body;
    }
}



// ------------------------------------------------------------------------
/* End of file common_helper.php */
