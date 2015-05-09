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

<h4>Creating an ImagickLayerable Object</h4>
<hr>
```php

include 'src/ImagickLayerable.php';

$layerStack = new ImagickLayerable(1000, 768);
//This would create a Transparent Canvas where you can add more other layers with width 1000px and height 768px

$layerStackWithColor = new ImagickLayerable(1000, 768, "#ffffff");
//This would create a white canvas of dimensions 1000px x 768px

```

