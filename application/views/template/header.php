<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>bookAchoy<?php echo isset($title)? " - $title":""; ?></title>
    <!-- project's custom CSS -->
        <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css") ?>"/>
    <!-- jQuery 1.11.0 -->
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
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
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        <a class="navbar-brand" href="<?php echo base_url()?>"><?php echo SITE_NAME?></a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="<?php echo base_url("page/newsfeed"); ?>">News Feed</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("page/contact"); ?>">Contact Us</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("page/about"); ?>">About</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("page/mybooks"); ?>">My Books</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("page/friends"); ?>">My Friends</a>
                            </li>



                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                           <li class="active">
                               <a href="<?php echo base_url("page/how_it_works"); ?>">How It Works?</a>
                           </li>
                        </ul>
                    </div>

                </nav>
            </div>
        </div>

</header>
<div class="wrapper">
