import {h,Fragment,Component} from "preact";
import SvgIcons from "../SvgIcons.jsx";
class FileUpload extends Component {
    constructor(props) {
        super(props);
    }
    handleChange = (e) => {
        let newData = this.props.e.data? [...this.props.e.data] : [];
        [...e.target.files].forEach((e) => {
            let size = ((e.size/1024)/1024).toFixed(4);
            if(size > 20 ) {
                alert(`${e.name} is too big.`);
                return; 
            }
            newData = [...newData,e];
        })
        if(newData.length) {
            this.props.changeState({type:"opened",state:true});
            
        }
        this.props.updater(newData,this.props.e.id);
    }
    removeItem = (index) => {   
        let newData = this.props.e.data.filter((e,i)=> i!==index)
        this.props.updater(newData,this.props.e.id)
        if(!newData.length) {
            this.props.changeState({type:"opened",state:false});
        }
    }
    
    render(props) {
        
        const {e,updater,isOpened, changeState,labelWidth} = props
        const isOpenedClass = (isOpened)? "isOpened": ""
        
    return <Fragment>
        <label ref={labelWidth} className={`interaction-label ${isOpenedClass}`}  >
            {`${e.title}${e.settings.required?"*":""}`} 
        </label>
        <div class={`upload-field ${isOpenedClass}`}>
            {(!e.data || !e.data.length) ? <div class="upload-field-text"> Drag & drop files here or <label class="a" for={e.id}>browse your device</label></div> :<div>
            <div class="file-item-list">{
                e.data.map((e,i)=> {
                    return <div key={`${e.name}-${e.size}`}class={`file-item button-base button-sm`}>
                        <div class="file-item-inner">
                            <div class={`file-item-name`}>{e.name}</div> 
                            <button onClick={(e)=>{e.preventDefault();this.removeItem(i) }} class={`remove-file-button`} title="Remove file"><SvgIcons iconName={"cancel"} /></button>
                        </div>
                    </div>
                })
            }</div>
            <label for={e.id} class="a">Upload more files</label>
            </div>}
           
            
        </div>
        
        <input onChange={this.handleChange} type="file" style={{display:"none"}} id={e.id} multiple accept="image/*,.pdf,.eps,.ai,.psd," ></input>
    </Fragment>
    }
}

export default FileUpload;