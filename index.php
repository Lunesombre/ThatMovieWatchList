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

<?php if (array_key_exists('msg', $_GET)) { ?>
    <div class="alert alert-success d-flex mx-auto">
        <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>
    </div>
<?php } ?>
    
    
<div id="underConstruction"></div>

<?php
require_once __DIR__. '/layout/footer.php';