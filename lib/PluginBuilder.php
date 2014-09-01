<?php
class PluginBuilder{
    static public function createPackage(){
        Output::info("Packaging plugin...");
        $description = new PluginDescription(file_get_contents("plugin.yml"));
        $pharPath =  $description->getName() . ".phar";
        $phar = new Phar($pharPath);
        $phar->setMetadata([
            "name" => $description->getName(),
            "version" => $description->getVersion(),
            "main" => $description->getMain(),
            "api" => $description->getCompatibleApis(),
            "depend" => $description->getDepend(),
            "description" => $description->getDescription(),
            "authors" => $description->getAuthors(),
            "website" => $description->getWebsite(),
            "creationDate" => time()
        ]);
        $phar->setStub('<?php echo "PocketMine-MP plugin '.$description->getName() .' v'.$description->getVersion().'\nThis file has been generated using RequestTool'.'\n----------------\n";if(extension_loaded("phar")){$phar = new \Phar(__FILE__);foreach($phar->getMetadata() as $key => $value){echo ucfirst($key).": ".(is_array($value) ? implode(", ", $value):$value)."\n";}} __HALT_COMPILER();');
        $phar->setSignatureAlgorithm(Phar::SHA1);
        $phar->startBuffering();
        $filePath = getcwd();
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($filePath)) as $file){
            $path = ltrim(str_replace(array("\\", $filePath), array("/", ""), $file), "/");
            if($path{0} === "." || strpos($path, "/.") !== false){
                continue;
            }
            $phar->addFile($file, $path);
        }
        $phar->compressFiles(Phar::GZ);
        $phar->stopBuffering();
        Output::success("Plugin packaged.");
        return $pharPath;
    }
}