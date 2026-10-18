<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-settings title_icon"></i><?php echo ucfirst(get_phrase('live_class_settings')); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end page title -->
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <div class="settings_content">
            <?php include 'settings.php'; ?>
        </div>
    </div>
</div>
<script>
function updateLiveClassSettings() {
    $(".live-class-settings-form").validate({});
    $(".live-class-settings-form").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, ()=>{});
    });
}
</script>
