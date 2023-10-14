export default () => {
    

    const clickMaker = (c) => {
        let downTime = 0;
        const url = c.querySelector(".the-card-url");
        if(!url) {
            return; 
        }
        const clickAction = (e) => {
            if(e.button !== 0) {
                return ; 
            }
            if(e.type === "mousedown") {
                downTime = +new Date();
                return
            }
            if ((+new Date() - downTime) > 200) {
                return ;
            }
            window.location.href = url; 
        }


        c.addEventListener("mousedown",clickAction);
        c.addEventListener("mouseup",clickAction);
    }

    document.querySelectorAll(".the-card").forEach(clickMaker) ;
}