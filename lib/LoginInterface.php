<?php
/*
 * Prompts for credentials where needed.
 */

namespace requesttool;

use Github\Client;

class LoginInterface{
    const PM_FORUM_URL = "http://forums.pocketmine.net";
    public function __construct(){
        /* PocketMine Forums */
        if(file_exists(__DIR__ . "/data/forums/login.dat") && file_exists(__DIR__ . "/data/forums/pass.dat")){
            try{
                $this->forum = new XenForoClient(LoginInterface::PM_FORUM_URL, file_get_contents(__DIR__ . "/data/forums/login.dat"), file_get_contents(__DIR__ . "/data/forums/pass.dat"));
            }
            catch(Exception $e){
                Output::error("Could not login.");
                exit(0);
            }
        }
        else{
            Output::input("Please enter your PocketMine forums username: ");
            $user = str_replace(PHP_EOL, "", fread(STDIN, 2048));
            Output::input("And password: ");
            $password = str_replace(PHP_EOL, "", fread(STDIN, 2048));
            try{
                $this->forum = new XenForoClient(LoginInterface::PM_FORUM_URL, $user, $password);
                file_put_contents(__DIR__ . "/data/forums/login.dat", $user);
                file_put_contents(__DIR__ . "/data/forums/pass.dat", $password);
                Output::success("Account configured successfully.");
            }
            catch(Exception $e){
                Output::error("Could not login.");
                exit(0);
            }
        }

        /* GitHub */
        if(file_exists(__DIR__ . "/data/github/login.dat") && file_exists(__DIR__ . "/data/github/pass.dat")){
            try{
                $this->github = new Client;
                $this->github->authenticate(file_get_contents(__DIR__ . "/data/github/login.dat"), file_get_contents(__DIR__ . "/data/github/pass.dat"), Client::AUTH_HTTP_PASSWORD);
            }
            catch(\Exception $e){
                Output::error("Could not login.");
                exit(0);
            }
        }
        else{
            Output::input("Please enter your Github username: ");
            $user = str_replace(PHP_EOL, "", fread(STDIN, 2048));
            Output::input("And password: ");
            $password = str_replace(PHP_EOL, "", fread(STDIN, 2048));
            try{
                $this->github = new Client;
                $this->github->authenticate($user, $password, Client::AUTH_HTTP_PASSWORD);
                file_put_contents(__DIR__ . "/data/github/login.dat", $user);
                file_put_contents(__DIR__ . "/data/github/pass.dat", $password);
                Output::success("Account configured successfully.");
            }
            catch(\Exception $e){
                Output::error("Could not login.");
                exit(0);
            }
        }
    }
    public function getForumClient(){
        return $this->forum;
    }
    public function getGithubClient(){
        return $this->github;
    }
}