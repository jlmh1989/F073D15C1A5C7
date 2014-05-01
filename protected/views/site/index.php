<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<center><h1><i><?php echo CHtml::encode(Yii::app()->name); ?></i> Full Time Comunication</h1></center>

<p></p>
<table width="100%" border="0" align="center">
  <tr>
    <td style="text-align:center"><img src="images/logo-web1.png" width="625" height="187" /></td>
  </tr>
  
</table>
<p></p>
<?php
/*
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
*/
?>
