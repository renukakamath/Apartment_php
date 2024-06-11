<?php include 'adminheader.php' ?>

  <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-6.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>

<center>
	<h1>View Services</h1>
	<table class="table" style="width:500px">
		<tr>
			<th>Service Name</th>
			
			<th>Phone</th>
			<th>Description</th>

		</tr>
		<?php 
        $q="select * from service ";
        $res=select($q);
        foreach ($res as $row)  {
        	?>
        	<tr>
        		<td><?php echo $row['service_name'] ?></td>
        		
        		<td><?php echo $row['phone'] ?></td>
        		<td><?php echo $row['description'] ?></td>

        	</tr>
     <?php
       }

		 ?>

	</table>
</center>
 </div></header>
<?php include 'footer.php' ?>