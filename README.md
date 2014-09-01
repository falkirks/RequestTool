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
In order to get a working version from the source you will need [Composer](https://getcomposer.org). Clone this repo:
```
git clone https://github.com/Falkirks/RequestTool.git
```
Then you will need to install the composer dependencies by running:
```
php composer.phar install
```
Then if you want you can add it to your $PATH or create an alias.

###Packaging 
Packaging in executable is done via [phar-composer](https://github.com/clue/phar-composer/). In order to package you will need to install it. Once you have it installed just navigate to the source directory and run:
```
phar-composer build
```
