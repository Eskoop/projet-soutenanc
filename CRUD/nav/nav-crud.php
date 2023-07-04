<?php
// require_once '../inc/init.inc.php';

?>

<style>
    /* make sidebar nav vertical */
    @media (min-width: 768px) {
        .affix-content .container {
            width: 700px;
        }

        html,
        body {
            background-color: #f8f8f8;
            height: 100%;
            overflow: hidden;
        }

        .affix-content .container .page-header {
            margin-top: 0;
        }

        .sidebar-nav {
            position: fixed;
            width: 100%;
        }

        .affix-sidebar {
            padding-right: 0;
            font-size: small;
            padding-left: 0;
        }

        .affix-row,
        .affix-container,
        .affix-content {
            height: 100%;
            margin-left: 0;
            margin-right: 0;
        }

        .affix-content {
            background-color: white;
        }

        .sidebar-nav .navbar .navbar-collapse {
            padding: 0;
            max-height: none;
        }

        .sidebar-nav .navbar {
            border-radius: 0;
            margin-bottom: 0;
            border: 0;
        }

        .sidebar-nav .navbar ul {
            float: none;
            display: block;
        }

        .sidebar-nav .navbar li {
            float: none;
            display: block;
        }

        .sidebar-nav .navbar li a {
            padding-top: 12px;
            padding-bottom: 12px;
        }
    }

    @media (min-width: 769px) {
        .affix-content .container {
            width: 600px;
        }

        .affix-content .container .page-header {
            margin-top: 0;
        }
    }

    @media (min-width: 992px) {
        .affix-content .container {
            width: 900px;
        }

        .affix-content .container .page-header {
            margin-top: 0;
        }
    }

    @media (min-width: 1220px) {
        .affix-row {
            overflow: hidden;
        }

        .affix-content {
            overflow: auto;
        }

        .affix-content .container {
            width: 1000px;
        }

        .affix-content .container .page-header {
            margin-top: 0;
        }

        .affix-content {
            padding-right: 30px;
            padding-left: 30px;
        }

        .affix-title {
            border-bottom: 1px solid #ecf0f1;
            padding-bottom: 10px;
        }

        .navbar-nav {
            margin: 0;
        }

        .navbar-collapse {
            padding: 0;
        }

        .sidebar-nav .navbar li a:hover {
            background-color: #428bca;
            color: white;
        }

        .sidebar-nav .navbar li a>.caret {
            margin-top: 8px;
        }
    }
</style>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<header class="col-sm-3 col-md-2 affix-sidebar">
    <div class="sidebar-nav">
        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="visible-xs navbar-brand">Sidebar menu</span>
            </div>
            <div class="navbar-collapse collapse sidebar-navbar-collapse">
                <h4><a href="index.php">Tengoku-ADMIN</a></h4>
                <ul class="nav navbar-nav" id="sidenav01">

                    <li>
                        <a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
                            <span class="glyphicon glyphicon-cloud"></span> Produit <span class="caret pull-right"></span>
                        </a>
                        <div class="collapse" id="toggleDemo" style="height: 0px;">
                            <ul class="nav nav-list">
                                <li><a href="index-produit.php">Tout les produit</a></li>
                                <li><a href="ajout-produit.php">Ajout-produit.php</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="active">
                        <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
                            <span class="glyphicon glyphicon-inbox"></span> Client <span class="caret pull-right"></span>
                        </a>
                        <div class="collapse" id="toggleDemo2" style="height: 0px;">
                            <ul class="nav nav-list">
                                <li><a href="index-client.php">Tout les clients</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="index-article.php" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav01" class="collapsed">
                            <span class="glyphicon glyphicon-lock"></span> Actu <span class="caret pull-right"></span>
                        </a>
                        
                    </li>
                    <li><a href="../Home.php"><span class="glyphicon glyphicon-lock"></span> Retour sur le site</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</header>