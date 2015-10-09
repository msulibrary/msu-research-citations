<!doctype html>
<html lang="en" vocab="http://schema.org/" typeof="WebPage">
<head>
<title><?php $title = (empty($title)) ? null : $title; if (strlen($title) < 3 ) { echo $pageTitle; } else { echo $title.', '.$pageTitle; } ?> - Montana State University (MSU) Library</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $pageDescription; ?>" />
<meta name="keywords" content="<?php echo $pageKeywords; ?>" />
<meta name="robots" content="noindex, nofollow" />
<?php
$fileName = htmlentities(strip_tags(basename($_SERVER['SCRIPT_NAME'])));
//get default value for id
$fileID = isset($_GET['id']) ? strip_tags((int)$_GET['id']) : null;
if ($fileName == 'item.php') {
?>
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']).'/item/'.$fileID; ?>" />
<?php
} elseif ($fileName == 'index.php') {
?>
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']).'/'; ?>" />
<?php
} else {
?>
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />
<?php
//end $fileName rel=canonical conditional
}
?>
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/meta/styles/master.css" />
<?php
if ($customCSS = (empty($customCSS)) ? null : $customCSS) {
	$countedCSS = count($customCSS);
	for ($i = 0; $i < $countedCSS; $i++) {
?>
<link rel="stylesheet" href="<?php echo $customCSS[$i]; ?>">
<?php
  }
}
if ($customScript = (empty($customScript)) ? null : $customScript) {
  $counted = count($customScript);
  for ($i = 0; $i < $counted; $i++) {
?>
<script type="text/javascript" src="<?php echo $customScript[$i]; ?>"></script>
<?php
	}
}
if ($_SERVER['HTTP_HOST'] == "arc.lib.montana.edu") {
?>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-2733436-2', 'auto', {'allowLinker': true});
	ga('require', 'linker');
	ga('linker:autoLink', ['lib.montana.edu']);
	ga('send', 'pageview');
</script>
<?php
}
?>
</head>
<body class="<?php echo($pageLayout).' '; if(!isset($_GET['view'])) { echo 'default'; } else { echo htmlspecialchars($_GET['view']); } ?>">
<div id="contain">
<div id="mastHead">
  <h1><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/index.php">Montana State University Research Citations - Montana State University (MSU) Library</a></h1>
  <p class="hidden"><a href="#mainContent" title="main content">skip navigation</a></p>
</div><!-- end masthead div -->
