# Simple Uploader

# Setup

## PHP

Install [PHP].

## Cron

Execute `check.sh` regularly with [cron] to delete old files:

You can run `clean.sh` on a [cron] job like this:

    $ crontab -e

To run once at midnight (00:00) every day:

    * 0 * * * /path/to/www/check.sh

 [cron]: https://en.wikipedia.org/wiki/Cron
 [PHP]: https://secure.php.net/manual/en/install.php
