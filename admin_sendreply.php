<?php include 'adminheader.php' ;
extract($_GET);
if (isset($_POST['send'])) {
	extract($_POST);

  $q="update complaint set reply='$reply' where complaint_id='$cid'";
  update($q);
  alert('successfully');
  return redirect('admin_viewcomplaint.php');
}

?>
  <!-- page header -->
    <header id="home" class="header" style="background-image: url(assets/imgs/post-5.jpg)">
    	 <div class="overlay">
           
    <br><br><br><br><br><br><br>
    <center>
<h1>Send Reply</h1>
<form method="post">
	<table class="table" style="width:500px">
		
		<tr>
			<th>reply</th>
			<td><input type="text" required="" class="form-control"  name="reply"></td>
		</tr>
	
		<td align="center" colspan="2"><input type="submit" name="send" value="submit" class="btn btn-success"></td>
	</table>
</form>
</center>
               
</div></header>
<?php include 'footer.php' ?>