<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `item_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
	<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
		<div class="card rounded-0">
			<div class="card-header py-0">
				<div class="card-title py-1"><b><?= isset($id) ? "Update Items Details" : "New Items Entry" ?></b></div>
			</div>
			<div class="card-body">
				<div class="container-fluid mt-3">
					<form action="" id="items-form">
						<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="category_id" class="form-label">Category</label>
							<select name="category_id" id="category_id" class="form-select" required="required">
								<option value="" disabled <?= !isset($category_id) ? "selected" : "" ?>></option>
								<?php 
								$query = $conn->query("SELECT * FROM `category_list` where `status` = 1 order by `name` asc");
								while($row=$query->fetch_assoc()):
								?>
								<option value="<?= $row['id'] ?>" <?= isset($category_id) && $category_id == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="fullname" class="control-label">Founder Name</label>
								<input type="text" name="fullname" id="fullname" class="form-control form-control-sm rounded-0" value="<?php echo isset($fullname) ? $fullname : ''; ?>"  autofocus required/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="title" class="control-label">Title</label>
								<input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" value="<?php echo isset($title) ? $title : ''; ?>"  required/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="contact" class="control-label">Contact #</label>
								<input type="text" name="contact" id="contact" class="form-control form-control-sm rounded-0" value="<?php echo isset($contact) ? $contact : ''; ?>"  required/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="description" class="control-label">Description</label>
								<textarea rows="5" name="description" id="description" class="form-control form-control-sm rounded-0"  required><?php echo isset($description) ? $description : ''; ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label for="" class="control-label">Item Image</label>
								<div class="custom-file">
								<input type="file" class="form-control" id="customFile" name="image" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group d-flex justify-content-center">
								<img src="<?php echo validate_image(isset($image_path) ? $image_path :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="status" class="control-label">Status</label>
								<select name="status" id="status" class="form-select form-select-sm rounded-0" required="required">
									<option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Pending</option>
									<option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Publish</option>
									<option value="2" <?= isset($status) && $status == 2 ? 'selected' : '' ?>>Claimed</option>
								</select>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-primary btn-sm bg-gradient-teal btn-flat border-0" form="items-form"><i class="fa fa-save"></i> Save</button>
				<a class="btn btn-light btn-sm bg-gradient-light border btn-flat" href="./?page=items"><i class="fa fa-times"></i> Cancel</a>
			</div>
		</div>
	</div>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
			$('#cimg').attr('src', "<?php echo validate_image(isset($meta['image_path']) ? $meta['image_path'] :'') ?>");
		}
	}
	$(document).ready(function(){
		$('#category_id').select2({
			placeholder: 'Please Select Here',
			width: '100%'
		})
		$('#items-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			setTimeout(() => {
				start_loader();
				$.ajax({
					url:_base_url_+"classes/Master.php?f=save_item",
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
							location.replace('./?page=items/view_item&id='+resp.iid)
						}else if(resp.status == 'failed' && !!resp.msg){
							var el = $('<div>')
								el.addClass("alert alert-danger err-msg").text(resp.msg)
								_this.prepend(el)
								el.show('slow')
								$("html, body").scrollTop(0);
								end_loader()
						}else{
							alert_toast("An error occured",'error');
							end_loader();
							console.log(resp)
						}
					}
				})
			}, 200);
			
		})

	})
</script>