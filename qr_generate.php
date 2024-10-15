<?php
    //use get to do the qr code thingy, just put the path to the page + ?(name of get variable goes here)=(whatever value)
    require_once('vendor/autoload.php');

    use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;

    function GenerateQrCode($content){
        $options = new QROptions(
            [
                'eccLevel' => QRCode::ECC_L,
                'outputType' => QRCode::OUTPUT_MARKUP_SVG,
                'version' => 5,
            ]
        );
    
        $GLOBALS["qrcode"] = (new QRCode($options))->render($content);
    }
?>