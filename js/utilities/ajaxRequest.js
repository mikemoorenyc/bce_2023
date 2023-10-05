const ajaxRequest = async (url, method="GET", body) => {

    const raw = await fetch(url, {
        method: method, // or 'PUT',
        body: body
    })
    const data = await raw.json();
  
    return data; 
}
export default ajaxRequest; 