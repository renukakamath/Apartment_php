<?php include 'hospitalheader.php' ;
extract($_GET);
if (isset($_POST['preq'])) {
	extract($_POST);

	$q="insert into precaution values(null,'$aid','$pre','$des')";
	insert($q);
	alert('successfully');
	return redirect('hospital_sendprecaution.php');
}

?>

 <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-7.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>
<center>
	<h1>Send Precaution</h1>
	<form method="post">
	<table class="table" style="width:500px">
		<tr>
			<th>Precaution</th>
			<td><input type="text" required="" class="form-control" name="pre"></td>
		</tr>
		<tr>
			<th>Description</th>
			<td><input type="text" required="" class="form-control" name="des"></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" class="btn btn-success" name="preq"></td>
		</tr>
	</table>
</form>
</center>

</div></header></div></div>
<center>
	<h1>View Precaution </h1>
	<table class="table" style="width:500px">
		<tr>
			<th>Slno</th>
			<th>Precaution</th>
			<th>Description</th>
		</tr>
		<?php 
         $q1="select * from precaution";
         $res=select($q1);
         $sino=1;
         foreach ($res as $row) {
         	?>
        <tr>
        	<td><?php echo $sino++; ?></td>
         <td><?php echo $row['precaution']?></td>
         <td><?php echo $row['description'] ?></td>
         </tr>
        <?php }

		 ?>
		
			
		
	</table>
</center>
<?php include 'footer.php' ?>