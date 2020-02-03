<?php
use src\App\Route;

//메인 페이지
Route::GET("/", "MainController@index");

Route::GET("/join", "MainController@joinView", "logout");
Route::POST("/join", "MainController@join", "logout");

Route::GET("/login", "MainController@loginView", "logout");
Route::POST("/login", "MainController@login", "logout");

Route::GET("/logout", "MainController@logout", "login");

Route::GET("/write/{boardIdx}", "MainController@createArticleView", "admin");
Route::POST("/write/{boardIdx}", "MainController@createArticle", "admin");

Route::GET("/modify/{articleIdx}", "MainController@modifyArticleView", "admin");
Route::POST("/modify/{articleIdx}", "MainController@modifyArticle", "admin");

Route::GET("/delete/{articleIdx}", "MainController@deleteArticle", "admin");

Route::GET("/list/{menuIdx}/{sortType}", "MainController@index");
Route::GET("/view/{postIdx}", "MainController@articleView");

Route::POST("/comment/{postIdx}", "MainController@comment", "login");
Route::POST("/comment_modify/{commentIdx}", "MainController@comment_modify", "login");
Route::GET("/comment_delete/{commentIdx}", "MainController@comment_delete", "login");

Route::GET("/like/{postIdx}", "MainController@like", "login");

Route::GET("/admin", "MainController@adminView", "admin");

Route::GET("/user_modify", "MainController@newPassView", "admin");
Route::POST("/user_modify", "MainController@newPass", "admin");

Route::POST("/create_category", "MainController@createCategory", "admin");
Route::POST("/modify_category", "MainController@modifyCategory", "admin");
Route::GET("/delete_category/{categoryIdx}", "MainController@deleteCategory", "admin");

Route::GET("/error", "MainController@errorView");

Route::init();
?>