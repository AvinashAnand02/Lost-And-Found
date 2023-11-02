<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	#list td:nth-child(4){
		text-align:end !important;
	}
	#list td:nth-child(5),
	#list td:nth-child(6){
		text-align:center !important;
	}
</style>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header ">
		<div class="card-tools d-flex justify-content-end">
			<a href="<?= base_url ?>admin?page=categories/manage_category" id="create_new" class="btn btn-flat btn-primary bg-gradient-teal border-0 rounded00"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<div class="table-responsive">
				<table class="table table-sm table-hover table-striped table-bordered" id="list">
					<colgroup>
						<col width="5%">
						<col width="20%">
						<col width="25%">
						<col width="25%">
						<col width="15">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Date Created</th>
							<th>Name</th>
							<th>Description</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `category_list` order by `name` asc ");
						while($row = $qry->fetch_assoc()):
						?>
							<tr>
								<td class="align-items-center text-center"><?php echo $i++; ?></td>
								<td class="align-items-center"><?php echo date("Y-m-d g:i A",strtotime($row['created_at'])) ?></td>
								<td class="align-items-center"><?= $row['name'] ?></td>
								<td class="align-items-center text-end"><p class="truncate-1" style="max-width:150px"><?= strip_tags(htmlspecialchars_decode($row['description'])) ?></p></td>
								<td class="align-items-center justify-content-center text-center">
									<?php if($row['status'] == 1): ?>
										<span class="badge bg-success px-3 rounded-pill">Active</span>
									<?php else: ?>
										<span class="badge bg-danger px-3 rounded-pill">Inactive</span>
									<?php endif; ?>
								</td>
								<td class="align-items-center" align="center">
									<div class="dropdown">
										<button type="button" class="btn btn-flat p-1 btn-default btn-sm border dropdown-toggle dropdown-icon" data-bs-toggle="dropdown">
												Action
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="./?page=categories/view_category&id=<?php echo $row['id'] ?>"><span class="bi bi-card-text text-dark"></span> View</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="./?page=categories/manage_category&id=<?php echo $row['id'] ?>"><span class="bi bi-pencil-square text-primary"></span> Edit</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="bi bi-trash text-danger"></span> Delete</a>
										</div>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this category permanently?","delete_category",[$(this).attr('data-id')])
		})
		const dT = new simpleDatatables.DataTable('#list')
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
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>