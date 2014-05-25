<?php
$yhteys = new PDO("pgsql:");
$yhteys->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Alustetaan muuttuja jossa on Select-kysely, joka palauttaa lukuarvon:
$sqlkysely = "SELECT 1+1 as two";

//Pyydetään PDO-yhteysoliota käsittelemään SQL-muotoinen kysely.
//Huom! PHP:ssä käytetään syntaksia $olio->metodi(); metodien kutsumiseen.
$kysely = $yhteys->prepare($sqlkysely);


if ($kysely->execute()) {
  //Tulos-muuttujan arvoksi pitäisi tulla numero kaksi.
  $tulos = $kysely->fetchColumn();

  //var_dump tulostaa muuttujan tyypin ja arvon käyttäjälle:
  var_dump($tulos);
}
