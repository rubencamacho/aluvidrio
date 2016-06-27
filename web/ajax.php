<?php

if(isset($_POST['name'])){
	$column=$_POST['name'];
	$new_value=$_POST['value'];
	$id=$_POST['pk'];
	$sql="update `operarios` set $column='$new_value' where id=$id";
	echo $sql;
}
