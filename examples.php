<?php
// Not Recommended: Uncomment to disable SSL Certificate Verification
// define('ICP_NOVERIFY', true);
error_reporting(E_ALL); ini_set('display_errors', 1);

// Load the iContact Pro library
require_once('iContactProApi.php');

// Store the singleton
$oiCP = iContactProApi::getInstance();

// Give the API your information
$oiCP->setConfig(array(
	'appId'       => '',
	'apiPassword' => '',
	'apiUsername' => '',
	'companyId' => 123,
	'profileId' => 123
));

// In case you need to add/update custom fields of contact, det keys here
$oiCP->setCustomFieldKeys(
	array(
		'key_1',
		'key_2',
		'key_3'
	)
);

// Custom fields keys and valuse
$customFields = array(
		'key_1' => 'value 1',
		'key_2' => 'value 2',
		'key_3' => 'value 3'
	);

// Try to make the call(s)
try {
	//  are examples on how to call the  iContact Pro PHP API class
	// Grab all contacts	
	var_dump($oiCP->getContacts());
	// Grab a contact
	var_dump($oiCP->getContact(42094396));
	// Create a contact
	var_dump($oiCP->addContact('joe@shmoe.com', null, null, 'Joe', 'Shmoe', null, '123 Somewhere Ln', 'Apt 12', 'Somewhere', 'NW', '12345', '123-456-7890', '123-456-7890', null));
	// Get messages
	var_dump($oiCP->getMessages());
	// Create a list
	var_dump($oiCP->addList('somelist', 1698, true, false, false, 'Just an example list', 'Some List'));
	// Subscribe contact to list
	var_dump($oiCP->subscribeContactToList(42094396, 179962, 'normal'));
	// Grab all campaigns
	var_dump($oiCP->getCampaigns());
	// Create message
	var_dump($oiCP->addMessage('An Example Message', 585, '<h1>An Example Message</h1>', 'An Example Message', 'ExampleMessage', 33765, 'normal'));
	// Schedule send
	var_dump($oiCP->sendMessage(array(33765), 179962, null, null, null, mktime(12, 0, 0, 1, 1, 2012)));
	// Upload data by sending a filename (execute a PUT based on file contents)
	var_dump($oiCP->uploadData('/path/to/file.csv', 179962));
	// Upload data by sending a string of file contents
	$sFileData = file_get_contents('/path/to/file.csv');  // Read the file
	var_dump($oiCP->uploadData($sFileData, 179962)); // Send the data to the API
	
	// Move a subscription from one list to another
	var_dump($oiCP->moveSubscriptionToList("1_15", 2));
	// Delete a contact
	var_dump($oiCP->deleteContact(6));
	// Updates a contact	
} catch (Exception $oException) { // Catch any exceptions
	// Dump errors
	var_dump($oiCP->getErrors());
	// Grab the last raw request data
	var_dump($oiCP->getLastRequest());
	// Grab the last raw response data
	var_dump($oiCP->getLastResponse());
}

exit;