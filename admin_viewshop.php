<?php include 'adminheader.php' ?>

  <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-4.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>

<center>
	<h1>View Shop</h1>
	<table class="table" style="width:700px">
		<tr>
			<th>Shop Name</th>
			<th>Place</th>
			<th>Land Mark</th>
			<th>Phone</th>
			<th>Email</th>

		</tr>
		<?php 
        $q="select * from shop ";
        $res=select($q);
        foreach ($res as $row)  {
        	?>
        	<tr>
        		<td><?php echo $row['shop_name'] ?></td>
        		<td><?php echo $row['place'] ?></td>
        		<td><?php echo $row['landmark'] ?></td>
        		<td><?php echo $row['phone'] ?></td>
        		<td><?php echo $row['email'] ?></td>

        	</tr>
     <?php
       }

		 ?>
		
	</table>
</center>
  </div></header>
<?php include 'footer.php' ?>