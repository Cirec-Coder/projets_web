<?php
    // permet le chargement automatique des Classes utiles au code
    spl_autoload_register(function ($class_name) {
        include 'class/'.$class_name . '.php';
    });


    include 'asset/populate.php';
/***************************************************************************************/
    function createRealSelectList(){
        $ret = '';
        // permet l'accès aux variable de type :
        global $real1, $real2, $real3, $real4, $real5, $real6;
        $ret .= '<option value="'.$real1->getPrenom().$real1->getNom().'">'.$real1->getPrenom()." ".$real1->getNom().'</option>';
        $ret .= '<option value="'.$real2->getPrenom().$real2->getNom().'">'.$real2->getPrenom()." ".$real2->getNom().'</option>';
        $ret .= '<option value="'.$real3->getPrenom().$real3->getNom().'">'.$real3->getPrenom()." ".$real3->getNom().'</option>';
        $ret .= '<option value="'.$real4->getPrenom().$real4->getNom().'">'.$real4->getPrenom()." ".$real4->getNom().'</option>';
        $ret .= '<option value="'.$real5->getPrenom().$real5->getNom().'">'.$real5->getPrenom()." ".$real5->getNom().'</option>';
        $ret .= '<option value="'.$real6->getPrenom().$real6->getNom().'">'.$real6->getPrenom()." ".$real6->getNom().'</option>';
        return $ret;
    }

    function createActorSelectList(){
        $ret = '';
        // permet l'accès aux variable de type :
        global $act1, $act2, $act3, $act4, $act5, $act6, $act7, $act8, $act9;
        $ret .= '<option value="'.$act1->getPrenom().$act1->getNom().'">'.$act1->getPrenom()." ".$act1->getNom().'</option>';
        $ret .= '<option value="'.$act2->getPrenom().$act2->getNom().'">'.$act2->getPrenom()." ".$act2->getNom().'</option>';
        $ret .= '<option value="'.$act3->getPrenom().$act3->getNom().'">'.$act3->getPrenom()." ".$act3->getNom().'</option>';
        $ret .= '<option value="'.$act4->getPrenom().$act4->getNom().'">'.$act4->getPrenom()." ".$act4->getNom().'</option>';
        $ret .= '<option value="'.$act5->getPrenom().$act5->getNom().'">'.$act5->getPrenom()." ".$act5->getNom().'</option>';
        $ret .= '<option value="'.$act6->getPrenom().$act6->getNom().'">'.$act6->getPrenom()." ".$act6->getNom().'</option>';
        $ret .= '<option value="'.$act7->getPrenom().$act7->getNom().'">'.$act7->getPrenom()." ".$act7->getNom().'</option>';
        $ret .= '<option value="'.$act8->getPrenom().$act8->getNom().'">'.$act8->getPrenom()." ".$act8->getNom().'</option>';
        $ret .= '<option value="'.$act9->getPrenom().$act9->getNom().'">'.$act9->getPrenom()." ".$act9->getNom().'</option>';
        return $ret;
    }

    function createRoleSelectList(){
        $ret = '';
        // permet l'accès aux variable de type :
        global $role1, $role2, $role3, $role4, $role5, $role6, $role7, $role8, $role9;
        $ret .= '<option value="'.$role1->getRoleName().'">'.$role1->getRoleName().'</option>';
        $ret .= '<option value="'.$role2->getRoleName().'">'.$role2->getRoleName().'</option>';
        $ret .= '<option value="'.$role3->getRoleName().'">'.$role3->getRoleName().'</option>';
        $ret .= '<option value="'.$role4->getRoleName().'">'.$role4->getRoleName().'</option>';
        $ret .= '<option value="'.$role5->getRoleName().'">'.$role5->getRoleName().'</option>';
        $ret .= '<option value="'.$role6->getRoleName().'">'.$role6->getRoleName().'</option>';
        $ret .= '<option value="'.$role7->getRoleName().'">'.$role7->getRoleName().'</option>';
        $ret .= '<option value="'.$role8->getRoleName().'">'.$role8->getRoleName().'</option>';
        $ret .= '<option value="'.$role9->getRoleName().'">'.$role9->getRoleName().'</option>';
        return $ret;
    }

    function createGenderSelectList(){
        $ret = '';
        foreach (Genre::ARRAY_OF_GENRE as $value) {
            $ret .= '<option value="'.$value.'">'.$value.'</option>';
        }
        return $ret;
    }

    function createFilmsSelectList(){
        $ret = '';
        global $films;
        foreach ($films as $idx => $value) {
            $ret .= '<option value="'.$idx.'">'.$value->getTitle().'</option>';
        }
        return $ret;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>POO Cinéthèque</title>
</head>
<body>
    <?php include_once "view/header.php" ?>
    <main>
<!-- =================================== Formulaire principale (aide à la pésentation) ========================================= -->

        <form class="form" action="recap.php" method="post">
        <div class="form-div" id="show_film_real">
            <!-- // voir les films d'un Realisateur -->
                <button type="submit" name="action" class="action" value="showFilmRealisateur" >Films réalisé par : </button>
            <select name="selectReal">
            <?php echo createRealSelectList() ?> 
            </select>
        </div>

        <div class="form-div" id="show_film_actor">
            <!-- // voir les films d'un Acteur -->
                <button type="submit" name="action" class="action" value="showFilmActeur" >Filmographie de : </button>
            <select name="selectActor">
            <?php echo createActorSelectList() ?> 
            </select>
        </div>

        <div class="form-div" id="show_actor_role">
            <!-- // voir les Acteurs ayant interpreté un rôle -->
                <button type="submit" name="action" class="action" value="showActeurRole" >Acteur(s) ayant joué le rôle de : </button>
            <select name="selectRole">
            <?php echo createRoleSelectList() ?> 
            </select>
        </div>

        <div class="form-div" id="show_by_gender">
            <!-- // voir les Films par Genre -->
                <button type="submit" name="action" class="action" value="showByGender" >Films de genre : </button>
            <select name="selectGender">
            <?php echo createGenderSelectList() ?> 
            </select>
        </div>

        <div class="form-div" id="show_film_casting">
            <!-- // voir le Casting d'un Film -->
                <button type="submit" name="action" class="action" value="showFilmCasting" >Casting du Film : </button>
            <select name="selectFilm">
            <?php echo createFilmsSelectList() ?> 
            </select>
        </div>

        </form>

    </main>
    <?php include_once "view/footer.php" ?>
</body>
</html>