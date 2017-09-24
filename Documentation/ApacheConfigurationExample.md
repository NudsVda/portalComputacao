```
<VirtualHost *:80>
    ServerName portal-computacao.com
    DocumentRoot /var/www/portalComputacao/web
    ServerAlias *.portal-computacao.com
    DirectoryIndex index.php app_dev.php app.php

      <Directory /var/www/portalComputacao/web>
              Options +Indexes +FollowSymLinks +MultiViews
              AllowOverride All
              Allow from All
              Require all granted
      </Directory>
</VirtualHost>
``` 