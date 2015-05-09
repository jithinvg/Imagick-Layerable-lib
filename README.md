#ImagickLayerable#

This PHP class provides layering capability to PHP5 programs which use PHP Imagick Extension. The Class is very small and super fast which gives layering Capability to the program.
It has several different capabilities like adding COMPOSITION Techniques other than DEFAULT, The library is very easy to use also.

You can use most of the layering functionalities available in Photoshop programatically with this class. <br>

##FUNCTIONALITIES##
<ul>
<li>Adding Layering capability to Imagick Based Programs</br>
<li>Sorting of layers</li>
<li>Deleting layers</li>
<li>Replace Layers with a Different Object</li>
<li>Position Layers by providing x and y cordinates</li>
<li>Adding Different Compositing Techniques</li>
</ul>

##How To Use the class##

Code Below shows how instantiate a new ImagickLayerable class and using it to access all the Photoshop like layer power stored inside Imagick with PHP

<h3>Dependencies</h3>
<ol>
    <li>PHP 5</li>
    <li>Imagick PHP5 Extension</li>
    <li>ImageMagick</li>
</ol>

<h4>Creating an ImagickLayerable Object</h4>

```php

include 'src/ImagickLayerable.php';
//importing the ImagickLayerable class

$layerStack = new ImagickLayerable(1000, 768);
//This would create a Transparent Canvas where you can add more other layers with width 1000px and height 768px

$layerStackWithColor = new ImagickLayerable(1000, 768, "#ffffff");
//This would create a white canvas of dimensions 1000px x 768px

```

<h4>Adding a layer to the Stack</h4>

```php
include 'src/ImagickLayerable.php';

$layerStack = new ImagickLayerable(1000, 768);
//Creates a transparent canvas with dimension 1000x768 px

$layerStack->addLayerToStack("square", new Imagick("square.png"));
//Adds a layer to the stack, with DEFAULT composite, with x=0, y=0

$layerStack->addLayerToStack("circle", new Imagick("circle.png"),300,300, Imagick::COMPOSITE_MULTIPLY);
//Adds a new layer at x-300px, y-300px with a composite MULTIPLY
//Find the List of COMPOSITE constants here, http://php.net/manual/en/imagick.constants.php#imagick.constants.compositeop
//As of now you cant specify channels with the functions available.
```
<h4>
Adding, Replacing and Deleting layers
</h4>

```php
include 'src/ImagickLayerable.php';

$layerStack = new ImagickLayerable(1000, 768);
//Creates a transparent canvas with dimension 1000x768 px

$layerStack->addLayerToStack("square", new Imagick("square.png"));
//Adds a layer to the stack, with DEFAULT composite, with x=0, y=0

$layerStack->addLayerToStack("circle", new Imagick("circle.png"),300,300, Imagick::COMPOSITE_MULTIPLY);
//Adds a new layer at x-300px, y-300px with a composite MULTIPLY
//Find the List of COMPOSITE constants here, http://php.net/manual/en/imagick.constants.php#imagick.constants.compositeop
//As of now you cant specify channels with the functions available.
//Params x, y and Composite is optional, x,y & composite defaults to 0,0, Imagick::COMPOSITE_DEFAULT respectively.

$layerStack->replaceLayer("circle", new Imagick("circle2.png"),300,300, Imagick::COMPOSITE_MULTIPLY);
//Replaces the cirlce layer with with a different Imagick Object
/*
* Options Array Structure
* ----------------------------------------------------------------------
* $options = array(
*                  "x" => X-Co-ordinate of the Layer,
*                   "y" => Y-Co-ordinate of the Layer,
*                   "composite" => Composition Method to be used
*                 );
*/

$layerStack->addLayerToStack("temp", new Imagick("square_temp.png"));
//Adding a temp layer.

$layerStack->deleteLayer("temp");
//This deletes temp Layer from the layers stack

$finalImageObject = $layerStack->getFinalResult();
//This returns an Imagick object with all the layers composited according to the options provided.

```

<h4>Other Functions available</h4>

All the functions available are not listed in the example code. Please look into the source code to understand how to use those functions.

<h6>Function list</h6>

<ol>
<li>addLayerToStack</li>
<li>replaceLayer</li>
<li>deleteLayer</li>
<li>changeOption</li>
<li>addCustomOptionsArray</li>
<li>changeZIndexArray</li>
<li>getFinalResult</li>
</ol>
