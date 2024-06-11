<?php include 'hospitalheader.php' ;



 	 $hid=$_SESSION['hospital_id'];
 	 extract($_GET);



 	 if (isset($_GET['aid'])) {
 	 	extract($_GET);

 	 	$q="update appointment set status='Accept' where appointment_id='$aid'";
 	 	update($q);
 	 	alert('successfully');
 	 	return redirect('hospital_viewappointment.php');


 	 }

 	 if (isset($_GET['rid'])) {
 	 	extract($_GET);

 	 	$q="update appointment set status='Reject' where appointment_id='$rid'";
 	 	update($q);
 	 	alert('successfully');
 	 	return redirect('hospital_viewappointment.php');
 	 }
?>

 <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-6.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>
<center>
	<h1>View Appointment</h1>
	<table class="table" style="width: 700px">
		<tr>
			<th>User</th>

			<th>Details</th>
			<th>Date </th>
		
			<th>Time</th>
			<th>Status</th>

		</tr>
		<?php 
        $q="SELECT * FROM appointment INNER JOIN USER USING (user_id) where hospital_id='$hid' ";
        $res=select($q);
        foreach ($res as $row)  {
        	?>
        	<tr>
        		<td><?php echo $row['fname'] ?></td>
        		
        		<td><?php echo $row['details'] ?></td>
        		<td><?php echo $row['date'] ?></td>
        		
        		<td><?php echo $row['time'] ?></td>
        		<td><?php echo $row['status'] ?></td>
        		<?php 

              if ($row['status']=="pending") {
              	?>
             <td><a href="?aid=<?php echo $row['appointment_id'] ?>">Accept</a></td>
             <td><a href="?rid=<?php echo $row['appointment_id'] ?>">Reject</a></td>
             <?php
              }elseif ($row['status']=="Accept") {
              	?>
              <td><a class=" btn btn-success" href="hospital_sendprecaution.php?aid=<?php echo $row['appointment_id'] ?>">Send Precaution</a></td>
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