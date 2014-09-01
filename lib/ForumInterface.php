<?php
class ForumInterface{
    const PM_FORUM_URL = "http://forums.pocketmine.net";
    public function __construct(){
        if(file_exists(__DIR__ . "/data/user.dat") && file_exists(__DIR__ . "/data/password.dat")){
            try{
                $this->client = new XenForoClient(ForumInterface::PM_FORUM_URL, file_get_contents(__DIR__ . "/data/user.dat"), file_get_contents(__DIR__ . "/data/password.dat"));
            }
            catch(Exception $e){
                Output::error("Could not login.");
                exit(0);
            }
        }
        else{
            Output::input("Please enter your PocketMine forums username: ");
            $user = fread(STDIN, 2048);
            Output::input("And password: ");
            $password = fread(STDIN, 2048);
            try{
                $this->client = new XenForoClient(ForumInterface::PM_FORUM_URL, $user, $password);
                file_put_contents(__DIR__ . "/data/user.dat", $user);
                file_put_contents(__DIR__ . "/data/password.dat", $password);
                Output::success("Account configured successfully.");
            }
            catch(Exception $e){
                Output::error("Could not login.");
                exit(0);
            }
        }
    }
}