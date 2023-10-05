import {h} from "preact";
import SvgIcons from "../SvgIcons.jsx";
export default ({data}) => {


    if(!data) {
        return null; 
    }
    const iconId = (data.weather[0].id === 800) ? 800 : String(data.weather[0].id).charAt(0)
    
    return <div className="live-data-section-container weather-section">
        <div className="live-data-section-img"><SvgIcons iconName={`weather-${iconId}`} /></div>
       <div className="live-data-section-text "> Weather in {data.name}:<br/>
        {Math.round(data.main.temp)} Degrees <br/> {data.weather[0].description} </div>
    </div>
}