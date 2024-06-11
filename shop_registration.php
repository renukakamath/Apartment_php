<?php include 'publicheader.php' ;

if (isset($_POST['shopreg'])) {
	extract($_POST);
	$q1="select * from login where username='$uname' and password='$pwd'";
 		$res1=select($q1);
 		if (sizeof($res1)>0) {
 			alert('already exist');
 		}else{
    $q="insert into login values(null,'$uname','$pwd','Shop')";
     $id=insert($q);
  $q1="insert into shop values(null,'$id','$fname','$place','$landmark','$num','$email') ";
   insert($q1);
   alert('sucessfully');
   return redirect('shop_registration.php');
}
}


?>

   <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-5.jpg)">
    	 <div class="overlay">
           
    <br><br><br><br>
<center>
<h1>Shop Registration</h1>
<form method="post" style="" class="ppp">
	<table class="table" style="width:500px">
		<tr>
			<th>Shop Name</th>
			<td><input type="text" required="" class="form-control" name="fname"></td>
		</tr>
		<tr>
			<th>Place</th>
			<td><input type="text" required="" class="form-control" name="place"></td>
		</tr>
		
		<tr>
			<th>Land Mark:</th>
			<td><input type="text" required="" class="form-control" name="landmark"></td>
		</tr>
		<tr>
			<th>Phone</th>
			<td><input type="text" required="" pattern="[0-9]{10}" maxlength="10" class="form-control" name="num"></td>
		</tr>
		<tr>
			<th>Email ID</th>
			<td><input type="email" required="" class="form-control" name="email"></td>
		</tr>
		
		
		
	
		<tr>
			<th>User Name</th>
			<td><input type="text" required="" class="form-control"  name="uname"></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" required="" class="form-control" name="pwd"></td>
		</tr>
		<td align="center" colspan="2"><input type="submit" name="shopreg" value="submit" class="btn btn-success"></td>
	</table>
</form>
</center>
<?php include 'footer.php' ?>