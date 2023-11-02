<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `category_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
		echo '<script>alert("Category ID is not valid."); location.replace("./?page=categories")</script>';
	}
}else{
	echo '<script>alert("Category ID is Required."); location.replace("./?page=categories")</script>';
}
?>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
	<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
		<div class="card rounded-0">
			<div class="card-body">
                <div class="container-fluid mt-4">
					<h2 class="titleTxt"><b><?= $name ?? "" ?></b></h2>
					<div><?= isset($description) ? (htmlspecialchars_decode($description)) : "" ?></div>
                    <dl>
                      <dt class="text-muted">Status</dt>
                        <dd class="ps-4">
                            <?php if($status == 1): ?>
                                <span class="badge bg-success px-3 rounded-pill">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger px-3 rounded-pill">Inactive</span>
                            <?php endif; ?>
                        </dd>
                    </dl>
                </div>
            </div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-danger btn-sm bg-gradient-danger rounded-0" type="button" id="delete_data"><i class="fa fa-trash"></i> Delete</button>
				<a class="btn btn-primary btn-sm bg-gradient-teal rounded-0" href="./?page=categories/manage_category&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Edit</a>
				<a class="btn btn-light btn-sm bg-gradient-light border rounded-0" href="./?page=categories"><i class="fa fa-angle-left"></i> Back to List</a>
			</div>
		</div>
	</div>
</div>
<script>
    $(function(){
		$('#delete_data').click(function(){
			_conf("Are you sure to delete this Category permanently?","delete_category", ["<?= isset($id) ? $id :'' ?>"])
		})
    })
    function delete_category($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_category",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace("./?page=categories");
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>