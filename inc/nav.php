<nav class="navbar">
    <div class="logo">
        <img src="img/Logo_finale_Detourer4.png" alt="">
        <h1 class=""><a href="#">TENGOKU</a></h1>
    </div>
    <div class="nav-links">
        <ul>
            <li class="logo-nav"><a href="#"><img src="img/Logo_finale_Detourer4.png" alt=""></a></li>
            <li><a href="Home.php">Accueil</a></li>

            <li><a href="Mangas.php">Manga</a></li>
            <li><a href="Blogs.php">Actu</a></li>
            <li><a href="Goodies.php">Goodies</a></li>
            <?php if (!estConnecte()) { ?>
                <li><a href="">Inscription</a></li>
            <li><a href="">Connexion</a></li>
           

            <?php } else {  ?>
                <li><a href="">Profil</a></li>
            <?php  }?>

            <li>
                <a href="" class="panier pt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-basket-fill" viewBox="0 0 16 16">
                        <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z" />
                    </svg>
                </a>
            </li>
        </ul>
    </div>
    <img src="img/nav/list.svg" alt="menu-hamburger" class="menu-hamburger">
</nav>