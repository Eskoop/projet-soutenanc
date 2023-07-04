<?php
// La connexion
require_once 'init.inc.php';

?>
<header class="sticky-top">
    <nav class="navbar">
        <!-- Logo et titre -->
        <div class="logo">
            <img src="asset/img/Logo_finale_Detourer4.png" alt="">
            <h1 class=""><a href="Home.php">TENGOKU</a></h1>
        </div>
        <!-- Page Admin -->
        <div class="btn-admin">
            <?php if (estConnecte() && estAdmin())
                echo '<a href="crud/index.php" class="btn btn-outline-info admin">Page Admin</a>';
            ?>
        </div>
        <div class="nav-links d-flex flex-sm-column flex-column flex-md-column flex-lg-row flex-xl-row">


            <!-- Barre de recherche -->
            <form action="recherche.php" method="GET" class="form-inline w-sm-50 w-md-75 w-lg-100 w-50">
                <input class="form-control " type="search" name="recherche" placeholder="Recherche" aria-label="Search">
            </form>

            <ul>
                <li>
                    <a href="Home.php">Accueil</a>
                </li>

                <li>
                    <a href="mangas.php">Manga</a>
                </li>
                <li>
                    <a href="actu.php">Actu</a>
                </li>
                <li>
                    <a href="goodies.php">Goodies</a>
                </li>
                <!-- On demande si il est connecté et si il est connecté les deux li "inscription et connexion seront remplacer par profil -->
                <?php if (!estConnecte()) { ?>
                    <li>
                        <a href="inscription.php">Inscription</a>
                    </li>
                    <li>
                        <a href="connexion.php">Connexion</a>
                    </li>


                <?php } else {  ?>
                    <li>
                        <a href="profil.php">Profil</a>

                    </li>
                <?php  } ?>

                <li class="li-panier">
                    <p class="text   p-1  n-panier"><?php echo array_sum($_SESSION['panier']) ?></p>
                    <a href="panier.php" class="panier pt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-basket-fill" viewBox="0 0 16 16">
                            <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <img src="asset/img/nav/list.svg" alt="menu-hamburger" class="menu-hamburger">
    </nav>
</header>

<!-- <script>
    const menuHamburger = document.querySelector(".menu-profil")
    const navLinks = document.querySelector(".nav-links")

    menuHamburger.addEventListener('click', () => {
        navLinks.classList.toggle('mobile-menu')
    })
</script> -->