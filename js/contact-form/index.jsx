
const {useEffect, useState, useRef, Component} = wp.element; 
import {arrayMoveImmutable} from "array-move";
import {commonSettings, components} from "./settings"
import EditPanel from "./EditPanel.jsx";
class Form extends Component {
    constructor(props) {
        super(props);
        this.state = {
            currentlyEditing: null,
            formLayout: [],
            currentlyAdding: false
        }
        this.selectRef = React.createRef();
    }
    componentDidMount() {
        fetch(`${theme_data.ajax_url}?action=contact_form_layout&id=${post_data.ID}`, {
            method: 'GET', // or 'PUT'
        })
        .then(function(response){
            return response.json()
        })
        .then(data => {
            console.log(data);
            if(!data.contact_form_layout) {
                return; 
            }
            this.setState({
                formLayout: data.contact_form_layout
            })
            
            
            
        })
        let inputId= document.querySelector("input[value=contact_form_layout]"); 
        if(inputId) {
            let key = inputId.getAttribute("id").split("-")[1];
            document.getElementById(`meta-${key}`).remove();
        }
        
    }
    sendData = async () => {
        const raw = await fetch(`${theme_data.ajax_url}?action=contact_form_layout&id=${post_data.ID}`, {
            method: 'POST', // or 'PUT',
            body: JSON.stringify({formData: this.state.formLayout, id: post_data.ID})
        })
        const data = await raw.json();
        console.log(data);
        if(data.layout.length) {
            this.setState({
                formLayout: data.layout
            })
        }
    }
    createNew = (e) => {
        e.preventDefault(); 
        const componentValues = {...components[this.selectRef.current.value]}
        const item = {
            id: "new",
            fieldType: this.selectRef.current.value,
            settings: {},
            title: `${componentValues.title} Heading`
        }
        this.setState({currentlyEditing:item});
    }
    updateItem = (item,updateType) => {
        let newLayout = [];
        this.setState({
            currentlyEditing:null,
            currentlyAdding: false
        })
        if(updateType === "cancel") {
            return ; 
        }
        if(item.id == "new") {
            item.id = new Date().getTime();
            newLayout = [...this.state.formLayout,item]; 
        } else {
            newLayout = this.state.formLayout.map((f) => {
                if(item.id === f.id) {
                    return item;
                } else {
                    return f; 
                }
            })
        }
        this.setState({formLayout:newLayout}, () => {
            this.sendData();
        }) 
    }
    actionsClick = (event,type,original) => {
        event.preventDefault();
        const {formLayout} = this.state;
       const item = JSON.parse(JSON.stringify(original))
       let currentPos = null;
       let updatedLayout = [];
       formLayout.forEach((e,i) => {
        if(item.id === e.id) {
            currentPos = i;
            return false; 
        }
       });
        switch (type)  {
            case "edit":
                this.setState({currentlyEditing:item});
                break;
            case "delete":
                if(confirm("Are you sure? This can't be undone.")) {
                    updatedLayout = formLayout.filter(i=>i.id!== item.id)
                }
                break;
            case "move-up":
                if(currentPos === null) {
                    break;
                }
                updatedLayout = arrayMoveImmutable(formLayout, currentPos, currentPos-1 );
                break; 
            case "move-down":
          
                    if(currentPos === null) {
                        break;
                    }
                    updatedLayout = arrayMoveImmutable(formLayout, currentPos, currentPos + 1);
                    break; 

        }
        
        if(type !== "edit") {
            this.setState({formLayout:updatedLayout},()=>{this.sendData()});
        }
    }
    render() {
        const {formLayout,currentlyAdding,currentlyEditing} = this.state; 
        return <div id="contact-form-creator">
            {
                formLayout.map((e,i)=> {
            
                    return <div key={e.id} className={`form-field-container form-field-width-${e.settings.width}`}>
                         {(!currentlyEditing || currentlyEditing.id != e.id) && <><div className={`title `}><b>{e.title}</b> - {components[e.fieldType].title}</div><div className={"settings"}>
                            {Object.entries(e.settings).map((w) => {
                             
                                return <div>{w[0]}: {String(w[1])}</div>;
                            })}
                        </div></>}
                         {currentlyEditing && currentlyEditing.id === e.id && <EditPanel updateFunction={this.updateItem } item={currentlyEditing} />}
                         {currentlyEditing === null &&<div className="row-actions">
                             <span>
                             <a onClick={(g)=>{this.actionsClick(g,"edit",e)}}  href="#">Edit</a> | </span> 
                             
                             {i!==0 && <><span><a onClick={(g)=>{this.actionsClick(g,"move-up",e)}}  href="">Move Up</a>  | </span>  </>}
                             <>
                             {i!== formLayout.length - 1 && <span>
                             <a  href="" onClick={(g)=>{this.actionsClick(g,"move-down",e)}}>Move Down</a> | </span>}    </>
                             
                             <span className="delete">
                             <a  onClick={(g)=>{this.actionsClick(g,"delete",e)}} href="">Delete</a></span>     
                             
                         </div>}
                         
                     </div>
                 })
            }
            {currentlyEditing &&currentlyEditing.id == "new"&& 
            <div className="form-field-container form-field-width-Full">
                <EditPanel updateFunction={this.updateItem }item={currentlyEditing} />
            </div>}
            {currentlyEditing === null && 
            <div className="add-field-row">
                {!currentlyAdding? 
                <button onClick={(e)=>{e.preventDefault; this.setState({currentlyAdding:true})}}  
                    type="button" 
                    class="components-button editor-post-switch-to-draft is-tertiary">Add new field</button> :
                <>
                <select ref={this.selectRef}>
                        {Object.entries(components).map((e) => <option value={e[0]}>{e[1].title}</option>)}
                </select>
                <button type="button" onClick={this.createNew} class="components-button is-primary">Add</button>
                <button onClick={(e)=>{e.preventDefault; this.setState({currentlyAdding:false})}} className=" components-button is-destructive">Cancel</button>
                </>}
            </div>}
    </div>
    }
}

export default () => {
    ReactDOM.render(<Form/>, document.getElementById('contact-form-creator-container'));
}
