<?php
/*
 * Gets and parses data from pluginReview.php
 */
namespace requesttool;
class ReviewInterface{
    const PLUGIN_REVIEW_URL = "http://pocketmine.net/pluginReview.php";
    static public function getReviewData($path){
        Output::info("Starting upload to pluginReview.");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, ReviewInterface::PLUGIN_REVIEW_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Expect: 100-continue","Content-Type: multipart/form-data"]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => curl_file_create(realpath($path))]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        preg_match('#<\s*?pre\b[^>]*>(.*?)</pre\b[^>]*>#s', $result, $matches);
        Output::success("Plugin review data scraped.");
        return $matches[1];
    }
}