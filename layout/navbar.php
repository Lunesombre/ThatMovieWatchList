<nav class="navbar navbar-expand-lg bg-dark px-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="./assets/img/TMWL_logo_v1.png" alt="Logo TMWL" width="100" class="rounded-5">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav d-flex justify-content-evenly col-6">
                <li class="nav-item">
                    <a class="nav-link active text-bg-dark" aria-current="page" href="index.php">Homepage</a>
                </li>
                <li class="nav-item">
                    <?php 
                    echo '<a class="nav-link text-bg-dark" ';
                    if ($_SESSION['isConnected']=== true){
                        echo "href='../ThatMovieWatchList/logout.php'>Me déconnecter</a>";
                    } else {
                        echo "href='../ThatMovieWatchList/login.php'>Connexion</a>";
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-bg-dark" href="movies.php">Parcourir les films</a>
                </li>
            </ul>
            <form class="d-flex col-4" role="search">
                <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Ok</button>
            </form>
        </div>
    </div>
</nav>