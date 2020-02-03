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
            <div id="content" class="post-view">
                <div class="article">
                    <div class="article-header d-flex flex-column justify-content-between">
                        <div class="article-title">
                            <?= text($post->title) ?>
                        </div>
                              
                        <?php 
                            $first  = new DateTime($post->write_date);
                            $second = new DateTime(date("Y-m-d H:i:s"));
                            $diff = $first->diff($second);
                        ?>
                        <div class="article-info d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="time"><?= $diff->h != 0 ? $diff->h . "시간 전" : $diff->i != 0 ? $diff->i . "분 전" : $diff->s . "초 전" ?></div>
                                <div class="particle"></div>
                                <div class="viewed">조회 <?= $post->viewed ?></div>
                                <div class="particle"></div>
                                <div class="liked">좋아요 <?= $post->liked ?></div>
                            </div>
                            <?php if(user() && user()->id == "admin") { ?>
                            <div class="d-flex align-items-center admin-u-d">
                                <a href="/modify/<?= $post->idx ?>"><div class="viewed">수정</div></a>
                                <div class="particle"></div>
                                <a href="/delete/<?= $post->idx ?>"><div class="liked">삭제</div></a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="article-content">
                        <?php foreach ($uploadList as $ul) { ?>
                            <img src="/<?= $ul->directory ?>" alt="" style="max-width: 500px;">
                        <?php } ?>
                        <?= $post->content ?>
                    </div>
                    <div class="down d-flex justify-content-start align-items-center flex-wrap" style="padding: 15px 30px; color: #c5c5c5;">
                        <?php foreach ($uploadList as $ul) { ?>
                            <?php if($ul->type == 0) { ?>
                                <a href="/<?= $ul->directory ?>" download><?= $ul->name ?></a>&nbsp;&nbsp;&nbsp;
                            <?php } ?>
                        <?php } ?>

                    </div>
                    <div class="article-footer d-flex justify-content-center align-items-center flex-column">
                        <div>
                            <?php if($like) { ?>
                            <a href="#" class="vote-button"><i class="fas fa-caret-up" style="color: #16ae81;"></i>&nbsp;&nbsp;<?= $post->liked ?></a>
                            <?php } else { ?>
                            <a href="/like/<?= $post->idx ?>" class="vote-button"><i class="fas fa-caret-up"></i>&nbsp;&nbsp;<?= $post->liked ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="comment-list">
                    <div class="comment-list-title">
                        댓글&nbsp;&nbsp;<span>총 <strong><?= $comment_cnt ?></strong>개</span>
                    </div>
                    <?php if(user()) { ?>
                    <div class="d-flex justify-content-center align-items-center comment-out-form">
                        <form method="POST" action="/comment/<?= $post->idx ?>" class="comment-form d-flex flex-column justify-content-between">
                            <span><?= user()->id ?></span>
                            <input type="hidden" name="user" value="<?= user()->id ?>">
                            <input type="text" name="comment" placeholder="타인의 명예를 훼손하는 게시물은 별도의 통보 없이 제재를 받을 수 있습니다.">
                            <div class="d-flex justify-content-end">
                                <button type="submit">댓글</button>
                            </div>
                        </form>
                    </div>
                    <?php } ?>
                    <?php foreach ($commentList as $col) { ?>
                    <div class="comment">
                        <form action="/comment_modify/<?= $col->idx ?>" method="POST">                        
                            <?php 
                                $first  = new DateTime($col->write_date);
                                $second = new DateTime(date("Y-m-d H:i:s"));
                                $diff = $first->diff($second);
                            ?>
                            <div class="comment-info d-flex align-items-center">
                                <div class="writer"><?= $col->user ?></div>
                                <div class="particle"></div>
                                <div class="time"><?= $diff->h != 0 ? $diff->h . "시간 전" : $diff->i != 0 ? $diff->i . "분 전" : $diff->s . "초 전" ?></div>
                                <?php if(user() && user()->id == $col->user) { ?>
                                <div class="particle"></div>
                                <button style="background: none; border: none; font-size: 14px; color: #7b858e;" class="modify">수정</button>
                                <div class="particle"></div>
                                <a href="/comment_delete/<?= $col->idx ?>" style="font-size: 14px; color: #7b858e;" class="modify">삭제</a>
                                <?php } ?>
                            </div>
                            <div class="comment-content">
                                <input type="text" name="comment" value="<?= text($col->comment) ?>" style="width: 100%; background: none; border: none; outline: none;" required <?= user() && user()->id == $col->user ? '' : 'readonly' ?>>
                            </div>
                        </form>
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