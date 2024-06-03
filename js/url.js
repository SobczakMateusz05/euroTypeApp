function url(elementName){
    if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete(elementName);
        window.history.replaceState(null, null, url);
    }
}

function hyper(url){
    window.location.href=url;
}