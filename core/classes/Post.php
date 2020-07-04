<?php

class Post extends User
{
    public function __construct($pdo)
    {
        parent::__construct($pdo);
    }

    public function posts($user_id, $profile_id, $number)
    {
        $userData = $this->userData($user_id);
        $stmt = $this->pdo->prepare('SELECT * FROM users LEFT JOIN profile ON users.user_id = profile.user_id
        LEFT JOIN post ON post.user_id = users.user_id WHERE post.user_id = :user_id ORDER BY post.postedOn DESC LIMIT :num');
        $stmt->bindParam(":user_id",$profile_id,PDO::PARAM_INT);
        $stmt->bindParam(":num",$number,PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($posts as $post){
//            $main_react = $this->main_react($user_id, $post->post_id);
//            $react_max_show = $this->react_max_show($post->post_id);
//            $main_react_count = $this-> main_react_count($post->post_id);
//
//            $commentDetails = $this->commentFetch($post->post_id);
//            $totalCommentCount = $this->totalCommentCount($post->post_id);
//            $totalShareCount = $this->totalShareCount($post->post_id);
//            if(empty($post->shareId)){}else{
//                $shareDetails = $this->shareFetch($post->shareId, $post->postBy);
//            }
            ?>
            <div class="profile-timeline">
                <div class="news-feed-comp">
                    <div class="news-feed-text">
                        <div class="nf-1">
                            <div class="nf-1-left">
                                <div class="nf-pro-pic">
                                    <a href="<?= BASE_URL . $post->userLink; ?>"></a>
                                    <img src='<?= BASE_URL . $post->profilePic;?>' class = "pro-pic" alt=''>
                                </div>
                                <div class="nf-pro-name-time">
                                    <div class="nf-pro-name">
                                        <a href="<?=BASE_URL.$post->userLink; ?>" class = "nf-pro-name">
                                            <?= $post->firstName .' ' . $post->lastName?>
                                        </a>
                                    </div>
                                    <div class="nf-pro-time-privacy">
                                        <div class="nf-pro-time">
                                            <?= $this->timeAgo($post->postedOn); ?>
                                        </div>
                                        <div class="nf-pro-privacy"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="nf-1-right">
                                <div class="nf-1-right-dott">
                                    <div class="post-option" data-postid = "<?= $post->post_id; ?>" data-userid ="<?= $user_id;?>" >...</div>
                                    <div class="post-option-details-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="nf-2">
                            <div class="nf-2-text" data-postid = "<?= $post->post_id?>" data-userid ="<?= $user_id;?>" data-profilePic = "<?= $post->profilePic?>">
                                <?= $post->post; ?>
                            </div>
                            <div class="nf-2-img"  data-postid = "<?= $post->post_id?>" data-userid ="<?= $user_id;?>" data-profilePic = "<?= $post->profilePic?>">
                                <?php
                                $imgJson = json_decode($post->postImage);
                                $count = 0;
                                if($imgJson !== null){
                                    for($i=0;$i<count($imgJson);$i++){
                                        echo '<div class = "post-img-box" data-postimgid="'.$post->id.'" style = "max-height:400px;overflow:hidden;">
                                    <img src = "'.BASE_URL.$imgJson[$count++]->imageName.'" class = "postImage" style = "width:100%;cursor:pointer;object-fit: cover" data-userid="'.$user_id.'" data-postid = "'.$post->post_id.'" data-profileid = "'.$profile_id .'"></div>';

                                    }
                                }
                                ?>
                            </div>
                        </div>
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
                            <div class="share-action ra" data-postid = "<?= $post->post_id?>" data-userid ="<?= $user_id;?>" data-profilePic = "<?= $post->profilePic?>">
                                <div class="share-action-icon">
                                    <img src="assets/image/shareAction.JPG" alt="">
                                </div>
                                <div class="share-action-text">Share</div>
                            </div>
                        </div>
                        <div class="nf-5"></div>
                    </div>
                    <div class="news-feed-photo"></div>
                </div>
            </div>
<?php
        }
    }
    public function postUpd($user_id,$post_id,$editedText){
        $stmt = $this->pdo->prepare('UPDATE post SET post = :editText WHERE post_id = :post_id AND user_id = :user_id');
        echo var_dump($user_id,$post_id,$editedText);

        $stmt->bindParam(':post_id',$post_id,PDO::PARAM_INT);
        $stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
        $stmt->bindParam(':editText',$editedText);
        $stmt->execute();
    }
}
