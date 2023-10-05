import Panzoom from "@panzoom/panzoom";
const createCloseBtn = (container, callback ) => {
    const closeBtn = document.querySelector("header .menu-opener").cloneNode(true);
        closeBtn.querySelector(".menu-opener-text").innerText = "Close";
        closeBtn.classList.add("opened");
        container.appendChild(closeBtn);
        const close = (e)=> {
            e.preventDefault();
            closeBtn.remove(); 
            callback();
        }
        closeBtn.addEventListener("click",close)
}
export default () => {
    const   sampleList = document.querySelector(".sample-thumbnails"),
            filters = document.querySelector(".filter-options-items-container");
    if(!sampleList || !filters) {
        return ; 
    }
    document.querySelector(".filter-options-opener").addEventListener("click",(e) => {
        e.preventDefault();
        const opClass = 'filter-options';
        const filterContainer = document.querySelector(`.${opClass}`)
        createCloseBtn(filterContainer,() => {
            filterContainer.classList.remove(`${opClass}__opened`);
        })
        filterContainer.classList.add(`${opClass}__opened`);
    })
    
    
    const buttonClass = "filter-options-button", 
    filterOptions = filters.querySelectorAll(`.${buttonClass}`),
    samplesClass = "sample-thumbnail",
    samples = sampleList.querySelectorAll(`.${samplesClass}`);
    let activeSamples = [];
    filterOptions.forEach((e) => {
        e.addEventListener("click",function(c){
            const activeClass = "button-base__active",
            id = e.getAttribute("data-id"),
            activeAttr = "data-active"
            c.preventDefault();
            if(e.getAttribute(activeAttr) == "active") {
                e.setAttribute(activeAttr,"");
                e.classList.remove(activeClass);
                updateSamples(id,"off");
            } else {
                e.setAttribute(activeAttr,"active");
                e.classList.add(activeClass);
                updateSamples(id,"on")
            }
        })
    })
    const updateSamples = (id,state) => {
        if(state == "on") {
            activeSamples = [...activeSamples,id];
            
        } else {
            activeSamples = activeSamples.filter(e => e != id);
        }
        console.log(activeSamples.length);
        document.querySelector(".filter-amt-selected").innerText = activeSamples.length ? (`(${activeSamples.length})`): ""
        samples.forEach((s) => {
            console.log(activeSamples.length)
           const thClass = "sample-thumbnail",
                removedClass = `${thClass}__removed`,
                removingClass = `${thClass}__removing`;
            
            let ids = (s.getAttribute("data-terms") || "" ).split(",").filter(e => activeSamples.includes(e));
            //Should be on the list
          
            if(ids.length > 0 || activeSamples.length < 1) {
                //Alredy on the list
                if(!s.classList.contains(removedClass)){
                    return ; 
                }
                s.classList.remove(removedClass);
                
                setTimeout(()=> {
                    s.classList.remove(removingClass);
                },200 )
                return ; 

            }
            //Should not be on the list
            //Already removed
            if(s.classList.contains(removedClass)) {
                return ; 
            }
            s.classList.add(removingClass);
            setTimeout(()=> {
               
                s.classList.add(removedClass);
            },200)
            
        })
    }
    document.querySelectorAll(".sample-thumbnail-img").forEach((i) => {
        
        i.addEventListener("click",(e)=>{
            e.preventDefault();
            createPan(i.getAttribute("src"));
        })
        
    });
    
    
}
function createPan(src) {
    const   pzClass = "pan-zoom-container",
            pzContainer = document.querySelector(`.${pzClass}`),
            pzOpen = `${pzClass}__open`;
    if(!pzContainer) {
        return; 
    }
    
    pzContainer.classList.add(pzOpen);
    createCloseBtn(pzContainer,()=> {
        pzContainer.classList.remove(pzOpen);
        if(pz!=null) {
            pz.destroy(); 
            pzContainer.textContent = "";
        }
    })
    const img = document.createElement("img");
   
    img.classList.add(`${pzClass}-img`);
    pzContainer.appendChild(img);
    let pz = null;
        

    const load = () => {
        let imgS = {},
            contS = {},
            diff = {},
            smallSide = "";
        const dimSet = () => {
            imgS = {...imgS,...{
                x: img.offsetWidth,
                y: img.offsetHeight
            }}
            contS = {...contS,...{
                x:pzContainer.offsetWidth,
                y:pzContainer.offsetHeight
            }}
            diff = {...diff,...{
                x: imgS.x - contS.x,
                y: imgS.y - contS.y
            }}
            smallSide = (diff.x < diff.y) ? "x" : "y";
        }
        dimSet(); 

        if(diff.x <= 0 && diff.y <= 0) {
            img.classList.add(`${pzClass}-img__small`);
            return ; 
        }
       const resetSize = (multiplier) => {
        [{style:"width",axis:"x"},{style:"height",axis:"y"}].forEach((e) => {
            img.style[e.style] = `${Math.ceil(imgS[e.axis] * multiplier + 1)}px`
        })
       }
       
        if(diff[smallSide]<1) {
            const multiplier = (contS[smallSide]/imgS[smallSide]) ;
            resetSize(multiplier);
        }
        dimSet();
        console.log(diff[smallSide]);
        console.log(contS[smallSide])
        if(diff[smallSide] > contS[smallSide] * 2) {
       
            resetSize(.75);
        }
        dimSet();

        pz = Panzoom(img, {
            disableZoom: true,
            contain: "outside",
            startX : -Math.abs(diff.x/2),
            startY: -Math.abs(diff.y / 2)
        })
    }
    img.addEventListener("load",()=>{
        setTimeout(load,100);
        setTimeout(()=> {
            img.classList.add(`${pzClass}-img--loaded`);
        },105)
    })
    img.setAttribute("src", src);
    
}