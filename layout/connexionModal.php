<!-- Modal -->
<div class="modal fade " id="Modale_connexion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Modale_connexion_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content d-flex flex-column rounded-4 my-2 mx-auto p-2 bg-dark text-light">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="Modale_connexion_label">Connexion</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
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
</div>