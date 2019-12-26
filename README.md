# CardTest

====================
#To install on local 
====================
- git clone https://github.com/antsagithub/CardTest
- cd CardTest
- composer install
- php bin/console doctrine:schema:create
- php bin/console fos:user:create test_user #create the user with password "test"

- Create virtual host to api.rest.local

<VirtualHost *>
    DocumentRoot "C:\xampp\htdocs\rest_api_project\public"
    ServerName api.rest.local:8000
    
    <Directory "C:\xampp\htdocs\rest_api_project\public">
        Order allow,deny
        Allow from all
        Require all granted
    </Directory>
</VirtualHost>

- Add this line on hosts file : 127.0.0.1 api.rest.local

==================
#LOGIN
==================
- POST http://api.rest.local:8000/createClient 
Body : {"redirect-uri": "api.rest.local:8000", "grant-type": "password"}
===> Return : "CLIENT_ID" and "CLIENT_SECRET"

- POST http://api.rest.local:8000/oauth/v2/token 
Body : {"client_id": "CLIENT_ID", "client_secret": "CLIENT_SECRET", "grant_type": "password", "username": "test_user", "password": "test"}
===> Return : "ACCESS_TOKEN"

===========================
#To show full list of card
==========================
GET http://api.rest.local:8000/api/cards
Header: {"Authorization:", "Bearer ACCESS_TOKEN"}

=======================
#To show a card with ID
=======================
GET http://api.rest.local:8000/api/card/{ID}
Header: {"Authorization:", "Bearer ACCESS_TOKEN"}

=================
#To delete a card
=================
DELETE http://api.rest.local:8000/api/card/{ID}
Header: {"Authorization:", "Bearer ACCESS_TOKEN"}

==============
#To add a card
==============
POST http://api.rest.local:8000/api/card
Header: {"Authorization:", "Bearer ACCESS_TOKEN"}
Body : {"name": "test 1", "description": "test 1 description"}





=============
#BUNDLE REFER
=============
friendsofsymfony/rest-bundle
sensio/framework-extra-bundle
jms/serializer-bundle
symfony/validator
symfony/form
symfony/orm-pack
friendsofsymfony/user-bundle
friendsofsymfony/oauth-server-bundle
