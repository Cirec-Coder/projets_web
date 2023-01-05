<?php
// $head = "<h1>Ajoute un Post au Topic</h1>";

// use App\Session;

$id = $result["data"]['id'];
// $head = "<h1>".$result['data']['head']."</h1>";
$title = $result['data']['title'];
$divTitle = $result['data']['divTitle'];
$isAdd = $result['data']['add'];
$messageId = null;
if (!$isAdd) {
  $messageId = $result['data']['messageId'];
  $message = $result['data']['message'];
} else $message = "";
// var_dump($result["data"]);
// $currentUser = Session::getUser();
// $isOwner = ($currentUser && $currentUser->getPseudo() == $topic->getUser()->getPseudo());
?>
<div class="cards" id="msg-cards">
  <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>
  <form action="index.php?ctrl=forum&action=addPost" method="post" enctype="multipart">
    <!-- <label for="message">Message : </label><br> -->
    <h2> <?= $divTitle ?> <small></small></h2>
    <div class="group">
      <textarea name="message" cols="100" rows="10" required><?= $message ?></textarea>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Message</label>
    </div>
    <!-- <textarea name="message" id="message" cols="30" rows="10"></textarea><br> -->
    <input type="hidden" name="topicId" value=<?= $id ?>>
    <input type="hidden" name="messageId" value=<?= $messageId ?>>
    <input type="hidden" name="adding" value=<?= intval($isAdd) ?>>
    <button class="submit-btn" type="submit">valider</button>
  </form>
</div>