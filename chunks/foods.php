
<?php

require('backends/connection.php');

if (isset($_REQUEST['id'])) {

	$sql = 'SELECT * FROM food WHERE cat_id = "'.$_REQUEST['id'].'"';
	
} else {

	$sql = 'SELECT * FROM food';

}

$query  = Connectiondb::connect()->prepare($sql);
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);

?>


<section class="fcategories">

	<div class="container">

		<?php

			if (isset($_SESSION['msg'])) {
				echo '<div class="section pink center white-text" style="margin: 10px; padding: 3px 10px; margin-top: 35px; border: 2px solid black; border-radius: 5px;">
						<p><b>'.$_SESSION['msg'].'</b></p>
					</div>';

				unset($_SESSION['msg']);
			}
		?>

		<div class="section white center">
			<h3 class="header">Foods Area!</h3>
		</div>

		<?php if (count($arr_all) == 0) {
	echo '<div class="section gray center" style="border: 1px solid black; border-radius: 5px;">
			<p class="header">Sorry No Categories to Display!</p>
		</div>';
			} else {  ?>
	
	<div class="row">
			
			<?php foreach($arr_all as $item) { ?>
				<div class="col s12 m4">
					<div class="card food-card">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src="images/<?php echo $item['image']; ?>">
						</div>
						<div class="card-content">
							<span class="card-title activator grey-text text-darken-4">
								<a class="black-text" href=""><?php echo $item['fname']; ?></a><i class="material-icons right">more_vert</i>
							</span>
							<div class="card-content">
								<p>Price <span>$<?php echo $item['price']; ?></span></p>
							</div>
							<div class="card-content center">
								<a href="backends/order-food.php?id=<?php echo $item['id']; ?>" class="btn waves-effect waves-block waves-light" href="">Add to Cart</a>
							</div>
						</div>
						<div class="card-reveal">
							<span class="card-title grey-text text-darken-4"><?php echo $item['fname']; ?><i class="material-icons right">close</i></span>
							<p><?php echo $item['description']; ?></p>
						</div>
					</div>
				</div>
			<?php } ?>

		</div>

		<?php
			} 
		?>

	</div>
	
</section>