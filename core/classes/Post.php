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
            ?>
            <div class="profile-timeline">
                <div class="news-feed-comp">
                    <div class="nf-1">
                        <div class="nf-1-left">
                            <div class="nf-pro-pic">
                                <a href="<?= BASE_URL . $post->userLink; ?>"></a>
                                <img src='<?= BASE_URL . $post->profilePic;?>' class = "pro-pic" alt=''>
                            </div>
                            <div class="nf-pro-name-time"></div>
                        </div>
                        <div class="nf-1-right"></div>
                    </div>
                    <div class="nf-2"></div>
                    <div class="nf-3"></div>
                    <div class="nf-4"></div>
                    <div class="nf-5"></div>
                </div>
            </div>
<?php
        }
    }

}
