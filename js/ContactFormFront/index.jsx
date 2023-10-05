import {h, createElement} from "preact";
import {useState,useEffect} from "preact/hooks";
import ajaxRequest from "../utilities/ajaxRequest.js";
import TextField from "./TextField.jsx";
import FileUpload from "./FileUpload.jsx";
import Select from "./Select.jsx";
import CheckBoxes from "./CheckBoxes.jsx";
import Quantity from "./Quantity.jsx";
import InteractionContainer from "./InteractionContainer.jsx";

export default () => {
    const components = {
        textField : TextField,
        bigTextField: TextField,
        emailAddress: TextField,
        upload: FileUpload,
        select: Select,
        checkBoxes: CheckBoxes,
        quantity: Quantity ,
        date: TextField
    }
    const[formData, updateFormData] = useState(null);
    const[submitState,updateSubmitState] = useState(sessionStorage.getItem("submitted")||"idle");
    
    const newData = (payload, id) => {
        updateFormData(formData.map((e) => {
            if(e.id != id) {
                return e;
            }  
            return {...e,...{data:payload,errorState: (e.settings.required && !payload)}};
        }));

    }
    useEffect(async ()=> {  
        const data = await ajaxRequest(`${WP_GLOBALS.ajax_url}?action=contact_form_layout&id=${WP_GLOBALS.post_id}`);
    
        updateFormData(data.contact_form_layout.map((e)=> {
         
            return {...e,...{data:null,errorState:false}}
        }));
        
    },[]);
    const submitData = async (e) => {
        const top = document.getElementById("contact-form-container").offsetTop - 102;
       
        e.preventDefault(); 
        updateSubmitState("submitting");
        const errored = formData.filter(e => {
            return e.settings.required && e.data == null; 
        }).map(e=>e.id)
        
        if(errored.length) {
            updateFormData(formData.map(e=>{
                return{...e,...{errorState:errored.includes(e.id)}}
            }));
            updateSubmitState("idle");
            window.scrollTo(0,top,"smooth");
            return;
        }
      
        let data = new FormData(); 
         
        formData.forEach(e => {
            if(e.fieldType=="upload") {
                if(!e.data || !e.data.length) {
                    return; 
                }
                e.data.forEach((e,i)=> {
         
                    data.append(`files_${i}`,e);
                })
                return;
            }
        
            data.append(e.id, JSON.stringify(e));
        });
        
        let request = await fetch(`${WP_GLOBALS.ajax_url}?action=post_form_submission`,{
            method: "POST",
            body: data
        })
        if(!request.ok) {
            alert("There was a problem sending your contact request. You can try submitting again.")
            console.log("errored");
            updateSubmitState("idle");
            return ; 
        }
        let text = await request.text()
        
        console.log(text);
     
        window.scrollTo(0,top, "smooth");
        
//removeIf(!production)
        sessionStorage.setItem("submitted", "success"); 
//endRemoveIf(!production)
        
        updateSubmitState("success");
        
    }
    if(!formData) {
        return null;
    }
    if(submitState == "success") {
        return <div class="section"><p class="success-message">Thank you for taking the time to contact us. <br/>We'll be in touch soon.</p></div>
    }
    return submitState != "success"&&<form onSubmit={submitData}>{
        formData.map((e)=>{
            return<div key={e.id} className={`section section-${e.fieldType} ${e.settings.width? `section-${e.settings.width}`:""}`}>
               <InteractionContainer errorState={e.errorState} type={e.fieldType}>{createElement(components[e.fieldType],{updater:newData,e:e})}</InteractionContainer>
               {(e.settings.required || e.settings.helperText)&&<div className={`helper-text ${e.errorState?"errored":""}`}>{`${e.settings.required?"*required":""} ${e.settings.helperText||""}`} </div>

               }
            </div>
        })
        
        
        }
        <div class="submit-button-container section">
            <button  disabled={submitState !="idle"} type="submit" class="contact-form-submit-button button-base">
                <span>
                    Submit
                </span>
            </button>
        </div>
        </form>
}