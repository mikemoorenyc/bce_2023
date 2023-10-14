export default (el) => {
    
    el.addEventListener("click",(e)=> {
        e.preventDefault(); 
        el.blur();
        document.querySelectorAll(".header-nav-container, .header-nav-container *, .header-mob-toggle-icon").forEach((e)=>{
            e.classList.toggle("header-nav--opened");
        })
       

        return false; 
        
    })
}