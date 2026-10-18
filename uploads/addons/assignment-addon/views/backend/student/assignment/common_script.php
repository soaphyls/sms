<script type="text/javascript">
	'use strict';
	
	var showAssignments = function () {
        var url = '<?php echo site_url('addons/assignment/index/list'); ?>';

        $.ajax({
            type : 'GET',
            url: url,
            success : function(response) {
                $('.assignment_content').html(response);
                initDataTable('basic-datatable');
            }
        });
    }

    function save_question_answer(question_id, assignment_id, btn){
		var btn_text = $(btn).text();
		//loading start
		$(btn).html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span><?= get_phrase('saving'); ?>..');
		$(btn).prop("disabled",true);

		var form_data = new FormData();
		
		if($("#question_answer_"+question_id).attr("type") == 'file'){
	    	var question_answer = $('#question_answer_'+question_id).prop('files')[0];
	    }else{
	    	var question_answer = $('#question_answer_'+question_id).val();
	    }
	    form_data.append('question_answer', question_answer);
	    $.ajax({
	        url: '<?= site_url('addons/assignment/save_answers/'); ?>' + question_id + '/' + assignment_id,
	        dataType: 'text',  // what to expect back from the PHP script, if anything
	        cache: false,
	        contentType: false,
	        processData: false,
	        data: form_data,                         
	        type: 'post',
	        success: function(response){
	        	var response = JSON.parse(response);
	   			//end loading
	   			if(response.status == 1){
	         		$.NotificationApp.send("<?php echo get_phrase('congratulations'); ?>!", response.message ,"top-right","rgba(0,0,0,0.2)","success");
					$(btn).html('<span class="px-20">'+btn_text+'</span>');
					$(btn).prop("disabled",false);
				}else{
					$.NotificationApp.send("<?php echo get_phrase('oh_snap'); ?>!", response.message ,"top-right","rgba(0,0,0,0.2)","error");
					$(btn).html('<span class="px-20">'+btn_text+'</span>');
					$(btn).prop("disabled",false);
	   			}
	        }
	     });
	}
</script>