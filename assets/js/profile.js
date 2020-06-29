
const el = document.querySelector('.add-cover-photo');
const toggleEl = document.querySelector('.add-cov-opt');
const fileChooseBlock = document.querySelector('#cover-upload');
el.addEventListener('click',()=>{
    toggleEl.classList.toggle('show');
});

document.addEventListener('mousedown',function(e){
    if(e.target.closest('.add-cov-opt')) return;
    if(e.target.closest('.add-cover-photo')) return ;
    if(toggleEl.classList.contains('show')) toggleEl.classList.remove('show');
});

fileChooseBlock.addEventListener('change',function(e){
    const target = e.target;
    if(target.files.length == 0) console.log('File is not chosen');
    else {
        // let fileData = target.files[0];
        // let fileName = fileData.name;
        // let fileSize = fileData.size;
        // let fileType = fileData.type.split('/').pop();
        // let formData = new FormData();
        // let myData = {fileName,fileSize,fileType};
        // console.log(myData);
        // // console.log(myData);
        // formData.append('file',JSON.stringify(myData));
        // console.log(formData);

        async function check(){
            let user = {
                name: 'John',
                surname: 'Smith'
            };
            let response = await fetch('http://face/core/ajax/profile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(user)
            });
        }
        check();
    }
});

