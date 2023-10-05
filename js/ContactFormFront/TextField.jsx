import {h,Fragment} from "preact";
import SvgIcons from "../SvgIcons.jsx";
export default (props) => {
    
   const {e,updater,isOpened, changeState,labelWidth} = props

   const isOpenedClass = (isOpened)? "isOpened": ""
   const handleFocus = () => {
    changeState({type:"opened",state:true});
    changeState({type:"active",state:true})
   }
   const handleBlur = () => {
    changeState({type:"active",state:false})
    if(!e.data) {
        changeState({type:"opened",state:false})
    }
   }

   let newprops = {
    id:e.id,
    name: e.id,
    onFocus:handleFocus,
    onBlur: handleBlur,
    onInput: (i)=>{updater(i.target.value,e.id)}
   }
  
    return <Fragment>
        <label ref={labelWidth} className={`interaction-label ${isOpenedClass} ${e.fieldType == "date"||e.errorState?"with-icon":""}`} for={e.id} >
            {`${e.title.trim()}${e.settings.required?"*":""} `} 
        </label>
        {(e.fieldType=="textField" || e.fieldType == "emailAddress")&&<Fragment><input class={`textField ${isOpenedClass}`} {...newprops} type={e.fieldType=="emailAddress" ? "email" : "text"}/>{e.errorState&&<SvgIcons iconName="warning" extraClasses="field-icon warning-icon" />}</Fragment>}
        {e.fieldType=="date"&&<Fragment><input onClick={(e)=>{e.target.showPicker()}} style={{color:(!e.data&&!isOpened)?"transparent":null}} class={`textField date ${isOpenedClass} `} {...newprops} type="date"/><SvgIcons iconName="calendar" extraClasses="field-icon calendar-icon" /></Fragment>}
        {e.fieldType=="bigTextField"&&<textarea rows="3"  {...newprops} class={`bigTextField ${isOpenedClass}`} >
            {e.data}    
        </textarea>}
        
    </Fragment>
}