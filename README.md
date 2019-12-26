# CardTest

#To install on local 
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

#To show full list of card
GET http://api.rest.local:8000/api/cards

#To show a card with ID
GET http://api.rest.local:8000/api/card/{ID}

#To delete a card
DELETE http://api.rest.local:8000/api/card/{ID}

#To add a card
POST http://api.rest.local:8000/api/card
{"name": "test 1", "description": "test 1 description"}
