# Casino

Este es el código de mi proyecto **"Casino"**, donde podrás ver hasta la última línea del código, también podrás descargarlo y usarlo libremente, siempre mencionándome como "Alberto Sánchez Torreblanca".

## Prueba online

Puedes probarlo en vivo en mi sitio WEB **[https://albertost.sytes.net/apps/casino/](https://albertost.sytes.net/apps/casino/)**.

## Requisitos

### Requisitos Mínimos

- Apache v2.4.53
- PHP v8.1.1
- MySQL v8.0.25 o MariaDB v10.7.6

### Requisitos Recomendados

- Apache v2.4.54
- PHP v8.1.11
- MySQL v8.0.30 o MariaDB v10.9.3

## Instalación

1. Descargar el software desde esta misma página y moverlo a su servidor Apache.
2. Para la creación de la base de datos dispone de un **Script SQL** en **"assets/sql/database.sql"**, este creará la base de datos y las tablas necesarias para funcionar correctamente.

Con estos dos sencillos pasos ya está instalado.

## Configuración

La única configuración que hay que hacer en el propio código es establecer la conexión a la base de datos, que se realiza en el archivo ubicado en **"src/classes/DB.php"**.

Tranquilo, si no eres programador está comentado claramente el lugar donde rellenarlo manualmente con la configuración de su base de datos.

## Aclaraciones

Este software funciona correctamente y ha sido probado por mí mismo, si no funciona en su servidor o equipo no me hago responsable de cualquier fallo en la configuración y uso del mismo.