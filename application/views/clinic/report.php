<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body bgcolor="rgb(0,210,0)">
<font color="silver" size="4 px"><center>weekly report showing how busy each dentist are:</center></font>
		<table cellspacing="3px" cellpadding="3px" border="2" align="center" bgcolor="lightgrey" class="table">
				<tr>
					<th>S.N</th>
					<th>dentist name</th>
					<th>total appointments during week</th>
					<th>view details</th>
				</tr><?php $i=1;
				foreach ($result as $results){//print_r($resultss);die;?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $results->dentist_name;?></td>
						<td><?php echo ($num[$i-1]); $i++ ;?></td>
						<td><a href="<?php echo base_url();?>Clinics/viewDetail/<?php echo $results->dentist_id;?>">view</a></td>
					</tr><?php
				}?>
		</table>
		<hr>
		<a href="<?php echo base_url();?>Clinics/report"><font color="silver" size="4px">Back</font></a><br><br>
		<a href="<?php echo base_url();?>dashboard/"><font color="silver" size="4px">Back to dashboard</font></a>
</body>
</html>