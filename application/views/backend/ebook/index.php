<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body py-2">
                <h4 class="page-title d-inline-block">
                    <i class="mdi mdi-database title_icon"></i> <?php echo get_phrase('ebook'); ?>
                </h4>
              <?php if ($this->session->userdata('librarian_login') == 1) { ?>  <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle float-end mt-1" onclick="rightModal('<?php echo site_url('addons/ebooks/ebook_add'); ?>', '<?php echo get_phrase('add_ebook'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_ebook'); ?></button>
            <?php }  else { echo "" ;}?>
			</div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end page title -->

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class = "book_content">
				<?php if ($this->session->userdata('librarian_login') == 1) { include 'list.php';} else { ?>
				
				<?php include 'all.php'; }?>
                </div> <!-- end table-responsive-->
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<script>
var showAllEbooks = function () {
    var url = '<?php echo site_url('addons/ebooks/index/list'); ?>';

    $.ajax({
        type : 'GET',
        url: url,
        success : function(response) {
            $('.book_content').html(response);
            
        }
    });
}
</script>
