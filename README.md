README
======

All from [Yii2 basic app template](https://github.com/yiisoft/yii2-app-basic) with a few improvements:

- mandatory https redirect for all web requests
- php ^8.1
- improved ActiveRecord (from beco/yii-commons)
- ModelLog: a way to automatically store in db model attributes when changed
- out of the box db user structure

# Procfile

```
web: vendor/bin/heroku-php-apache2 web/
worker: php yii queue/listen --verbose --isolate=1
release: sh start
```
