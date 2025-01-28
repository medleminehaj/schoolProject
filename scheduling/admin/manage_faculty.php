<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM faculty where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<form action="" id="manage-faculty">
		<div id="msg"></div>
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id']:'' ?>" class="form-control">
		<div class="row form-group">
			<div class="col-md-4">
						<label class="control-label">ID No.</label>
						<input type="text" name="id_no" class="form-control" value="<?php echo isset($id_no) ? $id_no:'' ?>" >
						<small><i>Laissez ce champ vide si vous souhaitez générer automatiquement un numéro d'identification.</i></small>
					</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Nom de famille</label>
				<input type="text" name="lastname" class="form-control" value="<?php echo isset($lastname) ? $lastname:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Nom</label>
				<input type="text" name="firstname" class="form-control" value="<?php echo isset($firstname) ? $firstname:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Prénom</label>
				<input type="text" name="middlename" class="form-control" value="<?php echo isset($middlename) ? $middlename:'' ?>">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Email</label>
				<input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Contact #</label>
				<input type="text" name="contact" class="form-control" value="<?php echo isset($contact) ? $contact:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Genre</label>
				<select name="gender" required="" class="custom-select" id="">
					<option <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Mâle</option>
					<option <?php echo isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Femelle</option>
				</select>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Adresse</label>
				<textarea name="address" class="form-control"><?php echo isset($address) ? $address : '' ?></textarea>
			</div>
		</div>
	</form>
</div>

<script>
	$('#manage-faculty').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_faculty',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast("Données enregistrées avec succès.",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}else if(resp == 2){
					$('#msg').html('<div class="alert alert-danger">L\'ID n° existait déjà.</div>')
					end_load();
				}
			}
		})
	})
</script>