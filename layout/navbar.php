<nav class="navbar navbar-expand-lg bg-dark px-2">
    <a class="navbar-brand" href="index.php">
        <img src="./assets/img/TMWL_logo_v1.png" alt="Logo TMWL" width="100" class="rounded-5">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav d-flex justify-content-evenly col-6">
            <li class="nav-item">
                <a class="nav-link active text-bg-dark" aria-current="page" href="index.php">Homepage</a>
            </li>
            <li class="nav-item">
                <?php
                // echo '<a class="nav-link text-bg-dark" ';
                if ($_SESSION['isConnected'] === true) {
                    echo "<button class='nav-link text-bg-dark'>
                    <a  class='text-bg-dark text-decoration-none' href='../ThatMovieWatchList/logout.php'>Me déconnecter</a>
                    </button>";
                } else {
                    // echo "href='../ThatMovieWatchList/login.php'>Connexion</a>";
                    require_once __DIR__.'/connexionModal.php';
                    echo " <button class='nav-link text-bg-dark' data-bs-toggle='modal' data-bs-target='#Modale_connexion'>
                        Connexion
                    </button>";
                } ?>
            </li>
            <?php 
            if ($_SESSION['isConnected']=== false){
                echo '<li class="nav-item">
                <a class="nav-link text-bg-dark" href="register.php">S\'enregistrer</a>
                </li>';
            }
            if ($_SESSION['isConnected']){
                echo '<li class="nav-item">
                <a class="nav-link text-bg-dark" href="dashboard.php">Mon profil</a>
                </li>';
            }
            ?>
            <li class="nav-item">
                <a class="nav-link text-bg-dark" href="movies.php">Parcourir les films</a>
            </li>
        </ul>
        <form class="form-inline d-flex col-4" role="search">
            <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
            <button class="btn btn-outline-success me-2" type="submit">Ok</button>
        </form>
    </div>
</nav>


