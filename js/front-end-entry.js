import openNav from "./frontend/openNav";
import lazyImages from "./frontend/lazyImages";
import headerHide from "./frontend/headerHide";
import cardClick from "./frontend/cardClick";

const nav = document.querySelector(".header-mob-toggle");

if(nav) {
    openNav(nav);
}
lazyImages(); 
headerHide(); 
cardClick(); 