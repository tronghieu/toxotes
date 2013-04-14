#/!/bin/sh

LOGFILE=api_call_$(date +"%H-%d_%m_%Y")
php /var/www/html/mc_billing/test/test_scenario/call.php >> /var/www/html/logs/$LOGFILE.log
