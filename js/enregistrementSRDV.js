document.querySelectorAll('input[name="rdv"]').forEach(element => {
    element.addEventListener("change", function(e) {
        let value = document.querySelector('input[name="rdv"]:checked').value == "oui";

        if(document.querySelector('input[name="rdv"]:checked').value == "oui") {
            document.getElementById("rdv-code-barre").style.display = "flex";
        } else {
            document.getElementById("rdv-code-barre").style.display = "none";
        }
        
    })
});