RequestTool
===========

Tool for filling plugin requests on PocketMine forums. 

- [x] Packages plugin.
- [x] Runs a code review and records results.
- [x] Authenticates with GitHub.
- [x] Creates a Gist with all the data (requires some nasty hacks).
- [x] Authenticates with PocketMine Forums.
- [ ] Posts a reply with a link to Gist on your behalf.

###PHP/System Requirements
- git command line tools
- curl for PHP
- YAML for PHP
- phar.readonly is disabled (you can also run with -d phar.readonly=0)


###Usage
Using RequestTool is incredibly simple. Just navigate to the directory and run:
```
php RequestTool.phar
```

###Installation
####Executable (Recomended)
Executable phar archives are posted with each version release. You can find them on the [releases page](https://github.com/Falkirks/RequestTool/releases). Once you have downloaded the executable, you will need to stick it in your $PATH so you can use the tool correctly. You can also create an alias in your .bash_profile if you want.
####Source
I will eventually distribute a package for easy setup but during development you will have to set it up yourself. In order to do this you will need composer. Start by running:
```
git clone https://github.com/Falkirks/RequestTool.git
```
Then you will need to install the composer dependencies by running:
```
php composer.phar install
```
After this you will need to create a terminal alias for the index.php or package and add the executable to your $PATH.

###Packaging 
Packaging in executable is done via [phar-composer](https://github.com/clue/phar-composer/). 
