<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Blog</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/my_layout.css">
	<link rel="stylesheet" href="/fontawesome/css/all.css">
	<script src="/js/script.js"></script>
</head>
<body>
	<!-- Header Section Start -->
	<header>
		<div class="container d-flex justify-content-between align-items-center h-100">
			<div class="logo">
				<a href="/">D-LOG</a>
			</div>
			<nav class="d-flex justify-content-between">
				<div class="menu-group">
					<a href="/">메인</a>
					<a href="/list/0/0">글목록</a>
					<a href="/admin">관리자</a>
				</div>
				<div class="user-group">
					<?php if(!user()) { ?>
					<a href="/login" class="bttn header-login-btn">로그인</a>
					<a href="/join" class="bttn header-login-btn">회원가입</a>
					<?php } else { ?>
					<a href="/logout" class="bttn header-login-btn">로그아웃</a>
					<?php } ?>
				</div>
			</nav>
		</div>
	</header>
	<!-- Header Section End -->