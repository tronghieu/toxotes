#/!/bin/sh
STAT_TIME=$(date +"%d-%m-%Y %H:%M:%S");
echo "$STAT_TIME - CUT OFF SESSION STATISTIC";

LOGFILE="/var/log/mc_billing/cos_statistic_$(date +"%H-%d_%m_%Y").log"

php /var/www/html/mc_billing/scheduler/bg.php cos statistic >> $LOGFILE

sleep 1

AUDIT_TIME=$(date +"%d-%m-%Y %H:%M:%S");
LOGFILE2="/var/log/mc_billing/check_cos_$(date +"%H-%d_%m_%Y").log"
echo "$AUDIT_TIME - CHECK LAST COS DATA";
php /var/www/html/mc_billing/scheduler/bg.php cos check >> $LOGFILE2