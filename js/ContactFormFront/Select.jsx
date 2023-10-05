import {h,Fragment} from "preact"
import { useRef } from "preact/hooks";
import SvgIcons from "../SvgIcons.jsx";
export default (props) => {
    const {e,updater,isOpened, changeState,labelWidth} = props
    const selectRef = useRef(null)
  
    const options = e.settings.options.split(";").map(e=>e.trim());
    const isOpenedClass = (isOpened)? "isOpened": ""
    const handleFocus = () => {
        console.log("focus")
        changeState({type:"opened",state:true});
        changeState({type:"active",state:true})
    }
    const handleBlur = () => {
        console.log("blur")
        changeState({type:"active",state:false})
        if(!e.data) {
            changeState({type:"opened",state:false})
        }
    }
    const handleChange = (s) => {
        console.log(s.target.value);
        updater(s.target.value,e.id);
        selectRef.current.blur();
        changeState({type:"active",state:false});
        
        changeState({type:"opened",state:(s.target.value)?true:false})
        
    }
  
    return <Fragment>
        <label ref={labelWidth} className={`interaction-label ${isOpenedClass} with-icon`} for={e.id} >
            {`${e.title}${e.settings.required?"*":""}`} 
        </label>
        {e.data&&<div class="interaction-label mask with-icon">{e.data}</div>}
        <select   ref={selectRef}  onChange={handleChange} onBlur={handleBlur} onFocus={handleFocus} className="selectField" value={e.data}>
            {options.map(e=><option onClick={()=>{console.log("test")}} value={e} key={e}>{e}</option>)}
        </select>
        <SvgIcons extraClasses="field-icon" iconName={"page-down"} />
        
    </Fragment>
}