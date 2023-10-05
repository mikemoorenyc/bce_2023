import {h,render,Component} from "preact"
import LiveData from "./LiveData/index.jsx";
import ContactFormFront from "./ContactFormFront/index.jsx";
import faqDropDowns from "./faq-drop-downs.js";
import menuInteraction from "./menuInteraction.js";
import samples from "./samples.js";

faqDropDowns();
menuInteraction();
samples();
const liveDataContainer = document.getElementById("live-data-container");
if(liveDataContainer) {
    render(<LiveData />,liveDataContainer);
            
}
const contactFormContainer = document.getElementById('contact-form-container');
if(contactFormContainer) {
    render(<ContactFormFront/>,contactFormContainer);
}
/*
fetch(`${WP_GLOBALS.ajax_url}?action=get_now_playing`, {
            method: 'GET', // or 'PUT'
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .then(function(response){
       
            return response.text();
        })
        .then(data => {
            console.log(data);
            
            
            
            
        })
   */    
//const App = ( ) => <h1>dtest test asdf</h1>
//render(<App/>, document.getElementById('app'));
