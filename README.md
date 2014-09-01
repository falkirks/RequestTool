RequestTool
===========

Tool for filling plugin requests on PocketMine forums. 

- [x] Packages plugin.
- [x] Runs a code review and records results.
- [x] Authenticates with GitHub.
- [x] Creates a Gist with all the data (requires some nasty hacks).
- [x] Authenticates with PocketMine Forums.
- [ ] Posts a reply with a link to Gist on your behalf.

###Requirements
- git command line tools
- curl for PHP
- YAML for PHP
- phar.readonly is disabled

###Installtion
I will eventually distribute a package for easy setup but during development you will have to set it up yourself. In order to do this you will need composer. Start by running:
```
git clone https://github.com/Falkirks/RequestTool.git
```
Then you will need to install the composer dependencies by running:
```
php composer.phar install
```

###Packaging 
Packaging in executable is done via [phar-composer](https://github.com/clue/phar-composer/). 
