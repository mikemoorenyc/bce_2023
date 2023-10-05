import {useEffect,useState} from "preact/hooks";
import {h,Fragment} from "preact";
import ajaxRequest from "../utilities/ajaxRequest";
import Spotify from "./Spotify.jsx";
import Weather from "./Weather.jsx";


export default () => {
    const [weatherData, updateWeatherData] = useState(JSON.parse(sessionStorage.getItem("weather_data")) ||null);
    const [spotifyData, updateSpotifyData] = useState(null)
   
    const getData = async (url,updateFunction,sessionData) => {
        const data = await ajaxRequest(url);
       
        updateFunction(data);
        if(sessionData) {
            sessionStorage.setItem(sessionData, JSON.stringify(data));
        }
    }
    useEffect(async ()=>{
        if(!weatherData) {
            getData(`${WP_GLOBALS.ajax_url}?action=get_weather_data`, updateWeatherData,"weather_data");
        }
        getData(`${WP_GLOBALS.ajax_url}?action=get_now_playing`, updateSpotifyData);
        const recheckSong = setInterval(()=>{
            getData(`${WP_GLOBALS.ajax_url}?action=get_now_playing`, updateSpotifyData);
        }, 60 * 1000);
        return () => {
            clearInterval(recheckSong);
        }
    },[])
    return <Fragment>{(!weatherData && !spotifyData)?null:<Fragment>
        
        {spotifyData&&<Spotify data={spotifyData} />}
        {weatherData&&<Weather data={weatherData} />}
    </Fragment>}</Fragment>
}