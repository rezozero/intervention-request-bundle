test:
	vendor/bin/php-cs-fixer fix --ansi -vvv
	vendor/bin/phpstan analyse -c phpstan.neon
