require 'properties.config';

// Create connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";



$api_key = '3NLTTNlXsi6rBWl7nYGluOdkl2htFHug';
$i = 1;

$json = file_get_contents('http://trialapi.craig.mtcdevserver.com/api/properties?api_key='.$api_key.'&page[number]='.$i); 
$data = json_decode($json);
$new_data = $data->data;

do {

   foreach($new_data as $value){

      // Update or Create a new record if not exist

      $sql_update = "INSERT INTO Properties (uuid, county, country, town, description, address, image_full, image_thumbnail, longitude, latitude, num_bedrooms, num_bathrooms, price,property_type, type) VALUES('".$value->uuid."','".$value->county."','".$value->country."','".$value->town."','".$value->description."', '".$value->address."','".$value->image_full."','".$value->image_thumbnail."',".$value->longitude.",".$value->latitude.",".$value->num_bedrooms.",".$value->num_bathrooms.",".$value->price.",'".$value->property_type->title."','".$value->type."') ON DUPLICATE KEY UPDATE uuid='".$value->uuid."',county='".$value->county."', country='".$value->country."', town='".$value->town."', description='".$value->description."', address='".$value->address."', latitude=".$value->latitude.",image_full='".$value->image_full."', image_thumbnail='".$value->image_thumbnail."',  longitude=".$value->longitude.", property_type='".$value->property_type->title."', type='".$value->type."',  num_bedrooms=".$value->num_bedrooms.",num_bathrooms=".$value->num_bathrooms.", price=".$value->price;

      $conn->query($sql_update);

   }

   $json = file_get_contents($data->next_page_url); 
   $data = json_decode($json);
   $new_data = $data->data;

   $i++;

} while (!is_null($data->next_page_url))

mysqli_close($conn);
