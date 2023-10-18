import openNav from "./frontend/openNav";

import headerHide from "./frontend/headerHide";
import cardClick from "./frontend/cardClick";
import copyAreaSetup from "./frontend/copyAreaSetup";
import pwCheck from "./frontend/pwCheck";

const nav = document.querySelector(".header-mob-toggle");

if(nav) {
    openNav(nav);
}
pwCheck(); 

headerHide(); 
cardClick(); 
copyAreaSetup(); 
