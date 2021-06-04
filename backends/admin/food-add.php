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

if (!isset($_POST['name']) || !isset($_POST['desc'])) {

	$_SESSION['msg'] = 'Invalid POST variable keys! Refresh the page!';

	header('location: ../../admin/food-list.php');

	exit();
}

$regex = '/^[(A-Z)?(a-z)?(0-9)?\-?\_?\.?\s*]+$/';


if (!preg_match($regex, $_POST['name']) || !preg_match($regex, $_POST['desc'])) {

	$_SESSION['msg'] = 'Whoa! Invalid Inputs!';

	header('location: ../../admin/food-list.php');

	exit();

} else {

	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$price = $_POST['price'];
	$image = $_FILES['image'];

	$newImgName = 'restro_' . time() . '.' .  pathinfo($image['name'], PATHINFO_EXTENSION);
	move_uploaded_file($image['tmp_name'], '../../images/'.$newImgName);

	$sql = "INSERT INTO food (fname, price, description, image) VALUES(?,?,?,?)";
    $query  = Connectiondb::connect()->prepare($sql);
    if ($query->execute([$name, $price, $desc, $newImgName])) {

    	$_SESSION['msg'] = 'Food Added!';

		header('location: ../../admin/food-list.php');
    	
    } else {

    	$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';

		header('location: ../../admin/food-list.php');

    }


}