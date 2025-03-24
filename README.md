# Servicio de análisis
Este servicio se encarga de recibir por medio de una cola mensajes del servicio de postulaciones que contienen el id del usuario y el id de la posición a la que el usuario aplicó,
con estos ids se consulta a la API del servicio de postulaciones más detalles del usuario y de la posición, luego con esta data se hace una llamada a la API de OpenAI para obtener
un puntaje de que tanto encaja el usuario al puesto, este puntaje será de 0 a 10, cuando se recibe la respuesta de la API de OpenAI se guarda el resultado.

## Instrucciones para iniciar el servicio

<ul>
  <li>
    Clonar el repositorio
  </li>
  
  <li>
    Inicia los contenedores: <b><i>docker-compose up -d --build</i></b>
  </li>
  
  <li>
    Copiar el archivo .env.example a .env
  </li>

  <li>
    En el .env, en la variable POSTULACIONES_API_TOKEN, agregar el token obtenido al iniciar el servicio de postulaciones
  </li>

   <li>
    En el .env, agregar las variables de la API de OpenAI: OPENAI_API_KEY y OPENAI_ORGANIZATION
  </li>
  
  <li>
    Instalar composer: <b><i>docker-compose run --rm --user analisis composer install</i></b>
  </li>
  
  <li> 
    Ejecutar las migraciones: <b><i>docker-compose run --rm artisan migrate</i></b>
  </li>

  <li>
    Ejecutar los seeders: <b><i>docker-compose run --rm artisan db:seed</i></b>
  </li>

  <li>
    Copiar y guardar el token generado, este token se usará para la autenticación a la api de este servicio, desde el servicio de resultados
  </li>

  <li>
    Iniciar el worker para despachar Jobs: <b><i>docker-compose run --rm -d artisan queue:work </i></b>
  </li>
</ul>
