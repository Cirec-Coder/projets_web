-- liste acteur ayant joué dans 3 films ou plus 

SELECT ac.nom,ac.prenom
FROM acteur ac,casting c,film f
WHERE ac.acteur_id=c.acteur_id AND f.film_id=c.film_id
GROUP BY ac.nom,ac.prenom
HAVING COUNT(*)>=3;


SELECT  COUNT(ac.sexe) AS nb, if(ac.sexe='H','H','F') AS sex
FROM acteur ac
GROUP BY ac.sexe;


-- listes des films qui on moins de 5ans (du plus récent au plus ancien)

SELECT titre
FROM film f
WHERE DATEDIFF(NOW(),f.date_de_sortie) > 1825
ORDER BY date_de_sortie DESC;



-- listes des acteurs ayant plus de 50ans


SELECT nom,prenom
FROM acteur
WHERE YEAR(NOW())-YEAR (date_de_naissance)>50

-- infos d'un film (titre,année, durée) et réalisateur

SELECT titre,date_de_sortie,duree,nom,prenom
FROM film f,realisateur r
WHERE f.realisateur_id= r.realisateur_id;


-- Liste des films dont la durée exede 2h15 classé par durée (du plus long au plus court)

SELECT titre,duree
FROM film
WHERE duree>135
ORDER BY duree DESC;

-- liste des films d'un realisateur (en précisant l'annee de sortie)

SELECT titre,nom,prenom,date_de_sortie
FROM film f,realisateur r
WHERE f.realisateur_id=r.realisateur_id
AND nom = 'Chabat';

-- nombre de films par genre 

SELECT nom,COUNT(*)
FROM genre
GROUP BY nom;

-- nombres de films par realisateur (ordre décroissant)

SELECT nom,prenom,count(titre)
FROM realisateur r, film f
WHERE r.realisateur_id=f.realisateur_id
GROUP BY nom,prenom
ORDER BY nom,prenom DESC;

-- casting d'un film en particulier nom,prenom et sexe

SELECT ac.nom,ac.prenom,ac.sexe
FROM casting c, film f, acteur ac
WHERE c.film_id=f.film_id AND ac.acteur_id=c.acteur_id
AND titre='Intouchable';



-- films tournés par un acteur en particulier avec l'annee de sortie (du film du plus recent au plus ancien)


SELECT f.titre,ac.nom,ac.prenom,f.date_de_sortie
FROM film f,acteur ac, casting c
WHERE c.acteur_id=ac.acteur_id AND f.film_id=c.film_id
AND nom='Sy'
ORDER BY date_de_sortie DESC; 

-- listes des personnes qui sont a la fois acteur et realisateur


SELECT ac.nom,ac.prenom
FROM acteur ac ,realisateur r
WHERE  ac.nom = r.nom;


-- listes des films qui on moins de 5ans (du plus récent au plus ancien)

SELECT titre,date_de_sortie 
FROM film 
WHERE date_de_sortie DATEDIFF date_de_sortie <=5
ORDER BY date_de_sortie DESC;

-- nombres d'hommes et de femmes parmis les acteurs

SELECT  COUNT(ac.sexe) AS nb, if(ac.sexe='H','H','F') AS sex
FROM acteur ac
GROUP BY ac.sexe;


-- listes des acteurs ayant plus de 50ans

SELECT nom,prenom,date_de_naissance
FROM acteur
WHERE date_de_naissance <'1972-01-01';



