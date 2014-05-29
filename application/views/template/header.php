<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <title>BookAchoy <?php echo isset($title) ? " - $title" : ""; ?></title>
    <!-- project's custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css") ?>"/>
    <!-- jQuery 1.11.0 -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- Optional theme -->
    <!--        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">-->

    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom_bootstrap.css') ?>">
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</head>
<body>
<header>
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1"><span
                                class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                                class="icon-bar"></span><span class="icon-bar"></span></button>
                        <a class="navbar-brand logo"   href="<?php echo base_url() ?>"><?php echo SITE_NAME ?></a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <?php if($loggedIn): ?>
                            <li>
                                <a href="<?php echo base_url("page/NewsFeed"); ?>">News Feed</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url("page/MyBookshelf"); ?>">My Bookshelf</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("page/myFriends"); ?>">My Friends</a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo base_url("page/Contact"); ?>">Contact Us</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("page/About"); ?>">About</a>
                            </li>


                        </ul>
                        <?php if($loggedIn): ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?php echo $username; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $fbLogin; ?>">Logout</a></li>

                                </ul>
                            </li>
                        </ul>
                        <?php else: ?>
                        <ul class="nav navbar-nav navbar-right">
                            <!--li>
                                <a href="<?php echo base_url("page/how_it_works"); ?>">How It Works</a>
                            </li-->
                            <li class="active">
                                <a href="<?php echo $fbLogin; ?>">Login</a>
                            </li>
                        </ul>
                        <?php endif ?>
                    </div>

                </nav>
            </div>
        </div>

</header>
<div class="wrapper">
