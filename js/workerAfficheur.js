let isLoad = false;
let myInterval = undefined;
let page = undefined;
let sha1Message = "";
let sha1CodeList = "";

/**
 * Placer un tableau de donnee en une ligne de texte.
 * 
 * @param {array} data donner a envoyer sous format de tableau.
 * @returns String avec les valeurs a envoyer sous format de texte.
 */
 function data(data) {
    let text = "";
    for (var key in data) {
      text += key + "=" + data[key] + "&";
    }
    return text.trim("&");
}

/**
 * Executer la page php avec des donnees de post.
 * 
 * @param {string} url le lien du fichier php qui va executer les post.
 * @param {array} dataArray tableau de donnees avec les post a transmettre.
 * @returns ajax fetch apres execution de la page php
 */
function fetch_post(url, dataArray) {
    let dataObject = this.data(dataArray);
    return fetch(url, {
             method: "post",
             headers: {
                   "Content-Type": "application/x-www-form-urlencoded",
             },
             body: dataObject,
        })
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

function timeSha1() {
  if(isLoad) {
    if(page != undefined) {
        // tableau de donnees post a envoyer
        let dataArray = {
            "sha1Message" : sha1Message,
            "sha1CodeList" : sha1CodeList
        };
        /* envoyer les informations du formulaire dans la page php. */
        fetch_post(page, dataArray).then(function(response) {
            let data = response.split("[#JSON#]");
            /* si tout c'est bien passe */
            if(data[0] == "true") {
                let emptyValue = (sha1Message == "" || sha1CodeList == "");
                let values = JSON.parse(data[1]);
                let valueChange = (sha1Message != values.sha1Message || sha1CodeList != values.sha1CodeList);
                sha1Message = values.sha1Message;
                sha1CodeList = values.sha1CodeList;
                postMessage([valueChange, emptyValue, false, ""]);
            } else {
                postMessage([false, false, true, response]);
                //clearInterval(myInterval);
                isLoad = false;
            }
        });
    }
  }
}

onmessage = function(e) {
  isLoad = e.data[1];
  page = e.data[2];
  if(myInterval != undefined) {
    clearInterval(myInterval);
  }
  if(isLoad) {
    timeSha1();
    //myInterval = setInterval(function () {timeSha1()}, e.data[0]);
  }
}
