<?php
Yii::import('application.extensions.EGMap.*');
$latitude = 25.651241;
$longitude = -100.275658;
$gMap = new EGMap();
$gMap->setJsName('map');
$gMap->zoom = 10;
$mapTypeControlOptions = array(
    'sensor'=>true,
    'position'=> EGMapControlPosition::LEFT_BOTTOM,
    'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
);
// Map settings
$gMap->mapTypeControlOptions= $mapTypeControlOptions;
$gMap->setWidth(600);
$gMap->setHeight(400);
$gMap->setCenter($latitude, $longitude);

// Prepare marker
$marker = new EGMapMarker($latitude, $longitude, array('title' => 'Ejemplo ubicacion',
    //'icon'=>$icon
        ));
$gMap->addMarker($marker);

$gMap->renderMap();