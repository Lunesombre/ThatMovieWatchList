<?php
$title = "Register";
session_start();
require_once __DIR__ . '/classes/ConnexionMessages.php';
require_once __DIR__ . '/layout/header.php';

?>
<div class="background container-fluid d-flex flex-column">
    <?php if (array_key_exists('msg', $_GET)) { ?>
        <div class="alert alert-danger mx-auto alert-dismissible fade show mt-3">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>
        </div>
    <?php } ?>
    <div class="d-flex align-items-start">
        <div class="d-flex  p-5">
            <form action="userRegistrationManagment.php" method="POST" class="register_form row py-2 gx-1 justify-content-center">
                <div class="col-4 form-floating mb-2 px-1">
                    <input type="text" name="nom" class="form-control" id="nom" placeholder="Votre nom" required>
                    <label for="nom" class="form-label">Votre nom</label>
                </div>
                <div class="col-4 form-floating mb-2 px-1">
                    <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Votre prénom" required>
                    <label for="prenom" class="form-label">Votre prénom</label>
                </div>
                <br>
                <div class="col-4 form-floating mb-2 px-1">
                    <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Votre pseudo" required>
                    <label for="pseudo" class="form-label">Votre pseudo</label>
                </div>
                <div class="col-4 form-floating mb-2 px-1">
                    <input type="date" name="birthdate" class="form-control" id="birthdate" placeholder="Votre date de naissance" required>
                    <label for="birthdate" class="form-label">Votre date de naissance</label>
                </div>
                <br>
                <div class="col-4 form-floating mb-2 px-1">
                    <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com" required>
                    <label for="email" class="form-label">Votre adresse mail</label>
                </div>
                <div class="col-4 form-floating mb-2 px-1">
                    <input type="password" name="password" class="form-control" id="password" placeholder="votre mot de passe" required>
                    <label for="password " class="form-label">Votre mot de passe</label>
                </div>
                <br>
                <div class="col-8 form-floating pt-1 px-1">
                    <input name="picture" class="form-control mb-2" type="file" id="picture">
                    <label for="picture" class="form-label " placeholder="image de profil">Choisissez votre image de profil</label>
                </div>
                <div class="col-8 text-end px-1">
                    <button type="submit" class="col-2 btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>

</div>