<?php

namespace Gondr\Controller;

use Gondr\DB;
use Gondr\Pager;

class StaticController extends MasterController {

    public function index() {
        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        if(!is_numeric($page)) {
            $page = 1;
        }
          
        $sql = "SELECT * FROM boards ORDER BY id DESC LIMIT ". ($page - 1) * 6 . ", 6";
        $list = DB::fetchAll($sql);
        $imgPattern = '/<img src=".+">/';
        foreach( $list as $item ){
            $match = preg_match($imgPattern, $item->content, $matches);
            if($match > 0){
                $item->thumbnail = $matches[0];
            }else {
                $item->thumbnail = "<img src='/imgs/noimage.png'>";
            }

        }


        $sql_slide =  "SELECT * FROM boards ORDER BY id DESC LIMIT 3";
        $list_slide = DB::fetchAll($sql_slide);
        $imgPattern_s = '/<img src=".+">/';
        foreach( $list_slide as $item ){
            $match = preg_match($imgPattern_s, $item->content, $matches);
            if($match > 0){
                $item->thumbnail = $matches[0];
            }else {
                $item->thumbnail = "<img src='/imgs/noimage_s.png'>";
            }

        }
        
        $pager = new Pager();
        $pager->calc($page);

        $this->render("main", ['list'=>$list, 'p'=>$pager, 'list_slide'=>$list_slide]);
    }

    public function errorPage($msg) {
        $this->render("error", ['msg'=>$msg]);
    }
}