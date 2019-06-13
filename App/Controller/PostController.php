<?php

namespace Gondr\Controller;

use Gondr\DB;

class PostController extends MasterController {
    
    public function writePage() {

        $this->render("post/write");

    }

    public function writeProcess() {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $writer = $_SESSION['user']->id;
        $id = $_POST['id'];

        if(isset($_POST['id'])) {
            $sql = "UPDATE boards SET title = ?, content = ? WHERE id = ?";
            $data = [$title, $content, $id];
        }else {
            $sql = "INSERT INTO boards(`title`, `content`, `writer`, `wdate`) VALUES (?, ?, ?, NOW())";
            $data = [$title, $content, $writer];
        }

        $cnt = DB::query($sql, $data);

        if($cnt != 1) {
            $_SESSION['flash_msg'] = ['msg' => '글 작성중 오류 발생'];
            header("Location: /post");
        }else {
            $_SESSION['flash_msg'] = ['msg' => '글이 작성되었습니다'];
            header("Location: /");
        }
    }

    public function uploadHandle(){
        if(!isset($_FILES['upload']) || $_FILES['upload']['name'] === ""){
            $this->json(['error'=>['msg'=>'이미지가 없습니다']], 400);
            exit;
        }
        //여기까지 코드가 왔다면 업로드 파일은 존재하는 거다.
        $file = $_FILES['upload'];

        $uploadDir = "uploads/" . date("Ymd", time());
        if(!file_exists($uploadDir)){
            mkdir($uploadDir, 0777, true);
        }

        $filename = date("ymdHis") . "_" . $file['name'];
        $fileDest = $uploadDir . "/" . $filename;
        move_uploaded_file($file['tmp_name'], $fileDest);

        $this->json(['url' => '/' . $fileDest]);

    }

    public function viewPage(){
        if(!isset($_GET['id'])){
            $_SESSION['flash_msg'] = ['msg' => '존재하지 않는 글'];
            header("Location: /");
            exit;
        }

        $id = $_GET['id'];

        $data = DB::fetch("SELECT * FROM boards WHERE id = ?", [$id]);
        
        if(!$data){
            $_SESSION['flash_msg'] = ['msg' => '존재하지 않는 글'];
            header("Location: /");
            exit;
        }

        $this->render("post/view", ['data'=>$data]);
    }

    public function updatePage() {

        if(!isset($_GET['id'])){
            $_SESSION['flash_msg'] = ['msg' => '존재하지 않는 글'];
            header("Location: /");
            exit;
        }

        $id = $_GET['id'];

        $sql = "SELECT * FROM boards WHERE id = ?";

        $data = DB::fetch($sql, [$id]);

        $this->render("post/update", ['data' => $data]);

    }
    public function deletePage(){
        $id = $_GET['id'];
        $sql = "DELETE FROM boards WHERE id = ?";
        $data = [$id];
        
        $cnt = DB::query($sql, $data);
        
        if($cnt != 1) {
            $_SESSION['flash_msg'] = ['msg' => '글 삭제중 오류 발생'];
            header("Location: /");
        }else {
            $_SESSION['flash_msg'] = ['msg' => '글이 삭제되었습니다'];
            header("Location: /");
        }

    }
}