document.body.onload = function () {
    const el = document.querySelector('.add-cover-photo');
    const toggleEl = document.querySelector('.add-cov-opt');
    const fileChooseBlock = document.querySelector('#cover-upload');
    const imgCover = document.querySelector('.profile-cover-wrap');
    const picUploadBlock = document.querySelector('.profile-pic-upload');
    const alertBlock = document.querySelector('.top-box-show');
    const avaFileChoose = document.querySelector('#profile-upload');
    const ava = document.querySelector('.profile-pic-me');
    const chooseFile = document.querySelector('#chooseFile');
    const multipleFiles = document.querySelector('#multiple_files');
    const sortable = document.querySelector('#sortable');
    const statusShareButton = document.querySelector('.status-share-button');
    const status = document.querySelector('.emojionearea-editor');
    const shareButtonWrap = document.querySelector('.status-share-button-wrap');
    const postImages = document.querySelectorAll('.postImage');
    const topBox = document.querySelector('.show-img-bg');
    const postOptions = document.querySelectorAll('.post-option');
    const postOptionDetailsContainer = document.querySelectorAll('.post-option-details-container');
    const postEdits = document.querySelectorAll('.post-edit');

    status.addEventListener('focus', function () {
        if (!shareButtonWrap.classList.contains('show')) shareButtonWrap.classList.add('show');
    });


    chooseFile.addEventListener('click', function () {
        if (!shareButtonWrap.classList.contains('show')) shareButtonWrap.classList.add('show');
    });

    multipleFiles.addEventListener('change', function (e) {
        let count = 0;
        let files = Array.from(e.target.files);
        files.forEach((file) => {
            let name = file.name;
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                let template = `<li class = "ui-state-default del" style = "position:relative"><img id = "${name}" alt="" style = "width: 60px;height: 60px;" src = ${reader.result}> </li>`;
                sortable.innerHTML += template;
            }
        });
        let block = document.createElement('div');
        block.className = 'remImg';
        block.style.cssText = 'position:absolute;top:0;right:0;cursor:pointer;display:flex;justify-content:center;align-items:center;background-color:white;border-radius:50%;height:1rem;width:1rem;font-size:.694rem;';
        block.innerText = 'X';
        sortable.append(block);
    });

    statusShareButton.addEventListener('click', async function () {
        let statusText = status.innerHTML;
        let formData = new FormData();
        let storageImage = [];
        let error_image = [];
        let files = multipleFiles.files;
        let names = [];
        if (files.length !== 0) {
            if (files.length > 10) {
                error_image += 'You can not select more than 10 images';
            } else {
                let formData = new FormData();
                for (let i = 0; i < files.length; i++) {
                    formData.append('files[]', files[i]);
                    names.push(files[i].name);
                }
                let request1 = await fetch('http://face/core/ajax/uploadPostImage.php', {
                    method: 'POST',
                    body: formData
                });
            }
        }
        if (statusText !== '' || files.length !== 0) {
            let request2 = await fetch('http://face/core/ajax/postSubmit.php', {
                method: 'POST',
                body: JSON.stringify({'text': statusText, names: names})
            });
            window.location.reload(true);
            // let result = await request2.json();
            status.innerHTML = '';
            sortable.innerHTML = '';
        }
    });


    el.addEventListener('click', () => {
        toggleEl.classList.toggle('show');
    });

    document.addEventListener('mousedown', function (e) {
        if (e.target.closest('.add-cov-opt')) return;
        if (e.target.closest('.add-cover-photo')) return;
        if (e.target.closest('.top-box-show')) return;
        if (e.target.closest('.post-img-wrap')) return;
        if(e.target.closest('.top-box')) return;
        if(e.target.closest('.post-option-details-container')) return;
        postOptionDetailsContainer.forEach(postOption=>{
            if(postOption.innerHTML !== '') postOption.innerHTML = '';
        });
        if (topBox.innerHTML !== '') topBox.innerHTML = '';
        if (toggleEl.classList.contains('show')) toggleEl.classList.remove('show');
        if (alertBlock.classList.contains('show')) alertBlock.classList.remove('show');
    });

    function checkVar(s) {
        if (s != '' && s != undefined && s != 0 && s != null) return true;
        return false;
    }

    fileChooseBlock.addEventListener('change', async function (e) {
        const target = e.target;
        if (target.files.length == 0) console.log('File is not chosen');
        else {
            let formData = new FormData();
            let fileData = fileChooseBlock.files[0];
            formData.append('file', fileData);
            let name = fileData.name;
            let size = fileData.size;
            let type = fileData.type;
            if (checkVar(name) && checkVar(size) && checkVar(type)) {
                let request1 = await fetch('http://face/core/ajax/profile.php', {
                    method: 'POST',
                    body: JSON.stringify({name, size, type}),
                    headers: {
                        'Content-Type': 'application/json'
                    },
                });
                let request2 = await fetch('http://face/core/ajax/profile.php', {
                    method: 'POST',
                    body: formData,
                });
                let result = await request2.text();
                imgCover.style.backgroundImage = `url(./${result})`;
                toggleEl.classList.toggle('show');
            }

        }
    });

    picUploadBlock.addEventListener('click', function () {
        alertBlock.classList.toggle('show');
    });

    avaFileChoose.addEventListener('change', async function (e) {
        const target = e.target;
        if (target.files.length === 0) console.log('file is not chosen');
        else {
            const file = target.files[0];
            let formData = new FormData();
            formData.append('file', file);
            try {
                let request = await fetch('http://face/core/ajax/profilePhoto.php', {
                    method: 'POST',
                    body: formData
                });
                let response = await request.text();
                ava.src = response;
                if (alertBlock.classList.contains('show')) alertBlock.classList.remove('show');
            } catch (e) {
                console.log('Error occured ' + e);
            }

        }
    });

    postImages.forEach(postImage => {
        postImage.addEventListener('click', async function () {
            let userid = postImage.dataset.userid;
            let profileid = postImage.dataset.profileid;
            let postid = postImage.dataset.postid;
            let imgSrc = postImage.src;
            let request = await fetch('http://face/core/ajax/imgFetchShow.php', {
                method: 'POST',
                body: JSON.stringify({
                    fetchImgInfo: userid,
                    postid: postid,
                    imageSrc: imgSrc
                })
            });
            let response = await request.text();
            topBox.innerHTML = response;
        });
    });
    postOptions.forEach(postOption => {
        postOption.addEventListener('click', function () {
            let postid = postOption.dataset.postid;
            let userid = postOption.dataset.userid;
            let postOptionDetailsContainer = postOption.nextElementSibling;
            postOptionDetailsContainer.innerHTML = `
                <div class = "post-option-details">
                    <ul style = "list-style: none;">
                        <li class = "post-edit" data-postid = "${postid}" data-userid = "${userid}"  onclick="postEdit(this)">
                            Edit
                        </li>
                        <li class = "post-delete" data-postid = "${postid}" data-userid = "${userid}">
                           Delete
                        </li>
                        <li class = "post-privacy" data-postid = "${postid}" data-userid = "${userid}">
                            Privacy
                        </li>
                    </ul>
                </div>
            `;
        });
    });
};
$("#statusEmoji").emojioneArea({
    position: 'right',
    spellcheck: true
});
function postEdit(e){
    let statusTextContainer = e.closest('.nf-1').nextElementSibling.querySelector('.nf-2-text');
    let getPostText1 = statusTextContainer.innerHTML;
    let postid = e.dataset.postid;
    let userid = e.dataset.userid;
    let getPostImg = e.closest('.nf-1').nextElementSibling.querySelector('.nf-2-img');
    let thiss = e.closest('.nf-1').nextElementSibling.querySelector('.nf-2-img');
    let profilepic = e.dataset.profilepPic;
    let getPostText = getPostText1.replace(/\s+/g, " ").trim();
    let tb = document.querySelector('.show-img-bg');
    tb.insertAdjacentHTML('afterBegin', `
        <div class="top-box profile-dialog-show" style = "top:12.5%;left:22.5%;width: 55%;">
    <div class="edit-post-header align-middle" style = "justify-content: space-between;padding: 10px;height: 20px;background-color: lightgray;font-size: 14px;font-weight: 600;">
        <div class="edit-post-text">Edit Post</div>
        <div class="edit-post-close" style = "padding: 5px;color:gray;cursor: pointer">x</div>
    </div>
    <div class="edit-post-value" style = "border-bottom:1px solid lightgray">
        <div class="status-med">
            <div class="status-prof">
                <div class="top-pic"><img src="${profilepic}" alt=""></div>
            </div>
            <div class="status-prof-textarea">
                <textarea data-autoresize rows = "5" columns = "5" placeholder=""  name="textStatus" class = "editStatus align-middle" style ="font-family: sans-serif;font-weight: 400;padding: 5px;">${getPostText}
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
        <div class="edit-post-save" style = "padding: 3px 15px;background-color: #4267bc;color:#fff;font-size: 14px;margin-left: 5px;cursor: pointer;" data-postid = "${postid}"
            data-userid = "${userid}" data-tag="${thiss}" onclick = "editPostSave(this)"
        >Save</div>
    </div>
</div>
    `);
}
async function editPostSave(obj){
    let postid = obj.dataset.postid;
    let userid = obj.dataset.userid;
    let editedText = document.querySelector('.editStatus').value;
    let request = await fetch('http://face/core/ajax/editPost.php',{
        method:'Post',
        body:JSON.stringify({
            postid,
            userid,
            editedText
        })
    });
    window.location.reload(true);

}

