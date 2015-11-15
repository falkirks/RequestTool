<?php
namespace requesttool;
require_once __DIR__ . "/vendor/autoload.php";
if(EnvironmentTest::runTests()){
    $auth = new LoginInterface;
    $path = PluginBuilder::createPackage();
    $data = ReviewInterface::getReviewData($path);
    $code = GistUpload::getLink($path, $data, $auth->getGithubClient());
    Output::info("Post a reply to the request with the below code:");
    Output::link($code);
}
else{
    Output::info("Exiting...");
}

