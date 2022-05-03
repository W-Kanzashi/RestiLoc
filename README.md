# RestiLoc


## Installer apache et mysql (Commandes réalisé avec ubuntu 20.04)
*Il est aussi possible d'utiliser WAMP sur windows*  
[Installer Apache](https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04)  
[Installer Mysql](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)  

Importer le fichier `restiloc.sql` dans la base de données.  

```bash
mysql -u username -p < restiloc.sql
```

## Lancer l'application

```bash
# Node > 16 et utiliser yarn de préférence mais npm fonctionne

git clone https://github.com/W-Kanzashi/RestiLoc.git
cd RestiLoc
yarn install # npm install
yarn start
```

## Configurer Apache

### Windows

Copier le dossier RestiLoc dans le dossier wamp_path\www\RestiLoc  
Aller à l'adresse : http://localhost/RestiLoc

### Linux

```bash
sudo vim /etc/apache/sites-available/restiloc.conf

# Dans le dossier RestiLoc
sudo ln -s $PWD /var/www/.
```
Coller la configuration suivante :
```xml
Listen 8100

<VirtualHost *:8100>
    DocumentRoot /var/www/RestiLoc
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
```bash
sudo a2ensite restiloc
sudo systemctl restart apache2.service
```
Aller sur le site internet http://localhost:8100/
