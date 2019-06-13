<?php
namespace Gondr;

class Pager {
    public $start;
    public $end;
    public $totalCnt;
    public $totalPage;
    public $prev = true;
    public $next = true;

    public $itemPerPage = 6; //페이지당 글의 갯수
    public $pagePerChapter = 5; //챕터당 페이지 수
    public $current = 1;

    public function calc($page){
        $this->current = $page;

        $sql = "SELECT count(*) AS cnt FROM boards";
        $this->totalCnt = DB::fetch($sql)->cnt;
        $this->totalPage = ceil($this->totalCnt / $this->itemPerPage); //전체 페이지수
        
        $this->end = ceil($this->current / $this->pagePerChapter) * $this->pagePerChapter;
        $this->start = $this->end - $this->pagePerChapter + 1;

        if($this->end >= $this->totalPage){
            $this->end = $this->totalPage;
            $this->next = false;
        }

        if($this->start == 1){
            $this->prev = false;
        }
    }
}