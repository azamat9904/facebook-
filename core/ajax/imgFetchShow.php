<?php

include $_SERVER['DOCUMENT_ROOT'] . '/core/load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/connect/Login.php';
$_POST = json_decode(file_get_contents('php://input'), true);
$userid = Login::isLogginedIn();
if (isset($_POST['fetchImgInfo'])) {
    $userid = $_POST['fetchImgInfo'];
    $postid = $_POST['postid'];
    $imgSrc = $_POST['imageSrc'];
}
//$main_react = $loadFromPost->main_react($userid, $postid);
//$react_max_show = $loadFromPost->react_max_show($postid);
//$main_react_count = $loadFromPost->main_react_count($postid);
//
//$commentDetails = $loadFromPost->commentFetch($postid);
//$totalCommentCount = $loadFromPost->totalCommentCount($postid);
//$totalShareCount = $loadFromPost->totalShareCount($postid);
?>
    <div class="top-wrap" style = "position:fixed;top:0;bottom:0px;right:0;justify-content: center;left:0;display:flex;background-color: #000000c4;z-index:1000;justify-content: center;align-items: center">
        <div class="post-img-wrap" style = "display: flex;background-color: #fff;width: 85%;justify-content: center;align-items: center;height:90vh">
            <div class="post-img-action" style = "background-color:#000; height:100%;align-items: center;display: flex;">
                <img src="<?= $imgSrc ?>" alt="" style = "width:850px">
            </div>
            <div class="post-img-details" style = "width: 100%;padding: 20px;align-self: flex-start;">
            <div class="nf-3"></div>
            <div class="nf-4">
                <div class="like-action-wrap">
                    <div class="like-action ra">
                        <div class="like-action-icon">
                            <img src="assets/image/likeAction.JPG" alt="">
                        </div>
                        <div class="like-action-text">
                            <span>Like</span>
                        </div>
                    </div>
                </div>
                <div class="comment-action ra">
                    <div class="comment-action-icon">
                        <img src="assets/image/commentAction.JPG" alt="">
                    </div>
                    <div class="comment-action-text">
                        <div class="comment-count-text-wrap">
                            <div class="comment-wrap"></div>
                            <div class="comment-text">Comment</div>
                        </div>
                    </div>
                </div>
                <div class="share-action ra" data-postid="<?= $postid ?>" data-userid="<?= $userid; ?>"">
                    <div class="share-action-icon">
                        <img src="assets/image/shareAction.JPG" alt="">
                    </div>
                    <div class="share-action-text">Share</div>
                </div>
            </div>
            <div class="nf-5"></div>
            </div>
        </div>
    </div>
