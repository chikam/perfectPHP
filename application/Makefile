CURL:=$(shell which curl)

php-cs-fixer.phar:
	$(CURL) -SslO http://get.sensiolabs.org/php-cs-fixer.phar

install: php-cs-fixer.phar

fixer:
	$(PHP) php-cs-fixer --level=psr2 fix .
