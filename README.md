# 🧥 Buzo Promo 2026 · Alvaredo

Página web para mostrar y votar el buzo de la Promo 2026.  
Cada visitante puede dar un 👍 o 👎 al **frente** y a la **espalda** del buzo (un voto por lado, por sesión).

**Stack:** Laravel 11 · PHP 8.2+ · SQLite · archivo de sesiones

---

## ⚙️ Instalación paso a paso

### 1. Clonar el repositorio

```bash
git clone https://github.com/fedex888/promo.git
cd promo
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Copiar y configurar el `.env`

```bash
cp .env.example .env
php artisan key:generate
```

> No hace falta editar nada más — SQLite y sesiones en archivo ya están configurados.

### 4. Crear la base de datos SQLite y correr la migración

```bash
# Crear el archivo SQLite vacío
touch database/database.sqlite

# Crear la tabla de votos
php artisan migrate
```

### 5. Levantar el servidor de desarrollo

```bash
php artisan serve
```

Abrí **http://localhost:8000** en el navegador. ¡Listo! 🎉

---

## 🗄️ Estructura de la base de datos

Una sola tabla `votes`:

| columna        | tipo                      | descripción                            |
|----------------|---------------------------|----------------------------------------|
| `id`           | INTEGER PK autoincrement  |                                        |
| `side`         | ENUM frente \| espalda    | Qué lado del buzo se votó              |
| `type`         | ENUM like \| dislike      | Voto positivo o negativo               |
| `voter_token`  | VARCHAR(36)               | UUID de sesión anónima del visitante   |
| `created_at`   | TIMESTAMP                 |                                        |
| `updated_at`   | TIMESTAMP                 |                                        |

Restricción única: `(side, voter_token)` → un voto por lado por visitante.

---

## 🗂️ Estructura del proyecto

```
promo/
├── app/
│   ├── Http/Controllers/
│   │   └── BuzoController.php   ← muestra la página y procesa votos
│   └── Models/
│       └── Vote.php             ← modelo Eloquent del voto
├── config/                       ← app, database, session, cache, etc.
├── database/
│   └── migrations/
│       └── ..._create_votes_table.php
├── public/
│   └── images/
│       ├── buzo-frente.jpg
│       └── buzo-espalda.jpg
├── resources/views/
│   └── buzo.blade.php           ← vista principal con sistema de votación
├── routes/
│   └── web.php                  ← GET / y POST /votar
└── .env.example
```

---

## 🔗 Rutas

| Método | URL       | Descripción                                    |
|--------|-----------|------------------------------------------------|
| GET    | `/`       | Página principal con el buzo y los conteos     |
| POST   | `/votar`  | Registra un voto (acepta JSON, devuelve JSON)  |

---

## 🚀 Deploy en producción (opcional)

Para subir a Railway, Render, Fly.io, etc.:

1. Asegurate de tener PHP 8.2+ y extensión `pdo_sqlite`.
2. Configurá las variables de entorno del panel (copiar del `.env.example`).
3. Ejecutá `php artisan migrate --force` al hacer deploy.
4. Apuntá el web server a la carpeta `public/`.

---

## 🛠️ Comandos útiles

```bash
# Ver todos los votos en consola
php artisan tinker
>>> \App\Models\Vote::all()

# Limpiar todos los votos (para empezar de cero)
>>> \App\Models\Vote::truncate()
```
