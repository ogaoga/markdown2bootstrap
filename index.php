<?php

// include
include_once('./php-markdown/markdown.php');

// defines
define('DEBUG_MDOE', true);
define('DOCUMENT_DIR', './docs');
define('MARKDOWN_EXTENSION', 'md');

// debug mode
if ( DEBUG_MDOE ) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ini_set('error_reporting', E_ALL);
}

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
$content = Markdown($content);

// output


?>
<html>
<body>
<h1>Test</h1>

<div class="content">
<?= $content ?>
</div>

<pre>
<? var_dump($params); ?>
<? var_dump($path); ?>
</pre>

<hr />
</body>
</html>
