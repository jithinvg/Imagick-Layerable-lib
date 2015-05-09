<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jithin
 * Date: 3/19/15
 * Time: 4:47 AM
 * To change this template use File | Settings | File Templates.
 */

class ImagickLayerable {

    private $layers;
    private $layerZIndex;
    private $lastLayer=1;
    private $layerOptions = array();

    private $canvas;

    function __construct($canvasWidth, $canvasHeight, $backGroundColor="none"){
        $this->layers = array();
        $this->layerZIndex = array();
        $this->canvas = new Imagick();
        $backGroundColor = ($backGroundColor=='none')? "none": (new ImagickPixel($backGroundColor));
        $this->canvas->newimage($canvasWidth, $canvasHeight,$backGroundColor);
    }

    function __destruct(){
        unset($this->layers);
        unset($this->layerZIndex);
        $this->canvas->clear();
        $this->canvas->destroy();
        unset($this->canvas);
        unset($this->layerOptions);
    }

    public function addLayerToStack($layerName, Imagick $imageLayer, $x=0, $y=0, $COMPOSITE_TECHNIQUE = Imagick::COMPOSITE_DEFAULT){
        $this->layers[$layerName] = $imageLayer;
        $this->layerZIndex[$this->lastLayer] = $layerName;
        $this->layerOptions[$layerName] = array(
                                                    "x" => $x,
                                                    "y" => $y,
                                                    "composite" => $COMPOSITE_TECHNIQUE
                                                );
        ++$this->lastLayer;
    }

    public function addCustomOptionsArray($customOptions){
        $this->layerOptions = $customOptions;
    }

    public function changeZIndexArray($z_index){
        $this->layerZIndex = $z_index;
    }

    public function changeOption($layerName, $itemName, $itemValue){
        if(array_key_exists($layerName,$this->layers)){
            if(isset($this->layerOptions[$layerName][$itemName])){
                $this->layerOptions[$layerName][$itemName] = $itemValue;
            }
        }
    }

    public function replaceLayer($layerName, Imagick $imageLayer, $x=0, $y=0, $COMPOSITE_TECHNIQUE = Imagick::COMPOSITE_DEFAULT){
        if(array_key_exists($layerName, $this->layers)){
            $this->layers[$layerName] = $imageLayer;
            $this->layerOptions[$layerName] = array(
                                        "x" => $x,
                                        "y" => $y,
                                        "composite" => $COMPOSITE_TECHNIQUE
            );

        }
    }

    public function deleteLayer($layerName){
        $this->layers[$layerName] = null;
        unset($this->layers[$layerName]);

    }

    public function getFinalResult($imageMagickCompositeMethod="none"){

        //print_r($this->layers);
        //$this->canvas = $this->layers[$this->layerZIndex[4]];
        //$this->canvas->compositeimage($this->layers[$this->layerZIndex[2]], Imagick::COMPOSITE_DEFAULT,0,0);
        //$this->canvas->writeimage("../cache/this_is_test.png");
        $i = 1;
        try{

        for($i=1;$i<=count($this->layerZIndex);$i++){
           // var_dump($this->layerZIndex[$i]);

            //$image = $this->layers[$this->layerZIndex[$i]];
            //$image->writeimage(("../cache/test_image_{$this->layerZIndex[$i]}_{$i}.png"));
            if(strtolower($imageMagickCompositeMethod) != "none"){
                $this->canvas->compositeimage($this->layers[$this->layerZIndex[$i]], $imageMagickCompositeMethod,$this->layerOptions[$this->layerZIndex[$i]]["x"],$this->layerOptions[$this->layerZIndex[$i]]["y"]);
            }
            else{
                $this->canvas->compositeimage($this->layers[$this->layerZIndex[$i]], $this->layerOptions[$this->layerZIndex[$i]]["composite"],$this->layerOptions[$this->layerZIndex[$i]]["x"],$this->layerOptions[$this->layerZIndex[$i]]["y"]);
            }
        }

        return $this->canvas;
        }

        catch(Exception $e){
            echo $e->getTraceAsString();
            echo $e->getCode();
            echo $e->getMessage();
            echo "----------------------------\n";
            echo $this->layerZIndex[$i];

        }
    }


}