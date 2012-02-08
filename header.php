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
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/jquery-ui-1.8.17.custom.min.js"></script>
    <script src="js/google-code-prettify/prettify.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/global.js"></script>
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
//	'Draggable' => 'draggable.php',
	'VM Terminator' => 'droppable.php',
	'Volume Management' => 'volumes.php',
	'Dense' => 'volumes2.php',
	'New Instance' => 'new_instance.php',
	'Instances' => 'instances.php',
	'Vertical Tabs' => 'vtabs.php',
	'Sliding Tabs' => 'stabs.php'
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
