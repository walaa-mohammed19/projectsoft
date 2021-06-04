
<?php

require('backends/connection.php');

$user_id = $_SESSION['user_id'];

$sql = 'SELECT cart.id as cart_id, food.* FROM cart LEFT JOIN food ON cart.food_id = food.id WHERE cart.user_id = ' . $user_id;

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
			<h3 class="header">Checkout</h3>
		</div>

		<?php if (count($arr_all) == 0) {
	echo '<div class="section gray center" style="border: 1px solid black; border-radius: 5px;">
			<p class="header">Your Cart Is Empty</p>
		</div>';
			} else {  ?>
	
		<div class="row">
			<div class="col s8">

				<p>Welcome <?= $_SESSION['user'] ?>, you are now paying for 
				<?php
				$subtotal = $vat_value = $total = 0;
				$count = count($arr_all);
				$i = 0;
				foreach($arr_all as $item) { 
					$subtotal += $item['price'];
					echo "<b>" . $item['fname'] . "</b>";
					$i++;
					echo ($i == $count) ? '' : ' and ';
					
				} 
				$vat = 15;
				$vat_value = $subtotal * $vat / 100;
				$total = $subtotal + $vat_value;
				?>
				</p>

				<a style="margin-top: 10px;" class="waves-effect waves-light btn purple darken-1 btn-large btn-block">Complete Payment With PayPal</a>
			</div>
			<div class="col s4">
				<table class="striped centered z-depth-1">
					<tr>
						<td><b>Subtotal</b></td>
						<td><b>$<?php echo $subtotal ?></b></td>
					</tr>

					<tr>
						<td><b>VAT (<?php echo $vat ?>%)</b></td>
						<td><b>$<?php echo $vat_value ?></b></td>
					</tr>

					<tr>
						<td><b>Total</b></td>
						<td><b>$<?php echo $total ?></b></td>
					</tr>
				</table>
			</div>
		</div>

		<?php
			} 
		?>

	</div>
	
</section>