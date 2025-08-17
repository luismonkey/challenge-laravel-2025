# Restaurant Orders API 🍽️

API RESTful para la gestión de órdenes de un restaurante, implementada en **Laravel**, usando **PostgreSQL**, **Redis** y contenedores **Docker**.

---

## Requisitos 🛠️

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- Docker Compose
- Composer (opcional, solo si quieres instalar dependencias fuera del contenedor)

---

## Levantar el proyecto con Docker 🚀

1️⃣ Clona el repositorio y entra al proyecto:

```bash
git clone <URL_DEL_REPO>
cd challenge-laravel-2025
```

2️⃣ Levanta los contenedores desde la carpeta docker/:


```bash
docker compose -f docker/docker-compose.yml up -d --build
```

Esto creará los contenedores: laravel_php, laravel_nginx, laravel_postgres y laravel_redis.

3️⃣ Ingresa al contenedor PHP:

```bash
docker exec -it laravel_php bash
```

4️⃣ Ve a la carpeta del proyecto dentro del contenedor:

```bash
cd /var/www
```

5️⃣ Copia el .env y configura la base de datos y Redis:

```bash
cp .env.example .env
```

Ejemplo de configuración para Docker:

APP_NAME=RestaurantOrders
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=restaurant
DB_USERNAME=postgres
DB_PASSWORD=12345

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

**Importante**: Los hosts postgres y redis corresponden a los nombres de los servicios definidos en docker/docker-compose.yml.

6️⃣ Genera la key de Laravel:

```bash
php artisan key:generate
```

7️⃣ Instala las dependencias y ejecuta migraciones:

```bash
composer install
php artisan migrate
```

Probar la API 🧪

Los endpoints están disponibles a través de Nginx en:

http://localhost:8000/api/
