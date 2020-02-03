<?php
namespace src\Controller;

use src\App\DB;

class MainController {
	public function index($idx = 0, $sort = 0) {
		$datas["cIdx"] = $idx;
		$datas["sort_type"] = $sort;

		if($idx == 0) {
			if($sort == 0) {
				$datas["articleList"] = DB::fetchAll("SELECT * FROM posts ORDER BY idx DESC");
			} else if ($sort == 1) {
				$datas["articleList"] = DB::fetchAll("SELECT * FROM posts ORDER BY idx ASC");
			} else if ($sort == 2) {
				$datas["articleList"] = DB::fetchAll("SELECT * FROM posts ORDER BY liked DESC");
			} else if ($sort == 3) {
				$datas["articleList"] = DB::fetchAll("SELECT * FROM posts ORDER BY viewed DESC");
			}
		} else {
			if($sort == 0) {
				$datas["articleList"] = DB::fetchAll("SELECT * FROM posts WHERE category_idx = ?  ORDER BY idx DESC", [$idx]);
			} else if ($sort == 1) {
				$datas["articleList"] = DB::fetchAll("SELECT * FROM posts WHERE category_idx = ?  ORDER BY idx ASC", [$idx]);
			} else if ($sort == 2) {
				$datas["articleList"] = DB::fetchAll("SELECT * FROM posts WHERE category_idx = ?  ORDER BY liked DESC", [$idx]);
			} else if ($sort == 3) {
				$datas["articleList"] = DB::fetchAll("SELECT * FROM posts WHERE category_idx = ?  ORDER BY viewed DESC", [$idx]);
			}
		}
		$datas["uploadList"] = DB::fetchAll("SELECT * FROM uploads WHERE type = 1");
		$datas["categoryList"] = DB::fetchAll("SELECT * FROM categorys");

		if(user()) DB::execute("INSERT INTO visitors(visit_date, name) VALUES(now(), ?)", [user()->id]);

		return view("index", $datas);
	}

	public function joinView() {
		return view("join");
	}

	public function join() {
		extract($_POST);

		// 누락
		if(isEmpty($_POST)) back("필수항목이 누락 되었습니다.");
		// 아이디
		if(!preg_match("/^[a-zA-Z]{1,8}$/", $id)) back("아이디 형식이 올바르지 않습니다. (영문 1 ~ 8)");
		// 중복
		if(DB::fetch("SELECT * FROM users WHERE id = ?", [$id])) back("이미 사용중인 아이디 입니다.");
		// 비밀번호 체크
		if($password != $password_check) back("비밀번호를 확인해 주십시오.");

		$data = [":id" => $id, ":password" => $password];
		DB::execute("INSERT INTO users(id, password) VALUES(:id, :password)", $data);
		move("/", "회원가입이 완료되었습니다.");
	}

	public function loginView() {
		return view("login");
	}

	public function login() {
		extract($_POST);

		$data = [":id" => $id, ":password" => $password];
		$user = DB::fetch("SELECT * FROM users WHERE id = :id AND password = :password", $data);
		if($user) {
			$_SESSION['user'] = $user;
			move("/", "로그인에 성공하였습니다.");
		} else {
			move("/login", "로그인에 실패하였습니다.");
		}
	}

	public function logout() {
		unset($_SESSION['user']);
		move('/', '로그아웃에 성공하였습니다.');
	}

	public function createArticleView($categoryIdx) {
		$datas["cIdx"] = $categoryIdx;
		$datas["categoryList"] = DB::fetchAll("SELECT * FROM categorys");

		return view("write", $datas);
	}

	public function createArticle($categoryIdx) {
		extract($_POST);

		if(isEmpty($_POST)) back("제목과 내용은 공백일 수 없습니다.");

		$data = [":category_idx" => $categoryIdx, ":title" => $title, ":content" => $content];
		DB::execute("INSERT INTO posts(category_idx, title, content, write_date) VALUES(:category_idx, :title, :content, now())", $data);

		$file = $_FILES['file'];

		for($i = 0; $i < count($file['name']); $i++) {
			// var setting
			$post_idx = DB::fetch("SELECT * FROM posts ORDER BY idx DESC LIMIT 0, 1")->idx;
			$upload_idx = DB::fetch("SELECT * FROM uploads ORDER BY idx DESC LIMIT 0, 1")->idx;
			$name = $file['name'][$i];
			$directory = "uploads/" . $upload_idx . $file['name'][$i];

			// upload
			move_uploaded_file($file['tmp_name'][$i], $directory);

			if(explode("/", $file['type'][$i])[0] == "image") {
				// if Image
				if($_FILES['file']['size'][$i] >= 1024 * 1024 * 10) back("10MB 미만의 파일만 받을 수 있습니다.");

				$data = [":post_idx" => $post_idx, ":name" => $name, ":directory" => $directory, ":type" => 1];
				DB::execute("INSERT INTO uploads(post_idx, name, directory, type) VALUES(:post_idx, :name, :directory, :type)", $data);
			} else {
				// if File
				if($_FILES['file']['size'][$i] >= 1024 * 1024 * 50) back("50MB 미만의 파일만 받을 수 있습니다.");

				$data = [":post_idx" => $post_idx, ":name" => $name, ":directory" => $directory, ":type" => 0];
				DB::execute("INSERT INTO uploads(post_idx, name, directory, type) VALUES(:post_idx, :name, :directory, :type)", $data);
			}
		}

		move("/list/" . $categoryIdx, "글 작성 완료");
	}

	public function modifyArticleView($articleIdx) {
		$datas["categoryList"] = DB::fetchAll("SELECT * FROM categorys");
		$datas["cIdx"] = $articleIdx;

		return view("modify", $datas);
	}

	public function modifyArticle($articleIdx) {
		extract($_POST);

		if(isEmpty($_POST)) back("제목과 내용은 공백일 수 없습니다.");

		$data = [":title" => $title, ":content" => $content, ":idx" => $articleIdx];

		DB::execute("UPDATE posts SET title = :title, content = :content WHERE idx = :idx", $data);
		DB::execute("UPDATE uploads SET post_idx = -1 WHERE post_idx = ?", [$articleIdx]);

		$file = $_FILES['file'];

		for($i = 0; $i < count($file['name']); $i++) {
			// var setting
			$post_idx = $articleIdx;
			$upload_idx = DB::fetch("SELECT * FROM uploads ORDER BY idx DESC LIMIT 0, 1")->idx;
			$name = $file['name'][$i];
			$directory = "uploads/" . $upload_idx . $file['name'][$i];

			// upload
			move_uploaded_file($file['tmp_name'][$i], $directory);

			if(explode("/", $file['type'][$i])[0] == "image") {
				// if Image
				if($_FILES['file']['size'][$i] >= 1024 * 1024 * 10) back("10MB 미만의 파일만 받을 수 있습니다.");

				$data = [":post_idx" => $post_idx, ":name" => $name, ":directory" => $directory, ":type" => 1];
				DB::execute("INSERT INTO uploads(post_idx, name, directory, type) VALUES(:post_idx, :name, :directory, :type)", $data);
			} else {
				// if File
				if($_FILES['file']['size'][$i] >= 1024 * 1024 * 50) back("50MB 미만의 파일만 받을 수 있습니다.");

				$data = [":post_idx" => $post_idx, ":name" => $name, ":directory" => $directory, ":type" => 0];
				DB::execute("INSERT INTO uploads(post_idx, name, directory, type) VALUES(:post_idx, :name, :directory, :type)", $data);
			}
		}

		move("/", "글 수정 완료");
	}

	public function deleteArticle($articleIdx) {
		DB::execute("DELETE FROM posts WHERE idx = ?", [$articleIdx]);
		move("/", "글 삭제 완료");
	}

	public function articleListView($menuIdx) {
		return view("list");
	}

	public function articleView($articleIdx) {
		$datas["categoryList"] = DB::fetchAll("SELECT * FROM categorys");
		$datas["cIdx"] = $articleIdx;
		$datas["uploadList"] = DB::fetchAll("SELECT * FROM uploads WHERE post_idx = ?", [$articleIdx]);
		$datas["commentList"] = DB::fetchAll("SELECT * FROM comments WHERE post_idx = ?", [$articleIdx]);
		$datas["post"] = DB::fetch("SELECT * FROM posts WHERE idx = ?", [$articleIdx]);
		$datas["like"] = user() ? DB::fetchAll("SELECT * FROM likes WHERE post_idx = ? AND user_idx = ?", [$articleIdx, user()->idx]) : [];
		$datas["comment_cnt"] = DB::fetch("SELECT count(*) as cnt FROM comments WHERE post_idx = ?", [$articleIdx])->cnt;

		DB::execute("UPDATE posts SET viewed = viewed + 1 WHERE idx = ?", [$articleIdx]);

		return view("post", $datas);
	}

	public function adminView() {
		$datas["categoryList"] = DB::fetchAll("SELECT * FROM categorys");
		$datas["visitorList"] = DB::fetchAll("SELECT *, count(*) as cnt FROM visitors GROUP BY visit_date ORDER BY visit_date ASC");
		$datas["max"] = DB::fetch("SELECT count(*) as cnt FROM visitors GROUP BY visit_date ORDER BY cnt DESC LIMIT 0, 1")->cnt;

		$datas["postviewList"] = DB::fetchAll("SELECT *, count(*) as cnt FROM posts GROUP BY write_date  ORDER BY cnt DESC");
		$datas["pMax"] = DB::fetch("SELECT count(*) as cnt FROM posts GROUP BY write_date ORDER BY cnt DESC LIMIT 0, 1")->cnt;

		return view("admin", $datas);
	}

	public function createCategory() {
		extract($_POST);

		if(isEmpty($_POST)) back("카테고리 이름이 누락 되었습니다.");
		if(DB::fetch("SELECT * FROM categorys WHERE name = ?", [$name])) back("이미 사용중인 카테고리 이름 입니다.");

		DB::execute("INSERT INTO categorys(name) VALUES(?)", [$name]);
		move("/admin", "카테고리 생성 완료하였습니다.");
	}

	public function modifyCategory() {
		extract($_POST);

		if(isEmpty($_POST)) back("카테고리 이름이 누락 되었습니다.");

		$data = [":idx" => $idx, ":name" => $name];
		DB::execute("UPDATE categorys SET name = :name WHERE idx = :idx", $data);

		move("/admin", "카테고리 수정 완료");
	}

	public function deleteCategory($idx) {
		if(!DB::fetch("SELECT * FROM categorys WHERE idx = ?", [$idx])) move("/error");
		if(DB::fetch("SELECT * FROM posts WHERE category_idx = ?", [$idx])) back("게시글이 있는 카테고리는 삭제할 수 없습니다.");

		DB::execute("DELETE FROM categorys WHERE idx = ?", [$idx]);
		move("/admin", "카테고리 삭제 완료");
	}

	public function errorView() {
		return view("error");
	}

	public function like($idx) {
		DB::execute("INSERT INTO likes(user_idx, post_idx) VALUES(?, ?)", [user()->idx, $idx]);
		DB::execute("UPDATE posts SET liked = liked + 1 WHERE idx = ?", [$idx]);
		back("좋아요 완료");
	}

	public function comment($articleIdx) {
		extract($_POST);
		if(isEmpty($_POST)) back("댓글은 공백일 수 없습니다.");

		$data = [":post_idx" => $articleIdx, ":user" => $user, ":comment" => $comment];
		DB::execute("INSERT INTO comments(post_idx, user, comment, write_date) VALUES(:post_idx, :user, :comment, now())", $data);

		back("댓글 작성 완료");
	}

	public function comment_modify($commentIdx) {
		extract($_POST);
		if(isEmpty($_POST)) back("댓글은 공백일 수 없습니다.");

		$data = [":comment" => $comment, ":idx" => $commentIdx];
		DB::execute("UPDATE comments SET comment = :comment WHERE idx = :idx", $data);
		back("댓글 수정 완료");
	}

	public function comment_delete($commentIdx) {
		DB::execute("DELETE FROM comments WHERE idx = ?", [$commentIdx]);
		back("댓글 삭제 완료");
	}

	public function newPassView() {
		return view("new_password");
	}

	public function newPass() {
		extract($_POST);
		if(isEmpty($_POST)) back("필수항목이 비어있습니다.");

		$admin = DB::fetch("SELECT * FROM users WHERE id = 'admin'");
		if($current_password != $admin->password) back("현재 비밀번호와 일치하지 않습니다.");
		if($password != $password_check) back("비밀번호을 다시 확인해 주십시오.");

		$data = [":password" => $password, ":id" => "admin"];
		DB::execute("UPDATE users SET password = :password WHERE id = :id", $data);

		move("/admin", "비밀번호 변경 완료");
	}
}
?>