<?php
    require_once('vendor/autoload.php');

    function GenerateBarcode($content){
        $barcode = (new Picqer\Barcode\Types\TypeEan13())->getBarcode($content);
        $renderer = new Picqer\Barcode\Renderers\DynamicHtmlRenderer();
        $renderer->setBackgroundColor([255, 255, 255]);

        $GLOBALS["renderedBarcode"] = $renderer->render($barcode);
    }
?>