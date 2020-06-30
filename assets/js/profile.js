const el = document.querySelector('.add-cover-photo');
const toggleEl = document.querySelector('.add-cov-opt');
const fileChooseBlock = document.querySelector('#cover-upload');
const imgCover = document.querySelector('.profile-cover-wrap');
const picUploadBlock = document.querySelector('.profile-pic-upload');
const alertBlock = document.querySelector('.top-box-show');
const avaFileChoose = document.querySelector('#profile-upload');
const ava = document.querySelector('.profile-pic-me');
el.addEventListener('click', () => {
    toggleEl.classList.toggle('show');
});

document.addEventListener('mousedown', function (e) {
    if (e.target.closest('.add-cov-opt')) return;
    if (e.target.closest('.add-cover-photo')) return;
    if(e.target.closest('.top-box-show')) return;
    if (toggleEl.classList.contains('show')) toggleEl.classList.remove('show');
    if(alertBlock.classList.contains('show')) alertBlock.classList.remove('show');
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
picUploadBlock.addEventListener('click',function(){
    alertBlock.classList.toggle('show');
});
avaFileChoose.addEventListener('change',async function(e){
    const target = e.target;
    if(target.files.length === 0) console.log('file is not chosen');
    else{
        const file = target.files[0];
        let formData = new FormData();
        formData.append('file',file);
        try{
            let request = await fetch('http://face/core/ajax/profilePhoto.php',{
                method:'POST',
                body:formData
            });
            let response = await request.text();
            ava.src = response;
            if(alertBlock.classList.contains('show')) alertBlock.classList.remove('show');
        }catch(e){
            console.log('Error occured ' + e);
        }

    }
});


