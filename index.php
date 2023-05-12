<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    
    <title>Järntorget Göteborg</title>
</head>
<body>
    


<div class="container">

<div id="logo" >
<header><img src="/img/Vasttrafik_logo.png"></header>

</div>

<?php
$url = 'https://api.vasttrafik.se/bin/rest.exe/v2/departureBoard';
date_default_timezone_set('Europe/Stockholm');
$currentTime = date('h:i');
$currentDate = date('y-m-d');
$id = '9021014003640000';
echo "<h2> $currentDate / $currentTime</h2>";
$headers = array(
   
    "Authorization: Bearer GXifl1aqiT_2iIzzLPk9LgW4rfoa",
 );

$pfield = array(
    'id' => $id,
    'date' => $currentDate,
    'time'=> $currentTime,
    'format' => "json"
);

$fields_string = "?".http_build_query($pfield);

$curl = curl_init();

curl_setopt($curl,CURLOPT_URL, $url.$fields_string);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, true); 
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true); 
## Passing an array to CURLOPT_POSTFIELDS will encode the data as multipart/form-data,
## while passing a URL-encoded string will encode the data as application/x-www-form-urlencoded."
##curl_setopt($curl,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($curl);
//var_dump($result);die;
curl_close($curl);
$json_content = json_decode($result);
echo "<table>";
foreach($json_content->DepartureBoard->Departure as $id => $departure)
{
   
    echo "<tr>";
    echo "<td bgcolor=\"$departure->bgColor\"><font color=\"$departure->fgColor\"> $departure->sname </td>";
    echo "<td bgcolor=\"$departure->bgColor\"><font color=\"$departure->fgColor\">  $departure->type </td>";
    echo "<td bgcolor=\"$departure->bgColor\"><font color=\"$departure->fgColor\">  $departure->direction </td>";
    echo "<td bgcolor=\"$departure->bgColor\"><font color=\"$departure->fgColor\">  $departure->rtTime </td>";
    echo "</tr>";
   
   
}
echo "</table>";
?>


</div>

</body>
</html>