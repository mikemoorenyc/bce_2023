import {h} from "preact";
import SvgIcons from "../SvgIcons.jsx";

export default ({e,updater}) => {

    const updateCheckBox = (c) => {
        let newData = e.data || "";
        const checked = c.target.checked;
        if(checked) {
            updater(`${newData}${newData?";":""}${c.target.value}`,e.id)
        } else {
            updater(newData.split(";").filter(e=>c.target.value !==e),join(";"),e.id);
        }
    }
    return <fieldset class="checkbox-section">
        <legend class="checkbox-title">{e.title}</legend>
        {e.settings.options.split(";").map((item,i)=> {
            let val = item.trim();
            let uid = `${val}-${e.id}`
            let isChecked = (e.data?e.data.split(";"):[]).includes(val)
            return<label class={`checkbox-item ${(isChecked)?"isChecked":""}`} for={uid} key={uid}>
                <input style={{display:"none"}} checked={isChecked} onChange={updateCheckBox} type="checkbox" value={val} id={uid} name={uid} />
                <SvgIcons iconName={"check"} extraClasses={`checkbox-check-container ${isChecked?"isChecked":""}`} />
                <span className="checkbox-label">{val}</span>
            </label>    
        })}
    </fieldset>
}