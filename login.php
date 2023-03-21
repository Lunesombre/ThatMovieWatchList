<?php
$title="Se connecter";

session_start();
$_SESSION['isConnected']=false;
require_once 'classes/ConnexionMessages.php';
require_once __DIR__ . '/layout/header.php';


?>

<h1>Connexion</h1>
<div>
    <form action="auth.php" method="POST">

        <input type="text" name="userNickname" id="userNickname" placeholder="Votre pseudo">
        <br />
        <input type="password" name="password" id="password" placeholder="votre mot de passe">
        <br />
        <input type="submit" value="Log in">
    </form>
</div>

<?php if (array_key_exists('msg', $_GET)) { ?>
    <div class="alert alert-danger">
        <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>
    </div>
<?php } ?>


<!-- <div id="underConstruction"></div> -->



<?php
require_once __DIR__. '/layout/footer.php';