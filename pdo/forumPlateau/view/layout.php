<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge; charset=UTF-8">
    <!-- <meta http-equiv="content-type" content="text/css"> -->
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" /> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="public/css/style.css" content="text/css; charset=UTF-8">

    <title>FORUM</title>
</head>

<body>

    <div id="wrapper">

        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message-error message"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message-success message"><?= App\Session::getFlash("success") ?></h3>
            <header>
                <h2>Bienvenue sur Forum CDA</h2>
                <nav>
                    <div id="nav-left">
                        <!-- <a href="index.php">Accueil</a> -->
                        <!-- Admin -->

                        <?php
                        if (App\Session::isAdmin()) {
                        ?>
                            <a href="index.php?ctrl=home&action=users">Voir la liste des membres</a>

                        <?php
                        }
                        ?>
                    </div>
                    <div id="nav-right">
                        <a href="index.php">Accueil</a>
                        <?php

                        if (App\Session::getUser()) {
                            $role = (App\Session::getUser()->getFrendlyRoleName() == "Administrateur") ? "-graduate" : "";
                        ?>
                            <a href="index.php?ctrl=security&action=profileForm&id=<?= App\Session::getUser()->getId() ?>"><span class="fas fa-user<?= $role ?>"></span>&nbsp;<?= App\Session::getUser() ?></a>
                            <!-- <a class="deco-btn" href="index.php?ctrl=security&action=logoutForm">déconnexion</a> -->
                            <a class="deco-btn" href="index.php?ctrl=security&action=logout">déconnexion</a>
                            <a href="index.php?ctrl=forum&action=listTopics">la liste des sujets</a>
                        <?php
                        } else {
                        ?>
                            <a href="index.php?ctrl=security&action=loginForm">Connexion</a>
                            <a href="index.php?ctrl=security&action=registerForm">Inscription</a>
                            <a href="index.php?ctrl=forum&action=listTopics">la liste des sujets</a>
                        <?php
                        }


                        ?>
                    </div>
                </nav>
            </header>

            <main id="forum">
                <h1><?= (isset($title)) ? $title : "" ?><small><?= (isset($subTitle)) ? $subTitle : "" ?></small></h1>
                <?= $page ?>
            </main>
        </div>


        <footer>
            <p>&copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $(".message").each(function() {
                if ($(this).text().length > 0) {
                    $(this).slideDown(1500, function() {
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function() {
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            $(".deco-btn").on("click", function() {
                return confirm("Etes-vous sûr de vouloir vous déconnecter ?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })



        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/


        function goBack() {
            history.back();
        }
    </script>
</body>

</html>