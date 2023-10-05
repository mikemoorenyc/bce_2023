import {components, commonSettings} from "./settings";
const {useState} = wp.element; 


export default ({item,updateFunction}) => {
   
    const [itemState, updateItem] = useState(item)
    const allSettings = {...commonSettings, ...components[itemState.fieldType].otherSettings}
    const handleChange = (e) => {
   
       const id = e.target.id;
       let newitem = {...itemState};
       if(e.target.id == "title") {
        
        newitem.title = e.target.value;
       } else {
        newitem.settings[id] = (e.target.type == "checkbox")? e.target.checked : e.target.value
       }
    
       
       updateItem(newitem);
        
    }
    const buttonClick = (e,type) => {
        e.preventDefault();
        updateFunction(itemState,type);
    }
    return <div  className="form-creator-edit-panel form-wrap">
        <div className="form-field">
            <label>Field Title</label>
            <input onChange={handleChange} value={itemState.title}  name={"title"} id="title" type="text" />
        </div>
        {
            Object.entries(allSettings).map((w)=> {
                const type = w[1].type;
                return <div className={`form-field form-field-${type}`}>
                {fieldInputs(w, itemState.settings, handleChange)}
                {w[1].description&&<p className="description">{w[1].description}</p>}
                </div>
            })
        }
        <div className="form-field action-buttons">
            <button onClick={e =>buttonClick(e,"save")} className=" components-button is-primary">Save</button>
            <button onClick={e=>buttonClick(e,"cancel")}className=" components-button is-destructive">Cancel</button>
        </div>
    </div>
}

const fieldInputs = (setting,itemValues, changeHandler) => {
 
    const fieldSettings = setting[1],
            fieldName= setting[0]
    switch (fieldSettings.type) {
        case "textField":
            return <><label for={fieldName}>{fieldSettings.label}</label>
                <input onChange={changeHandler} value={itemValues[fieldName ]}  id={fieldName} name={fieldName} type="text" />
            </>
        case "checkBox": {
            return <fieldset>
                <label for={fieldName}>
                    <input onChange={changeHandler} id={fieldName} name={fieldName} type="checkbox"  checked={itemValues[fieldName ]} />
                    {fieldSettings.label}
                </label>
            </fieldset>
        }
        case "select" : {
            return <>
                <label for={fieldName}>{fieldSettings.label}</label>
                <select id={fieldName} name={fieldName} onChange={changeHandler} value={itemValues[fieldName ]}>
                    {
                        fieldSettings.options.map(o => <option value={o}>{o}</option>)
                    }
                </select>
            </>
        }
    }
}
