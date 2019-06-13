<?php
namespace Gondr\Controller;

use Gondr\DB;

class UserController extends MasterController {
    public function loginPage(){
        $this->render("user/login");
    }

    public function loginProcess(){
        $id = $_POST['id'];
        $pwd = $_POST['pwd'];

        $sql = "SELECT * FROM users WHERE id = ? AND password = PASSWORD(?)";
        $user = DB::fetch($sql, [$id, $pwd]);

        if($user == null){
            //로그인 실패
            $_SESSION['flash_msg'] = ['msg'=>'로그인 실패, 아이디와 비밀번호 확인'];
            header("Location: /login");
        }else {
            $_SESSION['flash_msg'] = ['msg'=>'로그인 성공'];
            $_SESSION['user'] = $user;
            header("Location: /");
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        $_SESSION['flash_msg'] = ['msg'=> "로그아웃 되었습니다."];
        header("Location: /");
    }
}