import { toChildArray,h,cloneElement,Fragment } from "preact";
import {useState,useLayoutEffect,useRef} from "preact/hooks";
export default (props) => {
    if(["checkBoxes","quantity"].includes(props.type)) {
        return <Fragment>{props.children}</Fragment>
    }
    const labelElement = useRef(null)
    const [isOpened, updateIsOpened] = useState(false);
    const [isActive, updateIsActive] = useState(false);
    const[labelWidth, updateLabelWidth] = useState(0)
    const changeState = (payload) => {
       if(payload.type == "opened") {
        updateIsOpened(payload.state);
       }
       if(payload.type == "active") {
        updateIsActive(payload.state);
       }
    }
    const renderChildren = () => {
        return toChildArray(props.children).map((child) => {
            let newe= cloneElement(child, {
                 changeState: changeState,
                 isOpened : isOpened,
                 
                 labelWidth: labelElement
            })
            
            return newe
        })
        

    }
    useLayoutEffect(()=>{
        if(!labelElement.current) {
            return; 
        }
        updateLabelWidth(labelElement.current.offsetWidth);
        const resize = () => {
            updateLabelWidth(labelElement.current.offsetWidth);
        }
        window.addEventListener("resize",resize);
        return () => {
            window.removeEventListener("resize",resize);
        }
    },[])
    const labelCut = (labelWidth*.75) + 12;
    return <div className={`interaction-container ${isOpened?"isOpened":""} ${isActive?"isActive":""} ${props.errorState?"errored":""}`}>
        <div class="right-line" style={{left: (labelWidth * .75) + 16 + 6 }}/>
        <div class="seperator left-seperator" style={{left:10,width: labelCut/2 }} />
        <div class="seperator right-seperator" style={{ left: 9+ labelCut/2,width: labelCut/2 + 2}} />
        {renderChildren()}
    </div>
}