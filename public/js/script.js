window.addEventListener('scroll', (event)=>{
   let nav = document.getElementsByClassName('scroll')[0];
   nav.classList.add('scroll');
});

window.addEventListener('load', (event)=>{
    tinymce.init({
        selector: "textarea",
        resize: false,
        width: "100%",
        height : 500
    });
});
