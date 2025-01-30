
## HERRAMIENTAS

- laravel 8
- php 8.0.3
- mysql 8

## PARA LA INSTALACION

- composer install
- creacion de la bd (por ejemplo bd_idbi)
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=bd_idbi
    - DB_USERNAME=root
    - DB_PASSWORD=
- ejecucion del comando php artisan migrate
- modifcacion de las llaves mail para la simulacion de envio de correo
    - MAIL_MAILER=smtp
    - MAIL_HOST=sandbox.smtp.mailtrap.io
    - MAIL_PORT=2525
    - MAIL_USERNAME=f870bbeba47c03
    - MAIL_PASSWORD=1177bf743bd359
    - MAIL_ENCRYPTION=tls
    - MAIL_FROM_ADDRESS=your_email@example.com
    - MAIL_FROM_NAME="${APP_NAME}"
  
## GUIA DE CONSULTAS
- para la guia de consultas y a su posteior simulacion, se tiene que guiar del archivo estructura-de-consultas.json, ubicada dentro del proyecto

## OBSERVACIONES
- se instalo laravel excel pero no funcinaba correctamente, por el tiempo no se cosidero en este proyecto

