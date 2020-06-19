const navLinks = document.querySelectorAll('.nav-link');
const tabs = document.querySelectorAll('.tab');

navLinks.forEach((link, ind)=> {
    link.addEventListener('click', () => {
        openTab(tabs[ind]);
    })
})

function openTab(tab) {
    tab.classList.remove('hidden');
    tabs.forEach((t) => { if(t != tab) {t.classList.add('hidden') } })
    certyImages.forEach((i) => { i.classList.add('hidden') })
}


const certyImages = document.querySelectorAll('.img-display');
const certyIcons = document.querySelectorAll('.img-icon');

certyIcons.forEach((img, ind)=> {
    img.addEventListener('click', () => {
        openImg(certyImages[ind]);
    })
})

certyImages.forEach((img, ind)=> {
    img.addEventListener('click', () => {
        closeImg(certyImages[ind]);
    })
})

function openImg(icon) {
    icon.classList.remove('hidden');
    certyImages.forEach((i) => { if(i != icon) {i.classList.add('hidden') } })
}

function closeImg(icon) { icon.classList.add('hidden'); }

openTab(tabs[0]);


// CONTACT FORM

const formOpenButton = document.querySelector('.open-form-button');
const form = document.querySelector('.contact-form');
const formCloseButton = document.querySelector('.close-form-button');

formOpenButton.addEventListener('click', () => { form.classList.toggle('hidden'); })
formCloseButton.addEventListener('click', () => { form.classList.add('hidden'); })

// ROUTES

const routeButtons = document.querySelectorAll('.route-button');
const routeDivs = document.querySelectorAll('.route-div');
const routeTitles = document.querySelectorAll('.route-title');
const routeLegends = document.querySelectorAll('.route-legend');

routeLegends.forEach((legend) => {
    legend.innerHTML = legend.innerHTML.replace(/(?:\r\n|\r|\n)/g, '<br />');
});

routeTitles.forEach((title, index) => {
    title.innerHTML = routeButtons[index].innerHTML;
});

routeDivs[0].classList.remove('hidden');

routeButtons.forEach((button, ind) => {
    button.addEventListener('click', () => { openRoute(ind); })
});

function openRoute(index) {
    routeDivs.forEach((r) => { r.classList.add('hidden') })
    routeTitles.forEach((r) => { r.classList.add('hidden') })
    routeLegends.forEach((r) => { r.classList.add('hidden') })
    routeDivs[index].classList.remove('hidden');
    routeTitles[index].classList.remove('hidden');
    routeLegends[index].classList.remove('hidden');
}

openRoute(0);



