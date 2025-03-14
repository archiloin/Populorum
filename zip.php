
<?php
$zip = new ZipArchive;
if ($zip->open('Beta.zip') === TRUE) {
    $zip->extractTo('./');
    $zip->close();
    echo 'Extraction correctement éffectuer';
} else {
    echo 'échec';
}
?>
