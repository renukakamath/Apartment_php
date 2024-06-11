<?php include 'adminheader.php' ?>

  <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-7.jpg)">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>

<center>
	<h1>View Complaint</h1>
	<table class="table" style="width:700px">
		<tr>
			<th>Complaint</th>
			<th>User</th>
			<th>date</th>
			<th>Reply</th>
			

		</tr>
		<?php 
        $q="select * from complaint inner join user using (user_id) ";
        $res=select($q);
        foreach ($res as $row)  {
        	?>
        	<tr>
        		<td><?php echo $row['complaint'] ?></td>
        		<td><?php echo $row['fname'] ?></td>
        		<td><?php echo $row['date'] ?></td>
        		<td><?php echo $row['reply'] ?></td>
        		<?php 


              if ($row['reply']=="pending") {?>
              <td><a href="admin_sendreply.php?cid=<?php echo $row['complaint_id'] ?>">Send Reply</a></td>
             <?php  }

        		 ?>

        	</tr>
     <?php
       }

		 ?>
		
	</table>
</center>

  </div></header>
<?php include 'footer.php' ?>