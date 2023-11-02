<?php 
$user = $conn->query("SELECT * FROM users where id ='".$_settings->userdata('id')."'");
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
?>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<section class="section">
	<div class="card card-outline rounded-0 card-navy">
		<div class="card-body">
			<div class="container-fluid">
				<div id="msg"></div>
				<form action="" id="manage-user">	
					<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
					<div class="form-group">
						<label for="name">First Name</label>
						<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
					</div>
					<div class="form-group">
						<label for="name">Middle Name</label>
						<input type="text" name="middlename" id="middlename" class="form-control" value="<?php echo isset($meta['middlename']) ? $meta['middlename']: '' ?>">
					</div>
					<div class="form-group">
						<label for="name">Last Name</label>
						<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
						<small><i>Leave this blank if you dont want to change the password.</i></small>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Avatar</label>
						<div class="custom-file">
						<input type="file" class="form-control" id="customFile" name="img" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
						</div>
					</div>
					<div class="form-group d-flex justify-content-center">
						<img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
					</div>
				</form>
			</div>
		</div>
		<div class="card-footer">
				<div class="col-md-12">
					<div class="row">
						<button class="btn btn-sm btn-primary bg-gradient-teal border-0" form="manage-user">Update</button>
					</div>
				</div>
			</div>
	</div>
</section>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
			$('#cimg').attr('src', "<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] :'') ?>");
		}
	}
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_loader()
		$.ajax({
			url:_base_url_+'classes/Users.php?f=save',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					location.replace('<?= base_url.'admin?page=user' ?>')
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_loader()
				}
			}
		})
	})

</script>