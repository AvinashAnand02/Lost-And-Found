<?php 
if(is_file(base_app.'pages/welcome.html')){
  $content = file_get_contents(base_app.'pages/welcome.html');
}
?>
<div class="card rounded-0">
  <div class="card-body rounded-0 pt-4">
    <div class="container-fluid">
      <form action="" id="page-form">
        <textarea name="page[welcome]" id="" cols="30" rows="10" class="form-control tinymce-editor" requried=""><?= $content ?? "" ?></textarea>
      </form>
    </div>
  </div>
  <div class="card-footer">
    <div class="col-lg-4 col-md-5 col-sm-10 col-12 mx-auto">
      <button class="btn btn-block w-100 btn-primary" form="page-form">Update</button>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#page-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			setTimeout(() => {
				start_loader();
				$.ajax({
					url:_base_url_+"classes/Master.php?f=save_page",
					data: new FormData($(this)[0]),
					cache: false,
					contentType: false,
					processData: false,
					method: 'POST',
					type: 'POST',
					dataType: 'json',
					error:err=>{
						console.log(err)
						alert_toast("An error occured",'error');
						end_loader();
					},
					success:function(resp){
						if(typeof resp =='object' && resp.status == 'success'){
							location.reload()
						}else if(resp.status == 'failed' && !!resp.msg){
							var el = $('<div>')
								el.addClass("alert alert-danger err-msg").text(resp.msg)
								_this.prepend(el)
								el.show('slow')
								$("html, body").scrollTop(0);
								end_loader()
						}else{
							alert_toast("An error occured",'danger');
							end_loader();
						}
					}
				})
			}, 200);
			
		})
  })
</script>