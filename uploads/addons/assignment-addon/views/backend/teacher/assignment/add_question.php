<form method="POST" class="d-block ajaxForm" action="<?php echo site_url('addons/assignment/questions/create/'.$param1); ?>">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="question"><?php echo get_phrase('question'); ?></label>
            <input type="text" class="form-control" id="question" name = "question" required>
            <small id="title_help" class="form-text text-muted"><?php echo get_phrase('provide_question_title'); ?></small>
        </div>

        <div class="form-group col-md-12">
            <label for="mark"><?php echo get_phrase('mark'); ?></label>
            <input type="number" class="form-control" id="mark" name = "mark" min="0" required>
        </div>

        <div class="form-group col-md-12">
            <label><?php echo get_phrase('question_type'); ?></label><br>
            <input type="radio" value="text" id="question_type_text" name="question_type" required>
            <label for="question_type_text"><?php echo get_phrase('text'); ?></label>
            <input type="radio" value="file" id="question_type_file" name="question_type" class="ml-2" required>
            <label for="question_type_file"><?php echo get_phrase('file'); ?></label>
        </div>

        <div class="form-group mt-2 col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('add_question'); ?></button>
        </div>
    </div>
</form>

<script>
    'use strict';
    $(".ajaxForm").validate({}); // Jquery form validation initialization
    $(".ajaxForm").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, showAssignmentQuestion);
    });
</script>
