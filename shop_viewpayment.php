<?php include 'shopheader.php' ;
extract($_GET);
?>


  <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-2.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>
<center>
	<h1>View Payment</h1>
	<table class="table" style="width: 700px" >
		<tr>


	
			<th>User</th>
		
			<th>Price</th>
			<th>Status</th>

		</tr>
		<?php 
        $q="SELECT * FROM payment INNER JOIN  order_master USING (ordermaster_id) INNER JOIN USER USING (user_id) where ordermaster_id='$oid' ";
        $res=select($q);
        foreach ($res as $row)  {
        	?>
        	<tr>
        		
        		
        		
        		<td><?php echo $row['fname'] ?></td>
        		
        		<td><?php echo $row['total'] ?></td>
        		<td><?php echo $row['status'] ?></td>

        	</tr>
     <?php
       }

		 ?>
		
	</table>
</center>
</div></header>
<?php include 'footer.php' ?>