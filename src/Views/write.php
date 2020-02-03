	<!-- Visual Section Start -->
	<div id="visual" class="d-flex align-items-center">
		<img src="/images/image4.jpg" alt="" id="visual-image">
		<div class="container">
			<div id="visual-title">DEVELOPER'S BLOG</div>
		</div>
	</div>
	<!-- Visual Section End -->

	<!-- Blog Section Start -->
	<div id="blog" class="write">
		<div class="container d-flex justify-content-between">
			<!-- Side Menu Section Start -->
                <div id="side-menu">
                    <ul class="menu-group">
                        <?php if(!user()) { ?>
                        <a href="/login"><button class="user">로그인</button></a>
                        <?php } else { ?>
                        <button class="user">환영합니다 '<?= text(user()->id) ?>' 님</button>
                        <?php } ?>
                    </ul>
                    <ul class="menu-group"> 
                        <span>홈</span>
                        <a href="/">
                            <li class="menu <?= $cIdx == 0 ? 'active' : '' ?>">전체</li>
                        </a>
                    </ul>
                    <ul class="menu-group"> 
                        <?php foreach($categoryList as $cl) { ?>
                        <a href="/list/<?= $cl->idx ?>/0">
                            <li class="menu <?= $cIdx == $cl->idx ? 'active' : '' ?>" style="word-break: break-all;"><?= text($cl->name) ?></li>
                        </a>
                        <?php } ?>
                    </ul>
                </div>
            <!-- Side Menu Section End -->

			<!-- Content Section Start -->
			<div id="content">
				<!-- Editor Section Style Start -->
				<form class="editor" enctype="multipart/form-data" method="POST">
					<input type="text" name="title" placeholder="제목">
					<label for="file"><i class="fas fa-upload"></i>&nbsp;&nbsp;&nbsp;파일 또는 이미지를 입력해주세요.</label>
					<div class="option-group">
						<div class="wysiwyg">EDITOR</div>
						<div class="html">HTML</div>
					</div>
					<input type="file" name="file[]" id="file" multiple>
					<textarea name="content"></textarea>
					<div class="button-group">
						<a href="#" class="button back">취소</a>
						<button type="submit" class="button submit">작성완료</button>
					</div>
				</form>
				<!-- Editor Section Style End -->
			</div>
			<!-- Content Section End -->
		</div>
	</div>
	<!-- Blog Section End -->

	<!-- Footer Section Start -->
	<footer>
		<div class="footer-menu d-flex align-items-center">
			<div class="container">
				<a href="#">사이트소개</a>
				<a href="#">이용약관</a>
				<a href="#">개인정보처리방침</a>
				<a href="#">문의/피드백</a>
				<a href="#">광고</a>
			</div>
		</div>
		<div class="footer-content">
			<div class="container d-flex justify-content-between">
				<div>
					경기도 분당구 로램구 덤프대로 2801번길 12 345동 123호<br>
					Tel: 031) 890-1234 / Phone: 010) 6789-1234<br>
					분당 양영디지털고등학교 소프트웨어개발과 기능반 재학생<br><br>
					© DEVELOPER. ANNONYMOUS All rights reserved
				</div>
				<div>
					<img src="/images/twitter.png" alt="">
					<img src="/images/instagram.png" alt="">
					<img src="/images/facebook.png" alt="">
				</div>
			</div>
		</div>
		</div>
	</footer>
	<!-- Footer Section End -->
</body>
</html>