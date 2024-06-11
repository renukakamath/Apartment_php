<?php include 'serviceheader.php' ;
extract($_GET);

?>


  <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-3.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>
<center>
	<h1>View user</h1>
	<table class="table" style="width: 700px">
		<tr>
			<th> Name</th>
			<th>Place</th>
		
			<th>Phone</th>
			<th>Email</th>
			<th>Address</th>

		</tr>
		<?php 
        $q="select * from user where user_id='$uid'";
        $res=select($q);
        foreach ($res as $row)  {
        	?>
        	<tr>
        		<td><?php echo $row['fname'] ?> <?php echo $row['lname'] ?></td>
        		<td><?php echo $row['place'] ?></td>
        		
        		<td><?php echo $row['phone'] ?></td>
        		<td><?php echo $row['email'] ?></td>
        		<td><?php echo $row['address'] ?></td>

        	</tr>
     <?php
       }

		 ?>
		
	</table>
</center>
</div></header>
<?php include 'footer.php' ?>