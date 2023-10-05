import openToggle from "./utilities/openToggle.js";
export default () => {
    var dropdowns = document.querySelectorAll(".faq-section");
    dropdowns.forEach((e) => {
        const head = e.querySelector(".faq-header-container");
        const copy = e.querySelector(".faq-section-copy-container");
        openToggle(head,()=> {
            e.classList.add("opened");
          
        },() => {
            e.classList.remove("opened"); 
            
        })
        /*
        let isOpened = false;
        
        head.addEventListener("click", (h) => {
            console.log("click");
            h.preventDefault();
            console.log(e.classList);
            console.log(isOpened);
            if(isOpened) {
                isOpened = false;
                e.classList.remove("opened");
            } else {
                isOpened = true;
                e.classList.add("opened");
            }
        })
        */
    })
}