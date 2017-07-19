# php-magento2-api-extensions

Some useful Magento2 API extensions

# Features

The following web api is supported (where :param refers to the value of the parameter passed into the method)

GET /rest/V1/chen0040/customers/:customerId/logout

GET /rest/V1/chen0040/products/:sku/ratingSummary

GET /rest/V1/chen0040/products/:sku/reviewsCount



# Usage


### Prerequisites

The API module was developed against Magento2 version 2.1.

Before deploy any module:

1. Disable Magento cache

Disabling Magento cache during development will save you some time because you won’t need to manually flush the cache every time you make changes to your code.

The easiest way to disable cache is to go to Admin → System → Cache Management → select all cache types and disable them.

2. Put Magento into a developer mode

You should put Magento into a developer mode to ensure that you see all the errors Magento is throwing at you.

In order to do this, open your terminal and go to the Magento 2 root. From there you should run the following command:

php bin/magento deploy:mode:set developer

3. Create the /[magento-root]/app/code folder if not exists

The [magento-root] is the root directory at which magento2 is installed, e.g., /var/www/html

```bash
cd /var/www/html
[ -d app/code ] || mkdir app/code
```

### Install 

git clone this project to the computer running Magento2, copy /magento-modules/chen0040 folder into /[magento-root]/app/code (assuming [magento-root] is /var/www/html):

```bash
git clone https://github.com/chen0040/php-magento2-api-extensions.git
cd php-magento2-api-extensions
cp -R magento-modules/chen0040 /var/www/html/app/code
```

Next run the following command from the [magento-root] directory:

```bash
sudo php bin/magento setup:upgrade
sudo php bin/magento setup:di:compile
```


