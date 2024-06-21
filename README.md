# OceanusDB: Sistema de Gestión de Base de Datos Relacional

Base de datos relacional con interfaz en php y implementacioens con js.

## Descripción

OceanusDB es una base de datos relacional desarrollada para la empresa “Oceanus Supervisión y Proyectos”. Su objetivo principal es facilitar la gestión de empleados a tiempo completo, temporales o por contrato, así como el manejo de su documentación personal. Además, permite la creación de contratos con los datos correspondientes y el almacenamiento de información relevante para estos procesos. Tanto la documentación en formato PDF como los datos de acceso rápido para la visualización de tablas están disponibles.

### Características clave: 
#### Backend seguro en PHP:
- OceanusDB utiliza PHP en el lado del servidor para garantizar un manejo seguro de los datos.

- Implementa medidas estándar de seguridad para prevenir la inyección de datos y mantiene una interacción mínima con el servidor para evitar un uso indebido.

#### Frontend basado en Bootstrap y jQuery:
- El frontend de OceanusDB se basa en Bootstrap para una implementación sencilla de estilos.

- Utiliza jQuery para mejorar la interacción entre el usuario y la interfaz.
## Visuales
Login de diseño simple para el inicio de sesion
![login](https://github.com/potter00/oceanusDb/assets/60475316/be884d48-3e07-4187-ad75-752ccaa4cb58)


Gestiona la informacion de los empleados y el estado de sus contratos
![dashboard](https://github.com/potter00/oceanusDb/assets/60475316/e39e2270-2f46-43c9-bf77-0692169bdf6f)

Gestiona la informacion de los contratos de la empresa
![contratos](https://github.com/potter00/oceanusDb/assets/60475316/06e716f3-01dc-4055-a3e3-417777354aaf)



## Empezando 🚀

Ten escuenta que este programa esta muy personalizado para la empresa en cuestion, cualquier personalizacion que sea nesesario para su proyecto favor de contactar o comentar.

### Prerrequisitos 📋

Lista de software y herramientas, incluyendo versiones, que necesitas para instalar y ejecutar este proyecto:

- Laragon o programa similar para el servidor local y base de datos

En caso de estarlo haciendo de lado de servidor
- PHP 8.1 o superior
- Conexion a base de datos MySQL de su preferencia
- Apache para la pagina web

### Instalación 🔧

Primero se nesesita instalar laragon el cual es una aplicacion que permite la apertura de servidores y bases de datos de forma local.

Una vez instalado es tan sensillo como abrirlo y elegir "Iniciar Todo"

![instalacionpaso1](https://github.com/potter00/oceanusDb/assets/60475316/e073b56c-28f4-43b3-a8a6-1331ea7f7191)

Ya con laragon instalado se va a crear una carpeta root la cual es llamada "www", podemos acceder atravez de ella en laragon en el boton de root, aqui vamos a guardar la carpeta del repositorio o clonar directamente con git(su preferencia)


Una vez hecho esto abrimos nuevamente laragon donde dice "Base de Datos" y posterirmente en "Abrir".

Una vez aqui, Daremos click derecho en la instancia por defecto y daremos, Crear Nuevo > Base de Datos.
![image](https://github.com/potter00/oceanusDb/assets/60475316/6ef56ce6-df2b-4c4d-a55b-280b027b0dd8)

Se abre una ventana en la cual le indicaremos el nombre de la base de datos, la cual llamaremos crud_2019
![image](https://github.com/potter00/oceanusDb/assets/60475316/6ed5bed9-b511-4334-9f5b-50e151a257c3)

Ya creada la base de datos donde se trabajara, la buscaremos en la lista, daremos click derecho y en "Cargar Archivo SQL", donde seleccionamos el archivo incluido en el repositorio llamado "esquemaDB.sql"

Contodo esto hecho solo es cuestion de colocar en el navegador la siguiente url "nombreCarpeta.test" donde el nombre de la carpeta es donde se guardo el proyecto.
si todo esta correcto se abrira la pagina de login.

en la base de datos puedes añadir el primer usuario en la tabla, se puede llamar como gustes en este caso aqui esta la plantilla
id: dejar vacio
usuario: admin
Contraseña: 827ccb0eea8a706c4c34a16891f84e7b
type: admin

Con esto podemos iniciar sesion con el usuario admin y contraseña 12345(en la base de datos esta encriptada)


## Construido Con 🛠️

Explica qué tecnologías usaste para construir este proyecto. Aquí algunos ejemplos:

- [PHP](https://www.php.net/) - El lenguaje utilizado
- [JQuery](https://jquery.com/) - Manejo de eventos
- [bootstrap](https://getbootstrap.com/) - Estilos CSS
- [JavaScript](https://developer.mozilla.org/es/docs/Web/JavaScript) - Lenguaje principal



## Soporte

Si tienes algún problema o sugerencia, por favor abre un problema [aquí](https://github.com/potter00/oceanusDb/issues).

## Roadmap

-Se pranea implementar la gestion de notificaciones para contratos vencidos asi como fianzas




## Autores ✒️

- **Omar Ignacio Urias Ruiz** - _Desarrollador_ - [potter00](https://github.com/potter00)

## Licencia 📄

Este proyecto está bajo la Licencia MIT - ve el archivo [LICENSE.md](https://github.com/potter00/oceanusDb/blob/main/LICENSE) para detalles


