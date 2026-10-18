<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-certificate"></i><small> <?php echo get_phrase('manage_certificate_type'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <strong> <?php echo get_phrase('quick_link'); ?>: </strong>
                
                    <a href="<?php echo route('cert_type'); ?>"><?php echo get_phrase('certificate'); ?> <?php echo get_phrase('type'); ?></a>
               
                
                   | <a href="<?php echo route('generate'); ?>"><?php echo get_phrase('generate'); ?> <?php echo get_phrase('certificate'); ?></a>
                
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
				
            <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link <?php if(isset($list)){ echo 'active'; }?>" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false"><i class="fa fa-list-ol"></i>  Home</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true"><i class="fa fa-plus-square-o"></i>   Add</button>
    <?php if(isset($edit)){ ?>
	<button class="nav-link active" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fa fa-pencil-square-o"></i>   Edit</button>
	<?php } ?>
	<?php if(isset($detail)){ ?>
	<button class="nav-link active" id="nav-view-tab" data-bs-toggle="tab" data-bs-target="#nav-view" type="button" role="tab" aria-controls="nav-View" aria-selected="false"><i class="fa fa-eye"></i>   View</button>
	 <?php } ?>
 </div>
</nav>

 


                    <br/>
                    
                   <div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show  <?php if(isset($list)){ echo 'active'; }?>" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo get_phrase('No'); ?></th>
                                        <th><?php echo get_phrase('certificate'); ?> <?php echo get_phrase('name'); ?></th>
                                        <th><?php echo get_phrase('school'); ?> <?php echo get_phrase('name'); ?></th>
                                        <th nowrap><?php echo get_phrase('main_certificate_text'); ?></th>
                                        <th><?php echo get_phrase('background'); ?></th>
                                        <th width="30%"><?php echo get_phrase('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                
								<tbody>   
                                    <?php  $count = 1; 
									$certificates = $this->db->get('certificates')->result_array();
									
									if(isset($certificates) && !empty($certificates)){ ?>
                                        <?php foreach($certificates as $obj){ ?>
                                        <tr>
                                            <td width="5%"><?php echo $count++; ?></td>
                                            <td width="15%"><?php echo ucfirst($obj['name']); ?></td>
                                            <td width="15%"><?php echo $obj['top_title']; ?></td>
                                            <td width="25px"><?php echo $obj['main_text']; ?></td>
                                            <td width="15px">
                                                <?php // if($obj->background != ''){ ?>
                                                <img src="<?php echo base_url().'uploads'; ?>/certificate/<?php echo $obj['background']; ?>" alt="" width="150" /> 
                                                <?php// } ?>
                                            </td>
                                            <td width="30px">
                                               
                                                    <a href="<?php echo route('view/'.$obj['id']); ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo get_phrase('view'); ?> </a>
                                         
                                                    <a href="<?php echo route('edit/'.$obj['id']); ?>"   class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo get_phrase('edit'); ?> </a>
                                                
                                                
                                                    <a href="<?php echo route('delete/'.$obj['id']); ?>" onclick="javascript: return confirm('<?php echo get_phrase('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo get_phrase('delete'); ?> </a>
                                                
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
							</div>
                        </div>

                        <div  class="tab-pane fade in " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="x_content"> 
                                <div class="col-md-8 col-sm-8 col-xs-12">
								<form method="POST" class="col-12 d-block ajaxForm" action="<?php echo route('add'); ?>" id = "student_admission_form" enctype="multipart/form-data">                                   
								     
                                    <div class="item form-group row mb-3">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> <?php echo get_phrase('certificate'); ?> <?php echo get_phrase('name'); ?> <span class="required">*</span>
                                         </label>
                                         <div class="col-md-9 col-sm-9 ">
                                             <input  class="form-control "  name="name"  id="name" value="<?php echo isset($name) ?  $name : ''; ?>" placeholder="<?php echo get_phrase('certificate'); ?> <?php echo get_phrase('name'); ?>" required="required" type="text">
                                             <div class="help-block"><?php //echo form_error('name'); ?></div>
                                         </div>
                                     </div>

                                     <div class="item form-group row mb-3">
                                         <label class="col-md-3 col-form-label" for="top_title"> <?php echo get_phrase('school'); ?> <?php echo get_phrase('name'); ?> <span class="required">*</span></label>
                                         <div class="col-md-9">
                                             <input  class="form-control "  name="top_title"  id="top_title" value="<?php echo isset($top_title) ?  $top_title : ''; ?>" placeholder="<?php echo get_phrase('school'); ?> <?php echo get_phrase('name'); ?>" required="required" type="text">
                                             
                                         </div>
                                     </div>
                              

                                     <div class="item form-group row mb-3">
                                         <label class="col-md-3 col-form-label" for="main_text"> <?php echo get_phrase('main_certificate_text'); ?> <span class="required">*</span></label>
                                         <div class="col-md-9">
                                             <textarea  class="form-control "  name="main_text"  id="main_text" required="required" placeholder="<?php echo get_phrase('main_certificate_text'); ?>"><?php echo isset($main_text) ?  $main_text : ''; ?></textarea>
                                            
                                             <div class="col-md-9">
                                                <div class="fn_add_tag"></div>
                                            </div>
                                         </div>
                                         
                                     </div>

                                     <div class="item form-group row mb-3">
                                         <label class="col-md-3 col-form-label" for="footer_left"> <?php echo get_phrase('footer_left'); ?></label>
                                         <div class="col-md-9">
                                             <input  class="form-control col-md-7 col-xs-12"  name="footer_left"  id="footer_left" value="<?php echo isset($footer_left) ?  $footer_left : ''; ?>" placeholder="<?php echo get_phrase('footer_left'); ?>" type="text">
                                             <div class="help-block"><?php //echo form_error('footer_left'); ?></div>
                                         </div>
                                     </div>

                                     <div class="item form-group row mb-3">
                                         <label class="col-md-3 col-form-label" for="footer_middle"> <?php echo get_phrase('footer_middle'); ?></label>
                                         <div class="col-md-9 ">
                                             <input  class="form-control col-md-7 col-xs-12"  name="footer_middle"  id="footer_middle" value="<?php echo isset($footer_middle) ?  $footer_middle : ''; ?>" placeholder="<?php echo get_phrase('footer_middle'); ?>"  type="text">
                                             <div class="help-block"><?php //echo form_error('footer_middle'); ?></div>
                                         </div>
                                     </div>

                                     <div class="item form-group row mb-3">
                                         <label class="col-md-3 col-form-label" for="footer_right"> <?php echo get_phrase('footer_right'); ?></label>
                                         <div class="col-md-9 ">
                                             <input  class="form-control col-md-7 col-xs-12"  name="footer_right"  id="footer_right" value="<?php echo isset($footer_right) ?  $footer_right : ''; ?>" placeholder="<?php echo get_phrase('footer_right'); ?>" type="text">
                                             <div class="help-block"><?php //echo form_error('footer_right'); ?></div>
                                         </div>
                                     </div>

                                     <div class="item form-group row mb-3">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12"> <?php echo get_phrase('background'); ?>
                                         </label>
                                         <div class="col-md-9 ">
                                             <div class="btn btn-default btn-file">
                                                 <i class="fa fa-paperclip"></i> <?php echo get_phrase('upload'); ?>
                                                 <input  class="form-control col-md-7 col-xs-12"  name="background"  id="background" type="file">
                                             </div>
                                             <div class="text-info">jpeg,jpg [1300x700]</div>
                                             <div class="help-block"><?php //echo form_error('background'); ?></div>
                                         </div>
                                     </div>

                                     <div class="ln_solid"></div>
                                     <div class="form-group">
                                         <div class="col-md-6 col-md-offset-3">
                                             <a  href="<?php echo site_url('certificate/type'); ?>" class="btn btn-primary"><?php echo get_phrase('cancel'); ?></a>
                                             <button id="send" type="submit" class="btn btn-success"><?php echo get_phrase('submit'); ?></button>
                                         </div>
                                     </div>
                                     </form>
                                </div>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="x_content"> 
                                <div class="col-md-8 col-sm-8 col-xs-12">
									<form method="POST" class="col-12 d-block ajaxForm" action="<?php echo route('edit'); ?>" id = "student_admission_form" enctype="multipart/form-data">                                 
                                    <div class="item form-group row mb-3">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> <?php echo get_phrase('certificate'); ?> <?php echo get_phrase('name'); ?> <span class="required">*</span>
                                         </label>
                                         <div class="col-md-9 ">
                                             <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($certificate) ? $certificate->name : ''; ?>" placeholder="<?php echo get_phrase('certificate'); ?> <?php echo get_phrase('name'); ?>" required="required" type="text">
                                             <div class="help-block"><?php //echo form_error('name'); ?></div>
                                         </div>
                                     </div>

                                     <div class="item form-group row mb-3">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="top_title"><?php echo get_phrase('school'); ?> <?php echo get_phrase('name'); ?> <span class="required">*</span></label>
                                         <div class="col-md-9 ">
                                             <input  class="form-control col-md-7 col-xs-12"  name="top_title"  id="top_title" value="<?php echo isset($certificate) ? $certificate->top_title : ''; ?>" placeholder="<?php echo get_phrase('certificate'); ?> <?php echo get_phrase('name'); ?>" required="required" type="text">
                                             <div class="help-block"><?php //echo form_error('top_title'); ?></div>
                                         </div>
                                     </div>
                                                                     

                                     <div class="item form-group row mb-3">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_text"> <?php echo get_phrase('main_certificate_text'); ?> <span class="required">*</span></label>
                                         <div class="col-md-9">
                                             <textarea  class="form-control col-md-7 col-xs-12"  name="main_text"  id="edit_main_text" required="required" placeholder="<?php echo get_phrase('main_certificate_text'); ?>"><?php echo isset($certificate) ? $certificate->main_text : ''; ?></textarea>
                                             <div class="help-block"><?php // echo form_error('main_text'); ?></div>
                                             <div class="col-md-12 col-sm-12 col-xs-12">
											 <a href="#" onclick="get_tag_by_role()" id= "hideme">+ Show tags</a>
                                                <div class="fn_add_tag"></div>
                                            </div>
                                         </div>
                                     </div>

                                     <div class="item form-group row mb-3">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="footer_left"> <?php echo get_phrase('footer_left'); ?></label>
                                         <div class="col-md-9 ">
                                             <input  class="form-control col-md-7 col-xs-12"  name="footer_left"  id="footer_left" value="<?php echo isset($certificate) ? $certificate->footer_left : ''; ?>" placeholder="<?php echo get_phrase('footer_left'); ?>" type="text">
                                             <div class="help-block"><?php // echo form_error('footer_left'); ?></div>
                                         </div>
                                     </div>

                                     <div class="item form-group row mb-3">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="footer_middle"> <?php echo get_phrase('footer_middle'); ?></label>
                                         <div class="col-md-9 ">
                                             <input  class="form-control col-md-7 col-xs-12"  name="footer_middle"  id="footer_middle" value="<?php echo isset($certificate) ? $certificate->footer_middle : ''; ?>" placeholder="<?php echo get_phrase('footer_middle'); ?>" type="text">
                                             <div class="help-block"><?php // echo form_error('footer_middle'); ?></div>
                                         </div>
                                     </div>

                                     <div class="item form-group row mb-3">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="footer_right"> <?php echo get_phrase('footer_right'); ?></label>
                                         <div class="col-md-9 ">
                                             <input  class="form-control col-md-7 col-xs-12"  name="footer_right"  id="footer_right" value="<?php echo isset($certificate) ? $certificate->footer_right : ''; ?>" placeholder="<?php echo get_phrase('footer_right'); ?>" type="text">
                                             <div class="help-block"><?php // echo form_error('footer_right'); ?></div>
                                         </div>
                                     </div>
                                    
                                    <div class="item form-group row mb-3">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> <?php echo get_phrase('background'); ?>
                                        </label>
                                        <div class="col-md-9 ">
                                            <input type="hidden" name="prev_background" id="prev_background" value="<?php echo $certificate->background; ?>" />
                                            <?php if($certificat->background){ ?>
                                            <img src="<?php echo base_url().'uploads'; ?>/certificate/<?php echo $certificate->background; ?>" alt="" width="120" /><br/><br/>
                                            <?php } ?>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo get_phrase('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="background"  id="background" type="file">
                                            </div>
                                            <div class="text-info">jpeg,jpg [1300x700]</div>
                                            <div class="help-block"><?php //echo form_error('background'); ?></div>
                                        </div>
                                    </div>

                                     <div class="ln_solid"></div>
                                     <div class="form-group">
                                         <div class="col-md-6 col-md-offset-3">
                                             <input type="hidden" value="<?php echo isset($certificate) ? $certificate->id : $id; ?>" name="id" />
                                             <a href="<?php echo route('cert_type'); ?>" class="btn btn-primary"><?php echo get_phrase('cancel'); ?></a>
                                             <button id="send" type="submit" class="btn btn-success"><?php echo get_phrase('update'); ?></button>
                                         </div>
                                     </div>
                                     </form>
									
                                </div>                        
                            </div>
                        </div>  
                        <?php } ?>
                        
                        <?php if(isset($detail)){ ?>
                             <div class="tab-pane fade in show active" id="nav-view" aria-controls="nav-View" aria-labelledby="nav-view">
                                <div class="x_content"> 
                                 <?php //echo form_open_multipart(site_url('certificate/type/view/'. $certificate->id), array('name' => '', 'id' => '', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                    
                                        <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet"> 
                                        <link href="https://fonts.googleapis.com/css?family=Allerta+Stencil" rel="stylesheet"> 
                                        <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
                                        <link href="https://fonts.googleapis.com/css?family=Limelight" rel="stylesheet">  
                                        <link href="https://fonts.googleapis.com/css?family=Michroma" rel="stylesheet"> 
                                        <link href="https://fonts.googleapis.com/css?family=Prosto+One" rel="stylesheet"> 
                                        
                                         <div class="row">
                                             <div class="col-sm-12">
                                                <div class="certificate">
                                                    <div class="certificate-top">
													
                                                        <h2 class="top-heading-title"><?php echo $certificate->top_title; ?></h2>
                                                       <div class="row">
                                                            <span class="sub-title-img">
															<img src="<?php echo $this->settings_model->get_logo_light(); ?>" alt="" height="70">
      
                                                                                                                     </span> 
                                                       </div>
                                                    </div>
                                                    
                                                    <div class="name-ection">
                                                        <div class="row" >
                                                            <div class="col-sm-12">
                                                                <div class="name-text"><?php echo $certificate->name; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="main-text-block">
                                                        <p class="main-text">
                                                            <?php echo $certificate->main_text; ?>
                                                        </p>
                                                    </div>
                                                    <div class="footer-section">
                                                        <div class="row" >
                                                            <div class="col-sm-4 <?php if($certificate->footer_left){ echo 'footer_text'; } ?>"><?php echo $certificate->footer_left; ?></div>
                                                            <div class="col-sm-4 <?php if($certificate->footer_middle){ echo 'footer_text'; } ?>"><?php echo $certificate->footer_middle; ?></div>
                                                            <div class="col-sm-4 <?php if($certificate->footer_right){ echo 'footer_text'; } ?>"><?php echo $certificate->footer_right; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                         </div>
															
                                </div>
                                         </div>
                                    <?php // echo form_close(); ?>
                                </div>
                             </div>
                        <?php } ?>
                    </div>
                </div>				
            </div>
        </div>
    </div>
</div> 


 <script type="text/javascript">
   function get_tag_by_role(){
	 var role_id = "STUDENT";
	 
	 $.ajax({
			 
                url: '<?php echo route('get_tag_by_role/');?>'+ role_id,
				
				success : function(response){
                    $('.fn_add_tag').html(response);
				alert(data)
                }
			 });
	  // alert('Hello Google');
        
   }
   var btn = document.getElementById("nav-profile-tab");
	    // add event listener for the button, for action "click"
	    btn.addEventListener("click", get_tag_by_role);
		
		var btn2 = document.getElementById("hideme");
	    // add event listener for the button, for action "click"
	    btn2.addEventListener("click", get_tag_by_role);
  </script>
<!-- datatable with buttons -->
 <script type="text/javascript">
        // $(document).ready(function() {
          // $('#datatable-responsive').DataTable( {
              // dom: 'Bfrtip',
        // buttons: [
            // 'copy','print'],
              // search: true
          // });
		 
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
    $("#add").validate();     
    $("#edit").validate();     
</script>
<style type="text/css">
     .certificate {
        min-height: 550px;
        margin-left: auto;
        margin-right: auto;
        padding: 80px 120px;
        background: url("<?php echo base_url().'uploads'; ?>/certificate/<?php echo $certificate->background; ?>") no-repeat ;
        background-size: 100% 100%;
    } 
/* Certificate Extra CSS*/
 .certificate-top {
        position: relative;
}

.sub-title-img {
    font-family: 'Prosto One', cursive;
    left: 80%;
    position: absolute;
    top: 40%;
    transform: translate(-50%, 50%);                   
}
               
.name-text {
    font-family: 'Michroma', sans-serif;
    font-size: 25px;  
    color: #333;
    text-align: center;

}                
.top-heading-title {
    text-align: center;
    font-family: 'Allerta Stencil', sans-serif;
    text-transform: uppercase;
    margin-bottom: 0;
} 
.main-text-block {
    margin-top: 30px; 

}
.main-text {
    font-family: 'Great Vibes', cursive;
    font-size: 24px;                    
    line-height: 24px;
    letter-spacing: 2px;
}              
.main-text span{
    padding: 0px 20px 0px 20px;                    
    text-decoration: underline;
}
.name-ection {
    margin-top: 100px;
}
.footer-section {
    margin-top: 30px;
}
.footer_text {
    font-family: 'Prosto One', cursive;
    font-size: 14px;
    border-top: 1px dashed;
    text-align: center;
    padding-top: 10px;
    margin :0px  10px 0px 10px;
    width: 30%; 
}
/* Certificate Extra CSS END*/
x_panel {
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