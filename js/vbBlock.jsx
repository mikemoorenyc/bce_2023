import metadata from '../assets/vb_block.json';
import {Flag,AppWindow,Heart,Group,Eye} from "./vbSvgs"
const {Component,useState,useRef,useEffect} = wp.element; 
const {Panel,PanelBody,TextareaControl} = wp.components;


const Board = ({ attributes, setAttributes }) => {
    console.log(attributes);
     
    const aKeys = Object.keys(metadata.attributes)
    const [openSections, updateOpenSections] = useState([]);
    const block = useRef(null);
  
    return <div  className='wp-block'>
  
    <Panel header={"Vison Board"}>
    



    {aKeys.map((s) => {
        const i = metadata.attributes[s];
        return <PanelBody key={s} title={i.label}  initialOpen={ false }>
          <TextareaControl 
          value={attributes[s]}
          onChange={(value) => {
            const obj = {}
            obj[s] = value; 
            setAttributes( obj)
          }}
          
          />
        </PanelBody>
    
    })}
    
    </Panel></div>
}




const Saver = ({attributes}) => {
    
    const sections = [
        ["productVision",<Eye />],
        ["targetGroup",<Group />],
        ["needs",<Heart />],
        ["product",<AppWindow />],
        ["businessGoals",<Flag />]
    ]
    
    return <table class="vision-board-style">
    <tr>
        <td className={sections[0][0]} colSpan={4}>
            <div>
                <h4>
                    {sections[0][1]}
                    <span>{metadata.attributes[sections[0][0]].label}</span>
                </h4>
                <div dangerouslySetInnerHTML={{__html: attributes[sections[0][0]]}}/>
            </div>
        </td>
    </tr>
    <tr>
        {sections.map((s,i) => {
            if(i === 0) {
                return null; 
            }
            const md = metadata.attributes[s[0]];
            return <td key={s[0]} className={s[0]} style={{width: "25%"}}>
                <div>
                    <h4>
                        {s[1]}
                        <span>
                            {md.label}
                        </span>
                    </h4>
                    <div dangerouslySetInnerHTML={{__html:attributes[s[0]]}} />
                </div>
            </td>
        })

        }
    </tr>
    
    </table>
}
wp.blocks.registerBlockType( metadata.name, {
    edit: Board,
    save: Saver
} );