<?php
header('Access-Control-Allow-Origin: *');

$username = "root";
$password = "15213";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
 or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";

//select a database to work with
$selected = mysql_select_db("aggregate",$dbhandle)
  or die("Could not select examples");

//execute the SQL query and return records
$result = mysql_query("SELECT webex21.ent_line.Code AS Code, webex21.ent_line.Comment AS Comments, webex21.ent_line.LineIndex AS LNo
				FROM webex21.ent_line
				JOIN webex21.ent_dissection ON(webex21.ent_line.DissectionID=webex21.ent_dissection.DissectionID)
				WHERE webex21.ent_dissection.rdfID='ifelse2_v2_version_1' ORDER BY LNo ASC");

//fetch tha data from the database
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
   $to_encode[] = $row;
}
$main = json_encode($to_encode);
echo($main);

//close the connection
mysql_close($dbhandle);


?>