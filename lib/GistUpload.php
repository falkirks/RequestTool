<?php
/*
 * Hacky Gist upload for everything.
 */
namespace requesttool;

use Github\Client;

class GistUpload{
    const GIST_API_URL = "https://api.github.com/gists";
    static public function getLink($path, $data, Client $client){
        $post = [
            'description' => 'Request response generated with RequestTool',
            'public' => 1,
            'files' => [
                'README.md' => ['content' => 'This is a simple README file.'],
                'review.txt' => ['content' => $data],
            ]
        ];
        $res = $client->api('gists')->create($post);
        Output::info("Attaching phar to gist. You may have to enter your Github credentials again.");
        exec("git clone " . $res["git_pull_url"] . " ./gist");
        rename($path, "gist/" . $path);
        $w = getcwd();
        chdir($w . "/gist");
        exec("git add " . $path);
        exec('git commit -m "Added code"');
        exec("git push " . $res["git_push_url"] . " master");
        chdir($w);
        GistUpload::rrmdir("gist");
        //var_dump($res);
        return "[MEDIA=gist]" . $res["id"] . "[/MEDIA]";
    }
    static public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") GistUpload::rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

}