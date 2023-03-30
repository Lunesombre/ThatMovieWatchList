<nav class="navbar navbar-expand-lg bg-dark px-2">
    <a class="navbar-brand" href="index.php">
        <img src="./assets/img/TMWL_logo_v1.png" alt="Logo TMWL" width="100" class="rounded-5">
    </a>

    <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav d-flex justify-content-evenly col-6">
            <li class="nav-item">
                <a class="nav-link active text-bg-dark" aria-current="page" href="index.php">Homepage</a>
            </li>
            <li class="nav-item">
                <?php
                if ($_SESSION['isConnected'] === true) { ?>
                    <button class='nav-link text-bg-dark rounded-3'>
                        <a class='text-bg-dark text-decoration-none  ' href='./logout.php'>Me déconnecter</a>
                    </button>
                <?php } else {
                    require_once __DIR__ . '/connexionModal.php'; ?>
                    <button class='nav-link text-bg-dark rounded-3' data-bs-toggle='modal' data-bs-target='#Modale_connexion'>Connexion</button>
                <?php } ?>
            </li>
            <?php
            if ($_SESSION['isConnected'] === false) { ?>
                <li class="nav-item">
                    <a class="nav-link text-bg-dark" href="register.php">S'inscrire</a>
                </li>
            <?php }
            if ($_SESSION['isConnected']) { ?>
                <li class="nav-item">
                    <a class="nav-link text-bg-dark" href="dashboard.php">Mon profil</a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link text-bg-dark" href="movies.php">Parcourir les films</a>
            </li>
        </ul>
        <form class="form-inline d-flex col-4" role="search" method="GET" action="searchResults.php">
            <input class="form-control me-2" name="search" type="search" placeholder="Rechercher" aria-label="Search">
            <button class="btn btn-outline-success me-2" type="submit">Ok</button>
        </form>
    </div>
</nav>