import {h} from "preact"



export default ({data}) => {

    if(!data) {
        return null; 
    }
    const {imgurl,artist,title,type} = data
    return <div className="live-data-section-container">
        <img className="live-data-section-img" src={imgurl.url} />
        <div className="live-data-section-text">
            Playing now:
            <div className="spotify-scrolling-text">
                {`${title} ${(artist)? `by ${artist[0].name}` : ""}`}
            </div>
        </div>
    </div>
}