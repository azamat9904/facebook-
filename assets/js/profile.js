document.body.onload = function(){
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
    const sortable =  document.querySelector('#sortable');
    const statusShareButton = document.querySelector('.status-share-button');
    const status = document.querySelector('.emojionearea-editor');
    const shareButtonWrap = document.querySelector('.status-share-button-wrap');


    status.addEventListener('focus', function () {
        if (!shareButtonWrap.classList.contains('show')) shareButtonWrap.classList.add('show');
    });


    chooseFile.addEventListener('click',function(){
        if (!shareButtonWrap.classList.contains('show')) shareButtonWrap.classList.add('show');
    });

    multipleFiles.addEventListener('change',function(e){
        let count = 0;
        let files = Array.from(e.target.files);
        files.forEach((file)=>{
            let name = file.name;
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(){
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

    statusShareButton.addEventListener('click',async function(){
        let statusText = status.innerHTML;
        let formData = new FormData();
        let storageImage = [];
        let error_image = [];
        let files = multipleFiles.files;
        let names = [];
        if(files.length !== 0){
            if(files.length > 10) {
                error_image += 'You can not select more than 10 images';
            }else{
                let formData = new FormData();
                for(let i = 0;i<files.length;i++){
                    formData.append('files[]',files[i]);
                    names.push(files[i].name);
                }
                let request1 = await fetch('http://face/core/ajax/uploadPostImage.php',{
                    method:'POST',
                    body:formData
                });
            }
        }
        if(statusText !== ''|| files.length !==0 ){
            let request2 = await fetch('http://face/core/ajax/postSubmit.php',{
                method:'POST',
                body:JSON.stringify({'text':statusText,names:names})
            });
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
};
$("#statusEmoji").emojioneArea({
    position: 'right',
    spellcheck: true
});


