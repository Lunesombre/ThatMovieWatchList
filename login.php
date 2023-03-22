<?php
$title="Se connecter";

session_start();
$_SESSION['isConnected']=false;
require_once 'classes/ConnexionMessages.php';
require_once __DIR__ . '/layout/header.php';


?>
<div class="background container-fluid d-flex flex-column justify-content-center">
    <?php if (array_key_exists('msg', $_GET)) { ?>
        <div class="alert alert-danger mx-auto alert-dismissible fade show">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>
        </div>
    <?php } ?>
    <div class="d-flex flex-column border border-3 rounded-4 my-2 mx-auto p-2 bg-secondary">
        <h1 class="mx-auto">Connexion</h1>
        <div>
            <form action="auth.php" method="POST">
                <input class="d-block mx-auto" type="text" name="userNickname" id="userNickname" placeholder=" Votre pseudo">
                <br />
                <input class="d-block mx-auto" type="password" name="password" id="password" placeholder=" Votre mot de passe">
                <br />
                <input class="d-block mx-auto" type="submit" value="Log in">
            </form>
        </div>
    </div>
</div>



<!-- <div id="underConstruction"></div> -->



<?php
require_once __DIR__. '/layout/footer.php';