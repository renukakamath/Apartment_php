<?php include 'shopheader.php';



if (isset($_POST['product'])) {
	extract($_POST);
    

$dir = "image/";
	$file = basename($_FILES['imgg']['name']);
	$file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
	$target = $dir.uniqid("image_").".".$file_type;
	if(move_uploaded_file($_FILES['imgg']['tmp_name'], $target))
	{
		 	
	echo$q1="insert into product values(null,'$shop','$category','$fname','$quantity','$price','$target') ";
   insert($q1);
   alert('sucessfully');
   return redirect('shop_manageproduct.php');
 }
		else
		{
			echo "file uploading error occured";
		}


}


if (isset($_GET['uid'])) {
 	extract($_GET);

 	 $q="select * from product inner join shop using (shop_id) inner join category using (category_id) where product_id='$uid'";
 	$res1=select($q);

 }

 if (isset($_POST['update'])) {
 	extract($_POST);

$dir = "image/";
	$file = basename($_FILES['imgg']['name']);
	$file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
	$target = $dir.uniqid("image_").".".$file_type;
	if(move_uploaded_file($_FILES['imgg']['tmp_name'], $target))
	{
		

 	echo$q="update product set shop_id='$shop' ,category_id='$category',product_name='$fname',quantity='$quantity',price='$price',image='$target'where  product_id='$uid'";
 	update($q);
 	 alert('sucessfully');
   return redirect('shop_manageproduct.php');

 }
  else
		{
			echo "file uploading error occured";
		}


}


if (isset($_GET['did'])) {
	extract($_GET);

	$q3="delete from product  where product_id='$did'";
	delete($q3);
	alert('sucessfully');
	return redirect('shop_manageproduct.php');
}



 ?>
 <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-7.jpg)" style="width: 200px">
       <div class="overlay">
           
    <br><br><br><br><br><br><br>
<center>
<h1>Manage Product</h1>
<form method="post" enctype="multipart/form-data">
	<?php if (isset($_GET['uid'])) { ?>
	<table class="table" style="width:500px">
		<tr>
			<th>Shop</th>
			<td><select name="shop" class="form-control">
				<option value="<?php echo $res1[0]['shop_id'] ?>"><?php echo $res1[0]['shop_name'] ?></option>

				<option>Select</option>
				<?php 

				$q="select * from shop ";
				$res=select($q);
				foreach ($res as $row) {
					?>
					<option value="<?php echo $row['shop_id'] ?>"><?php echo $row['shop_name'] ?></option>
				<?php 
			}
				 ?>
			</select></td>
		</tr>


		<tr>
			<th>Category</th>
			<td><select name="category" class="form-control">
				<option value="<?php echo $res1[0]['category_id'] ?>"><?php echo $res1[0]['category_name'] ?></option>

				<option>Select</option>
				<?php 

				$q="select * from category ";
				$res=select($q);
				foreach ($res as $row) {
					?>
					<option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
				<?php 
			}
				 ?>
			</select></td>
		</tr>
		
		
		<tr>
			<th>Name</th>
			<td><input type="text" required="" class="form-control" value="<?php echo $res1[0]['product_name'] ?>" name="fname"></td>
		</tr>
		<tr>
			<th>Stock</th>
			<td><input type="number" name="quantity" required="" value="<?php echo $res1[0]['quantity'] ?>" class="form-control"></td></td>
		</tr>
		<tr>
			<th> Image</th>
			<td><input type="file" required="" class="form-control" value="<?php echo $res1[0]['image'] ?>" name="imgg"></td>
		</tr>
		<tr>
			<th>price</th>
			<td><input type="number" required="" class="form-control" value="<?php echo $res1[0]['price'] ?>" name="price"></td>
		</tr>
		
		

		<td align="center" colspan="2"><input type="submit" name="update" value="submit" class="btn btn-success"></td>
	</table>
<?php }else{ ?>
	<table class="table" style="width:500px">
		<tr>
			<th>shop</th>
			<td><select name="shop" class="form-control">
				
				<option>Select</option>
				<?php 

				$q="select * from shop";
				$res=select($q);
				foreach ($res as $row) {
					?>
					<option value="<?php echo $row['shop_id'] ?>"><?php echo $row['shop_name'] ?></option>
				<?php 
			}
				 ?>
			</select></td>
		</tr>


		<tr>
			<th>Category</th>
			<td><select name="category" class="form-control">
			
				<option>Select</option>
				<?php 

				$q="select * from category ";
				$res=select($q);
				foreach ($res as $row) {
					?>
					<option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
				<?php 
			}
				 ?>
			</select></td>
		</tr>
		
		
		<tr>
			<th>Name</th>
			<td><input type="text" required="" class="form-control" name="fname"></td>
		</tr>
		<tr>
			<th>Stock</th>
			<td><input type="number" name="quantity" required="" class="form-control"></td>
		</tr>
		<tr>
			<th> Image</th>
			<td><input type="file" required="" class="form-control" name="imgg"></td>
		</tr>
		<tr>
			<th>price</th>
			<td><input type="number" required="" class="form-control" name="price"></td>
		</tr>
	
		

		<td align="center" colspan="2"><input type="submit" name="product" value="submit" class="btn btn-success"></td>
	</table>
<?php } ?>
</form>
</center>

</div></header></div></div>
<br><br><br><br><br>
<center>
	<h1>view Product</h1>
	<form>
		<table class="table" style="width: 500px">
			<tr>
				<th>sino</th>
				<th>shop</th>
				<th>Category</th>
				<th>Name</th>
				<th>Stock</th>
				<th> Image</th>
				<th>price</th>
			
				
			</tr>
			<?php 

     $q="select * from product inner join shop using (shop_id)  inner join category using (category_id)";
     $res=select($q);
     $sino=1;

    foreach ($res as $row) {?>
    	<tr>
    		<td><?php echo $sino++; ?></td>
    		<td><?php echo $row['shop_name'] ?></td>
    		<td><?php echo $row['category_name'] ?></td>
    		<td><?php echo $row['product_name'] ?></td>
    		<td><?php echo $row['quantity'] ?></td>
    		<td><img src="<?php echo $row['image'] ?>" height="100" width="100"></td>
    		<td><?php echo $row['price'] ?></td>
    		
    		
    		 	<td><a class="btn btn-success" href="?uid=<?php echo $row['product_id'] ?>">update</a></td>

    		 	<td><a class="btn btn-success" href="?did=<?php echo $row['product_id'] ?>">Delete</a></td>    		 	
    		
    	</tr>
    <?php }

			 ?>
		</table>
	</form>
</center>

<?php include 'footer.php' ?>