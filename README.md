<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Despliegue en Google Cloud Run con Docker

### Requisitos

-   Tener una cuenta y proyecto en Google Cloud Platform (GCP)
-   Tener instalado Docker y Google Cloud SDK (`gcloud`)

### Archivos necesarios

-   `Dockerfile` (ya incluido en el repositorio)
-   `.dockerignore` (ya incluido)
-   `.gcloudignore` (ya incluido)

### Pasos rápidos

1. **Construye la imagen Docker:**

    ```sh
    docker build -t talentcheck-app .
    ```

2. **Sube la imagen a Google Container Registry:**

    ```sh
    gcloud auth login
    gcloud auth configure-docker
    docker tag talentcheck-app gcr.io/[TU_PROJECT_ID]/talentcheck-app:latest
    docker push gcr.io/[TU_PROJECT_ID]/talentcheck-app:latest
    ```

    Reemplaza `[TU_PROJECT_ID]` por el ID de tu proyecto en GCP.

3. **Despliega en Cloud Run:**

    ```sh
    gcloud run deploy talentcheck-app \
      --image gcr.io/[TU_PROJECT_ID]/talentcheck-app:latest \
      --platform managed \
      --region us-central1 \
      --allow-unauthenticated
    ```

4. **Configura variables de entorno y la base de datos**

    - Desde la consola de Cloud Run, agrega las variables necesarias (`APP_KEY`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc.)
    - Si usas Cloud SQL, sigue la documentación oficial para conectar tu instancia.

5. **Accede a tu aplicación**
    - Cloud Run te dará una URL pública para tu servicio.

---

## Conexión a Cloud SQL desde Cloud Run

1. **Crea tu instancia de Cloud SQL** en Google Cloud Platform (MySQL o PostgreSQL).
2. **Obtén el ID de conexión** de la instancia (formato: `proyecto:región:instancia`).
3. **Configura las variables de entorno** en Cloud Run (puedes hacerlo desde la consola web o en el despliegue):

-   `DB_CONNECTION=mysql` (o `pgsql`)
-   `DB_HOST=127.0.0.1`
-   `DB_PORT=3306` (o el puerto de tu base)
-   `DB_DATABASE=nombre_de_tu_db`
-   `DB_USERNAME=usuario`
-   `DB_PASSWORD=contraseña`
-   `DB_SOCKET=/cloudsql/proyecto:región:instancia`

4. **Despliega desde el repositorio** usando Cloud Build:

```sh
gcloud builds submit --tag gcr.io/[TU_PROJECT_ID]/talentcheck-app:latest

gcloud run deploy talentcheck-app \
  --image gcr.io/[TU_PROJECT_ID]/talentcheck-app:latest \
  --platform managed \
  --region us-central1 \
  --allow-unauthenticated \
  --add-cloudsql-instances=proyecto:región:instancia \
  --set-env-vars=DB_CONNECTION=mysql,DB_HOST=127.0.0.1,DB_PORT=3306,DB_DATABASE=nombre_de_tu_db,DB_USERNAME=usuario,DB_PASSWORD=contraseña,DB_SOCKET=/cloudsql/proyecto:región:instancia
```

5. **No subas tu archivo `.env` al repositorio**. Las variables se configuran en Cloud Run.

---
