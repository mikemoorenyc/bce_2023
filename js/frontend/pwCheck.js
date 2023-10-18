import copyAreaSetup from "./copyAreaSetup";
export default() => {

   
    const pw = (form) => {
         const savedPW = new URLSearchParams(new URL(window.location.href).search).get("pw") || localStorage.getItem("pw");
         
         const postid = form.dataset.postid;
        
        const iner = form.querySelector("input");
        const inCon = form.querySelector(".pw-form-input")
        const btn = form.querySelector(".pw-form-submit-button");
        const container = form.closest(".copy-area-reading-section");
        const checkstate = container.querySelector(".pw-checking-state");
     
        const error = false; 
        const errorBox = form.querySelector(".pw-form-error-text")
        iner.addEventListener("input",(e)=> {
            let v = e.target.value; 
            if(v) {
                inCon.classList.add("contains-text");
            } else {
                inCon.classList.remove("contains-text");
            }
        })
        form.addEventListener("submit", (e)=> {
            e.preventDefault(); 
            form.style.display="none";
            checkstate.style.display="block";
            checkPW(iner.value);
            return false; 
        })
        const setError = () => {
            
            inCon.classList.add("errored");
            errorBox.innerText = "You entered the wrong password. Try again."
        }
        const setSuccess = (response,pw) => {
            container.innerHTML = response;
            copyAreaSetup(); 
            localStorage.setItem("pw",pw);
        }
        const checkPW = async (val) => {
            btn.setAttribute("disabled",true);
            btn.classList.add("lazy-gradient");
     
            if(!val) {
                setError(); 
                return ; 
            }
            const data = new FormData();
            data.append("pw",val);
            data.append("id",postid);
            let request = await fetch(`${WP_GLOBALS.ajax_url}?action=password_check`,{
                method: "POST",
                body: data
            })
            form.style.display="block";
            checkstate.style.display="none";
            btn.removeAttribute("disabled");
            btn.classList.remove("lazy-gradient");
            if(!request.ok && request.status == 401) {
                setError(); 
                return; 
            }
            
            request = await request.text(); 
            setSuccess(request,val);
        }
        if(savedPW) {
            checkPW(savedPW);
         }
        
    }
    const forms = document.querySelectorAll(".pw-form");
    forms.forEach(pw)
}