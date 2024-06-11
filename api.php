<?php 
//include 'connection.php';

$con=mysqli_connect('localhost','root','','apartment_management',3306);
$result=array();
if(isset($_GET['action']))
{
	extract($_GET);
    if($action=="login")
    {   $q="select * from login where username='$username' and password='$password'";
         $res=mysqli_query($con,$q);
        
                                            
         if(mysqli_num_rows($res)>0)#check res values here
         {
        	$ar=array();#stored in ar

        	while($row=mysqli_fetch_array($res))#res values stored in row
            {
        		 array_push($ar,$row);
        	}
           
        	$result['status']="success";
        	$result['data']=$ar;
         }
         else
        {
        	$result['status']="failed";

        }

        echo json_encode($result);
        die();
    }


    elseif($action=="Registration")
    {   
        $q="select * from login where username='$username'";
        $res=mysqli_query($con,$q);
        if(mysqli_num_rows($res)> 0)
        {
            $result['status']="duplicate";
        }
        else
        {
            $t1="insert into login values(null,'$username','$password','User')";
            mysqli_query($con,$t1);
            $lid=mysqli_insert_id($GLOBALS['con']);
    
            $t="INSERT INTO user VALUES(NULL,'$lid','$fname','$lname','$place','$email','$phone','$address')";
            mysqli_query($con,$t);
            
    
            $result['status']="success";
        }
      
         echo json_encode($result);
        die();
      
      
    }

    elseif($action=="Viewproduct")
    {
        $t="SELECT * FROM `product` inner join shop using (shop_id) inner join category using (category_id) where category_id='$cat'";
        $res=mysqli_query($con,$t);

       
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $result['status']="success";
            $result['data']=$ar;

           
        }else
        {
            $result['status']="failed";
        }
         $result['action']="Viewproduct";
        echo json_encode($result);
        die();
    }



        elseif($action=="Viewcategory")
    {
        $t="SELECT * FROM `category` ";
        $res=mysqli_query($con,$t);

       
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $result['status']="success";
            $result['data']=$ar;

           
        }else
        {
            $result['status']="failed";
        }
         $result['action']="Viewproduct";
        echo json_encode($result);
        die();
    }


elseif($action=="Viewcart")
    {
        $t="SELECT * FROM `order_child` INNER JOIN `order_master` USING (`ordermaster_id`)  INNER JOIN shop USING (`shop_id`) INNER JOIN `product` USING (`product_id`) INNER JOIN USER USING (user_id) where `user`.login_id='$login_id'";
        $res=mysqli_query($con,$t);

       
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $result['status']="success";
            $result['data']=$ar;

           
        }else
        {
            $result['status']="failed";
        }
         $result['action']="Viewcart";
        echo json_encode($result);
        die();
    }



elseif($action=="Viewhospital")
    {
        $t="SELECT * FROM hospital";
        $res=mysqli_query($con,$t);

       
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $result['status']="success";
            $result['data']=$ar;

           
        }else
        {
            $result['status']="failed";
        }
         $result['action']="Viewhospital";
        echo json_encode($result);
        die();
    }

elseif($action=="Viewappointment")
    {
        $t="SELECT * FROM `appointment` INNER JOIN `hospital` USING (`hospital_id`) INNER JOIN USER USING (user_id) WHERE user.login_id='$login_id' AND STATUS='Accept'";
        $res=mysqli_query($con,$t);

       
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $result['status']="success";
            $result['data']=$ar;

           
        }else
        {
            $result['status']="failed";
        }
         $result['action']="Viewappointment";
        echo json_encode($result);
        die();
    }

    elseif($action=="Viewservice")
    {
        $t="select * from service";
        $res=mysqli_query($con,$t);

       
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $result['status']="success";
            $result['data']=$ar;

           
        }else
        {
            $result['status']="failed";
        }
         $result['action']="Viewservice";
        echo json_encode($result);
        die();
    }


  elseif($action=="Viewrequest")
    {
        $t="SELECT * FROM request INNER JOIN `service` USING (`service_id`) INNER JOIN `user` USING (`user_id`) where `user`.login_id='$login_id' and status='Accept'";
        $res=mysqli_query($con,$t);

       
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $result['status']="success";
            $result['data']=$ar;

           
        }else
        {
            $result['status']="failed";
        }
         $result['action']="Viewrequest";
        echo json_encode($result);
        die();
    }




    elseif($action=="Addtocart")
    {   

        
     // $total=$price*$quantity;
        $t="select * from order_master where status='pending' and user_id=(select user_id from user where login_id='$login_id')";
        $res=mysqli_query($con,$t);
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $oid=$ar[0]['ordermaster_id'];

           
        }else
        {
            $t1="insert into order_master values(null,(select user_id from user where login_id='$login_id'),'$sid',curdate(),'0','pending') ";
            mysqli_query($con,$t1);
            $oid=mysqli_insert_id($GLOBALS['con']);
        }

     


        $t="select * from order_child where product_id='$pid'  and ordermaster_id='$oid'";
        $val=mysqli_query($con,$t);
        
        if(mysqli_num_rows($val)>0){
            $ar=array();

            while($row=mysqli_fetch_array($val)){
                 array_push($ar,$row);
            }
           
            $dtlsid=$ar[0]['orderchild_id'];
            $t="update order_child set qty=qty+'$quantity' where orderchild_id='$dtlsid'";
            mysqli_query($con,$t);

           
        }else
        {
            $t1="insert into order_child values(null,'$oid','$pid','$quantity','$price') ";
            mysqli_query($con,$t1);
            $oid=mysqli_insert_id($GLOBALS['con']);
        }

 
        
        $t="update order_master set total=total +'$price' where ordermaster_id='$oid'";
        mysqli_query($con,$t);

        
               $result['status']="success";
        
      
         echo json_encode($result);
        die();

    }


   elseif($action=="Makepayment")
    {   
        
        $t="update order_master set status='Paid' where ordermaster_id='$omid'";
        mysqli_query($con,$t);

         
         $t="insert into payment values(null,'$omid','$amount',curdate())";
        mysqli_query($con,$t);     

        $result['status']="success";
        
        
         echo json_encode($result);
        die();
    }

 elseif($action=="Makeappointment")
    {   
        
     
         $t="insert into appointment values(null,'$hid',(select user_id from user where login_id='$login_id'),'$date','$time','$description','pending')";
        mysqli_query($con,$t);     

        $result['status']="success";
        
        
         echo json_encode($result);
        die();
    }


   elseif($action=="ViewPrecaution")
    {
        $t="SELECT * FROM `precaution` INNER JOIN appointment USING (`appointment_id`) INNER JOIN USER USING (user_id) WHERE user.login_id='$login_id' AND appointment_id='$apid'";
        $res=mysqli_query($con,$t);

       
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $result['status']="success";
            $result['data']=$ar;

           
        }else
        {
            $result['status']="failed";
        }
         $result['action']="ViewPrecaution";
        echo json_encode($result);
        die();
    }
  
 elseif($action=="Sendrequest")
    {   
        
      
         $t="insert into request values(null,'$sid',(select user_id from user where login_id='$login_id'),'pending')";
        mysqli_query($con,$t);     

        $result['status']="success";
        
        
         echo json_encode($result);
        die();
    }

     elseif($action=="complaint")
    {   
        
       

         
        $t="insert into complaint values(null,(select user_id from user where login_id='$login_id'),'$complaint','pending',curdate())";
        mysqli_query($con,$t);

        $result['status']="success";
        $result['action']="complaint";
          $result['method']="complaint";
        
        
         echo json_encode($result);
        die();
    }

    
    elseif($action=="complaintview")
    {
     $t="SELECT * FROM complaint where user_id=(select user_id from user where login_id='$login_id') ";
        $res=mysqli_query($con,$t);

       
        if(mysqli_num_rows($res)>0){
            $ar=array();

            while($row=mysqli_fetch_array($res)){
                 array_push($ar,$row);
            }
            $result['status']="success";
            $result['data']=$ar;
            $result['method']="complaintview";

           
        }else
        {
            $result['status']="failed";
        }
         $result['action']="complaintview";
        echo json_encode($result);
        die();
    }


}