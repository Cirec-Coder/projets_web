SELECT v.plaque, v.model, m.nom 
FROM voiture v, marque m
WHERE m.id_marque = v.marque_id 
AND  m.pays = 'France';

SELECT m.nom, count(m.nom) AS nb_voiture 
FROM voiture v, marque m 
WHERE m.id_marque = v.marque_id 
GROUP BY m.nom
ORDER BY nb_voiture DESC;

SELECT m.`type`, count(m.`type`) AS nb_voiture 
FROM voiture v, motorisation m 
WHERE m.id_motorisation = v.motorisation_id 
GROUP BY m.`type`
ORDER BY nb_voiture DESC;


SELECT m.pays, count(m.pays) AS nb_voiture 
FROM voiture v, marque m 
WHERE m.id_marque = v.marque_id 
GROUP BY m.pays
ORDER BY nb_voiture DESC;



SELECT v.plaque
FROM voiture v, couleur c, habillage h
WHERE v.id_voiture = h.voiture_id
AND h.couleur_id = c.id_couleur 
AND c.nom IN ("rouge", "gris") 
GROUP BY v.id_voiture
HAVING COUNT(c.id_couleur) = 2;

SELECT v.plaque
FROM voiture v, couleur c, habillage h
WHERE v.id_voiture = h.voiture_id
AND h.couleur_id = c.id_couleur
AND c.nom = 'rouge'
AND v.id_voiture IN (
	SELECT v.id_voiture
	FROM voiture v, couleur c, habillage h
	WHERE v.id_voiture = h.voiture_id
	AND h.couleur_id = c.id_couleur
	AND c.nom = 'gris'
	
)

SELECT *
FROM voiture v, marque m, motorisation mot
WHERE mot.id_motorisation = v.motorisation_id
AND m.id_marque = v.marque_id 
AND mot.`type` = 'essence'
AND m.pays = 'Allemagne';
