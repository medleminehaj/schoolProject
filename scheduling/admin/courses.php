<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-course">
				<div class="card">
					<div class="card-header">
					Formulaire de cours
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Cours</label>
								<input type="text" class="form-control" name="course">
							</div>
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea class="form-control" cols="30" rows='3' name="description"></textarea>
							</div>
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Sauvegarder</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Annuler</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Liste des cours</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Cours</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$course = $conn->query("SELECT * FROM courses order by id asc");
								while($row=$course->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p>Cours: <b><?php echo $row['course'] ?></b></p>
										<p>Description: <small><b><?php echo $row['description'] ?></b></small></p>
										
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_course" type="button" data-id="<?php echo $row['id'] ?>" data-course="<?php echo $row['course'] ?>" data-description="<?php echo $row['description'] ?>" >Modifier</button>
										<button class="btn btn-sm btn-danger delete_course" type="button" data-id="<?php echo $row['id'] ?>">Supprimer</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
</style>
<script>
	function _reset(){
		$('#manage-course').get(0).reset()
		$('#manage-course input,#manage-course textarea').val('')
	}
	$('#manage-course').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_course',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Données ajoutées avec succès",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Données mises à jour avec succès",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_course').click(function(){
		start_load()
		var cat = $('#manage-course')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='course']").val($(this).attr('data-course'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		end_load()
	})
	$('.delete_course').click(function(){
		_conf("Etes-vous sûr de vouloir supprimer ce cours ?","delete_course",[$(this).attr('data-id')])
	})
	function delete_course($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_course',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Données supprimées avec succès",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()
</script>