<?php
namespace requesttool;
require_once __DIR__ . "/vendor/autoload.php";
if(EnviromentTest::runTests()){
    $auth = new LoginInterface;
    $path = PluginBuilder::createPackage();
    $data = ReviewInterface::getReviewData($path);
    Output::link(GistUpload::getLink($path, $data, $auth->getGithubClient()));
}
else{
    Output::info("Exiting...");
}

