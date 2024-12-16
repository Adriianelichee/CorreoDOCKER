# Sistema de Envío de Correos

Este proyecto es un sistema de envío de correos utilizando PHP, PHPMailer, y Docker. Está diseñado para enviar correos electrónicos a múltiples destinatarios almacenados en una base de datos MySQL.

## Estructura del Proyecto
correo-master/
├── db/
│   └── config.php
├── models/
│   └── user.php
├── vendor/
├── index.php
├── Dockerfile
├── docker-compose.yml
└── README.md


## Requisitos

- Docker
- Docker Compose

## Configuración

1. Clonamos este repositorio en nuestra máquina local.

2. Nos aseguramos de tener Docker y Docker Compose instalados en el sistema.

3. En el directorio raíz del proyecto, ejecutamos el siguiente comando para instalar las dependencias de PHP:    `composer require phpmailer/phpmailer`

4. Configuramos las variables de entorno en el archivo `docker-compose.yml` según nuestras necesidades.

## Ejecución

1. En el directorio raíz del proyecto, ejecutamos el siguiente comando para crear y levantar los contenedores:   ` docker-compose up --build`

2. Una vez que los contenedores estén en funcionamiento, podemos acceder a la aplicación en nuestro navegador web:  `http://localhost:8080`

3. Para ver los correos enviados, accedemos a la interfaz web de MailHog: `http://localhost:8025`

## Funcionamiento

El script `index.php` lo siguiente:

1. Se conecta a la base de datos MySQL.
2. Recupera los correos electrónicos de los usuarios almacenados en la base de datos.
3. Configura PHPMailer para usar SMTP con MailHog.
4. Envía un correo electrónico de prueba a cada dirección recuperada de la base de datos.
5. Muestra un mensaje de confirmación por cada correo enviado y muestra el correo enviado en pantalla.
