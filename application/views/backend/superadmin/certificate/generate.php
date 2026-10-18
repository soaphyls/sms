<!DOCTYPE html>
<html>
<head>      

        <title><?php echo get_phrase('generate'); ?> <?php echo get_phrase('certificate'); ?></title>
        <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico" type="image/x-icon" />        
         <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Allerta+Stencil" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Limelight" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css?family=Michroma" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Prosto+One" rel="stylesheet">         
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

		<!-- Bootstrap -->
		<link href="<?php echo base_url(); ?>assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
			
		<!-- Custom Theme Style -->
		<link href="<?php echo base_url(); ?>assets/vendors/bootstrap/custom.css" rel="stylesheet" type="text/css" />

        
        <style>
            body {background: #fff;}
            @page { margin: 0; }   
            @media print {
                .certificate {                   
                    background: url("<?php echo base_url().'uploads';  ?>/certificate/<?php echo $certificate->background; ?>") no-repeat !important;    
                    min-height: 550px;
                    padding: 10%;
                    width: 100%;
                    margin-left: auto;
                    margin-right: auto;
                    background-size: 100% 100% !important;
                   -webkit-print-color-adjust: exact !important; 
                    color-adjust: exact !important; 
                    text-align: center;
                }              
            } 
   
            .certificate {
                min-height: 550px;
                margin-left: auto;
                margin-right: auto;
                padding: 80px 120px;
                background: url("<?php echo base_url().'uploads';  ?>/certificate/<?php echo $certificate->background; ?>") no-repeat;    
                background-size: 100% 100%;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                text-align: center;
            }
            .x_content{
                width:98%;
            }

    </style>
    </head>

    <body>
        <div class="x_content">
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
                                <div class="col-sm-12" style="text-align:center;">
                                    <div class="name-text"><?php echo $certificate->name; ?> </div>
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

            <!-- this row will not appear when printing -->
            <center class="row no-print">
                <div class="col-xs-12">
                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> <?php echo get_phrase('print'); ?></button>
                </div>
            </center>
        </div>
    </body>
</html>