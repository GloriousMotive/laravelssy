# pornmgr.com
## Installation
### Git
Um das SaasyKit als Basis zu verwenden, wird zuerst ein neues GitHub-Repository erstellt und anschließend das SaasyKit als Basis definiert:
```
git remote add upstream https://github.com/saasykit/saasykit
git remote -v
git fetch upstream
git merge upstream/main
```
### Composer
Abhängigkeiten installieren:
```
composer install --ignore-platform-reqs --no-interaction --no-scripts --prefer-dist
```

### Node Package Manager
Abhängigkeiten installieren und Build-Prozesses ausführen:
```
npm install
npm run build
```

### Laravel
Env erstellen und anpassen:
```
cp .env.example .env
```

Laravel Basis installation durchführen:
```
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### Git
Upstream Repository auf Github pushen:
```
git push origin main
```

## Spickzettel
### Git
1. Repository auf Commit zurücksetzen:
```
git reset --soft <commit-id>
git push origin main --force
```

## Erweiterungen & Funktionen

