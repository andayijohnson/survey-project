
 <!--- GET THE QTNS FROM THE DATABASE AND THE LOAD THEM ONE BY ONE AS THE USER ANSWERS THEM
   THE ANSWERS ARE ALSO STORE INTHE DATABASE WITH POINTS ,THE ANSWERS DONT CHANGE ONLY THE QTNS DO,AFTER THE LAST QTN IS DON THE 
   USER IS ALLOWED TO ENTER EMAIL OR NOT ACCORDING TO THE TOTAL POINTS-->
<?php 
session_start();
include("db.php");
include("functions.php");
$err="";
if(isset($_GET['id'])){

	$sql="INSERT INTO users(userid,session,points)
   VALUES('','".session_id()."',".$_GET['id'].")";
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $_SESSION['SURVEYID']=mysqli_insert_id($conn);
         if($sql){
		 $err="<p style='color:springgreen;padding:10px;font-weight:bold;text-align:center;'>Answer successfully submitted ,proceed to the next question 
		 <a href='qtn2.php' style='text-decoration:none;float:right;color:hotpink;font-weight:bold;'>Click Next <i class='fa fa-caret-right;'></i></a></p>"; 
	  }else{
		  $err="<p style='font-weight:bold;text-align:center;color:crimson;padding:10px;'>Error while submitting your answer,try again</p>";
	  }	
	
	
}
?>
<html>
<head>
<style>
nav{background:#fff;padding:5px;width:100%;border:1px solid #ccc;box-shadow:0  2px 1px #ddd;top:0;left:0;position:fixed;z-index:1;
}
.topnav a{
   display: block;font-weight:bold;
  padding:5px;text-decoration: none;cursor:pointer;
}
</style>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Qtns</title>
</head>
<body>
<nav>
<ul class="topnav">
	  <a href='index.php' class='active' style="float:left;color:Hotpink;font-weight:bold;text-decoration:none;"><i class="fa fa-heart-o"></i>
	  You Can Now Begin</a>
	 
   </ul>
   </nav>
   <div class="container" style="margin:5px auto;margin-top:100px;">
   <p style="text-align:center;padding:10px;"><b>1.</b> I think about the next person I’m going to fall in love with. </p>
   <div class="row">
   <div class="col">
   <div class="text-center">
   <img src="images/think.jpg" class="img-fluid">
   </div>
   </div>
   
   </div>
   </div>
  
   <div class="container" style="margin:10px auto;background:#f0f8f0;">
   <div class="row">
   <div class="col">
   <?php 
   $sql="SELECT * FROM answers ";
   $res=mysqli_query($conn,$sql);
   $numrows=mysqli_num_rows($res);
   $row=mysqli_fetch_array($res);
   if($numrows>0){
	   echo $err;
	   echo"<table class='table table-stripped'>
	   <tbody>";
	   do{
	  echo "<tr><td>".$row['id']." =</td>
	       <td><a href='survey.php?id=".$row['points']."' style='text-decoration:none;color:#000;'>".$row['answer']."</td></a></tr>";
	   }while($row=mysqli_fetch_array($res));
	   echo"<tbody></table>";
   }else{
	   echo"<p style='text-align:center;padding:10px;color:#000;'></p>";
   }
   
   ?>
   </div>
   </div>
   </div
   </body>
  </html>