import {h} from "preact"
import {useEffect,useState} from "preact/hooks";
export default({iconName, extraClasses=""}) => {
    const [svgContent, updateSvgContent] = useState(null);
    useEffect(async ()=> {
        const sessionCache =sessionStorage.getItem("svg_"+iconName)
        if(sessionCache) {
         
            updateSvgContent(sessionCache);
            return ; 
        }

        const raw = await fetch(`${WP_GLOBALS.theme_url}/assets/${iconName}.svg`, {
            method: "GET"
        });
        let theSVG = await raw.text();
        sessionStorage.setItem("svg_"+iconName,theSVG);
        updateSvgContent(theSVG);
    },[])


    return <span class={extraClasses} dangerouslySetInnerHTML={{__html:svgContent}} />; 
}