<?php include 'publicheader.php';

if (isset($_POST['login'])) {
	extract($_POST);

	$q="select * from login where username='$uname' and password='$pwd'";
	$res=select($q);
	if (sizeof($res)>0) {

             $_SESSION['login_id']=$res[0]['login_id'];
             $lid=$_SESSION['login_id'];

	      if ($res[0]['usertype']=="admin") {

	      	return redirect('admin_home.php');
	    
	      }elseif ($res[0]['usertype']=="Hospital") {

	      	$q1="select * from hospital inner join login using (login_id) where login_id='$lid'";
	      	$res=select($q1);
	      	if (sizeof($res)>0) {
	      	 
	      	 $_SESSION['hospital_id']=$res[0]['hospital_id'];
	      	 $hid=$_SESSION['hospital_id'];

	      	 	return redirect('hospital_home.php');
	      	}
	   
	      }else if ($res[0]['usertype']=="Service") {
             	$q1="select * from service inner join login using (login_id) where login_id='$lid'";
	      	$res=select($q1);
	      	if (sizeof($res)>0) {
	      	 
	      	 $_SESSION['service_id']=$res[0]['service_id'];
	      	 $hid=$_SESSION['service_id'];

	      	return redirect('service_home.php');
	      }
	      	
	      }else if ($res[0]['usertype']=="Shop") {
	      	return redirect('shop_home.php');
	
	      }



	      else{
	      	alert('invalid username and password');

	      }

	      }
	}


?>

    <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/slide-1.jpg)">
    	 <div class="overlay">
           
    <br><br><br><br><br><br><br>
 <center>
<h1>Login</h1>
<form method="post">
	<table class="table" style="width:500px;color: black">
		
		<tr>
			<th><b>User Name</b></th>
			<td><input type="text" required="" class="form-control"  name="uname"></td>
		</tr>
		<tr>
			<th><b>Password</b></th>
			<td><input type="password" required="" class="form-control" name="pwd"></td>
		</tr>
		<td align="center" colspan="2"><input type="submit" name="login" value="submit" class="btn btn-primary"></td>
	</table>
</form>
</center>
</div>
               
   </header><!-- end of page header -->
<?php include 'footer.php' ?>