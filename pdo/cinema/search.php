<div class="container" id="search-container">
    <form action="traitement.php" method="post">
        <!-- // récupère une chaine de caractères pour effectuer une recherche -->
        <label for="search">Rechercher un Film par Nom:</label><br>
        <input type="search" name="q" id="search" placeholder='Batman' required>
        <button type="submit" name="action" class="action" value="search">Rechercher </button>
    </form>
</div>