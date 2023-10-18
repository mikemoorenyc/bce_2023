export default () => {
    
    const loadVideo = (v) => {
        const classer = v.querySelector(".cai-video-shim");

        let attrString = ""
        for (var i = 0; i < classer.attributes.length; i++) {
            var attrib = classer.attributes[i];
            if (attrib.specified && attrib.name != "class") {
               // theVid.setAttribute(attrib.name,attrib.value);
               attrString += `${attrib.name}="${attrib.value}" `
            }
        }

        v.querySelector(".cai-video-placeholder").remove(); 
        classer.remove(); 
        v.querySelector(".cai-video-container").innerHTML = `
        <video ${attrString} />
        `

    }
    const lazyVideo = (v) => {
        v.dataset.state = "initialized";
        const observer = new IntersectionObserver((changes)=> {
            changes.forEach(change => {
                if(change.isIntersecting) {
                    loadVideo(v);
                    observer.unobserve(v)
                    observer.disconnect(); 
                }
            })
        });
        observer.observe(v);
        
    }

    document.querySelectorAll(".lazy-video[data-state=not-initialized]").forEach(lazyVideo)
}