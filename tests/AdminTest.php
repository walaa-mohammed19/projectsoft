<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once "..\src\Admin.php";

class AdminTest extends TestCase
{

    public function test_reset_table () {
        $stmt = Connection::connect()->prepare("TRUNCATE users");
        $ok = $stmt->execute();
        $this->assertTrue($ok);
    }


    public function test_add () {
        $table = 'admin';

        $crypt = crypt('146', '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $data = array(
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'password' => $crypt,
        );

        $answer = Admin::AddAdminModel($table, $data);
        $this->assertEquals($answer, "ok");
    }

    public function test_edit () {

        $table = "admin";
        $encryptpassword = "1256";
        $data = array(
            'name' => 'Admin2',
            'email' => 'admin@gmail.com',
            'password' => $encryptpassword
        );

        $answer = Admin::EditAdminModel($table, $data);
        $this->assertEquals($answer, "ok");
    }

    public function test_delete () {
        $table ="admin";
        $data = 3;
        $answer = Admin::DeleteAdminModel($table, $data);
        $this->assertEquals($answer, "ok");
    }



}
