El proyecto esta montado en un docker y docker-compose

Los proyectos soap-wallet y api-wallet deben instalarse las dependencias en el host con composer install

El proyecto arranca con sudo docker compose build && sudo docker compose up -d

En el archivo docker compose tiene todos los elementos necesarios para la funcionalidad del proyecto incluyendo la base de datos

el proyecto tiene configurado par su arranque los puertos 8080 para el soap con la url del wsdl http://tuiplocal:8080/wallet-server?wsdl y la api esta en http://tuiplocal/api/funcionalidad
