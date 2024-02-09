const btn = document.querySelector("#btn-menu");
const menu = document.querySelector("#vertical-menu");
//Dropdown

btn.addEventListener('click', e => {
    menu.classList.toggle("menu-collapsed");
    menu.classList.toggle("menu-expanded");
});


