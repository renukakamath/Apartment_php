<?php include 'shopheader.php';



if (isset($_POST['category'])) {
	extract($_POST);
    
		 	
	echo$q1="insert into category values(null,'$cname','$description') ";
   insert($q1);
   alert('sucessfully');
   return redirect('shop_managecategory.php');
 
}


if (isset($_GET['uid'])) {
 	extract($_GET);
 	 $q="select * from category where category_id='$uid'";
 	$res1=select($q);

 }

 if (isset($_POST['update'])) {
 	extract($_POST);

 	echo$q="update category set category_name='$cname',description='$description' where  category_id='$uid'";
 	update($q);
 	 alert('sucessfully');
   return redirect('shop_managecategory.php');

 }
  


if (isset($_GET['did'])) {
	extract($_GET);

	$q3="delete from category  where category_id='$did'";
	delete($q3);
	alert('sucessfully');
	return redirect('shop_managecategory.php');
}



 ?>
 <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-7.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>
<center>
<h1>Manage category</h1>
<form method="post" enctype="multipart/form-data">
	<?php if (isset($_GET['uid'])) { ?>
	<table class="table" style="width:500px">
		
		<tr>
			<th>category name</th>
			<td><input type="text" required="" class="form-control" value="<?php echo $res1[0]['category_name'] ?>" name="cname"></td>
		</tr>
		<tr>
			<th>description</th>
			<td><input type="text" name="description" required="" value="<?php echo $res1[0]['description'] ?>" class="form-control"></td></td>
		</tr>
		
		
		

		<td align="center" colspan="2"><input type="submit" name="update" value="submit" class="btn btn-success"></td>
	</table>
<?php }else{ ?>
	<table class="table" style="width:500px">
		
		<tr>
			<th>Name</th>
			<td><input type="text" required="" class="form-control" name="cname"></td>
		</tr>
		<tr>
			<th>description</th>
			<td><input type="text" name="description" required="" class="form-control"></td>
		</tr>
	
		

		<td align="center" colspan="2"><input type="submit" name="category" value="submit" class="btn btn-success"></td>
	</table>
<?php } ?>
</form>
</center>

</div></header></div></div>
<br><br><br><br><br>
<center>
	<h1>view category</h1>
	<form>
		<table class="table" style="width: 500px">
			<tr>
				<th>sino</th>
			
				<th>Name</th>
				<th>description</th>
			
			
				
			</tr>
			<?php 

     $q="select * from category  ";
     $res=select($q);
     $sino=1;

    foreach ($res as $row) {?>
    	<tr>
    		<td><?php echo $sino++; ?></td>
    	
    		<td><?php echo $row['category_name'] ?></td>
    		<td><?php echo $row['description'] ?></td>
    	
    		
    		 	<td><a class="btn btn-success" href="?uid=<?php echo $row['category_id'] ?>">update</a></td>

    		 	<td><a class="btn btn-success" href="?did=<?php echo $row['category_id'] ?>">Delete</a></td>    		 	
    		
    	</tr>
    <?php }

			 ?>
		</table>
	</form>
</center>

<?php include 'footer.php' ?>