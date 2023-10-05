import {h,Fragment} from "preact";
import { useRef, useLayoutEffect,useState } from "preact/hooks";

export default ({e,updater}) => {
    
    const range = useRef(null);
   
    
    useLayoutEffect(()=>{
        updater(range.current.value, e.id);
        
    },[])
    const maxDown = Math.floor(parseInt(e.settings.max)/12)
    const max = maxDown * 12,
    min = parseInt(e.settings.min)
    return<Fragment>
        <label className="checkbox-title">{e.title}</label>
        <div class="range-container" >
        <input ref={range} onInput={(i)=>{updater(i.target.value,e.id)}} class="range-input" type="range" id="volume" name="volume" min={min} max={max} value={e.data} step="12" />
        <div  class="range-counter">{e.data}{(e.data == min?" (minimum order)":"")}{e.data >= max?" or more":""}</div>
        </div>
        
    </Fragment>
}
//{transform:`translateX(${percentage}%)`}