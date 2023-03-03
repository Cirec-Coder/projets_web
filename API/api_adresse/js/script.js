

const dataList = document.getElementById('json-datalist');
const input = document.getElementById('address');
const btn = document.querySelector('button')

const map = L.map('map').setView([48.833, 2.333], 15);
const osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors Cirec 2023',
    maxZoom: 19
});

map.addLayer(osmLayer);

// crée un marker
const marker = L.marker([0, 0])
// le place sur la carte au point 0, 0 
// et on le déplacera en fonction de l'adresse choise
marker.addTo(map)


// click sur bouton "Localiser"
btn.addEventListener('click', function () {
    setMarker()
})

input.addEventListener('keyup', function (e) {
    // si on a plus de 3 caractères 
    if (this.value.length > 3) {
    // vide la liste
    dataList.innerHTML = ""
        // on commence la recherche
        fetch("https://api-adresse.data.gouv.fr/search/?q=" + this.value.replace(/ /g, '%20') + "&type=housenumber&autocomplete=1")
            .then((response) => response.json())
            .then((data) => {
                // console.log(data)// output will be the required data

                //  pour chaque résultat
                data.features.forEach(function (item) {
                    // crée un nouvel élément <option>.
                    var option = document.createElement('option');
                    // lui donne la valeur de item.properties.label.
                    option.value = item.properties.label;
                    // et on passe les coordonées dans le innerHTML pour les récupérer
                    // dans la fonction setMarker()
                    option.innerHTML = 'lat:' + item.geometry.coordinates[1] + ' long:' + item.geometry.coordinates[0];
                    // et on l'ajoute à la site de sélection
                    dataList.appendChild(option);
                })

                if (e.key === 'Enter') {
                    btn.click()
                }
            })
            .catch((error) => console.log(error))
    }

})

// Affiche le marker à la position de l'adresse choisie
function setMarker() {
    const option = dataList.querySelector('option')

    if (option !== null) {
        // récupère longitude & latitude
        let coords = option.innerHTML
        // extrait la longitude
        let long = coords.split('long:')[1].split(' ')[0]
        // extrait la latitude
        let lat = coords.split('lat:')[1].split(' ')[0]
        // si on a cliqué sur le bouton "Localiser" 
        // sans avoir fait un choix dans la liste
        // c'est le premier élément qui est utilisé 
        // et on met le input à jour avec la bonne adresse
        input.value = option.value
        // déplace la marker au bonnes coordonnées
        marker.setLatLng([lat, long])
        // ajoute un popup qui contient l'adresse choisie
        marker.bindPopup('<h4>' + input.value + '</h4><br>');
        // place la carte au centre 
        map.setView([lat, long], 15);
        // et on lui donne le focus
        document.querySelector('#map').focus()
    }
}


