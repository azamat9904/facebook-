<div class="top-box profile-dialog-show" style = "top:12.5%;left:22.5%;width: 55%;">
    <div class="edit-post-header align-middle" style = "justify-content: space-between;padding: 10px;height: 20px;background-color: lightgray;font-size: 14px;font-weight: 600;">
        <div class="edit-post-text">Edit Post</div>
        <div class="edit-post-close" style = "padding: 5px;color:gray;cursor: pointer">x</div>
    </div>
    <div class="edit-post-value" style = "border-bottom:1px solid lightgray">
        <div class="status-med">
            <div class="status-prof">
                <div class="top-pic"><img src="'+ profilepic + '" alt=""></div>
            </div>
            <div class="status-prof-textarea">
                <textarea data-autoresize rows = "5" columns = "5" placeholder=""  name="textStatus" class = "editStatus align-middle" style ="font-family: sans-serif;font-weight: 400;padding: 5px;">' + getPostText + '
                </textarea>
            </div>
        </div>
    </div>
    <div class="edit-post-submit" style = "position: absolute;right:0;bottom:0;display: flex;align-items: center;margin:10px;">
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
            <div class="status-privacy-option"></div>
        </div>
        <div class="edit-post-save" style = "padding: 3px 15px;background-color: #4267bc;color:#fff;font-size: 14px;margin-left: 5px;cursor: pointer;" data-postid = "'+postid+'"
            data-userid = "'+userid +'" data-tag="'+thiss+'"
        >Save</div>
    </div>
</div>