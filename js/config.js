document.getElementById("actualiser").addEventListener("click", function(event) {
    location.reload(true);
});

document.getElementById("initFile").addEventListener("click", function(event) {
    window.location.href = './exec/initFile.php';
});

document.getElementById("defautFile").addEventListener("click", function(event) {
    window.location.href = './exec/defaultFile.php';
});