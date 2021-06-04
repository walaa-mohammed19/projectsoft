<?php declare(strict_types=1);

require_once "connection.php";

/**
 * Class Users
 */
final class Users
{

    public static function AddUserModel($table, $data): string
    {

        $stmt = Connection::connect()->prepare("INSERT INTO $table(name, email, password, timestamp) VALUES (:name, :email, :password, :timestamp)");

        $stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":timestamp", $data["timestamp"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return 'ok';

        } else {

            return 'error';
        }

        $stmt -> close();

        $stmt = null;
    }

    public static function EditUserModel($table, $data): string
    {

        $stmt = Connection::connect()->prepare("UPDATE $table set email = :email, password = :password WHERE name = :name");

        $stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);


        if ($stmt->execute()) {

            return 'ok';

        } else {

            return 'error';

        }

        $stmt -> close();

        $stmt = null;
    }

    public static function DeleteUserModel($table, $data): string
    {

        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

        $stmt -> bindParam(":id", $data, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return 'ok';

        } else {

            return 'error';

        }

        $stmt -> close();

        $stmt = null;
    }
}