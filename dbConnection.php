<?php
//all the variables defined here are accessible in all the files that include this one
/* $con= new mysqli('localhost(its the host name)','username','password','databaseName') */

$con= new mysqli('localhost','root','','db_oes_master')or die("Could not connect to mysql".mysqli_error($con));

?>