<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM faculty where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<p>Nom: <b><?php echo ucwords($name) ?></b></p>
	<p>Genre: <b><?php echo ucwords($gender) ?></b></p>
	<p>Email: </i> <b><?php echo $email ?></b></p>
	<p>Contact: </i> <b><?php echo $contact ?></b></p>
	<p>Adresse: </i> <b><?php echo $address ?></b></p>
	<hr class="divider">
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-md-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Fermer</button>
		</div>
	</div>
</div>
<style>
	p{
		margin:unset;
	}
	#uni_modal .modal-footer{
		display: none;
	}
	#uni_modal .modal-footer.display {
		display: block;
	}
</style>
<script>
	
</script>