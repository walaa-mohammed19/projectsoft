<?php declare(strict_types=1);

require_once "connection.php";

/**
 * Class Food
 */
final class Food
{
    /**
     * adds food to the food table in the database using input data
     *
     * @param mixed $table
     * @param mixed $data
     *
     * @return string
     */
    public static function AddFoodModel($table, $data): string
    {
        $stmt = Connection::connect()->prepare("INSERT INTO $table(fname, price, description,image) VALUES (:fname, :price, :description, :image)");

        $stmt->bindParam(":fname", $data["fname"], PDO::PARAM_STR);
        $stmt->bindParam(":price", $data["price"], PDO::PARAM_INT);
        $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
        $stmt->bindParam(":image", $data["image"], PDO::PARAM_STR);


        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    public static function DeleteFoodModel($table, $data){

        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

        $stmt -> bindParam(":id", $data, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;

    }

    public static function EditFoodModel($table, $data): string
    {

        $stmt = Connection::connect()->prepare("UPDATE $table set fname = :fname , price = :price, description = :description WHERE image = :image");

        $stmt->bindParam(":fname", $data["fname"], PDO::PARAM_STR);
        $stmt->bindParam(":price", $data["price"], PDO::PARAM_INT);
        $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
        $stmt->bindParam(":image", $data["image"], PDO::PARAM_STR);


        if ($stmt->execute()) {

            return 'ok';

        } else {

            return 'error';

        }

        $stmt -> close();

        $stmt = null;
    }
    //adding total sales

    /**
     * sums the prices as total price from the table
     * @param mixed $table
     *
     * @return void
     */
    public 	static function sumTotalFoodModel($table){

        $stmt = Connection::connect()->prepare("SELECT SUM(Price) as totalPrice FROM $table");

        $stmt -> execute();

        return $stmt -> fetch();


        $stmt -> close();

        $stmt = null;

    }

}