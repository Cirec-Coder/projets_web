const cards = document.querySelector('#cards')
const imgUrl = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/%s%.png"
const nbPokemon = 25

const cardPrototype = '<div class="col"><div class="card h-100" style="background:%bkColor%;text-shadow: 1px 1px 2px #ffffffc8, -1px 1px .5rem %iconColor%78, 1px -1px .5rem %iconColor%78, -1px -1px .5rem %iconColor%78;border: 8px double %iconColor%;"><div class="card-header text-center bg-secondary bg-opacity-25"><span class=" pt-3 p-0">#%id%</span><h4 class="card-title p-0 m-0 pb-3">%title%</h4><div class="icon p-0" style="box-shadow: 0 0 20px %iconColor%;border: 8px double %iconColor%;"><img src="icons/%type%.svg"></div><div class="pt-3"><h6 class="fw-bold">%type%</h6></div></div><img src="%imgUrl%" class="card-img-top" alt=""></div></div>'

const pokeStyle = {
    "grass": { bkColor: "#78c850aa", iconColor: "#007f00" },
    "fire": { bkColor: "#f08030aa", iconColor: "#7f0000" },
    "electric": { bkColor: "#f8d030aa", iconColor: "#8f781d" },
    "water": { bkColor: "#7090f0aa", iconColor: "#0000ff" },
    "bug": { bkColor: "#a8b820aa", iconColor: "#474e0e" },
    "ground": { bkColor: "#e0c068aa", iconColor: "#a52a2a" },
    "normal": { bkColor: "#a8a878aa", iconColor: "#4a4a35" },
    "poison": { bkColor: "#a040a0aa", iconColor: "#4a1d4a" },
    "fighting": { bkColor: "#c03028aa", iconColor: "#591613" },
    "fairy": { bkColor: "#FBADFFaa", iconColor: "#724f74" },
    "psychic": { bkColor: "#f85888aa", iconColor: "#7e2d45" },
    "rock": { bkColor: "#b8a038aa", iconColor: "#5d511d" },
    "ghost": { bkColor: "#705898aa", iconColor: "#332844" },
    "dark": { bkColor: "#705848aa", iconColor: "#43342b" },
    "ice": { bkColor: "#98d8d8aa", iconColor: "#3a5151" },
    "steel": { bkColor: "#b8b8d0aa", iconColor: "#3d3d4f" },
    "dragon": { bkColor: "#7038f8aa", iconColor: "#2a155b" },

};
let card, typename
for (let i = 1; i <= nbPokemon; i++) {
    fetch("https://pokeapi.co/api/v2/pokemon/" + i)
        .then((response) => response.json())
        .then((data) => {//console.log(data)

            card = cardPrototype.replace("%imgUrl%", data.sprites.front_default)
            card = card.replace("%title%", data.name)
            card = card.replace("%id%", data.id)
            typename = data.types[0].type.name
            // utilisation d'une REGEX qui permet de remplacer plusieurs occurences
            // grâce à l'indicateur "g" (pour global)
            card = card.replace(/%type%/g, typename)
            card = card.replace(/%bkColor%/g, pokeStyle[typename].bkColor)
            card = card.replace(/%iconColor%/g, pokeStyle[typename].iconColor)
            cards.innerHTML += card

        })
        .catch((error) => console.log(error))
}


