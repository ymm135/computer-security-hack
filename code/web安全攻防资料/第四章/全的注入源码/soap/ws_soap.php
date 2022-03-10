<?php
error_reporting(0);

// SOAP function
function get_password_by_username($username)
{

    include("/www/web/default/sql/soap/connect/sql-connect.php");
    $text = "Your Password is: ";
    $sql = "SELECT password FROM admin WHERE username = '" . $username . "'";
    $recordset = mysql_query($sql);
    $row = mysql_fetch_array($recordset);
    return $text.$row["password"];

}

// Includes the NuSOAP library
require("/www/web/default/sql/soap/soap/nusoap.php");

// Creates an instance of the soap_server class
$server = new nusoap_server();

// Specifies the name of the server and the namespace
$server->configureWSDL("*** Pentest ***", "urn:movie_service");

// Registers the function we created with the SOAP server and passes several different parameters to the register method
// The first parameter is the name of the function
$server->register("get_password_by_username",
// The second parameter specifies the input type
    array("title" => "xsd:string"),
// The third parameter specifies the return type
    array("tickets_stock" => "xsd:integer"),
// The next two parameters specify the namespace we are operating in, and the SOAP action
    "urn:tickets_stock",
    "urn:tickets_stock#get_password_by_username");
// Checks if $HTTP_RAW_POST_DATA is initialized. If it is not, it initializes it with an empty string.
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
// Calls the service. The web request is passed to the service from the $HTTP_RAW_POST_DATA variable.
$server->service($HTTP_RAW_POST_DATA);

?>