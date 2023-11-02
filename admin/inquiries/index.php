<style>
	#list td:nth-child(4),
	#list td:nth-child(5){
		text-align:center !important;
	}
</style>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-body pt-4">
        <div class="container-fluid">
			<div class="table-responsive">
				<table class="table table-sm table-hover table-striped table-bordered" id="list">
					<thead>
						<tr>
							<th>#</th>
							<th>Date Created</th>
							<th>Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `inquiry_list` order by `status` asc, abs(unix_timestamp(`created_at`))  desc");
						while($row = $qry->fetch_assoc()):
						?>
							<tr>
								<td class="align-items-center text-center"><?php echo $i++; ?></td>
								<td class="align-items-center"><?php echo date("Y-m-d g:i A",strtotime($row['created_at'])) ?></td>
								<td class="align-items-center"><?= $row['fullname'] ?></td>
								<td class="align-items-center text-center">
									<?php if($row['status'] == 1): ?>
										<span class="badge bg-success px-3 rounded-pill">Read</span>
									<?php else: ?>
										<span class="badge bg-secondary px-3 rounded-pill">Unread</span>
									<?php endif; ?>
								</td>
								<td class="align-items-center" align="center">
									<div class="dropdown">
										<button type="button" class="btn btn-flat p-1 btn-default btn-sm border dropdown-toggle dropdown-icon" data-bs-toggle="dropdown">
												Action
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="./?page=inquiries/view_inquiry&id=<?php echo $row['id'] ?>"><span class="bi bi-card-text text-dark"></span> View</a>
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
			_conf("Are you sure to delete this inquiry permanently?","delete_inquiry",[$(this).attr('data-id')])
		})
		const dT = new simpleDatatables.DataTable('#list')

	})
	function delete_inquiry($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_inquiry",
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