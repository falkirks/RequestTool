<?php
require_once __DIR__ . "/autoload.php";
if(EnviromentTest::runTests()){
    $path = PluginBuilder::createPackage();
    $data = ReviewInterface::getReviewData($path);
    GistUpload::getLink($path, $data);
}
else{
    Output::info("Exiting...");
}

