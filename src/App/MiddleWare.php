<?php
namespace src\App;

class MiddleWare {
	public function logout() {
		if(isset($_SESSION['user'])) move("/", "로그아웃 후 접근 가능합니다.");
	}

	public function login() {
		if(!isset($_SESSION['user'])) move("/login", "로그인 후 사용가능합니다.");
	}

	public function admin() {
		if(!isset($_SESSION['user']) || $_SESSION['user']->id != "admin") move("/", "관리자만 접근 가능합니다.");
	}
}

?>