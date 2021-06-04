<?php

session_start();
try {

    if (!file_exists('../connection.php' ))
        throw new Exception();
    else
        require_once('../connection.php');
		
} catch (Exception $e) {

	$_SESSION['msg'] = 'There were some problem in the Server! Try after some time!';

	header('location: ../../admin/food-list.php');

	exit();
	
}

if (!isset($_REQUEST['id'])) {

	$_SESSION['msg'] = 'Invalid ID!';

	header('location: ../../admin/food-list.php');

	exit();
} 

	$id = $_REQUEST['id'];


	$sql = "DELETE FROM food WHERE id = ?";
    $query  = Connectiondb::connect()->prepare($sql);
    if ($query->execute([$id])) {

    	$_SESSION['msg'] = 'Food Deleted!';

		header('location: ../../admin/food-list.php');
    	
    } else {

    	$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';

		header('location: ../../admin/food-list.php');

    }

