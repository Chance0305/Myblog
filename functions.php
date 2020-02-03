<?php
use src\App\DB;

function view($url, $data = []) {
	extract($data);

	require "../src/Views/_template/header.php";
	require "../src/Views/$url.php";
	require "../src/Views/_template/footer.php";
}

function move($url, $msg = "") {
	if($msg != "") echo "<script>alert('" . $msg . "')</script>";
	echo "<script>location.href='$url';</script>";
	exit;
}

function back($msg = "") {
	if($msg != "") echo "<script>alert('" . $msg . "')</script>";
	echo "<script>history.back();</script>";
	exit;
}

function user($idx = 0) {
	if($idx == 0) {
		if(isset($_SESSION['user'])) {
			$user = DB::fetch("SELECT * FROM users WHERE idx = ?", [$_SESSION['user']->idx]);
			if($user) {
				return $user;
			} else {
				unset($_SESSION['user']);
				move("/", "로그아웃 되었습니다.");
			}
		}
		return false;
	} else {
		$user = DB::fetch("SELECT * FROM users WHERE idx = ?", [$idx]);
		if($user) {
			return $user;
		} else {
			return false;
		}
	}
}

function text($text, $type = false) {
	$text = htmlspecialchars($text);
	$text = str_replace(" ", "&nbsp;", $text);
	if($type) $text = str_replace("\n", "<br>", $text);

	return $text;
}

function isEmpty($arr) {
	$arr = array_map("trim", $arr);
	if(in_array("", $arr)) return true;
	else return false;
}

function passJS($vName, $dName) {
	echo '<script> let ' . $vName . ' = ' . json_encode($dName) . ';</script>';
}
?>
