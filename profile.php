<?php
include 'connect/Login.php';
include 'core/load.php';
if (Login::isLogginedIn()) $userId = Login::isLogginedIn();
else header('Location:sign.php');

if (isset($_GET['username']) && !empty($_GET['username'])) {
    $username = $loadFromUser->checkInput($_GET['username']);
    $profileId = $loadFromUser->userIdByUserName($username);
    $profileData = $loadFromUser->userData($profileId);
    $userData = $loadFromUser->userData($userId);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/dist/emojionearea.min.css">
    <title>Azamat Namiyaly</title>
</head>
<body>
<header>
    <div class="top-bar">
        <div class="top-left-part">
            <div class="profile-logo"><img src="assets/image/logo.jpg" alt=""></div>
            <div class="search-wrap">
                <input type="text" name="main-search" id="main-search">
                <div class="s-icon top-icon top-css">
                    <img src="assets/image/icons8-search-36.png" alt="">
                </div>
            </div>
            <div id="search-show">
                <div class="search-result">

                </div>
            </div>
        </div>
        <div class="top-right-part">
            <div class="top-pick-name-wrap">
                <a href="profile.php?username=<?php echo $userData->userLink; ?>" class="top-pic-name">
                    <div class="top-pic"><img src="<?php echo $userData->profilePic; ?>" alt=""></div>
                    <span class="top-name top-css">
                           <?= $userData->firstName; ?>
                        </span>
                </a>
            </div>
            <a href="index.php">
                <span class="top-home top-css border-left" style="height: 20px">Home</span>
            </a>

            <div class="top-request top-css top-icon border-left">
                <div class="request-count"></div>
                <svg xmlns="http://www.w3.org/2000/svg" class="request-svg" viewBox="0 0 15.8 13.63"
                     style="height:20px;width:20px;">
                    <defs>
                        <style>.cls-1 {
                                fill: #1a2947;
                            }</style>
                    </defs>
                    <title>request</title>
                    <g id="Layer_2" data-name="Layer 2">
                        <g id="Layer_1-2" data-name="Layer 1">
                            <path class="cls-1"
                                  d="M13.2,7.77a7.64,7.64,0,0,0-1.94-.45,7.64,7.64,0,0,0-1.93.45,3.78,3.78,0,0,0-2.6,3.55.7.7,0,0,0,.45.71,12.65,12.65,0,0,0,4.08.59A12.7,12.7,0,0,0,15.35,12a.71.71,0,0,0,.45-.71A3.79,3.79,0,0,0,13.2,7.77Z"/>
                            <ellipse class="cls-1" cx="11.34" cy="4.03" rx="2.48" ry="2.9"/>
                            <path class="cls-1"
                                  d="M7.68,7.88a9,9,0,0,0-2.3-.54,8.81,8.81,0,0,0-2.29.54A4.5,4.5,0,0,0,0,12.09a.87.87,0,0,0,.53.85,15.28,15.28,0,0,0,4.85.68,15.25,15.25,0,0,0,4.85-.68.87.87,0,0,0,.53-.85A4.49,4.49,0,0,0,7.68,7.88Z"/>
                            <ellipse class="cls-1" cx="5.47" cy="3.44" rx="2.94" ry="3.44"/>
                        </g>
                    </g>
                </svg>
            </div>

            <a href="messenger.php">
                <div class="top-messanger top-css top-icon border-left">
                    <div class="messenger-count"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="message-svg" viewBox="0 0 12.64 13.64"
                         style="height:20px;width:20px;">
                        <defs>
                            <style>.cls-1 {
                                    fill: #1a2947;
                                }</style>
                        </defs>
                        <title>message</title>
                        <g id="Layer_2" data-name="Layer 2">
                            <g id="Layer_1-2" data-name="Layer 1">
                                <path class="cls-1"
                                      d="M6.32,0A6.32,6.32,0,0,0,1.94,10.87c.34.33-.32,2.51.09,2.75s1.79-1.48,2.21-1.33a6.22,6.22,0,0,0,2.08.35A6.32,6.32,0,0,0,6.32,0Zm.21,8.08L5.72,6.74l-2.43,1,2.4-3,.84,1.53,2.82-.71Z"/>
                            </g>
                        </g>
                    </svg>
                </div>
            </a>
            <div class="top-notification top-css top-icon border-left">
                <svg xmlns="http://www.w3.org/2000/svg" class="notification-svg" viewBox="0 0 12.06 13.92"
                     style="height:20px;width:20px;">
                    <defs>
                        <style>.cls-1 {
                                fill: #1a2947;
                            }

                            .cls-2 {
                                fill: none;
                                stroke: #1a2947;
                                stroke-miterlimit: 10;
                            }</style>
                    </defs>
                    <title>notification</title>
                    <g id="Layer_2" data-name="Layer 2">
                        <g id="Layer_1-2" data-name="Layer 1">
                            <path class="cls-1"
                                  d="M11.32,9A10.07,10.07,0,0,0,7.65,2.1,2.42,2.42,0,0,0,4.8,2,9.66,9.66,0,0,0,.74,9a2,2,0,0,0-.25,2.81H11.57A2,2,0,0,0,11.32,9Z"/>
                            <path class="cls-1" d="M8.07,12.32a1.86,1.86,0,0,1-2,1.6,1.86,1.86,0,0,1-2-1.6"/>
                            <ellipse class="cls-2" cx="6.17" cy="1.82" rx="1.21" ry="1.32"/>
                        </g>
                    </g>
                </svg>
                <div class="notification-list-wrap">
                    <ul>

                    </ul>
                </div>
            </div>
            <div class="top-help top-css top-icon border-left">
                <svg xmlns="http://www.w3.org/2000/svg" class="help-svg" viewBox="0 0 13.69 13.69"
                     style="height:20px;width:20px;">
                    <defs>
                        <style>.cls-1 {
                                fill: #1a2947;
                            }</style>
                    </defs>
                    <title>help</title>
                    <g id="Layer_2" data-name="Layer 2">
                        <g id="Layer_1-2" data-name="Layer 1">
                            <path class="cls-1"
                                  d="M6.85,0a6.85,6.85,0,1,0,6.84,6.85A6.85,6.85,0,0,0,6.85,0ZM7.4,10.44a.77.77,0,0,1-.19.28.75.75,0,0,1-.28.18,1,1,0,0,1-.35.07,1,1,0,0,1-.35-.07.79.79,0,0,1-.29-.18.92.92,0,0,1-.19-.28,1,1,0,0,1-.06-.34,1,1,0,0,1,.06-.35,1.07,1.07,0,0,1,.19-.28,1,1,0,0,1,.64-.25.84.84,0,0,1,.35.07.75.75,0,0,1,.28.18.87.87,0,0,1,.19.28.81.81,0,0,1,.07.35A.8.8,0,0,1,7.4,10.44Zm1.48-5a1.93,1.93,0,0,1-.3.53,2.4,2.4,0,0,1-.39.39l-.41.31c-.12.09-.23.19-.33.28a.6.6,0,0,0-.17.31l-.14.78h-1L6,7.19a.76.76,0,0,1,.07-.46,1.35,1.35,0,0,1,.28-.36c.12-.1.25-.21.39-.31l.41-.32a1.9,1.9,0,0,0,.31-.39,1,1,0,0,0,.13-.51.72.72,0,0,0-.25-.58,1,1,0,0,0-.66-.21,1.75,1.75,0,0,0-.5.06l-.36.15-.25.14a.32.32,0,0,1-.2.07.34.34,0,0,1-.31-.18l-.4-.63a3.65,3.65,0,0,1,.43-.31,2.54,2.54,0,0,1,.49-.26,3.43,3.43,0,0,1,.57-.17,2.87,2.87,0,0,1,.67-.07A2.72,2.72,0,0,1,7.71,3a2.09,2.09,0,0,1,.69.38,1.86,1.86,0,0,1,.44.6A2,2,0,0,1,9,4.75,2.18,2.18,0,0,1,8.88,5.47Z"/>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="top-more top-css top-icon border-left">
                <div class="warchmore-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="more-svg" viewBox="0 0 14.54 6.57"
                         style="height:20px;width:20px;">
                        <defs>
                            <style>.cls-1 {
                                    fill: #1a2947;
                                }</style>
                        </defs>
                        <title>more</title>
                        <g id="Layer_2" data-name="Layer 2">
                            <g id="Layer_1-2" data-name="Layer 1">
                                <polygon class="cls-1" points="0 0 14.54 0 7.27 6.57 0 0"/>
                            </g>
                        </g>
                    </svg>
                    <div class="setting-logout-wrap">

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="main-area">
        <div class="profile-left-wrap">
            <div class="profile-cover-wrap" style="background-image:url('<?php
            if (explode('/', $profileData->coverPic)[0] == 'users') {
                echo './' . $profileData->coverPic;
            } else {
                echo './assets/image/defaultCover.png';
            }
            ?>');background-size:cover;">
                <div class="upload-cov-opt-wrap">

                    <?php if ($userId == $profileId) { ?>
                        <div class="add-cover-photo">
                            <img src="assets/image/profile/uploadCoverPhoto.JPG" alt="">
                            <div class="add-cover-text">Add a cover photo</div>
                        </div>
                    <?php } else { ?>
                        <div class="dont-add-cover-photo"></div>
                    <?php } ?>
                    <div class="add-cov-opt">
                        <div class="select-cover-photo">Select photo</div>
                        <div class="file-upload">
                            <label for="cover-upload" class="file-upload-label">Upload Photo</label>
                            <input type="file" name="file-upload" id="cover-upload" class="file-upload-input">
                        </div>
                    </div>
                </div>
                <div class="cover-photo-rest-wrap">
                    <div class="profile-pic-name">
                        <div class="profile-pic">
                            <?php if ($profileId === $userId) { ?>
                                <div class="profile-pic-upload">
                                    <div class="add-pro">
                                        <img src="assets/image/profile/uploadCoverPhoto.JPG" alt="">
                                        <div>Update</div>
                                    </div>
                                </div>
                            <?php } ?>
                            <img src="<?= $profileData->profilePic; ?>" alt="" class="profile-pic-me">
                        </div>
                        <div class="profile-name">
                            <?php echo $profileData->first_name . ' ' . $profileData->last_name ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cover-bottom-part">
                <div class="timelie-button align-middle cover-but-css" data-userid="<?= $userId ?>"
                     data-profileid="<?= $profileId ?>">
                    Timeline
                </div>
                <div class="about-button align-middle cover-but-css" data-userid="<?= $userId ?>"
                     data-profileid="<?= $profileId ?>">
                    About
                </div>
                <div class="friends-button align-middle cover-but-css" data-userid="<?= $userId ?>"
                     data-profileid="<?= $profileId ?>">
                    Friends
                </div>
                <div class="photos-button align-middle cover-but-css" data-userid="<?= $userId ?>"
                     data-profileid="<?= $profileId ?>">
                    Photo
                </div>
            </div>
            <div class="bio-timeline">
                <div class="bio-wrap">
                    <div class="bio-intro">
                        <div class="intro-wrap">
                            <img src="assets/image/profile/intro.JPG" alt="">
                            <div>Intro</div>
                        </div>
                        <div class="intro-icon-text">
                            <img src="assets/image/profile/addBio.JPG" alt="">
                            <div class="add-bio-text">Add a short bio to tell people more yourself</div>
                            <div class="add-bio-click"><a href="">Add Bio</a></div>
                        </div>
                        <div class="bio-details">
                            <div class="bio-1">
                                <img src="assets/image/profile/livesIn.JPG" alt="">
                                <div class="live-text">Lives in <span class='live-text-css blue'>Chittagon</span></div>
                            </div>
                            <div class="bio-2">
                                <img src="assets/image/profile/followedBy.JPG" alt="">
                                <div class="iive-text">Followed by <span class="followed-text-css blue">65 people</span>
                                </div>
                            </div>
                        </div>
                        <div class="bio-feature">
                            <img src="assets/image/profile/feature.JPG" alt="">
                            <div class="feat-text">
                                Showcase what's important to you by adding people. pages,groups and more to your
                                featured section on your public profile.
                            </div>
                            <div class="add-feature blue">Add to featured</div>
                            <div class="add-feature-link blue">
                                <div class="link-plus">+</div>
                                <div>Add Instagram, Websites, Other Links</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="status-timeline-wrap">
                    <?php if ($profileId == $userId) { ?>
                        <div class="profile-status-write">
                            <div class="status-wrap">
                                <div class="status-top-wrap">
                                    <div class="status-top">
                                        Create Post
                                    </div>
                                </div>
                            </div>
                            <div class="status-med">
                                <div class="status-prof">
                                    <div class="top-pic"><img src="<?= $userData->profilePic; ?>" alt=""></div>
                                </div>
                                <div class="status-prof-textarea">
                                    <textarea name="textStatus" id="statusEmoji" cols="5" rows="5"
                                              class="status align-middle"
                                              placeholder="What's going on your mind ?"></textarea>
                                </div>
                            </div>
                            <div class="status-bot">
                                <div class="file-upload-remIm">
                                    <label for="multiple_files" class="file-upload-label">
                                        <div class="status-bot-1" id = "chooseFile">
                                            <img src="assets/image/photo.JPG" alt="">
                                            <div class="status-bot-text">Photo/Video</div>
                                        </div>
                                    </label>
                                    <input type="file" name="file-upload" id="multiple_files" class="file-upload-input"
                                           data-multiple-caption="{count} files selected" multiple="">
                                </div>
                                <div class="status-bot-1">
                                    <img src="assets/image/tag.JPG" alt="">
                                    <div class="status-bot-text">Tag Friends</div>
                                </div>
                                <div class="status-bot-1">
                                    <img src="assets/image/activities.JPG" alt="">
                                    <div class="status-bot-text">Feeling/Activities</div>
                                </div>
                                <div class="status-bot-1 dott">...</div>
                            </div>
                            <ul id="sortable"></ul>
                            <div class="status-share-button-wrap">
                                <div class="status-share-button">
                                    <div class="newsFeed-privacy">
                                        <div class="newFeed">
                                            <div class="right-sign-icon">
                                                <img src="assets/image/profile/rightSign.JPG" alt="">
                                            </div>
                                            <div class="newsfeed-icon align-middle">
                                                <img src="assets/image/profile/newsFeed.JPG" alt="">
                                            </div>
                                            <div class="newsfee-text">
                                                News Feed
                                            </div>
                                        </div>
                                        <div class="status-privacy-wrap">
                                            <div class="status-privacy">
                                                <div class="privacy-icon align-middle">
                                                    <img src="assets/image/profile/publicIcon.JPG" alt="">
                                                </div>
                                                <div class="privacy-text">Public</div>
                                                <div class="privacy-downarrow-icon align-middle">
                                                    <img src="assets/image/watchmore.png" alt="">
                                                </div>
                                            </div>
                                            <div class="status-privacy-option">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="seemore-sharebutton">
                                        <div class="share-seemore-option">
                                            <div class="privacy-downarr-icon align-middle">
                                                <img src="assets/image/watchmore.png" alt="" class="privacy-img">
                                                <span class="status-seemore">See more</span>
                                            </div>
                                        </div>
                                        <div class="status-share-button align-middle">
                                            <sapn>Share</sapn>
                                        </div>
                                    </div>
                            </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="ptaf-wrap">
                        <?php $loadFromPost->posts($userId,$profileId,20); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-right-wrap"></div>
    </div>
    <div class="top-box-show">
        <div class="top-box align-vertical-middle profile-dialog-show">
            <div class="profile-pic-upload-action">
                <div class="pro-pic-up">
                    <div class="file-upload">
                        <label for="profile-upload" class="file-upload-label">
                            <snap class="upload-plus-text align-middle">
                                <snap class="upload-plus-sign">+</snap>
                                Upload Photo
                            </snap>
                        </label>
                        <input type="file" name="file-upload" id="profile-upload" class="file-upload-input">
                    </div>
                </div>
                <div class="pro-pic-choose"></div>
            </div>
        </div>
    </div>
    <div class="show-img-bg"></div>
    <div id="adv_dem"></div>
</main>
<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
</script>

<script src="assets/dist/emojionearea.min.js"></script>
<script src="assets/js/profile.js"></script>
</body>
</html>