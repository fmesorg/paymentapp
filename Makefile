deploy:
	-mkdir /Library/WebServer/Documents/paymentapp
	-rm /Library/WebServer/Documents/paymentapp/*.php
	-rm /Library/WebServer/Documents/paymentapp/*.html
	-rm /Library/WebServer/Documents/paymentapp/*.js
	cp *.php *.html *.js /Library/WebServer/Documents/paymentapp/
