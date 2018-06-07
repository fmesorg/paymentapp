define _deploy
	ssh fmes "rm -f /var/www/html/ijmewp/paymentapp/*.$1"
	scp *.$1 fmes:/var/www/html/ijmewp/paymentapp/
endef

deploy_php:
	$(call _deploy,php)

deploy_html:
	$(call _deploy,html)

deploy_js:
	$(call _deploy,js)

deploy: deploy_html deploy_js deploy_php
