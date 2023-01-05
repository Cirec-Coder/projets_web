<?php
    // permet le chargement automatique des Classes utiles au code
    spl_autoload_register(function ($class_name) {
        include '../lib/class_' . $class_name . '.php';
    });


$tit1 = new Titulaire("Marc", "Durant", "1960-10-26", "Paris");
$compt1 = new Compte($tit1, Compte::COMPTE_COURANT, 2000, "€");
$compt1 = new Compte($tit1, Compte::COMPTE_LIVRET_A, 8000, "€");
$compt1 = new Compte($tit1, Compte::COMPTE_PRO, 200000, "€");

$tit1->getInfos();

$tit2 = new Titulaire("Michelle", "Grognon", "1954-02-29", "Mulhouse");
$compt2 = new Compte($tit2, Compte::COMPTE_COURANT, 1250, "€");
$compt2 = new Compte($tit2, Compte::COMPTE_LIVRET_A, 50, "€");
$compt2 = new Compte($tit2, Compte::COMPTE_PRO, 2000, "€");

$tit2->getInfos();
$tit2->virementInterne(Compte::COMPTE_PRO, Compte::COMPTE_LIVRET_A, 250);
$tit2->getInfosCompte(Compte::COMPTE_LIVRET_A);
$tit2->getInfosCompte(Compte::COMPTE_PRO);

$montant = 598;
echo "<b>Crédite le compte : </b>".Compte::COMPTE_COURANT." <b>de</b> ".$tit1->getNomPremon()." <b>de</b> $montant <b>€</b><br>";
$tit1->getCompte(Compte::COMPTE_COURANT)->setAmount($montant);
$tit1->getInfosCompte(Compte::COMPTE_COURANT);

$tit1->getInfos();
$tit1->virementInterne(Compte::COMPTE_COURANT, Compte::COMPTE_LIVRET_A, 3500);
$tit1->getInfosCompte(Compte::COMPTE_LIVRET_A);
$tit1->getInfosCompte(Compte::COMPTE_COURANT);

?>