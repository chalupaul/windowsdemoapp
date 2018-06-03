<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php print $html_title . "\n"; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
    .masthead {
      background-color: #428bca;
      -webkit-box-shadow: inset 0 -2px 5px rgba(0,0,0,.1);
      box-shadow: inset 0 -2px 5px rgba(0,0,0,.1);
    }

    .paul-nav .active {
      color: #fff;
    }

    .paul-nav-item {
      position: relative;
      display: inline-block;
      padding: 10px;
      font-weight: 500;
      color: #cdddeb;
    }

    .paul-header {
      padding-top: 20px;
      padding-bottom: 20px;
    }

    .paul-title {
      margin-top: 30px;
      margin-bottom: 0;
      font-size: 60px;
      font-weight: normal;
    }

    #names-table td.index {
        width: 40px;
    }

    #pageContainer ul.pagination {
        margin: 2px 0;
    }

    .status-start,
    .status-stop,
    .status-total {
        font-weight: 700;
    }

    </style>
  </head>
  <body>
    <div class="masthead">
     <div class="container">
        <nav class="paul-nav">
          <a class="paul-nav-item active" href="#">Home</a>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="paul-header">
        <h1 class="paul-title"><?php print $html_title; ?></h1>
        <p class="lead paul-description">Simple demo of the things! All of the things!.</p>
      </div>
