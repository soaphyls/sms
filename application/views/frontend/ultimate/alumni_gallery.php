<?php
  $this->db->where('visibility', 1);
  $this->db->where('school_id', $active_school_id);
  $query = $this->db->get('alumni_gallery');
  $galleries = $query->result_array();
?>
<!-- ========== MAIN ========== -->
<main id="content" role="main">
  <!-- Hero Section -->
  <div class="gradient-half-primary-v1">
    <div class="container text-center space-top-4 space-top-md-4 space-top-lg-3 space-bottom-1">
      <!-- Title -->
      <div class="w-md-80 w-lg-50 mx-auto mb-5">
        <h1 class="h1 text-white">
          <span class="font-weight-semi-bold"><?php echo get_phrase('Alumni Photo Gallery'); ?></span>
        </h1>
      </div>
      <!-- End Title -->
    </div>
  </div>
  <!-- End Hero Section -->

  <!-- Gallery section starts -->
  <div class="bg-light">
    <div class="container space-2 space-md-2">

      <!-- Title -->
      <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9">
        <span class="btn btn-xs btn-soft-success btn-pill mb-2"><?php echo get_phrase('Alumni Albums'); ?></span>
        <h2 class="text-primary"><?php echo get_phrase('Our latest photo galleries'); ?></h2>
      </div>
      <!-- End Title -->

      <div class="row mx-gutters-2">

        <?php
        foreach ($galleries as $row) {
          $this->db->where('gallery_id', $row['id']);
          $query = $this->db->get('alumni_gallery_photos');
          $images = $query->result_array();
          $number_of_image = count($images);

          // determining the first image of gallery
          foreach ($images as $image) {
            $cover_image = $image['photo'];
            break;
          }
        ?>
        <!-- Gallery thumb starts -->
        <div class="col-md-4 mb-3">
          <a class="d-flex align-items-end bg-img-hero gradient-overlay-half-dark-v1 transition-3d-hover height-450 rounded-pseudo" href="<?php echo site_url('home/alumni_gallery_view/'.$row['id']);?>"
          style="background-image: url(<?php echo $this->alumni_model->get_gallery_image($cover_image); ?>);">
            <article class="w-100 text-center p-6">
              <h3 class="h4 text-white">
                <?php echo $row['title']; ?>
              </h3>
              <div class="mt-4" style="margin-top:0px !important;">
                <strong class="d-block text-white-70 mb-2">
                  <?php echo $number_of_image;?> <?php echo get_phrase('images'); ?>
                </strong>
              </div>
            </article>
          </a>
        </div>
        <!-- Gallery thumb ends -->
        <?php } ?>

      </div>

    </div>
  </div>
  <!-- Gallery section ends -->
</main>
  <!-- ========== END MAIN ========== -->
