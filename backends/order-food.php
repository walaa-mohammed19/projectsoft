<?php
session_start();

try {

    if (!file_exists('connection.php' ))
        throw new Exception();
    else
        require_once('connection.php');

} catch (Exception $e) {

	$arr = array ('code'=>"0",'msg'=>"There were some problem in the Server! Try after some time!");
	echo json_encode($arr);
	exit();
	
}

if (!isset($_SESSION['user']) || !isset($_SESSION['user_id'])) {
	$_SESSION['msg'] = "You must Log In First to Add This Food to Cart!, <a href='' class='hvr-grow white-text modal-trigger' data-target='modal1'>Login Here</a>";
	header('location: ../foods.php');
	exit();
}

if (!isset($_REQUEST['id'])) {
	$_SESSION['msg'] = "Invalid food item! Please try again!";
	header('location: ../foods.php');
	exit();
}

date_default_timezone_set("Asia/Gaza");

$food_id = $_REQUEST['id'];

$user_name = $_SESSION['user'];

$user_id = $_SESSION['user_id'];

$order_id = "RSTO" . strval(mt_rand(100000, 999999));

$timest = date("d:m:Y h:i:sa");

$sql = "INSERT INTO cart (user_id,food_id, timestamp) VALUES (?,?,?)";

$query  = Connectiondb::connect()->prepare($sql);

if ($query->execute([$user_id, $food_id, $timest])) {

	$_SESSION['msg'] = 'Product Added To Cart Successfully';

	header('location: ../foods.php');
	
} else {

	$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';

	header('location: ../foods.php');

}