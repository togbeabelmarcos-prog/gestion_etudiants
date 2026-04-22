document.addEventListener("DOMContentLoaded", function () {

    let form = document.querySelector("form");

    form.addEventListener("submit", function (e) {

        let nom = document.querySelector("input[name='nom']").value;
        let prenom = document.querySelector("input[name='prenom']").value;

        if (nom === "" || prenom === "") {
            alert("Veuillez remplir tous les champs !");
            e.preventDefault();
        }
    });

});