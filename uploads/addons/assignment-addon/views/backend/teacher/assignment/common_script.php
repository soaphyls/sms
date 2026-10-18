<script type="text/javascript">
	'use strict';

	var showAssignments = function () {
        var url = '<?php echo site_url('addons/assignment/student_assignment/list/'.$assignment_type); ?>';

        $.ajax({
            type : 'GET',
            url: url,
            success : function(response) {
                $('.assignment_content').html(response);
                initDataTable('basic-datatable');
            }
        });
    }

    function select_section(classId) {
        $.ajax({
            url: "<?php echo route('section/list/'); ?>"+classId,
            success: function(response){
                $('#selected_section_id').html(response);
                select_subject(classId);
            }
        });
    }

    function select_subject(classId) {
        $.ajax({
            url: "<?php echo route('class_wise_subject/'); ?>"+classId,
            success: function(response){
                $('#selected_subject_id').html(response);
            }
        });
    }

    function classWiseSectionOnCreate(classId) {
        $.ajax({
            url: "<?php echo route('section/list/'); ?>"+classId,
            success: function(response){
                $('#section_id_on_create').html(response);
                classWiseSubjectOnCreate(classId);
            }
        });
    }

    function classWiseSubjectOnCreate(classId) {
        $.ajax({
            url: "<?php echo route('class_wise_subject/'); ?>"+classId,
            success: function(response){
                $('#subject_id_on_create').html(response);
            }
        });
    }

    function save_obtained_mark(answer_id, question_mark, btn){
		var btn_text = $(btn).text();
		//loading start
		$(btn).html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span><?= get_phrase('saving'); ?>..');
        var obtained_mark = $('#obtained_mark_'+answer_id).val();

        if(obtained_mark <= question_mark){
            $.ajax({
                type: 'post',
                url: '<?= site_url('addons/assignment/save_obtained_mark/'); ?>' + answer_id,
                data: {obtained_mark:obtained_mark},                         
                success: function(response){
                    var response = JSON.parse(response);
                    //end loading
                    if(response.status == 1){
                        $.NotificationApp.send("<?php echo get_phrase('congratulations'); ?>!", response.message ,"top-right","rgba(0,0,0,0.2)","success");
                        $(btn).html('<span class="px-20">'+btn_text+'</span>');
                        $(btn).prop("disabled",false);

                        $('#total_obtained_marks').text(response.student_obtained_marks);

                    }else{
                        $.NotificationApp.send("<?php echo get_phrase('oh_snap'); ?>!", '<?php echo get_phrase('something_is_wrong') ?>' ,"top-right","rgba(0,0,0,0.2)","error");
                        $(btn).html('<span class="px-20">'+btn_text+'</span>');
                        $(btn).prop("disabled",false);
                    }
                }
            });
        }else{
            $(btn).html('<span class="px-20">'+btn_text+'</span>');
            $(btn).prop("disabled",false);
            $.NotificationApp.send("<?php echo get_phrase('oh_snap'); ?>!", '<?php echo get_phrase('the_obtained_mark_is_higher_than_the_original_mark') ?>' ,"top-right","rgba(0,0,0,0.2)","error");
        }
	}
</script>