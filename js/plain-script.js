

function inputPsswordHideShow() {
    
    var inputTypeValue = document.querySelector(".pass-contnr input").getAttribute("type");

    if (inputTypeValue == "password") {
        document.querySelector(".pass-contnr input").setAttribute("type", "text");

        document.querySelector(".pass-contnr i").classList.remove("fa-eye");
        document.querySelector(".pass-contnr i").classList.add("fa-eye-slash");
    } else {
        document.querySelector(".pass-contnr input").setAttribute("type", "password");

        document.querySelector(".pass-contnr i").classList.remove("fa-eye-slash");
        document.querySelector(".pass-contnr i").classList.add("fa-eye");
    }

}

document.querySelector(".pass-contnr i").onclick = inputPsswordHideShow;