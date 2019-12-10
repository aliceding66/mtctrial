$my_file = 'updateproperties.sql';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file


// Create table structure
$sql_create = "CREATE TABLE IF NOT EXISTS Properties ( id INT AUTO_INCREMENT PRIMARY KEY UNIQUE, uuid VARCHAR(255), county VARCHAR(50), country VARCHAR(100), town VARCHAR(100), description VARCHAR(255), url VARCHAR(255), address VARCHAR(255), image_full VARCHAR(255), image_thumbnail VARCHAR(255), latitude Float, longitude Float, num_bedrooms UNSIGNED TININT, num_bathrooms UNSIGNED TININT, price FLOAT, property_type VARCHAR(50), type VARCHAR(10))";
fwrite($myfile, $sql_create."\n");

fclose($myfile);