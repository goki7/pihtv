
setInterval(() => {
    fetch("/assets/include/eventi.php").then(response => {
        response.json().then(items => {
            postMessage(items);
        }).catch(error =>
            postMessage(null));
    });
}, 2500);