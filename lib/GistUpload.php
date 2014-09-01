<?php
/*
 * Hacky Gist upload for everything.
 */
require_once dirname(__DIR__) . "/vendor/autoload.php"; //Start composer autoloading, blocks custom autoload
class GistUpload{
    const GIST_API_URL = "https://api.github.com/gists";
    static public function getLink($path, $data){
        $post = [
            'description' => 'Request response generated with RequestTool',
            'public' => 1,
            'files' => [
                'README.md' => ['content' => 'This is a simple README'],
                'review.txt' => ['content' => $data],
            ]
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, GistUpload::GIST_API_URL);
        curl_setopt($ch,CURLOPT_USERAGENT,'RequestTool Falkirks nhfalkirks@gmail.com');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($response, true);
        print $decoded['html_url'];

    }
}