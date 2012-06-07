<?php

// include
include_once('./php-markdown/markdown.php');

// defines
define('DEBUG_MDOE', true);
define('DOCUMENT_DIR', './docs');
define('MARKDOWN_EXTENSION', 'md');

// ===================================================
// debug mode
if ( DEBUG_MDOE ) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ini_set('error_reporting', E_ALL);
}

// functions
function h($str) {
  return htmlspecialchars($str);
}

// ===================================================
// parse params
$params = $_GET;
$page = 'index';
if ( count($params) == 1 ) {
  $keys = array_keys($params);
  $page = $keys[0];
}

// load markdown file
$path = DOCUMENT_DIR.'/'.$page.'.'.MARKDOWN_EXTENSION;
$content = file_get_contents($path);
if ( $content === false ) {
  // file not found
}

// convert markdown to html
$content = Markdown(h($content));

// utils
$title = $page;
if ( preg_match('/<h1[^>]*>([^<]+)<\/h1>/i', $content, $matches) > 0 ) {
  $title = $matches[1];
}

// output


?>
<html>
<head>
<title><?= h($title) ?></title>
</head>
<body>

<div class="content">
<?= $content ?>
</div>

<? if ( DEBUG_MDOE ) { ?>
<hr />
<pre>
<? var_dump($params); ?>
<? var_dump($path); ?>
</pre>
<? } ?>

</body>
</html>
