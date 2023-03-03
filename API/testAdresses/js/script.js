// le bouton rechercher
const btn = document.querySelector('.btn');
// l'input de recherche et son label
const input = document.querySelector('input');
const lblName = document.querySelector('#lblName');
// la checkbox de sélection entre recherche par nom ou par id
const checkBox = document.querySelector('#byName');
// l'affichage du nombre de résultat
const results = document.querySelector('.results');
// conteneur pour l'affichage du résultat 
const cards = document.querySelector('#cards');

// définition d'un protoype de carte 
// utilisé par buildCards pour construire la vue 
const cardPrototype = '<div class="col"><div class="card h-100" ><div class="card-header text-center bg-secondary bg-opacity-25"><span class=" pt-3 p-0">#%id%</span></div><div class="card-body"><h4 class="card-title p-0 m-3 text-start">%prenom% %nom%</h4><h6 class="card-subtitle mx-3 text-muted text-start">%adresse% %ville%</h6><h6 class="pt-2 text-start mx-3"">%tel%</h6><div class="text-end mx-3"><span class="fs-3">%sex%</span></div></div></div></div>'

//  

//  définition des icones Homme & Femme
const sex = {homme: '<i class="text-male fa-solid fa-mars"></i>',
             femme: '<i class="text-female fa-solid fa-venus"></i>'}

// fonction qui recoit un tableau de données au format json
// place les données dans des card et les ajoute à la vue 
function buildCards(elements) {
    let card, i = 0;
    elements.forEach(e => {
        i++;
        card = cardPrototype.replace('%id%', e.id);
        card = card.replace('%prenom%', e.prenom);
        card = card.replace('%nom%', e.nom);
        card = card.replace('%adresse%', e.adresseClient);
        card = card.replace('%ville%', e.ville);
        card = card.replace('%tel%', e.tel);
        card = card.replace('%sex%', e.sex == 1 ? sex.homme : sex.femme);
        // card = card.replace('%sex%', e.sex == 1 ? "Homme" : "Femme");
        cards.innerHTML += card;
    })

    if (i > 1) {
        results.innerHTML = i + " Résultats"
    } else
    results.innerHTML = i + " Résultat"
}

btn.addEventListener('click', function () {

    if (checkBox.checked) {
        // si la checkbox est cochée alors on recherche par nom
        listeDeNoms = generation(["https://127.0.0.1:8000/api/adresses/nom/" + document.querySelector('input').value])
    } else {
        // sinon par id
        const id = parseInt(document.querySelector('input').value)
        if (isNaN(id)) {
            // si id n'est pas un nombre valide ou vide on renvoie la liste complète
            listeDeNoms = generation(["https://127.0.0.1:8000/api/adresses/"])
        } else
            // sinon on renvoie l'id demandé
            listeDeNoms = generation(["https://127.0.0.1:8000/api/adresses/" + id])
    }
    // traitement du résultat de la requete
    listeDeNoms.then(noms => {
        if (noms[0] === "404") {
            // si pas trouvé on affiche un message
            new bootstrap.Toast(document.getElementById('liveToastMessage')).show()
        } else {
            // si on arrive ici c'est qu'on a au moins 1 résultat
            // alors on efface le précédent affichage
            cards.innerHTML = "";
            if (noms[0].length > 0) {
                // si on est en présence de plusieurs résultats (un tableau)                
                noms.forEach(element => {
                    // on boucle sur chaque éléments
                    buildCards(element);
                });
            } else {
                buildCards(noms);
            }
        }
    });
});


// getion des demandes en mode asynchrone avec promesse de réponse 
//
// création d'une fonction de génération d'une Promise d'un JSON en y entrant un tableau d'URL
// rappel : une promise en js permet de réaliser des traitements de façon asynchrone. 
// Une promesse représente une valeur qui peut être disponible maintenant, dans le futur voir jamais
// les "await" sont justement du à la fonction qui est async
async function generation(urls) {

    const noms = await Promise.all(urls.map(async url => {
        const resp = await fetch(url);
        if (resp.ok) {
            // si ok on revoie le json
            return resp.json();
        }
        // sinon on renvoie le status (404)
        return JSON.stringify(resp.status, null);
    }));
    return noms;
}


// pour plus de confort quand tape sur "Enter" après la saisie
// on déclenche la recherche
input.addEventListener('keyup', function (e) {
    if (e.key === 'Enter') {
        btn.click();
    }
})


// gestion du click sur la checkbox
// et adapte l'affichage en fonction du choix
checkBox.addEventListener('click', function () {
    if (this.checked) {
        lblName.innerHTML = "Recherche par Nom";
        input.placeholder = "Ex. br (affiche tous les noms commencant par br)";
    } else {
        lblName.innerHTML = "Recherche par id";
        input.placeholder = "Ex. 12 (affiche le nom qui correpond à l'id 12 -- vide: pour la liste complète)";
    }
})

