<?php include 'publicheader.php' ;

if (isset($_POST['servicereg'])) {
	extract($_POST);
	$q1="select * from login where username='$uname' and password='$pwd'";
 		$res1=select($q1);
 		if (sizeof($res1)>0) {
 			alert('already exist');
 		}else{
    $q="insert into login values(null,'$uname','$pwd','Service')";
     $id=insert($q);
  $q1="insert into service values(null,'$id','$fname','$place','$det') ";
   insert($q1);
   alert('sucessfully');
   return redirect('service_registration.php');
}
}


?>

   <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-2.jpg)">
    	 <div class="overlay">
           
    <br><br><br><br>
<center>
<h1>Service Registration</h1>
<form method="post" style="" class="ppp">
	<table class="table" style="width:500px">
		<tr>
			<th>Service Name</th>
			<td><input type="text" required="" class="form-control" name="fname"></td>
		</tr>
		<tr>
			<th>Place</th>
			<td><input type="text" required="" class="form-control" name="place"></td>
		</tr>
		
        <tr>
	       <th>details</th>
			<td><textarea required="" class="form-control" name="det"></textarea></td>
		</tr>
		
	
		<tr>
			<th>User Name</th>
			<td><input type="text" required="" class="form-control"  name="uname"></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" required="" class="form-control" name="pwd"></td>
		</tr>
		<td align="center" colspan="2"><input type="submit" name="servicereg" value="submit" class="btn btn-success"></td>
	</table>
</form>
</center>

</div>
               
   </header><!-- end of page header -->
<?php include 'footer.php' ?>