<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once "..\src\Users.php";

class UsersTest extends TestCase
{

    public function test_reset_table () {
        $stmt = Connection::connect()->prepare("TRUNCATE users");
        $ok = $stmt->execute();
        $this->assertTrue($ok);
    }


    public function test_add () {
        $table = 'users';

        $crypt = crypt('123', '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $data = array('id' => '1',
            'name' => 'Enaam Rajab',
            'email' => 'enaam@gmail.com',
            'password' => 123,
            );

        $answer = Users::AddUserModel($table, $data);
        $this->assertEquals($answer, "ok");
    }

    public function test_edit () {

        $table = "users";
        $encryptpassword = "123456";
        $data = array(
            'name' => 'Enaam Rajab',
            'email' => 'enaam@gmail.com',
            'password' => $encryptpassword
            );

        $answer = Users::EditUserModel($table, $data);
        $this->assertEquals($answer, "ok");
    }

    public function test_delete () {
        $table ="users";
        $data = 1;
        $answer = Users::DeleteUserModel($table, $data);
        $this->assertEquals($answer, "ok");
    }



}
