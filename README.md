# Wi-Fi QR Code Signage Server

Displays a web page with Wi-Fi info including a QR code that can be scanned to connect to a Wi-Fi network. Designed to be used as web based signage for displaying Wi-Fi information in a public spaces. WifI information is updated through a webhook and is intended to be posted through an external service such as [xiq-ad-user-sync](https://github.com/MelonSmasher/xiq-ad-user-sync) which syncs user data from Active Directory to Extreme XIQ and creates PPSK users.

## Installation

```bash
git clone https://github.com/MelonSmasher/qr-code-server.git && cd qr-code-server
```

## Setup

Copy the `.env.example` file to `.env` and update the values as needed.

```bash
cp .env.example .env
```

Generate a app key:

```bash
# If using docker set the owner to to the www-data user and group found in the php-fpm container
chown -R 82:82 .
# If using docker exec into the php-fpm container
docker exec -it php-fpm /bin/sh
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Edit the `.env` file and fill out the values that match your environment.

## Build Docker Image For Production

```bash
NEW_VERSION=0.1.0
# build the latest tag
docker buildx build --provenance=false --platform linux/amd64 -t qr-code-server:latest .
# build a specific tag
docker tag qr-code-server:latest qr-code-server:$NEW_VERSION
```

## Build Docker Image For Development

```bash
NEW_VERSION=0.1.0
# build the latest tag
docker buildx build -f Dockerfile.dev --provenance=false --platform linux/amd64 -t qr-code-server:dev .
# build a specific tag
docker tag qr-code-server:latest qr-code-server:$NEW_VERSION-dev
```
