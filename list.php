<?php
session_start();
if($_SESSION['name'] != 'Admin Kvr0077'){
    header("location:index.php");
}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>OES MASTER || DASHBOARD </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
<link  rel="stylesheet" href="css/bootstrap-sortable.css">
    
 <script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap-sortable.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>

 	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

<script>
$(function () {
    $(document).on( 'scroll', function(){
        console.log('scroll top : ' + $(window).scrollTop());
        if($(window).scrollTop()>=$(".logo").height())
        {
             $(".navbar").addClass("navbar-fixed-top");
        }

        if($(window).scrollTop()<$(".logo").height())
        {
             $(".navbar").removeClass("navbar-fixed-top");
        }
    });
});</script>
</head>

<body  style="background:#eee;">
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">Test Your Skill</span></div>
<?php
 include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['name'];

include_once 'dbConnection.php';
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}?>

</div></div>
<!-- admin start-->

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dash.php?q=0"><b>Dashboard</b></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dash.php?q=0">Home<span class="sr-only">(current)</span></a></li>
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash.php?q=1">User</a></li>
		<li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="list.php?q=2">Ranking</a></li>
		<li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="dash.php?q=3">Feedback</a></li>
        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quiz<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dash.php?q=4">Add Quiz</a></li>
            <li><a href="dash.php?q=5">Remove Quiz</a></li>
          </ul>
        </li>
      </ul>
          </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--navigation menu closed-->
<div class="container-fluid"><!--container start-->
<div class="row">
<?php 
if(@$_GET['q']== 2) 
{
    echo '
    <div class="col-md-12">
    <div class="panel">
    <div class="row">
    <form role="form" method="post" action="list.php?q=2&query=Search">';
    
    $result = mysqli_query($con,"SELECT * FROM courses") or die('Error');
        while($row = mysqli_fetch_array($result)) {
	$cid = $row['cid'];
    $cname = $row['cnm'];
            
            echo '<div class="col-md-3">
            <div class="form-group">
  				<div class="col-md-12"> 
    				<label class="checkbox-inline" for="'.$cname.'">
      				<input type="checkbox" name="'.$cname.'" id="'.$cname.'" value="'.$cname.'"> '.$cname.'
    				</label>
    				<div class="col-md-8">
  				<input id="'.$cname.'val" name="'.$cname.'val" type="text" placeholder="% to Consider" class="form-control input-md">
    
  				</div>
  				</div>
		</div>
            
            </div>
            
            ';
        }
    
    echo '<div class="col-md-12">
<div class="form-group" align="center">
<input type="submit" value="Search" class="btn btn-primary" />
</div>
</div>
    </form></div></div>
    </div>
    <div class="col-md-3">
        <div class="panel">
        <table class="table table-striped title1">
        <tr>
            <td style="color:red"><b>Total Sudents : </b></td><td>';
    $result = mysqli_query($con,"SELECT * FROM user") or die('Error');
    $c=0;
    while($row = mysqli_fetch_array($result)) {
	$c++;
}    
        
        
echo '<b>'.$c.'</b></td>
            </tr>
        <tr>
        <td align="center" colspan="2"><b>Skilled Students</b></td>
        </tr>
        ';
        $result = mysqli_query($con,"SELECT * FROM courses") or die('Error');
        while($row = mysqli_fetch_array($result)) {
	$cid = $row['cid'];
    $cname = $row['cnm']; 
            echo '<tr><td style="color:blue"><b>'.$cname.'</b></td>';
            $res = mysqli_query($con,"SELECT * FROM cresult where cid='$cid'") or die('Error');
            $c=0;
    while($row = mysqli_fetch_array($res)) {
	$c++;
}    
            
            echo '<td><b>'.$c.'</b></td></tr>';
        }
    echo '
        </table>
        </div>
    </div>
<div class="col-md-9">';

    
    
    
if(@$_GET['query']=='Search'){
    $result = mysqli_query($con,"SELECT * FROM courses") or die('Error');
$cnt=0;
    while($row = mysqli_fetch_array($result)) {
	$cid = $row['cid'];
    $cname = $row['cnm'];
            $a = $_POST[''.$cname.''];
            $aval=$_POST[''.$cname.'val'];
            if($a == $cname){
                $tab[$cnt]=$cid;
                $tabval[$cnt]=$aval; 
                $cnt+=1;
            } 
        }

  $res = mysqli_query($con,"SELECT * FROM user");
echo  '<div class="jquery-script-clear"></div><div class="panel title">
<table class="table table-striped title1 sortable" >
<thead>
<tr style="color:red"><th><b>S.No</b></th><th><b>Name</b></th><th><b>Gender</b></th><th><b>College</b></th><th  ><b>Score</b></th></tr></thead><tbody>';
$c=0;
  
while($row=mysqli_fetch_array($res) )
{
$e=$row['email'];
$fscore=0;
    $i=0;
    while($i<$cnt){
    $result = mysqli_query($con,"SELECT * FROM cresult WHERE uname='$e' AND cid='$tab[$i]' "); 
        
    while($rows=mysqli_fetch_array($result) )
    {

        $scr=$rows['score'];
        $scr*=$tabval[$i]/100;
        $fscore+=$scr;
        
    }
        $i++;
    }
if($fscore>0){

$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$gender=$row['gender'];
$college=$row['college'];
}
$c++;
echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$gender.'</td><td>'.$college.'</td><td>'.$fscore.'</td></tr>';
    
}
}
    
echo '
  </tbody></table>
  </div>'; 

}

//ranking start
if(@$_GET['query']!='Search'){
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="jquery-script-clear"></div><div class="panel title">
<table class="table table-striped title1 sortable" >
<thead>
<tr style="color:red"><th><b>Rank</b></th><th><b>Name</b></th><th><b>Gender</b></th><th><b>College</b></th><th><b>Score</b></th></tr></thead><tbody>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$gender=$row['gender'];
$college=$row['college'];
}
$c++;
echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$gender.'</td><td>'.$college.'</td><td>'.$s.'</td><td>';
}
echo '</tbody></table></div>';}
}

?>


</div><!--container closed-->
</div>
    
</body>
</html>
<?php 
    
}
?>