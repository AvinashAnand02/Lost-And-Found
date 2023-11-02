<?php require_once('./config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
  <body class="toggle-sidebar">
    <style>
      #banner-slider{
        height: 400px;
      }
      #banner-slider .carousel-inner {
          height: 100%;
      }
      #banner-slider img.d-block.w-100 {
          object-fit: cover;
          object-position: center center;
      }
    </style>
     <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
     <?php 
      $pageSplit = explode("/",$page);  
      if(isset($pageSplit[1]))
      $pageSplit[1] = (strtolower($pageSplit[1]) == 'list') ? $pageSplit[0].' List' : $pageSplit[1];
     ?>
     
     <?php require_once('inc/topBarNav.php') ?>
      <!-- Content Wrapper. Contains page content -->
      <main id="main" class="main">
        <?php if(in_array($page, ['home'])): ?>
          <div class="col-12">
            <div id="site-header" style="--bg: url(<?= validate_image($_settings->info('cover')) ?>)">
              <div class="header-content">
                <div class="siteTitle"><?= $_settings->info('name') ?></div>
                <hr class="border-light opacity-100 mx-auto" style="width:100px;border-width:3px">
                <a href="<?= base_url.'?page=items' ?>" class="btn btn-lg btn-primary rounded-pill col-lg-3 col-md-5 col-sm-7 col-10 mx-auto d-block">Find Item</a>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="container-xl px-4">
          <div id="msg-container">
          <?php if($_settings->chk_flashdata('success')): ?>
          <script>
            alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
          </script>
          <?php endif;?>   
          </div>
          <?php 
            if(!file_exists($page.".php") && !is_dir($page)){
                include '404.html';
            }else{
              if(is_dir($page))
                include $page.'/index.php';
              else
                include $page.'.php';

            }
          ?>
        </div>
      </main>
  
      <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
          <div class="modal-content rounded-0">
            <div class="modal-header">
            <h5 class="modal-title"></h5>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary bg-gradient-teal border-0 rounded-0" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
            <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancel</button>
          </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="uni_modal_right" role='dialog'>
        <div class="modal-dialog modal-full-height  modal-md rounded-0" role="document">
          <div class="modal-content rounded-0">
            <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="fa fa-arrow-right"></span>
            </button>
          </div>
          <div class="modal-body">
          </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
          <div class="modal-content rounded-0">
            <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
          </div>
          <div class="modal-body">
            <div id="delete_content"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary  bg-gradient-teal border-0 rounded-0" id='confirm' onclick="">Continue</button>
            <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
          </div>
          </div>
        </div>
      </div>
    <div class="modal fade" id="viewer_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
                <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                <img src="" alt="">
        </div>
      </div>
    </div>
    <?php require_once('inc/footer.php') ?>
  </body>
</html>
