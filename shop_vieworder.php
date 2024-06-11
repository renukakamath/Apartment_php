<?php include 'shopheader.php' ?>


  <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-2.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>
<center>
	<h1>View Orders</h1>
	<table class="table" style="width: 700px">
		<tr>
			<th>Image</th>
			<th>Shop Name</th>
			<th>Product Name</th>
			<th>User</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Status</th>

		</tr>
		<?php 
        $q="SELECT * FROM `order_master` INNER JOIN `order_child` USING (`ordermaster_id`) INNER JOIN USER USING (user_id) INNER JOIN shop USING (shop_id) INNER JOIN product USING (product_id) ";
        $res=select($q);
        foreach ($res as $row)  {
        	?>
        	<tr>
        		<td><img src="<?php echo $row['image'] ?>" width="100" height="100"></td>
        		<td><?php echo $row['shop_name'] ?></td>
        		<td><?php echo $row['product_name'] ?></td>
        		<td><?php echo $row['fname'] ?></td>
        		<td><?php echo $row['quantity'] ?></td>
        		<td><?php echo $row['price'] ?></td>
        		<td><?php echo $row['status'] ?></td>
        		<td><a class="btn btn-success" href="shop_viewpayment.php?oid=<?php echo $row['ordermaster_id'] ?>">View payment</a></td>

        	</tr>
     <?php
       }

		 ?>
		
	</table>
</center>
</div></header>
<?php include 'footer.php' ?>