<?php
$title="Accueil";
require_once __DIR__. '/classes/ConnexionMessages.php';
session_start();
if (!isset($_SESSION['isConnected']))
{
    $_SESSION['isConnected']=false;
}
require_once __DIR__ . '/layout/header.php';
?>


    
    
<div class="background container-fluid d-flex flex-column justify-content-center">
    <?php if (array_key_exists('msg', $_GET)) { ?>
        <div class="alert alert-success my-1 mx-auto" role="alert">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>
        </div>
    <?php } ?>
    <div class="d-flex flex-column my-auto">
        <h2 class="mx-auto">Cette page est en construction</h2>
        <p class="mx-auto">Repassez plus tard !</p>
    </div>
</div>


<?php
var_dump($_SESSION);
require_once __DIR__. '/layout/footer.php';