
// une fois le document chargé le code js entre en fonction.
window.addEventListener('load', function () {

    // ************************ Changement de thème******************************************************


    const mainContainer = document.getElementById("mainContainer");
    const btnToggleTheme = document.getElementById("toggleTheme");
    // gestion du changement de thème
    btnToggleTheme.addEventListener("click", () => {

        mainContainer.classList.toggle("light-mode");
        mainContainer.classList.toggle("dark-mode");
    })

    // *******************************************************************************************************


    // fonction commune qui fait la bascule des états (play, pause, playing)
    function togglePlayMode(element, eventKind) {
        element.classList.toggle("playing");
        // console.log(element, element.nextElementSibling.getElementsByTagName('source')[0].type.startsWith('audio'));
        // si on est en présence d'un élément "audio"
        if (element.nextElementSibling.getElementsByTagName('source')[0].type.startsWith('audio')) {
            element.classList.toggle("fa-music");
        }
        else
            element.classList.toggle("fa-play");
        element.classList.toggle("fa-pause");
    }

    const medias = Array.from(document.querySelectorAll(".media"));

    function stopPlayingMedias() {
        $(medias).each((e) => {
            if (medias[e].tagName !== "IMG") {
                medias[e].pause();
            }
        })
    }


    function checkPlayMode(resetAll = false) {
        let allPlayableMedias = Array.from(allVideos);
        allPlayableMedias = allPlayableMedias.concat(Array.from(allAudios));
        allPlayableMedias.forEach(media => {
            const elem = media.querySelector('i');
            const video = media.querySelector('video');
            const bRect = video.getBoundingClientRect();
            if (elem.classList.contains('playing')) {
                if ((bRect.y + bRect.height < 0 || bRect.y > window.innerHeight) || resetAll) video.pause();
            }
        })
    }

    document.addEventListener('scroll', () => {
        checkPlayMode();
    });

    medias.forEach((elem) => {
        // ajoute des actions aux événements: 
        // click, ended (la lecture du média est arrivée à sa fin), pause des médias
        elem.addEventListener("click", (e) => {
            let icon = e.target.parentElement.querySelector('i');
            if (!e.target.paused) {
                e.target.pause();
            }
            else {
                checkPlayMode(true);
                e.target.play();
                togglePlayMode(icon, 'play');
            }
        })

        // elem.addEventListener("ended", (e) => {
        //     let icon = e.target.parentElement.querySelector('i');
        //     togglePlayMode(icon, 'ended');
        // })

        elem.addEventListener("pause", (e) => {
            let icon = e.target.parentElement.querySelector('i');
            togglePlayMode(icon, 'pause');
        })
    });


    //************************* gestion des accordéons ************************************
    const acc = document.getElementsByClassName("accordion");
    for (let i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    };



    let id1 = null, id2 = null;
    // fonction qui permet de faire bouger l'image de fond
    //@@ elem: l'élément ciblé
    //@@ id: id du setInterval lié à l'élément ciblé
    //@@ imgWidth: largeur de l'image à faire défiler
    function myMove(elem, id, imgWidth) {
        var pos = parseInt(getComputedStyle(elem).getPropertyValue("background-position-x"));
        clearInterval(id);
        id = setInterval(frame, 20);
        function frame() {
            if (pos == -imgWidth) {
                pos = 0;
            } else {
                pos -= .5;
                elem.style.setProperty("background-position-x", pos + 'px');
            }
        }
        return id;
    }



    // *********************** Défillement du font au pasage de la souris Section Main Header *******************************    
    const mainHeader = document.querySelector(".main_header");
    // ajoute un évenement à l'entré du pointeur et déclanche
    // l'animation du fond
    mainHeader.addEventListener("pointerenter", e => {
        id1 = myMove(mainHeader, id1, 1985)
    }
    );
    // stop l'animation à la sortie du pointeur
    mainHeader.addEventListener("pointerleave", e => {
        clearInterval(id1)
    }
    );


    // *********************** Défillement du font au pasage de la souris Section New Horizon *******************************    
    // const newHorizons = document.querySelector(".new_horizons");
    // newHorizons.addEventListener("pointerenter", e => {
    //     id2 = myMove(newHorizons, id2, 2042)
    // }
    // );
    // newHorizons.addEventListener("pointerleave", e => {
    //     clearInterval(id2)
    // }
    // );


    // ajoute un effet de couleur sur tous les bouttons 
    // quand: 
    // - le pointeur entre
    // - le pointeur sort
    // - et au click
    const buttons = document.querySelectorAll("[class*=btn_");
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("pointerenter", function () {

            this.style.cursor = "pointer";

            let color1 = getComputedStyle(this).getPropertyValue("color");
            let color2 = getComputedStyle(this).getPropertyValue("background-color");

            if (color2.startsWith('rgba')) {
                color2 = color2.replace('rgba', 'rgb');
                color2 = color2.replace(', 0)', ')');
            }
            this.style.backgroundColor = color1;
            this.style.color = color2;
            this.style.transition = "all 0.5s";
        });

        buttons[i].addEventListener("pointerleave", function () {
            this.style.backgroundColor = '';
            this.style.color = '';
        })

        buttons[i].addEventListener("pointerdown", function () {
            let rgbCol = w3color(getComputedStyle(this).getPropertyValue("background-color"));
            rgbCol.darker(10);
            this.style.backgroundColor = rgbCol.toHexString();
        })

        buttons[i].addEventListener("pointerup", function () {
            let rgbCol = w3color(getComputedStyle(this).getPropertyValue("background-color"));
            rgbCol.lighter(10);
            this.style.backgroundColor = rgbCol.toHexString();
        })
    }

    const navbar = document.querySelector(".navBar")
    const navbarItems = document.querySelectorAll(".navBar_item")

    for (let i = 0; i < navbarItems.length; i++) {
        navbarItems[i].addEventListener("click", e => {
            navbar.classList.toggle('show-nav')
        })

    }

    //******************************* Activation du menu burger *************************
    function toggleMenu() {
        const burger = document.querySelector(".burger")
        burger.addEventListener('click', () => {
            navbar.classList.toggle('show-nav')
        })
    }
    toggleMenu();


    // ********************************* Gestions de l'affichage des Médias *********************************************************

    // renvoie un tableau mélangé de taille num 
    function array_rand(array, num = array.length) { // eslint-disable-line camelcase
        //       discuss at: https://locutus.io/php/array_rand/
        //      original by: Waldo Malqui Silva (https://waldo.malqui.info)
        // reimplemented by: RafaÅ‚ Kukawski
        //        example 1: array_rand( ['Kevin'], 1 )
        //        returns 1: '0'
        // By using Object.keys we support both, arrays and objects
        // which phpjs wants to support
        const keys = Object.keys(array)
        if (typeof num === 'undefined' || num === null) {
            num = 1
        } else {
            num = +num
        }
        if (isNaN(num) || num < 1 || num > keys.length) {
            return null
        }
        // shuffle the array of keys
        for (let i = keys.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1)) // 0 â‰¤ j â‰¤ i
            const tmp = keys[j]
            keys[j] = keys[i]
            keys[i] = tmp
        }
        // modifications pour qu'il renvoie le tableau mélangé à la place des index
        let nKeys = num === 1 ? keys[0] : keys.slice(0, num)
        let nArray = [];
        for (let i = 0; i < nKeys.length; i++) {
            nArray[i] = array[nKeys[i]];

        }
        return nArray
    }


    // Affichage des vignettes (image video & audio)
    const btnLoadMore = document.querySelector('.btn_load_more');
    // tous les médias
    let divMedias = document.querySelectorAll('.div_media');
    // toutes les vidéos
    const allVideos = document.querySelectorAll('.div_media.video');
    // toute les Images
    const allImages = document.querySelectorAll('.div_media.image');
    // tous les Audios
    const allAudios = document.querySelectorAll('.div_media.audio');

    // Mélange le tableau
    divMedias = array_rand(divMedias);

    // permet le positionnement des vignettes en absolue (left: 0, 25%, 50%, 75%) (top: 0, 50%)
    function rebuildMediaPositions(arrayOfMedia, refreshClassList = false) {
        let posX = 25, posY = 50, row, col;
        arrayOfMedia.forEach((media, index) => {
            if (refreshClassList) { // remet la liste des classes à l'état initiale 
                if (index < 8) {
                    media.classList.remove('is-inactive');
                    media.style.display = 'block';
                }
                else {
                    media.classList.add('is-inactive');
                    media.style.display = 'none';
                }
            }
            row = (index % 4);
            col = (Math.floor(index / 4) % 2);
            media.style.setProperty('left', posX * row + "%");
            media.style.setProperty('top', posY * col + "%");
        });
        return arrayOfMedia;
    }

    // initiatise les positions de chaque vignettes 
    divMedias = rebuildMediaPositions(divMedias, true);

    // liste des média actif
    let currentActives = Array.from(divMedias).filter(divMedia => !divMedia.classList.contains('is-inactive'));
    let nextActives = Array.from(allImages).filter(allImage => allImage.classList.contains('is-inactive'));


    // réduit la liste à 8 éléments max
    nextActives.splice(8, 50);


    // construit le tableau des 8 vignettes à "éffacer" 
    // + les 8 à afficher
    function buildAnimatedSet() {
        let refreshClassList = false;
        // récupère les 8 à l'écran
        currentActives = Array.from(divMedias).filter(divMedia => !divMedia.classList.contains('is-inactive'));
        // récupère les éléments suivants à afficher
        nextActives = currentActiveSet.filter(divMedia => divMedia.classList.contains('is-inactive'));
        if (nextActives.length < 8 && currentActiveSet.length >= 8) {
            // si on arrive ici c'est qu'une partie des éléments est déjà à l'écran
            // on les incluent
            nextActives = currentActiveSet;
            // et on indique qu'il faudra mettre la classList à jour
            refreshClassList = true;
        }
        // mise à jour des positions & classList
        nextActives = rebuildMediaPositions(nextActives, refreshClassList);
        // on les limite à 8
        nextActives.splice(8, 50);
        // retire les 8 sélectionnés de la liste courante
        let deleted = currentActiveSet.splice(0, 8);
        // pour les placer à la fin
        // ce qui permet un affichage circulaire
        currentActiveSet = currentActiveSet.concat(deleted);

        // assemble et renvoi le tableau
        if (nextActives.length > 0) {
            nextActives = nextActives.concat(currentActives);
        }
        return nextActives;
    }

    // liste des Média actifs
    let currentActiveSet = Array.from(divMedias);

    function doAnimate(animatedSet) {
        stopPlayingMedias();
        $(animatedSet).animate({
            opacity: 'toggle',
        }, {
            duration: 2000
        });
        // inverse l'état de la classList avec une bascule (toggle)
        // à la fin des animations grâce à une temporisation 
        setTimeout(() => {
            for (let i = 0; i < animatedSet.length; i++) {
                animatedSet[i].classList.toggle('is-inactive');
            }
        }, 2000);


    }

    // ******************************** gestion du click sur le bouton "Load More" ************
    btnLoadMore.addEventListener('click', e => {
        doAnimate(buildAnimatedSet());
    })


    // ******************************** gestion des items de la media navbar ******************
    const mediaNavbarItems = document.querySelectorAll(".media_navbar_item button");
    mediaNavbarItems.forEach(item => {
        // désactive le bouton précédement cliqué
        item.addEventListener("click", () => {
            mediaNavbarItems.forEach(mediaItem => {
                mediaItem.classList.remove('active');
            });
            // active le bouton cliqué
            item.classList.add('active');
            switch (true) {
                case item.innerText === 'ALL':
                    // tous les Médias sont actifs
                    currentActiveSet = Array.from(divMedias);
                    break;

                case item.innerText === 'VIDÉO':
                    // toutes les Videos sont actives
                    currentActiveSet = Array.from(allVideos);
                    break;

                case item.innerText === 'AUDIO':
                    // tous les Audios sont actifs
                    currentActiveSet = Array.from(allAudios);
                    break;

                case item.innerText === 'IMAGE':
                    // toutes les Images sont actives
                    currentActiveSet = Array.from(allImages);
                    break;

                default:
                    break;
            }
            doAnimate(buildAnimatedSet());
        })
    });


    // calcule la taille tu textArea du formulaire de contact
    // ainsi que les icones "play pause" des médias
    function ajustTextAreaSize() {
        // cible l'input de type "tel"
        const input = this.document.querySelector('#phone');
        // récupère sa hauteur
        const inputHeight = parseInt(getComputedStyle(input).getPropertyValue("height"));
        // sa marge du bas
        const marginBottom = parseInt(getComputedStyle(input).getPropertyValue("margin-bottom"));

        // cible le textArea à redimensioner
        const textArea = this.document.querySelector('#message');
        // récupère la hauteur de son label
        const labelHeight = parseInt(getComputedStyle(textArea.labels[0]).getPropertyValue("height"));
        // calcule la hauteur final
        textArea.style.setProperty("height", inputHeight * 2 + marginBottom + labelHeight + "px");


        // ajuste la taille des icones "Font Awsome" des div média 
        // 2 tière de la taille du parent dans tous les cas
        const mediaDivs = this.document.querySelectorAll('.div_media');
        const mediaDivHeight = parseInt(getComputedStyle(mediaDivs[0]).getPropertyValue("height")) * .66 + 'px';
        for (let i = 0; i < mediaDivs.length; i++) {
            let icon = mediaDivs[i].firstChild.nextElementSibling;
            // ne redimenssionne que les balise <i>
            if (icon.tagName == "I") {
                icon.style.setProperty("font-size", mediaDivHeight);
            }
        }

    }


    // on ajuste la taille une première fois
    ajustTextAreaSize();
    // puis à chaque redimensionnement 
    window.addEventListener('resize', e => {
        ajustTextAreaSize();
    });


});
