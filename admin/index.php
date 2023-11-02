<?php require_once('../config.php'); ?>
<?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
<?php 
$pageSplit = explode("/",$page);  
if(isset($pageSplit[1]))
$pageSplit[1] = (strtolower($pageSplit[1]) == 'list') ? $pageSplit[0].' List' : $pageSplit[1];
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
  <body>
     
     <?php require_once('inc/topBarNav.php') ?>
     <?php require_once('inc/navigation.php') ?>   
      <!-- Content Wrapper. Contains page content -->
      <main id="main" class="main">
        <div class="pagetitle">
          <h1><?= ucwords(str_replace(['_', '/'], ' ', ($pageSplit[1] ?? $page))) ?></h1>
          <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item <?= $page == 'home' ? 'selected' : '' ?>"><a href="<?= base_url ?>/admin">Dashboard</a></li>
                <?php if($page != 'home'): ?>
                <li class="breadcrumb-item active"><?= ucwords(str_replace(['_', '/'], ' ', ($pageSplit[1] ?? $page))) ?></li>
                <?php endif; ?>
              </ol>
          </nav>
        </div>
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
