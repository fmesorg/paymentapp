deploy:
	ssh fmes "rm -f /var/www/html/ijmewp/paymentapp/*.php"
	ssh fmes "rm -f /var/www/html/ijmewp/paymentapp/*.html"
	ssh fmes "rm -f /var/www/html/ijmewp/paymentapp/*.js"
	scp *.php *.html *.js fmes:/var/www/html/ijmewp/paymentapp/
