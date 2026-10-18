<table class="table table-bordered table-responsive-sm" width="50%">
<h1 style="text-align: center;">Abbreviation Guide </h1>

<tr>
<th width=5px>SN</th>
<th>(Effectiveness) General Behaviour</th>
<th width=10px>Abbreviation</th>
<th width=5px>SN</th>
<th>(Psychomotor) Skills</th>
<th width=10px>Abbreviation</th>

</tr>
<tr>
<td>1</td>
<td>Punctuality</td>
<td>PT</td>
<td>1</td>
<td>Handwriting</td>
<td>Hw</td>
</tr>
<tr>
<td>2</td>
<td>Neatness</td>
<td>Nt</td>
<td>2</td>
<td>Fluency</td>
<td>Fl</td>
</tr>
<tr>
<td>3</td>
<td>Politeness</td>
<td>Pl</td>
<td>3</td>
<td>Games</td>
<td>Gm</td>
</tr>
<tr>
<td>4</td>
<td>Honesty</td>
<td>Ht</td>
<td>4</td>
<td>Sports</td>
<td>St</td>
</tr>
<tr>
<td>5</td>
<td>Self Control</td>
<td>Sc</td>
<td>5</td>
<td>Gymnastics</td>
<td>Gy</td>
</tr>
<tr>
<td>6</td>
<td>Sense of Responsibility</td>
<td>Rt</td>
<td>6</td>
<td>Drawing & Painting</td>
<td>Dp</td>
</tr>
<tr>
<td>7</td>
<td>Obedience</td>
<td>Ob</td>
<td>7</td>
<td>Musical Performanc</td>
<td>Mp</td>
</tr>
<tr>
<td>8</td>
<td>Initiative</td>
<td>Iv</td>
<td>8</td>
<td>Handling Tools</td>
<td>Ht</td>
</tr>
<tr>
<td>9</td>
<td>Organizational Ability</td>
<td>Oa</td>
<td>9</td>
<td>Crafts</td>
<td>Cf</td>
</tr>



</table>
<form method="POST" class="d-block ajaxForm" action="<?php echo route('primary/prim_mark_update_all'); ?>">

<div class="row mb-3">
    <div class="col-md-4"></div>
    <div class="col-md-4 toll-free-box text-center text-white pb-2" style="background-color: #6c757d; border-radius: 10px;">
        <h4><?php echo get_phrase('primary_school_grading'); ?></h4>
        <span><?php echo get_phrase('class'); ?> : <?php echo $this->db->get_where('classes', array('id' => $class_id))->row('name'); ?></span><br>
        <span><?php echo get_phrase('section'); ?> : <?php echo $this->db->get_where('sections', array('id' => $section_id))->row('name'); ?></span><br>
        </div>
		<input type="hidden"  name="class_id" value ="<?php echo $class_id; ?>">		
		<input type="hidden"  name="section_id" value ="<?php echo $section_id; ?>">		
		<input type="hidden"  name="exam_id" value ="<?php echo $exam_id; ?>">		
		<input type="hidden"  name="student_id" value ="<?php echo $mark['student_id']; ?>">		
		<input type="hidden"  name="student_id" value ="<?php echo $mark['student_id']; ?>">		
      
</div>
<?php
$school_id = school_id();
$prim_marks = $this->crud_model->get_prim_marks($class_id, $section_id, $exam_id)->result_array();
?>
<?php if (count($prim_marks) > 0): ?>
<div class="w-100 table-responsive">

    <table  class="table table-bordered table-sm">
    
        <thead class="thead-dark">
             <tr>
				<th colspan="1"></th>
				<th colspan="9">(Effectiveness) General Behaviour Grade is from 1-5</th>
				<th colspan="10">(Psychomotor) Skill..Grade is from 1-5</th>
				
				</tr>
			 <tr>
                <th><?php echo get_phrase('student_name'); ?></td>
				<th width="4px"><?php echo 'Punct'; ?></td>
				<th width="4px"><?php echo get_phrase('Neatn'); ?></td>
                <th width="4px"><?php echo get_phrase('Polite'); ?></td>
               <th width="4px"><?php echo get_phrase('Hones'); ?></td>
                <th width="4px"><?php echo get_phrase('SelfCo'); ?></td>
				<th width="4px"><?php echo get_phrase('Respo'); ?></td>
                <th width="4px"><?php echo get_phrase('Obedi'); ?></td>
				<th width="4px"><?php echo get_phrase('Initiat'); ?></td>
                <th width="4px"><?php echo get_phrase('Organ'); ?></td>
				<th width="4px"><?php echo get_phrase('Handw'); ?></td>
                <th width="4px"><?php echo get_phrase('Fluncy'); ?></td>
                <th width="4px"><?php echo get_phrase('Games'); ?></td>
				<th width="4px"><?php echo get_phrase('Sports'); ?></td>
				<th width="4px"><?php echo get_phrase('Gymna'); ?></td>
				<th width="4px"><?php echo get_phrase('Painti'); ?></td>
                <th width="4px"><?php echo get_phrase('Music'); ?></td>
				<th width="4px"><?php echo get_phrase('Toolss'); ?></td>
                <th width="4px"><?php echo get_phrase('Crafts'); ?></td>
				</tr>
				</thead>
        <tbody >
        <?php foreach($prim_marks as $mark):
		
                $student = $this->db->get_where('students', array('id' => $mark['student_id']))->row_array(); ?>
                <tr>
                    <td ><?php echo $this->user_model->get_user_details($student['user_id'], 'name'); ?></td>
                   

				   <td>
				   <select name="punct-<?php echo $mark['student_id'];?>" id="Punct-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$punct = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->punct;?>
					<option value="5" <?php if($punct == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($punct == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($punct == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($punct == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($punct == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
					</select>
				   </td>
				   <td>
				   <select name="neatn-<?php echo $mark['student_id'];?>" id="Neatn-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$neatn = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->neatn;?>
					<option value="5" <?php if($neatn == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($neatn == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($neatn == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($neatn == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($neatn == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
					</select>	
				   </td>
				   <td>
				   <select name="polite-<?php echo $mark['student_id'];?>" id="Polite-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$polite = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->polite;?>
					<option value="5" <?php if($polite == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($polite == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($polite == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($polite == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($polite == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
					</select>
				   </td>
				   <td>
				   <select name="honesty-<?php echo $mark['student_id'];?>" id="Honesty-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$honesty = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->honesty;?>
					<option value="5" <?php if($honesty == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($honesty == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($honesty == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($honesty == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($honesty == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
				</select>
				   </td>
				   <td>
				   <select name="self-<?php echo $mark['student_id'];?>" id="Self-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$self = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->self;?>
					<option value="5" <?php if($self == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($self == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($self == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($self == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($self == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
					</select>
				   </td>
				   <td>
				   <select name="respon-<?php echo $mark['student_id'];?>" id="Respon-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$respon = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->respon;?>
					<option value="5" <?php if($respon == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($respon == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($respon == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($respon == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($respon == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
					</select>
				   </td>
				   <td>
				   <select name="obedie-<?php echo $mark['student_id'];?>" id="Obedie-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$obedie = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->obedie;?>
					<option value="5" <?php if($obedie == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($obedie == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($obedie == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($obedie == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($obedie == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
				</select>
				   </td>
				   <td>
				   <select name="initia-<?php echo $mark['student_id'];?>" id="Initia-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$initia = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->initia;?>
					<option value="5" <?php if($initia == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($initia == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($initia == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($initia == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($initia == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
			</select>
				   </td>
				   <td>
				   <select name="organiz-<?php echo $mark['student_id'];?>" id="Organiz-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$organiz = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->organiz;?>
					<option value="5" <?php if($organiz == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($organiz == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($organiz == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($organiz == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($organiz == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
				</select>
				   </td>
				   <td>
				   <select name="hardwr-<?php echo $mark['student_id'];?>" id="Hardwr-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$hardwr = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->hardwr;?>
					<option value="5" <?php if($hardwr == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($hardwr == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($hardwr == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($hardwr == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($hardwr == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
				</select>
				   </td>
				   <td>
				   <select name="fluncy-<?php echo $mark['student_id'];?>" id="Fluncy-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$fluncy = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->fluncy;?>
					<option value="5" <?php if($fluncy == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($fluncy == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($fluncy == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($fluncy == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($fluncy == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
				</select>
				   </td>
				   <td>
				   <select name="games-<?php echo $mark['student_id'];?>" id="games-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$games = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->games;?>
					<option value="5" <?php if($games == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($games == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($games == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($games == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($games == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
				</select>
				   </td>
				   <td>
				   <select name="sports-<?php echo $mark['student_id'];?>" id="Sports-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$sports = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->sports;?>
					<option value="5" <?php if($sports == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($sports == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($sports == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($sports == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($sports == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
					</select>
				   </td>
				   <td>
				   <select name="gymnast-<?php echo $mark['student_id'];?>" id="gymnast-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$gymnast = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->gymnast;?>
					<option value="5" <?php if($gymnast == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($gymnast == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($gymnast == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($gymnast == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($gymnast == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
				</select>
				   </td>
				   <td>
				   <select name="painting-<?php echo $mark['student_id'];?>" id="painting-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$painting = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->painting;?>
					<option value="5" <?php if($painting == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($painting == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($painting == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($painting == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($painting == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
				</select>
				   </td>
				   <td>
				   <select name="music-<?php echo $mark['student_id'];?>" id="music-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$music = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->music;?>
					<option value="5" <?php if($music == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($music == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($music == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($music == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($music == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
					</select>
				   </td>
				   <td>
				   <select name="tools-<?php echo $mark['student_id'];?>" id="tools-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$tools = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->tools;?>
					<option value="5" <?php if($tools == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($tools == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($tools == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($tools == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($tools == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
						</select>
				   </td>
				   <td>
				   <select name="craft-<?php echo $mark['student_id'];?>" id="craft-<?php echo $mark['student_id'];?>" class="form-control select2" data-toggle = "select2">
					<?php 
					$craft = $this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$mark['student_id'],'exam_id'=>$exam_id))->row()->craft;?>
					<option value="5" <?php if($craft == 5) echo 'selected'; ?>><?php echo get_phrase('5'); ?></option>
					<option value="4" <?php if($craft == 4) echo 'selected'; ?>><?php echo get_phrase('4'); ?></option>
					<option value="3" <?php if($craft == 3) echo 'selected'; ?>><?php echo get_phrase('3'); ?></option>
					<option value="2" <?php if($craft == 2) echo 'selected'; ?>><?php echo get_phrase('2'); ?></option>
					<option value="1" <?php if($craft == 1) echo 'selected'; ?>><?php echo get_phrase('1'); ?></option>
					</select>
				   </td>
				   
			
			   </tr>
			<input type="hidden"  name="student_id" value ="<?php echo $mark['student_id']; ?>">		
        <?php endforeach; ?>
        </tbody>
    </table>
	</div>
	<div>
	<center>
					
					<button type="submit"
						class="btn btn-success entypo-check" style="background-color:#060;color:#fff; margin-left:10px;margin-right:10px" >
						<?php echo get_phrase('Save_changes');?>
					</button>
												
					<a href="<?php echo base_url('superadmin/mark');?>" 
						class="btn btn-danger" style="margin-right:30px" >
						<?php echo get_phrase('Cancel');?>
					</a>
				</center>
	
	</div>
	</form>
<?php else: ?>
<?php include APPPATH.'views/backend/empty.php'; ?>
<?php endif; ?>


<script>
    function prim_mark_update(student_id){
        var class_id = '<?php echo $class_id; ?>';
        var section_id = '<?php echo $section_id; ?>';
        var exam_id = '<?php echo $exam_id; ?>';
        var punct = $('#punct-' + student_id).val();
		var neatn = $('#neatn-' + student_id).val();
		var polite = $('#polite-' + student_id).val();
		var honesty = $('#honesty-' + student_id).val();
		var self = $('#self-' + student_id).val();
		var respon = $('#respon-' + student_id).val();
		var obedie = $('#obedie-' + student_id).val();
		var initia = $('#initia-' + student_id).val();
		var organiz = $('#organiz-' + student_id).val();
		var hardwr = $('#hardwr-' + student_id).val();
		var fluncy = $('#fluncy-' + student_id).val();
		var games = $('#games-' + student_id).val();
		var sports = $('#sports-' + student_id).val();
		var gymnast = $('#gymnast-' + student_id).val();
		var painting = $('#painting-' + student_id).val();
		var music = $('#music-' + student_id).val();
		var tools = $('#tools-' + student_id).val();
		var craft = $('#craft-' + student_id).val();
		
		
        if(exam_id != ""){
            $.ajax({
                type : 'POST',
                url : '<?php echo route('primary/prim_mark_update'); ?>',
                data : {student_id : student_id, class_id : class_id,section_id : section_id,exam_id : exam_id,Punct : Punct,
				neatn : neatn,polite : polite,honesty : honesty,self : self,respon : respon,obedie : obedie,initia : initia,organiz : organiz,
				hardwr : hardwr,fluncy : fluncy,games : games,sports : sports,gymnast : gymnast,painting : painting,music : music,tools : tools,craft : craft},
                					
				success : function(response){
                    success_notify('<?php echo get_phrase('mark_hass_been_updated_successfully'); ?>');
                }
            });
        }else{
            toastr.error('<?php echo get_phrase('required_mark_field'); ?>');
        }
    }

    	
	 
  
</script>
<style type="text/css">
.mytable > :not(caption) > * > * {
    padding: 0.2rem 0.2rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    -webkit-box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
--bs-table-bg: transparent;
  --bs-table-accent-bg: transparent;
  --bs-table-striped-color: #6c757d;
  --bs-table-striped-bg: #f1f3fa;
  --bs-table-active-color: #6c757d;
  --bs-table-active-bg: rgba(222, 226, 230, 0.4);
  --bs-table-hover-color: #6c757d;
  --bs-table-hover-bg: #f1f3fa;
  width: 100%;
  margin-bottom: 1.5rem;
  color: #6c757d;
  vertical-align: top;
  border-color: #eef2f7;
			}
			
			
			.xform-control {
 display:block;
  width: 40px;
  height:40px;
  font-size: 0.9rem;
  font-weight: 400;
  line-height: 1.3;
  color: #6c757d;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #dee2e6;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  border-radius: 0.25rem;
  -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
  transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out; }
table.scrolldown tbody {
              
            /* Set the height of table body */
            height: 50px; 
              
            /* Set vertical scroll */
            overflow-y: hidden;
              
            /* Hide the horizontal scroll */
            overflow-x: auto; 
        }
</style>