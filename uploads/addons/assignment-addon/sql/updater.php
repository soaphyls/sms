<?php
$CI = get_instance();
$CI->load->database();
$CI->load->dbforge();

$menu_data1['displayed_name'] = 'assignment';
$menu_data1['route_name'] = 'assignment/student_assignment/published';
$menu_data1['parent'] = '0';
$menu_data1['icon'] = 'mdi mdi-clipboard-text-outline';
$menu_data1['status'] = '1';
$menu_data1['superadmin_access'] = '0';
$menu_data1['admin_access'] = '0';
$menu_data1['teacher_access'] = '1';
$menu_data1['parent_access'] = '0';
$menu_data1['student_access'] = '0';
$menu_data1['accountant_access'] = '0';
$menu_data1['librarian_access'] = '0';
$menu_data1['sort_order'] = '52';
$menu_data1['is_addon'] = '1';

if($this->db->get_where('menus', array('unique_identifier' => 'assignment'))->num_rows() > 0){
	$CI->db->where('unique_identifier', 'assignment');
	$CI->db->update('menus', $menu_data1);
}else{
	$menu_data1['unique_identifier'] = 'assignment';
	$CI->db->insert('menus', $menu_data1);
}

$menu_data2['displayed_name'] = 'my_assignment';
$menu_data2['route_name'] = 'assignment/my_active_assignment';
$menu_data2['parent'] = '0';
$menu_data2['icon'] = 'mdi mdi-clipboard-text-outline';
$menu_data2['status'] = '1';
$menu_data2['superadmin_access'] = '0';
$menu_data2['admin_access'] = '0';
$menu_data2['teacher_access'] = '0';
$menu_data2['parent_access'] = '0';
$menu_data2['student_access'] = '1';
$menu_data2['accountant_access'] = '0';
$menu_data2['librarian_access'] = '0';
$menu_data2['sort_order'] = '52';
$menu_data2['is_addon'] = '1';
$menu_data2['unique_identifier'] = 'assignment';
$CI->db->insert('menus', $menu_data2);


$assignments = array(
	'id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => TRUE,
		'auto_increment' => TRUE
	),
	'title' => array(
		'type' => 'LONGTEXT',
		'null' => TRUE
	),
	'teacher_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'class_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'section_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'subject_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'deadline' => array(
		'type' => 'VARCHAR',
		'constraint' => 255,
		'null' => TRUE
	),
	'status' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'school_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'date_added' => array(
		'type' => 'VARCHAR',
		'constraint' => 255,
		'null' => TRUE
	)
);

$CI->dbforge->add_field($assignments);
// define primary key
$CI->dbforge->add_key('id', TRUE);
// create table
$CI->dbforge->create_table('assignments');

// define table fields
$assignment_answers = array(
	'id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => TRUE,
		'auto_increment' => TRUE
	),
	'assignment_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'question_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'student_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'answer' => array(
		'type' => 'LONGTEXT',
		'null' => TRUE
	),
	'answer_type' => array(
		'type' => 'VARCHAR',
		'constraint' => 100,
		'null' => TRUE
	),
	'obtained_mark' => array(
		'type' => 'FLOAT',
		'null' => TRUE
	),
	'status' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'date_updated' => array(
		'type' => 'VARCHAR',
		'constraint' => 255,
		'null' => TRUE
	)
);

$CI->dbforge->add_field($assignment_answers);
// define primary key
$CI->dbforge->add_key('id', TRUE);
// create table
$CI->dbforge->create_table('assignment_answers');


// define table fields
$assignment_questions = array(
	'id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => TRUE,
		'auto_increment' => TRUE
	),
	'assignment_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'question' => array(
		'type' => 'TEXT',
		'null' => TRUE
	),
	'question_type' => array(
		'type' => 'VARCHAR',
		'constraint' => 255,
		'null' => TRUE
	),
	'mark' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'date_added' => array(
		'type' => 'VARCHAR',
		'constraint' => 255,
		'null' => TRUE
	)
);
$CI->dbforge->add_field($assignment_questions);
// define primary key
$CI->dbforge->add_key('id', TRUE);
// create table
$CI->dbforge->create_table('assignment_questions');


// define table fields
$assignment_remarks = array(
	'id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => TRUE,
		'auto_increment' => TRUE
	),
	'assignment_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'student_id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'null' => TRUE
	),
	'remark' => array(
		'type' => 'LONGTEXT',
		'null' => TRUE
	)
);
$CI->dbforge->add_field($assignment_remarks);
// define primary key
$CI->dbforge->add_key('id', TRUE);
// create table
$CI->dbforge->create_table('assignment_remarks');


?>
