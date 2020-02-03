    <!-- Visual Section Start -->
    <div id="visual" class="d-flex align-items-center">
        <img src="/images/image4.jpg" alt="" id="visual-image">
        <div class="container">
            <div id="visual-title">DEVELOPER'S BLOG</div>
        </div>
    </div>
    <!-- Visual Section End -->

    <!-- Blog Section Start -->
    <div id="blog" class="blog-content">
        <div class="container d-flex justify-content-between">
            <!-- Side Menu Section Start -->
            <div id="side-menu" class="admin">
                <ul class="menu-group">
                    <a href="/user_modify">
                        <button class="user">비밀번호 재설정</button>
                    </a>
                </ul>
                <ul class="menu-group create-category"> 
                    <form action="/create_category" method="POST">
                        <input type="text" placeholder="카테고리 생성" name="name">
                        <button type="submit"><i class="fas fa-plus"></i></button>
                    </form>
                </ul>
                <ul class="menu-group"> 
                    <?php foreach ($categoryList as $cl) { ?>
                    <li class="menu">
                        <form action="/modify_category" method="POST">
                            <input type="hidden" name="idx" value="<?= $cl->idx ?>">
                            <input type="text" class="menu" name="name" value="<?= text($cl->name) ?>">
                            <button type="submit" class="menu-status-btn modify"><i class="fas fa-check"></i></button>
                            <a href="/delete_category/<?= $cl->idx ?>" class="menu-status-btn delete"><i class="fas fa-times"></i></a>
                        </form>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- Side Menu Section End -->

            <!-- Content Section Start -->
            <div id="content" class="admin">
                <div class="panel user-view">
                    <?php $fuck = 90 / $max ?>
                    <?php foreach ($visitorList as $vl) { ?>
                        <div class="item d-flex flex-column align-items-center justify-content-end">
                            <div class="bar" style="height: <?= $fuck * $vl->cnt ?>%"></div>
                            <div class="date"><?= $vl->visit_date ?> (<?= $vl->cnt ?> 회)</div>
                        </div>
                    <?php } ?>
                </div>

                <div class="panel post-view">
                    <?php $fuck = 80 / $pMax ?>
                    <?php foreach ($postviewList as $pl) { ?>
                        <div class="item d-flex flex-column align-items-center justify-content-end">
                            <div class="bar" style="height: <?= $fuck * $pl->cnt ?>%"></div>
                            <div class="date"><?= $pl->title ?> (<?= $pl->cnt ?> 회)</div>
                        </div>
                    <?php } ?>
                </div>
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