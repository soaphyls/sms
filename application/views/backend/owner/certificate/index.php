<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-certificate jgreen"></i><small> <?php echo get_phrase('manage_certificate'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up jgreen"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
               <strong> <?php echo get_phrase('quick_link'); ?>: </strong>
               
                    <a href="<?php echo route('cert_type'); ?>"><?php echo get_phrase('certificate'); ?> <?php echo get_phrase('type'); ?></a> |
                
                
                    <a href="<?php echo route('generate'); ?>"><?php echo get_phrase('generate'); ?> <?php echo get_phrase('certificate'); ?></a>
             
            </div>
            
            
            <div class="x_content"> 
                
                <div class="row">
				
				            
                    <div class="col-md-3 col-sm-3 col-xs-12">
					<form method="POST" class="col-12 d-block ajaxForm" action="<?php echo route('list_generate'); ?>" id = "student_admission_form" enctype="multipart/form-data">
					        <div class="item form-group"> 
                            <div><?php echo get_phrase('class'); ?> <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12 select2"  name="class_id"  id="class_id" required="required">
                                <option value="">--<?php echo get_phrase('select'); ?>--</option> 
									 <?php
								$classes = $this->db->get_where('classes', array('school_id' => school_id()))->result_array();
								foreach($classes as $class){
									?>
                                <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                            <?php } ?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo get_phrase('certificate'); ?> <?php echo get_phrase('type'); ?> <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12 select2"  name="certificate_id"  id="certificate_id" required="required">
                                <option value="">--<?php echo get_phrase('select'); ?>--</option>  
                               
								<?php
								$certificates = $this->db->get('certificates')->result_array();
								foreach($certificates as $certificate){
									?>
							   <option value="<?php echo $certificate['id']; ?>"><?php echo $certificate['name']; ?></option>
                            <?php } ?>
                            </select>
                            
                        </div>
                    </div>
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo get_phrase('find'); ?></button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            
             <div class="x_content">
                
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-group"></i> <?php echo get_phrase('student'); ?> <?php echo get_phrase('list'); ?></a></a>
					  </li>
					  </ul>
					<div class="tab-content" id="myTabContent">
					  <div class="tab-pane fade show active" id="tab_user_list" role="tabpanel" aria-labelledby="home-tab" style="padding:10px 0">
					  <div class="clearfix"></div>
					    <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo get_phrase('sl_no'); ?></th>
                                        <th><?php echo get_phrase('photo'); ?></th>                                                                    
                                        <th><?php echo get_phrase('name'); ?></th>
                                        <th><?php echo get_phrase('phone'); ?></th>
                                        <th><?php echo get_phrase('email'); ?></th>
                                        <th><?php echo get_phrase('created'); ?></th>                                            
                                        <th><?php echo get_phrase('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody id="fn_mark">   
                                    <?php
                                    $count = 1;
                                    if (isset($students) && !empty($students)) {
                                        ?>
                                        <?php foreach ($students as $obj) { ?>
                                         
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td>
                                                    <?php if ($obj->photo != '') { ?>                                        
                                                        <img src="<?php echo UPLOAD_PATH; ?>/student-photo/<?php echo $obj->photo; ?>" alt="" width="60" /> 
                                                    <?php } else { ?>
                                                        <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="60" /> 
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo ucfirst($obj['name']); ?></td>
                                                <td><?php echo $obj['phone']; ?></td>
                                                <td><?php echo $obj['email']; ?></td>   
                                                <td><?php echo date('M j, Y', strtotime($obj['created_at'])); ?></td>   
                                                <td>    
                                                    
                                                    <a target="_blank" href="<?php echo route('generate/filter/'.$obj['id'].'/'.$class_id .'/'.$certificate_id); ?>"  class="btn btn-success btn-xs"><i class="fa fa-certificate"> <?php echo get_phrase('generate'); ?></i></a>
                                                    
                                                </td>   
                                            </tr>
                                        <?php } ?>
                                    <?php } ?> 

                                </tbody>
                            </table> 
                        </div> 
                        </div>
                 </div>
            </div>

            
        </div>
    </div>
</div>
</div>

 <script type="text/javascript">

        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
        buttons: [
            'copy','print'],
              search: true
          });
		 
		$('.collapse-link').on('click', function () {
        var $BOX_PANEL = $(this).closest('.x_panel'),
                $ICON = $(this).find('i'),
                $BOX_CONTENT = $BOX_PANEL.find('.x_content');

        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function () {
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200);
            $BOX_PANEL.css('height', 'auto');
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });  
		  
		  
        });
        
     $("#generate").validate();  


function sendnow(){
    var certificate_id = $('#certificate_id').val();
    var class_id = $('#class_id').val();
     if(class_id != "" && certificate_id != "" ){
        $.ajax({
            type: 'POST',
            url: '<?php echo route('generate/filter') ?>',
            data: {class_id : class_id, certificate_id : certificate_id},
            success: function(response){
                $('.mark_content').html(response);
            }
        });
    }else{
        toastr.error('<?php echo get_phrase('please_select_in_all_fields !'); ?>');
    }
}	 
    

// /Panel toolbox
</script> 


<style type="text/css">

.x_panel {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
    padding: 10px 17px;
    display: inline-block;
    background: #fff;
    border: 1px solid #E6E9ED;
    -webkit-column-break-inside: avoid;
    -moz-column-break-inside: avoid;
    column-break-inside: avoid;
    opacity: 1;
    transition: all .2s ease
}
.x_title {
    border-bottom: 2px solid #0acf97;
    padding: 1px 5px 6px;
    margin-bottom: 10px
}
.x_title .filter {
    width: 40%;
    float: right
}
.x_title h2 {
    margin: 5px 0 6px;
    float: left;
    display: block;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap
}
.x_title h2 small {
    margin-left: 10px
}
.x_title span {
    color: #BDBDBD
}
.x_content {
    position: relative;
    width: 100%;
    float: left;
    clear: both;
}
.x_content h4 {
    font-size: 16px;
    font-weight: 500
}

.quick-link{
    font-size: 12px;
    color: #656565;
    margin-bottom: 10px;
}
.quick-link a{
    color: #08c;
}
.quick-link span{
    float:left;
    padding: 10px 10px 0 0;
}
.quick-link select{
    width: auto;
}

.head-title, .head-title small {
    
	font-size: 18px;
}

.jgreen{color:#0acf97}
.panel_toolbox {
    float: right !important;
    min-width: 70px
}
.panel_toolbox>li {
    float: left;
    cursor: pointer
}
.panel_toolbox>li>a {
    padding: 5px;
    color: #C5C7CB;
    font-size: 14px
}
.panel_toolbox>li>a:hover {
    background: #F5F7FA
}

.navbar-right {
    margin-right: 0
}
.top_nav .navbar-right {
    margin: 0;
    width: auto;
    float: right
}

.clearfix:after,
form:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden
}

.nav-tabs>li>a:hover {   
    border-bottom: 0;
}
.nav-tabs>li {    
    margin-bottom: -2px;
}

.active a span.fa {
    text-align: right !important;
    margin-right: 4px
}
.nav {
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
</style>