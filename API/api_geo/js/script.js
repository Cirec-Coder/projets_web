const result = document.querySelector(".result");

fetch("https://geo.api.gouv.fr/communes?codePostal=68200&fields=nom,code,codesPostaux,siren,codeEpci,codeDepartement,departement,codeRegion,region,population&format=json&geometry=centre")
    .then((response) => response.json())
    .then((data) => {console.log(data)// output will be the required data
    result.innerHTML = "<strong>Ville : </strong>" + data[0].nom + 
    "<br><strong>Département : </strong>" + data[0].departement.code + " - " + data[0].departement.nom +"<br>"
    result.innerHTML += "<strong>Population : </strong>" + data[0].population + " habitants<br><br>"

    result.innerHTML += "<strong>Les codes posteaux associés sont :</strong><br>"
    result.innerHTML += "<ul class'codesPostaux'>"
    for (const codePostal of data[0].codesPostaux) {
        result.innerHTML += "<li>" + codePostal + " </li>"
    }
    result.innerHTML += "</ul>"

})
    .catch((error) => console.log(error))