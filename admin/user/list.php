<style>
    .user-avatar{
        width:3rem;
        height:3rem;
        object-fit:scale-down;
        object-position:center center;
    }
	#list td{
		vertical-align: middle;
	}
</style>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<div class="card-tools d-flex justify-content-end">
			<a href="<?= base_url ?>admin/?page=user/manage_user" id="create_new" class="btn btn-flat btn-primary bg-gradient-teal border-0 rounded-0"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body pt-4">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="25%">
					<col width="15%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Updated</th>
						<th>Avatar</th>
						<th>Name</th>
						<th>Username</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT *, concat(firstname,' ', coalesce(concat(middlename,' '), '') , lastname) as `name` from `users` where id != '{$_settings->userdata('id')}' order by concat(firstname,' ', lastname) asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_updated'])) ?></td>
							<td class="text-center">
                                <img src="<?= validate_image($row['avatar']) ?>" alt="" class="img-thumbnail rounded-circle user-avatar">
                            </td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['username'] ?></td>
							<td class="text-center">
                                <?php if($row['type'] == 1): ?>
                                    Administrator
                                <?php elseif($row['type'] == 2): ?>
                                    Staff
                                <?php else: ?>
									N/A
                                <?php endif; ?>
                            </td>
							<td align="center">
								<div class="dropdown">
									<button type="button" class="btn btn-flat p-1 btn-light btn-sm dropdown-toggle dropdown-icon border" data-bs-toggle="dropdown">
										Action
									</button>
									<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="./?page=user/manage_user&id=<?= $row['id'] ?>"><span class="bi bi-pencil-square text-dark"></span> Edit</a>
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
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this User permanently?","delete_user",[$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [6] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_user($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Users.php?f=delete",
			method:"POST",
			data:{id: $id},
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(resp == 1){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>