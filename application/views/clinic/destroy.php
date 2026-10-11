<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body bgcolor="rgb(0,210,0)">
<form method="POST" action="<?php echo base_url();?>clinics/destroy/<?php echo $id;?>">
	<label>Are You Sure You Want To Delete The Selected Record?</label><br>
	<input type="submit" value="delete">
	<a href="<?php echo base_url()?>clinics"><input type="button" value="cancel"></a>
</form>
</body>
</html>