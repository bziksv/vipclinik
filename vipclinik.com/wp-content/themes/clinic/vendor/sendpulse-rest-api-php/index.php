<?
require($_SERVER['DOCUMENT_ROOT']."/wp-content/themes/clinic/vendor/sendpulse-rest-api-php/src/ApiInterface.php");
require($_SERVER['DOCUMENT_ROOT']."/wp-content/themes/clinic/vendor/sendpulse-rest-api-php/src/ApiClient.php");
require($_SERVER['DOCUMENT_ROOT']."/wp-content/themes/clinic/vendor/sendpulse-rest-api-php/src/Storage/TokenStorageInterface.php");
require($_SERVER['DOCUMENT_ROOT']."/wp-content/themes/clinic/vendor/sendpulse-rest-api-php/src/Storage/FileStorage.php");
require($_SERVER['DOCUMENT_ROOT']."/wp-content/themes/clinic/vendor/sendpulse-rest-api-php/src/Storage/SessionStorage.php");
require($_SERVER['DOCUMENT_ROOT']."/wp-content/themes/clinic/vendor/sendpulse-rest-api-php/src/Storage/MemcachedStorage.php");
require($_SERVER['DOCUMENT_ROOT']."/wp-content/themes/clinic/vendor/sendpulse-rest-api-php/src/Storage/MemcacheStorage.php");

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

	define('API_USER_ID', '0e32f16feee1eb76224a85a28da1ee0e');
	define('API_SECRET', '2ed3136c1e81d9dfd5a1834b62fed570');
	define('PATH_TO_ATTACH_FILE', __FILE__);
	
	 
	if(array_key_exists("email", $_POST)) {
		
			$SPApiClient = new ApiClient(API_USER_ID, API_SECRET, new FileStorage());

			 $bookID = 2403960;
			 $emails = array(
				array('email' => $_POST['email']),
			);

			$SPApiClient->addEmails($bookID, $emails);
	
	}
	die;
	
	

	 
	 
	





