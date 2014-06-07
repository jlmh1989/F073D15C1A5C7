<?php
/**
 * Description of CircleCrop
 *
 * @author joseluis
 */
class CircleCrop {

    private $image;

    public function __construct($imgUrl, $ancho, $alto) {
        $ext =  pathinfo($imgUrl, PATHINFO_EXTENSION);
        if($ext == "jpg"){
            $image_s = imagecreatefromjpeg($imgUrl);
        }else if($ext == "png"){
            $image_s = imagecreatefrompng($imgUrl);
        }else{
            $image_s = imagecreatefromgif($imgUrl);
        }
        $width = imagesx($image_s);
        $height = imagesy($image_s);
        $newwidth = $ancho;
        $newheight = $alto;
        $this->image = imagecreatetruecolor($newwidth, $newheight);
        imagealphablending($this->image, true);
        imagecopyresampled($this->image, $image_s, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $mask = imagecreatetruecolor($newwidth, $newheight);
        $transparent = imagecolorallocate($mask, 255, 0, 0);
        imagecolortransparent($mask, $transparent);
        imagefilledellipse($mask, $newwidth / 2, $newheight / 2, $newwidth, $newheight, $transparent);
        $red = imagecolorallocate($mask, 0, 0, 0);
        imagecopymerge($this->image, $mask, 0, 0, 0, 0, $newwidth, $newheight, 100);
        imagecolortransparent($this->image, $red);
        imagefill($this->image, 0, 0, $red);
    }
    
    public function getImage(){
        return $this->image;
    }
    
    public function getImagenBase64(){
        $file = "tmp.png";
        imagepng($this->getImage(), $file);
        $data = file_get_contents($file);
        unlink($file);
        return base64_encode($data);
    }
}
