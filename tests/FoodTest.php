<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once "..\src\Food.php";

class FoodTest extends TestCase
{

    public function test_reset_table()
    {
        $stmt = Connection::connect()->prepare("TRUNCATE users");
        $ok = $stmt->execute();
        $this->assertTrue($ok);
    }

    public function test_add () {

        $table = 'food';

        $data = array('fname'=>'burger',
            'price'=> 150,
            'description' =>'lorem2',
            'image' => 'Smash-Burgers.jpg'
            );

        $answer = Food::AddFoodModel($table, $data);
        $this->assertEquals($answer, "ok");
    }

    public function test_edit () {

        $table = "food";
        $data = array('fname'=>'sandwich',
            'price'=> 170,
            'description' =>'lorem3',
            'image' => 'Ham-Sandwich.jpg'
        );

        $answer = Food::EditFoodModel($table, $data);
        $this->assertEquals($answer, "ok");
    }

    public function test_delete () {
        $answer = Food::DeleteFoodModel("food", 3);
        $this->assertEquals($answer, "ok");
    }

    public function test_sum () {
        $answer = Food::sumTotalFoodModel('food');
        $this->assertTrue(isset($answer['totalPrice']));


    }
}
