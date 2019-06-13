<?php

use Gondr\Route;

Route::get("/", "StaticController@index");
Route::get("/view", "PostController@viewPage");
if(!isset($_SESSION['user'])) {
    Route::get("/login", "UserController@loginPage");
    Route::post("/login", "UserController@loginProcess");
    
}else {
    Route::get("/logout", "UserController@logout");
    Route::get("/post", "PostController@writePage");
    Route::post("/post", "PostController@writeProcess");

    //첨부파일 업로드
    Route::post("/upload", "PostController@uploadHandle");
    Route::get("/update", "PostController@updatePage");
    Route::get("/delete", "PostController@deletePage");
}
