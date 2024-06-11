<?php include 'serviceheader.php' ;



 	 $sid=$_SESSION['service_id'];
 	 extract($_GET);



 	 if (isset($_GET['aid'])) {
 	 	extract($_GET);

 	 	echo$q="update request set status='Accept' where request_id='$aid'";
 	 	update($q);
 	 	alert('successfully');
 	 	return redirect('service_viewrequest.php');


 	 }

 	 if (isset($_GET['rid'])) {
 	 	extract($_GET);

 	 	$q="update request set status='Reject' where request_id='$rid'";
 	 	update($q);
 	 	alert('successfully');
 	 	return redirect('service_viewrequest.php');
 	 }
?>


  <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-4.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>
<center>
	<h1>View request</h1>
	<table class="table" style="width: 700px">
		<tr>
			<th>User</th>
		
			
			<th>Status</th>

		</tr>
		<?php 
        $q="SELECT * FROM request INNER JOIN USER USING (user_id) where service_id='$sid' ";
        $res=select($q);
        foreach ($res as $row)  {
        	?>
        	<tr>
        		<td><?php echo $row['fname'] ?></td>
        		
        	
        	
        		<td><?php echo $row['status'] ?></td>
        		<?php 

              if ($row['status']=="pending") {
              	?>
             <td><a class="btn btn-success" href="?aid=<?php echo $row['request_id'] ?>">Accept</a></td>
             <td><a class="btn btn-success"  href="?rid=<?php echo $row['request_id'] ?>">Reject</a></td>
             <?php
              }elseif ($row['status']=="Accept") {
              	?>
              <td><a class="btn btn-success"  href="service_viewuser.php?uid=<?php echo $row['user_id'] ?>">View User</a></td>
         <?php  
        }

        		 ?>

        	</tr>
     <?php
       }

		 ?>
		
	</table>
</center>
</div></header>
<?php include 'footer.php' ?>