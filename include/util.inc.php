<?php
	 function dateFrEn(){ 
        $langue = "fr";
        if(isset($_GET["lang"]) && !empty($_GET["lang"])){
            $langue= $_GET["lang"];
        }
      
    	if(($langue === "en")){
    		$jour = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    		$mois = [ "January","February","March","April","May","June","July","August","September","October","November","December"];

    		$jourActuel = date("w");
    		$jourAvecZero = date("d");
    		$moisActuel = date("n");

            echo "<p class=\"Copyright\">";
    		printf("%s ,  %s  %d ,2021\n",$jour[$jourActuel],$mois[$moisActuel-1],$jourAvecZero);
            echo "</p>";

    	}else{
    		$jour = ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
    		$mois = [ "Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Decembre"];
    	
    		$jourActuel = date("w");
    		$jourAvecZero = date("d");
    		$moisActuel = date("n");

            echo "<p class=\"Copyright\">";
    		printf("%s %d %s 2021\n",$jour[$jourActuel],$jourAvecZero,$mois[$moisActuel-1]);
            echo "</p>";
    	}  		
    }
?>