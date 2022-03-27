
<?php

/************************ *******
En attendant la base de données ou de les recuperer dans l'api si possible
*********************************/

function getBeerNameArray(){
  $BeerNameArray = ["Kilkenny","Guinness","chimay","Chouffe","Leffe","Grimbergen","Heineken","TripleKarmeliet","carlsberg","1664","Affligem"];
return $BeerNameArray;
}

function getBeerPrice(){
  $BeerPriceArray = [0.87,0.89,0.45,1.10,1.25,1.33,0.87,0.89,0.45,1.10,1.25];
return $BeerPriceArray;
}
/*******************************************
**********************************************
*/

function getBeers(){
  $BeerNameArray = getBeerNameArray();
  $BeerPriceArray = getBeerPrice();
  for($i = 0 ; $i < count($BeerNameArray) ; $i++ ){
    echo "<section class=\"product\">";
    echo "<div class=\"product__photo\">";
    echo "<div class=\"photo-container\">";
    echo "<div class=\"photo-main\">";
    echo "<div class=\"controls\">";

    echo "</div>";
    echo "<img src=./images/$BeerNameArray[$i].png>"; // 350*350 les images
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"product__info\">";
    echo "<div class=\"title\">";
    echo "<h1>$BeerNameArray[$i]</h1>";
    echo "</div>";
    echo "<div class=\"price\">";
    echo "€ <span>$BeerPriceArray[$i]</span>";
    echo "</div>";
    echo "<div class=\"variant\">";
    echo "<h3>Prix Moyen</h3>";
    echo "</div>";
    echo "<div class=\"description\">";
    echo "<h3>BENEFITS</h3>";
    echo "<ul>";
    echo "<li>Apples are nutricious</li>";
    echo "<li>Apples may be good for weight loss</li>";
    echo "<li>Apples may be good for bone health</li>";
    echo "<li>Theyre linked to a lowest risk of diabetes</li>";
    echo "</ul>";
    echo "</div>";
    echo "<a href=beerupResults.php?name=$BeerNameArray[$i]>";
    echo "<button onclick=window.location.href= class=\"buy--btn\">Go !</button>";
    echo "</a>";
    echo "</div>";
    echo "</section>";
  }
}

function getBarsByBeerName($beerName){

  $json = file_get_contents("https://data.opendatasoft.com/api/records/1.0/search/?dataset=osm-fr-bars%40babel&q=&rows=999&facet=brewery&refine.brewery=".$beerName);
  $json_data = json_decode($json);
  $elementCount  = count($json_data->records);
  $housenumber="addr:housenumber";
  $city="addr:city";
  $street="addr:street";

  echo "<h2>Voici la liste des bars trouvés pour la biere $beerName: $elementCount trouvés</h2>";

  echo "<div class=\"container\">";
  echo "<div class=\"section\" >";

  for($i = 0 ; $i < $elementCount ; $i++ ){
  echo "<div class=\"menu\" >";
  echo "<div>";
  echo "<img src=\"./images/logo_1.png\">";
  echo "</div>";
  echo "<div class=\"article-1\">";
  echo  "<p>".$json_data->records[$i]->fields->name."</p>";
  echo "<div>";
  if (isset($json_data->records[$i]->fields->other_tags)){
  $json_other_tags = json_decode($json_data->records[$i]->fields->other_tags);
  if (isset($json_other_tags->$housenumber)){
    echo "<i class=\"far fa-calendar-alt\"></i><p>".$json_other_tags->$housenumber." ".$json_other_tags->$street." ".$json_other_tags->$city. " "."</p>";
  }
}
  echo  "<i class=\"far fa-comments\"></i> <p>22 Comments</p>";
  echo  "</div>";
  if (isset($json_data->records[$i]->fields->opening_hours)){
    echo "<p> Horaire: ".$json_data->records[$i]->fields->opening_hours."</p>";
  }
  if (isset($json_data->records[$i]->fields->phone)){
    echo "<p> Phone: ".$json_data->records[$i]->fields->phone."</p>";
  }
  if (isset($json_data->records[$i]->fields->brewery)){
    echo "<p> Bierres: ".$json_data->records[$i]->fields->brewery."</p>";
  }
  if (isset($json_data->records[$i]->fields->other_tags)){
    $json_other_tags = json_decode($json_data->records[$i]->fields->other_tags);
  if (isset($json_other_tags->description)){
    echo "<p>Description: </p>";
    }
  }
  echo  "</div>";
  echo "</div>";
  }

  echo  "</div>";
  echo  "</div>";

}

?>
