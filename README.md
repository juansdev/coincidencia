Proyecto Calculadora de Coincidencias
===============================================================================

Este proyecto consiste en el desarrollo de un sistema que permita validar nombres de personas contra una base de datos
de personas públicas. El sistema está compuesto por un algoritmo de comparación de nombres expuesto como servicio REST y
una interfaz web que permita el consumo del web service para realizar búsquedas individuales y dispone de un historial
de
consultas realizadas.

Interfaz Web
------------

La interfaz web permite realizar búsquedas por nombre, modificar el porcentaje de coincidencias mínimo que se desea
obtener y revisar el historial de consultas.

Algoritmo de Comparación de Nombres
-----------------------------------

El algoritmo de comparación de nombres recibe como parámetros los nombres y apellidos en un solo campo de la persona que
se debe validar y el porcentaje de coincidencia mínimo que se espera como respuesta. La respuesta del servicio será un
porcentaje de coincidencia (0 a 100) de los resultados encontrados según el umbral definido. El servicio debe
autenticarse utilizando JWT (JSON Web Token).

El algoritmo utiliza el servicio NameComparisonService para comparar la similitud entre dos nombres. El servicio usa el
algoritmo Jaro-Winkler para calcular la diferencia entre los dos nombres y devuelve el porcentaje de similitud entre 0 y 100.

Antes de comparar los nombres, normaliza los caracteres de los nombres (por ejemplo, convirtiendo a minúsculas y
eliminando acentos), elimina los caracteres no alfanuméricos y espacios adicionales.

Este servicio es útil para comparar nombres en diferentes escenarios, como verificar si dos nombres pertenecen a la
misma persona o detectar duplicados en una base de datos.

El algoritmo devuelve un mensaje en caso de error, si hay un resultado o si no se encuentran resultados.

Posibles soluciones para escalar más el algoritmo
------------

Para mejorar aún más la escalabilidad del algoritmo, se podría considerar lo siguiente:

1. Agregar índices en la tabla PersonPublic para acelerar la búsqueda por nombre. Esto permitiría que la búsqueda sea
   más rápida y eficiente cuando el número de registros aumenta.

2. En lugar de recuperar todos los registros de la tabla PersonPublic en una sola consulta, se podría dividir la
   búsqueda en lotes de registros. Esto reduciría la cantidad de memoria utilizada durante la búsqueda, especialmente si
   la tabla de PersonPublic contiene millones de registros.

3. Utilizar un algoritmo de búsqueda más rápido y escalable, como Elasticsearch o Apache Solr, para buscar registros por
   nombre. Estos sistemas de búsqueda están diseñados específicamente para manejar grandes volúmenes de datos y pueden
   buscar registros mucho más rápido que la base de datos tradicional.

4. Utilizar técnicas de procesamiento de lenguaje natural, como word embeddings y similarity matrices, para mejorar la
   precisión de la comparación de nombres. Estas técnicas usan modelos de lenguaje para comparar nombres en función de
   su similitud semántica, lo que puede ser útil para manejar variaciones en la ortografía o errores tipográficos en los
   nombres.

5. Utilizar técnicas de procesamiento paralelo y distribuido para acelerar la búsqueda. Esto podría involucrar el uso de
   múltiples servidores o máquinas virtuales para ejecutar la búsqueda en paralelo, o la implementación de un sistema
   distribuido usando tecnologías como Apache Kafka o RabbitMQ.

Instalación y Ejecución
=========================================================

Prerrequisitos
--------------

Antes de empezar, debes tener instalado lo siguiente:

* [Composer](https://getcomposer.org/)
* [Node.js 16^ y npm](https://nodejs.org/)
* [MySQL](https://www.mysql.com/)
* [PHP 8^](https://www.php.net/)

Pasos para desplegar el proyecto
--------------------------------

1. Clona el repositorio del proyecto en tu máquina local.

2. Abre una terminal y navega hasta la carpeta del proyecto.

3. Instala las dependencias de PHP utilizando Composer:

   `composer install`

4. Crea una copia del archivo `.env.example` y renómbrala a `.env`.

5. Genera una clave de aplicación Laravel ejecutando el siguiente comando:

   `php artisan key:generate`

6. Configura las variables globales del `.env` para la conexión a la base de datos y para la configuración de correo
   electrónico de Gmail. Para la configuración de correo electrónico de Gmail, asegúrate de proporcionar la dirección de
   correo electrónico y la contraseña correcta.

7. Verificar que todos los tests pasen correctamente. Para ello, ejecute el siguiente comando:

`php artisan test`

8. Si todos los tests pasan correctamente, ejecute los seeders para poblar la base de datos:

`php artisan migrate:fresh --seed`

9. Instala las dependencias de Node.js utilizando npm:

   `npm install`

10. Compila los assets con Laravel Mix utilizando el siguiente comando:

`npm run dev`

11. Ejecuta el servidor de desarrollo de Laravel:

`php artisan serve`

12. Abre el navegador y navega a la dirección `http://localhost:8000`.
