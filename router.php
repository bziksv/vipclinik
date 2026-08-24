<?php
/**
 * Router for PHP built-in server (WordPress pretty permalinks).
 */
$root = __DIR__ . '/vipclinik.com';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$legal_doc_redirects = array(
	'/wp-content/uploads/2026/02/cookies-vipclinic.pdf'             => '/wp-content/documents/cookies.pdf',
	'/wp-content/uploads/2026/03/consent-personal-data-vipclinic.pdf' => '/wp-content/documents/consent.pdf',
	'/wp-content/uploads/2026/03/personal-data-vipclinic.pdf'       => '/wp-content/documents/personal-data.pdf',
	'/wp-content/uploads/2026/03/rules-recommendation-vipclinic.pdf' => '/wp-content/documents/rules-recommendation.pdf',
	'/wp-content/documents/cookies-vipclinic.pdf'                    => '/wp-content/documents/cookies.pdf',
	'/wp-content/documents/consent-personal-data-vipclinic.pdf'     => '/wp-content/documents/consent.pdf',
	'/wp-content/documents/personal-data-vipclinic.pdf'              => '/wp-content/documents/personal-data.pdf',
	'/wp-content/documents/rules-recommendation-vipclinic.pdf'       => '/wp-content/documents/rules-recommendation.pdf',
);

$path = rtrim($uri, '/');
if (isset($legal_doc_redirects[$path])) {
	header('Location: ' . $legal_doc_redirects[$path], true, 301);
	return true;
}

// PDF in wp-content/documents/ — only static files, never WordPress
if (strpos($uri, '/wp-content/documents/') === 0) {
	$file = $root . $uri;
	if (is_file($file)) {
		return false;
	}
	http_response_code(404);
	header('Content-Type: text/plain; charset=UTF-8');
	echo '404 Not Found';
	return true;
}

if ($uri !== '/' && file_exists($root . $uri) && !is_dir($root . $uri)) {
	return false;
}

chdir($root);
require $root . '/index.php';
