import openToggle from "./utilities/openToggle.js";
export default () => {
    const   menuBtn = document.querySelector(".menu-opener"),
            nav = document.querySelector(".main-menu-nav-container");
    if(!nav || !menuBtn) {
        return; 
    }
    const adders = [menuBtn,nav]
    const textContainer = menuBtn.querySelector(".menu-opener-text")
    openToggle(menuBtn, () => {
        textContainer.innerText = menuBtn.getAttribute("data-close-text")
        adders.forEach((e) => {e.classList.add("opened")})
    }, () => {
        textContainer.innerText = menuBtn.getAttribute("data-open-text")
        adders.forEach((e)=> {e.classList.remove("opened")})
    })
    
}