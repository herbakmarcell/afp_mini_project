const hMenu = document.getElementsByClassName('hmenu')[0];
const linkek = document.getElementsByClassName('linkek')[0];

hMenu.addEventListener('click', () =>{
    linkek.classList.toggle('active');
})