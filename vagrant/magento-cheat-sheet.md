Note: the commands here assumes you are in the magento root folder.

To check whether your magento deployment is in production or developer mode, run the following command:

```bash
php bin/magento deploy:mode:show
```

If the the pub/static/frontend/luma/en_US/images folder is empty (the web page shows image not found) or same thing for the pub/static/adminhtml, run the following command:

```bash
php bin/magento setup:static-content:deploy
```


The default magento admin path is at

<pre>
magent-site-host-url/admin
</pre>
