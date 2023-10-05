export default (element, openCallback, closeCallback) => {
    
    let isOpened = false; 
    element.addEventListener("click", (h) => {
        h.preventDefault(); 
        
        if(!isOpened) {
            openCallback();
            isOpened = true;
        } else {
            closeCallback();
            isOpened = false; 
        }
    })

}