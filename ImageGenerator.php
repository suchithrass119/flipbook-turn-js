<?php


include "Root.php";

$Page = $_POST["current"];
$FileName = $_POST["filename"];

if (  (ctype_alnum($FileName))) {
    $Page = $Page < 1 ? 0 : $Page - 1;
    $PdfPage = $RootPath . $FileName . '.pdf[' . $Page . ']';
    $Page += 1;
    $ImageFile = "bookpic/" . "P" . $Page . ".jpg";
    $ImagePath = 'bookpic/P' . $Page . '.jpg';

    try {
        $im = new Imagick();
        $im->setResolution(300, 300);
        $im->readImage($PdfPage);
        $im->setImageFormat('jpeg');

        // Optional: Flatten image to remove transparency
        $im = $im->flattenImages();

        $im->writeImage($ImageFile);
        $im->clear();
        $im->destroy();
        echo $ImagePath;
    } catch (ImagickException $e) {
        echo 'Error: ', $e->getMessage();

        // Try using pdftoppm as a fallback
        $command = "pdftoppm -jpeg " . escapeshellarg($PdfPage) . " " . escapeshellarg($ImageFile);
        exec($command, $output, $return_var);
        if ($return_var === 0) {
            echo "Conversion successful";
        } else {
            echo "Conversion failed";
        }
    }
}


?>
