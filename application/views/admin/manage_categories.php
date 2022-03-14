<!DOCTYPE html>
<html lang="en">
<head>

  <!--Admin Page Meta Tags-->
  <title>Manage Main Categories | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
  <meta name="robots" content="noindex">
  <!--/Admin Page Meta Tags-->

  <!--------------------------------------------------------------------------------------------------------------->
  <?php $this->load->view('main/includes/headerscripts'); ?>
  <!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray">

  <!-- Wrapper -->
  <div id="wrapper">

    <!--------------------------------------------------------------------------------------------------------------->
    <div class="clearfix"></div>
    <!--------------------------------------------------------------------------------------------------------------->


    <!-- Dashboard Container -->
    <!--------------------------------------------------------------------------------------------------------------->
    <div class="dashboard-container">
      <?php $this->load->view('admin/includes/sidebar'); ?>
      <!--------------------------------------------------------------------------------------------------------------->

      <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

         <!-- Dashboard Headline -->
         <div class="dashboard-headline">
          <h3>Main Category Manager</h3>

          <!-- Breadcrumbs -->
          <nav id="breadcrumbs" class="dark">
           <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Main Category Manager</a></li>
          </ul>
        </nav>
      </div>

      <!-- Row -->
      <div class="row">

        <!-- Dashboard Box -->
        <div class="col-xl-12">
         <div class="dashboard-box margin-top-0">

          <!-- Headline -->
          <div class="headline">
           <h3>Main Category Manager</h3>
         </div>

         <!----- Content --->
         <div class="card">
           <div class="card-body">
            <form id="MainCategorySettingsForm" method="post" enctype="multipart/form-data"/>

            <div class="col-xl-12">
             <div class="submit-field">
              <label for="category_name">PLATFORM</label>
              <input type="text" class="with-border" id="platform" name = "platform" placeholder="Platform" required="true">
              <input type="hidden" class="form-control" id="platform_id" name = "platform_id">
            </div>
          </div>

          <div class="col-xl-12">
           <div class="submit-field">
            <label for="category_name">PLATFORM NAME</label>
            <input type="text" class="with-border" id="platform_name" name = "platform_name" placeholder="Platform Name" required="true">
          </div>
        </div>

        <div class="col-xl-12">
         <div class="submit-field">
          <label for="category_meta_description">PLATFROM DESCRIPTION</label>
          <textarea rows = "8" class="with-border" cols = "60" name = "platform_description" id="platform_description" maxlength="150" required="true"></textarea>
        </div>
      </div>

      <div class="col-xl-12">
        <div class="submit-field">
          <h5>PLATFORM ICON</h5>
          <div class="uploadButton margin-top-30">
            <input class="uploadButton-input-cover" type="file" accept="image/*" id="uploadListingImage" name="uploadListingImage"/>
            <label class="uploadButton-button ripple-effect" for="uploadListingImage">Upload Icon Image</label>
            <span class="uploadButton-file-name-cover"><b>ICON PNG image</b></span>
          </div>
        </div>
      </div>

      <div class="col-xl-12">
       <div class="submit-field">
        <label for="category_level">PLATFORM STATUS</label>
        <select class="form-control" id="platform_status" name="platform_status">
          <option value="1"> Active </option>
          <option value="0"> Inactive </option>
        </select>
      </div>
    </div>


    <button type="submit" name="btn_categorysave" class="btn btn-success mr-2">Save</button>
    <div id="categoriesSettingsMsg"></div>
    <span id="loadingCategories" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>

    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

  </form>
</div>
</div>
<!----- /Content --->

<!----- PAGES ---------------->
<div class="row">
  <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
    <div class="card mb-3">
      <div class="card-body">
        <div class="container">
        <div class="row">
          <div class="col-12">
            <table class="table table-bordered tbl_responsive">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">PLATFORM</th>
                  <th scope="col">TYPE</th>
                  <th scope="col">VERSION</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($platforms as $platform) { ?>
                <tr>
                  <th scope="row"><?= $platform['id']; ?></th>
                  <td><?= $platform['name']; ?></td>
                  <td><?= strtoupper($platform['type']); ?></td>
                  <td><?= $platform['version']; ?></td>
                  <td>
                    <?php if(!in_array($platform['platform'],array('domain','website','app'))) { ?>
                    <button data-id="<?= $platform['id']; ?>" type="button" class="btn btn-success editcategory"><i class="fas fa-edit"></i></button>
                    <button data-id="<?= $platform['id']; ?>" type="button" class="btn btn-danger deletecategory"><i class="far fa-trash-alt"></i></button>
                    <?php } ?>
                  </td>
                </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>              
  </div><!-- end card-->          
</div>
</div>
<!----- /PAGES ---------------->
</div>
</div>
</div>
<!-- Row / End -->

<!----------------------------------------------------------------------------------------------------------->
<?php $this->load->view('user/includes/footer'); ?>
<!----------------------------------------------------------------------------------------------------------->

</div>
</div>
<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<? if(DEMO_MODE) { 
  $this->load->view('admin/includes/disabled');
} ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>