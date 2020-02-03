	<!-- Main Page Start -->
	<div id="main-page">

		<!-- Visual Section Start -->
		<div id="visual">
			<img src="/images/image4.jpg" alt="" id="visual-image">
			<div class="container">
				<div class="square">
					<div class="side1"></div>
					<div class="side2"></div>
					<div class="side3"></div>
					<div class="side4"></div>
					<div class="side5"></div>
				</div>
				<div id="visual-title">DEVELOPERS'S BLOG</div>
			</div>
			<div class="wave">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
					<path fill="#eee5" fill-opacity="1" d="M0,192L60,170.7C120,149,240,107,360,128C480,149,600,235,720,266.7C840,299,960,277,1080,245.3C1200,213,1320,171,1380,149.3L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
				  <path fill="#eee8" fill-opacity="1" d="M0,288L60,282.7C120,277,240,267,360,256C480,245,600,235,720,202.7C840,171,960,117,1080,96C1200,75,1320,85,1380,90.7L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
				  <path fill="#ebeef1" fill-opacity="1" d="M0,192L60,186.7C120,181,240,171,360,160C480,149,600,139,720,154.7C840,171,960,213,1080,202.7C1200,192,1320,128,1380,96L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
				</svg>
			</div>
		</div>
		<!-- Visual Section End -->
		
		<!-- Content Section Start -->
		<div id="content">
			<!-- Blog Section Start -->
			<div id="blog" class="blog-content">
				<div class="container d-flex justify-content-between">
					<!-- Side Menu Section Start -->
					<div id="side-menu">
						<ul class="menu-group">
							<?php if(!user()) { ?>
							<a href="/login"><button class="user">로그인</button></a>
							<?php } else if($cIdx == 0 || user()->id != "admin") { ?>
							<button class="user">환영합니다 '<?= text(user()->id) ?>' 님</button>
							<?php } else { ?>
							<a href="/write/<?= $cIdx ?>">
								<button class="user">글쓰기</button>
							</a>
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
						<!-- Sub Header Section Start -->
						<div class="sub-header title">
							전체 글보기
						</div>
						<div class="sub-header navigation">
							<div class="sub-header-menus">
								<li class="menu <?= $sort_type == 0 ? 'active' : '' ?>"><a href="/list/<?= $cIdx ?>/0"><i class="fas fa-angle-down"></i>&nbsp;&nbsp;<span>최신글</span></a></li>
								<li class="menu <?= $sort_type == 1 ? 'active' : '' ?>"><a href="/list/<?= $cIdx ?>/1"><i class="fas fa-angle-up"></i>&nbsp;&nbsp;<span>오랜글</span></a></li>
								<li class="menu <?= $sort_type == 2 ? 'active' : '' ?>"><a href="/list/<?= $cIdx ?>/2"><i class="fas fa-heart"></i>&nbsp;&nbsp;<span>좋아요</span></a></li>
								<li class="menu <?= $sort_type == 3 ? 'active' : '' ?>"><a href="/list/<?= $cIdx ?>/3"><i class="fas fa-fire"></i>&nbsp;&nbsp;<span>조회수</span></a></li>
							</div>
							<div class="sub-header-search">
								<select name="search-option" class="search-option">
									<option value="title">제목</option>
									<option value="no">글번호</option>
								</select>
								<div class="search-input">
									<input type="text" placeholder="검색">
									<button type="submit"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
						<!-- Sub Header Section End -->
						<div id="article-list">
							<?php foreach($articleList as $key => $al) { ?>
							<div class="article d-flex justify-content-between">
								<div class="d-flex justify-content-between align-items-center">
									<div class="article-no">
										<?= $al->idx ?>
									</div>
									<div class="article-item d-flex flex-column">
										<div class="article-title d-flex">
											<a href="/view/<?= $al->idx ?>">
												<?= text($al->title) ?>
	<!-- 											<div class="comments">[0]</div> -->
											</a>
										</div>
										<div class="article-info d-flex justify-content-between align-items-center">
											<?php
											$first  = new DateTime($al->write_date);
											$second = new DateTime(date("Y-m-d H:i:s"));
											$diff = $first->diff($second);
											?>
											<div class="time"><?= $diff->h != 0 ? $diff->h . "시간 전" : $diff->i != 0 ? $diff->i . "분 전" : $diff->s . "초 전" ?></div>
											<div class="particle"></div>
											<div class="viewed">조회 <?= $al->viewed ?></div>
											<div class="particle"></div>
											<div class="liked">좋아요 <?= $al->liked ?></div>
										</div>
									</div>
								</div>
								<div class="article-img">
									<?php $flag = false; foreach ($uploadList as $ul) { ?>
										<?php if($al->idx == $ul->post_idx && !$flag) { ?>
											<img style="max-width: 500px;" src="/<?= $ul->directory ?>" alt="">
										<?php $flag = true;} ?>
									<?php } ?>
								</div>
							</div>
							<?php } ?>
							<div class="article-footer d-flex justify-content-center align-items-center asdasd">
		                        <div>
		                            <button class="page-button prev"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;이전</button>
		                            <button class="page-button next">다음&nbsp;&nbsp;<i class="fas fa-chevron-right"></i></button>

		                            <script>
		                            	window.onload = () => {
		                            		let list = document.querySelectorAll(".article");
		                            		let render_list = [];

		                            		let isSearch = false;
		                            		let search_btn = document.querySelector("#content .sub-header-search button");
		                            		let search_input = document.querySelector("#content .sub-header-search input");
		                            		let search_option = document.querySelector("#content .sub-header-search select");

		                            		let prev = document.querySelector(".page-button.prev");
			                            	let next = document.querySelector(".page-button.next");
			                            	let page = 0;
			                            	let MIN = 0;
			                            	let MAX = list.length;

			                            	// INIT
		                            		for(let i = 0; i < list.length; i++) {
			                            		list[i].style.setProperty("display", "none", "important");
			                            	}
			                            	let cnt = 1;
		                            		for(let i = page; i < list.length; i++) {

			                            		list[i].style.setProperty("display", "flex", "important");
		                            			if(cnt == 10) break;
		                            			cnt++;
		                            		}


		                            		search_btn.addEventListener("click", (e) => {
		                            			isSearch = true;
		                            			let keyword = search_input.value;

		                            			if(search_option.value == "title") {
		                            				render_list = Array.from(list).filter(x => {
		                            					let title = x.querySelector("a").innerHTML;
		                            					return title.includes(keyword);
		                            				});

		                            				console.log(render_list);
		                            			} else {
		                            				render_list = Array.from(list).filter(x => {
		                            					let no = x.querySelector(".article-no").innerHTML;
		                            					return no.includes(keyword);
		                            				});
		                            			}

		                            			// render search List
		                            			for(let i = 0; i < list.length; i++) {
				                            		list[i].style.setProperty("display", "none", "important");
				                            	}
		                            			let cnt = 1;
			                            		for(let i = page; i < render_list.length; i++) {

				                            		render_list[i].style.setProperty("display", "flex", "important");
			                            			if(cnt == 10) break;
			                            			cnt++;
			                            		}

												page = 0;
		                            			MAX = render_list.length;
		                            		});

			                            	prev.addEventListener("click", (e) => {
			                            		if(MIN < page) {
			                            			page -= 10;

				                            		for(let i = 0; i < list.length; i++) {
					                            		list[i].style.setProperty("display", "none", "important");
					                            	}

				                            		let cnt = 1;
				                            		for(let i = page; i < list.length; i++) {

				                            			list[i].style.display = "flex";

				                            			if(cnt == 10) break;
				                            			cnt++;
				                            		}
			                            		}

			                            	});

			                            	next.addEventListener("click", (e) => {
			                            		if(isSearch) {
			                            			if(MAX > page && page + 10 < MAX) page += 10;

				                            		for(let i = 0; i < render_list.length; i++) {
					                            		render_list[i].style.setProperty("display", "none", "important");
					                            	}

				                            		let cnt = 1;
				                            		for(let i = page; i < render_list.length; i++) {

				                            			render_list[i].style.display = "flex";

				                            			if(cnt == 10) break;
				                            			cnt++;
				                            		}
			                            		} else {
			                            			if(MAX > page && page + 10 < MAX) page += 10;

				                            		for(let i = 0; i < list.length; i++) {
					                            		list[i].style.setProperty("display", "none", "important");
					                            	}

				                            		let cnt = 1;
				                            		for(let i = page; i < list.length; i++) {

				                            			list[i].style.display = "flex";

				                            			if(cnt == 10) break;
				                            			cnt++;
				                            		}
			                            		}
			                            	});
		                            	};
		                            </script>
		                        </div>
		                    </div>
						</div>
					</div>
					<!-- Content Section End -->
				</div>
			</div>
			<!-- Blog Section End -->
		</div>
		<!-- Content Section End -->

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
	</div>

	

</body>
</html>