<header>
    <nav class="navbar">
        <div class="logo">
            <img src="img/Logo_finale_Detourer4.png" alt="">
            <h1 class=""><a href="Home.php">TENGOKU</a></h1>
        </div>
        <div class="nav-links d-flex">
            <form class="form-inline w-100">
                <input class="form-control " type="search" placeholder="Recherche" aria-label="Search">
            </form>
            <ul>
                <li class="logo-nav"><a href="#"><img src="img/Logo_finale_Detourer4.png" alt=""></a></li>
                <li><a href="Home.php">Accueil</a></li>

                <li><a href="mangas.php">Manga</a></li>
                <li><a href="actu.php">Actu</a></li>
                <li><a href="goodies.php">Goodies</a></li>
                <?php if (!estConnecte()) { ?>
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="connexion.php">Connexion</a></li>


                <?php } else {  ?>
                    <li class="profil-menu">
                        <p href="profil.php" class="menu-profil">Profil</p>
                        <img src="img/nav/caret-down-fill.svg" alt="fleche-bas" class="menu-profil">
                        <ul>
                            <li>ppe</li>
                            <li>ape</li>
                            <li>ipe</li>

                        </ul>
                    </li>
                <?php  } ?>

                <li>
                    <a href="panier.php" class="panier pt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-basket-fill" viewBox="0 0 16 16">
                            <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <img src="img/nav/list.svg" alt="menu-hamburger" class="menu-hamburger">
    </nav>
</header>

<script>
    const menuHamburger = document.querySelector(".menu-profil")
    const navLinks = document.querySelector(".nav-links")

    menuHamburger.addEventListener('click', () => {
        navLinks.classList.toggle('mobile-menu')
    })
</script>