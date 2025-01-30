
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

## PARA INICIALIZACION DEL PROYECTO
- Se debe de registar a un usuario administrador, asi como un con el rol de vendedor 

## DISEÑO
- Para el desarrollo de la solucion, se decidio divir por capas la aplicion (controlador, servicio y repositorio) con la finalidad de obtener un codigo estructura y limpio.
- Se uso la reutilizcion del codigo y responsabilidad unica mediante clases.
- Se organizo los endpoint de manera de tenerlos mas estrcuturados.
- Se uso los Request para la validacion de los datos a manipular.

## DISEÑO BD
![image](https://github.com/user-attachments/assets/aa481e4f-7eb5-479b-aa1e-facefee7bff0)

## OBSERVACIONES
- se instalo laravel excel pero no funcinaba correctamente, por el tiempo no se cosidero en este proyecto
- no se pudo grabar el video por el tiempo limitado
