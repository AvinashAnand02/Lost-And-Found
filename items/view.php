<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT *, COALESCE((SELECT `name` FROM `category_list` where `category_list`.`id` = `item_list`. `category_id` ) ,'N/A') as `category` from `item_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
		echo '<script>alert("item ID is not valid."); location.replace("./?page=items")</script>';
	}
}else{
	echo '<script>alert("item ID is Required."); location.replace("./?page=items")</script>';
}
?>
<style>
	.lf-image{
		width:400px;
		height:300px;
		margin: 1em auto;
		background: #000;
		box-shadow: 1px 1px 10px #00000069;
	}
	.lf-image > img{
		width: 100%;
		height: 100%;
		object-fit: scale-down;
		object-position: center center;
	}
</style>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
	<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
		<div class="card rounded-0">
			<div class="card-body">
                <div class="container-fluid mt-4">
					<div class="lf-image">
						<img src="<?= validate_image($image_path ?? "") ?>" alt="<?= $title ?? "" ?>">
					</div>
					<h2 class="titleTxt"><?= $title ?? "" ?> <span>| <?= $category ?? "" ?></span></h2>
                    <dl>
						<dt class="text-muted">Founder Name</dt>
						<dd class="ps-4"><?= $fullname ?? "" ?></dd>
						<dt class="text-muted">Contact No.</dt>
						<dd class="ps-4"><?= $contact ?? "" ?></dd>
						<dt class="text-muted">Description</dt>
						<dd class="ps-4"><?= isset($description) ? str_replace("\n", "<br>", ($description)) : "" ?></dd>
                    </dl>
                </div>
            </div>
		</div>
	</div>
</div>
<script>
</script>