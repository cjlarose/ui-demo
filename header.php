<?php
$body_class = str_replace('/ui-demo/', '', $_SERVER['PHP_SELF']);
$body_class = str_replace('.php', '', $body_class);
$body_class = 'page-' . $body_class;
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UI Demo</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
  </head>

  <body class="<?php echo $body_class; ?>">

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/ui-demo/">UI Demo</a>
          <div class="nav-collapse">
            <ul class="nav">
<?php
$links = array(
	'Home' => '',
	'Draggable' => 'draggable.php',
	'Droppable' => 'droppable.php'
);
#var_dump($_SERVER['PHP_SELF']);
foreach ($links as $content => $location) {
	echo "<li" . (($_SERVER['PHP_SELF'] == "/ui-demo/" . $location || ($location == '' && $_SERVER['PHP_SELF'] == '/ui-demo/index.php'))?" class=\"active\"":"")  . "><a href=\"/ui-demo/{$location}\">{$content}</a></li>";
}
?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
	<?php ob_start(); ?>
