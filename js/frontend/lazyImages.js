const loadImage = (i) => {

    const container = i.parentNode;
    const holdingImg = i.querySelector("img");
    const newImg = document.createElement("img");
    const newPic = document.createElement("picture");
    newPic.classList.add("lazy-img-loading");
    newImg.setAttribute("alt", holdingImg.getAttribute("alt"));
    newImg.setAttribute("class", i.getAttribute("class"));
    newImg.classList.remove("lazy-img-fake");
    newImg.classList.add("lazy-img-loading")
    newImg.setAttribute("style", `width:100%;  ${i.style.maxWidth?`max-width: ${i.style.maxWidth}`:""}`);
    const loader = () => {
        newImg.removeEventListener("load",loader);
        i.remove()
        newImg.classList.remove("lazy-img-loading");
        newPic.classList.remove("lazy-img-loading");
        
    }
    newImg.addEventListener("load",loader);
    newPic.append(newImg);
    container.append(newPic);
    newImg.setAttribute("srcset",holdingImg.dataset.srcset);
    newImg.setAttribute("src",holdingImg.dataset.src);
}

export default () => {
    const lazyMaker = (i) => {
        i.dataset.state = "initialized";

        if(!i.querySelector("img")) {
            return; 
        }
        const observer = new IntersectionObserver((changes)=> {
            changes.forEach(c => {
                
                if(c.isIntersecting) {
                    observer.unobserve(i)
                    observer.disconnect(); 
                    loadImage(i);
                }
            })
        })
        

        observer.observe(i);

    }
    document.querySelectorAll(".lazy-img[data-state=not-initialized]").forEach(lazyMaker)
}