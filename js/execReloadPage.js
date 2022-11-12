let page = "./../exec/execSha1File.php";

const myWorker = new Worker('./js/workerAfficheur.js');

myWorker.onmessage = (event) => {
    if(event.data[2]) {
        alert(event.data[3]);
        console.log(event.data[3]);
    } else if(event.data[0] && !event.data[1]) {
        location.reload(true);
    }
};

myWorker.postMessage([true, 1000, page]);