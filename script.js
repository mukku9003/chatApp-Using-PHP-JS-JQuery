
if("serviceWorker" in navigator){
    navigator.serviceWorker.register("sw.js").then(registration => {
        console.log("Hello I m JS FILE");
        console.log("Thank For Watching");
        console.log(registration);
        
    }).catch(error => {
        console.log("Fail");
        console.log(error);
        
    })
} else {

}