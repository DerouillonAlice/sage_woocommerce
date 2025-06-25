# 🚀 Starter WordPress – Bedrock + Sage 11 + Docker

---

## ✅ Pré-Requis

- [ ] **WSL 2 + Ubuntu** (ex: Ubuntu-22.04)
- [ ] **Docker Desktop**

  - Settings → Resources → WSL Integration
  - Cocher "Enable integration with my default WSL distro"
  - Cocher distro Ubuntu (ex: Ubuntu-22.04)
  - Apply & Restart

- [ ] **Git**

```bash
apt get update
apt install git
git config --global user.name "John Doe"
git config --global user.email johndoe@example.com
```

- [ ] **Composer**

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

- [ ] **Node.js + npm**

```bash
npm install -g npm
```

---

## 🚀 Démarrage d’un nouveau projet

### 1. Cloner le repo

```bash
git clone git@github.com:DerouillonAlice/wordpress-with-sage-template.git mon-projet
cd mon-projet
```

### 2. Initialisation

Renommer le docker compose

```bash
cp docker-compose.yml.example docker-compose.yml
```

Corriger le .env en mettant le nom du projet et remplir les champs suivants

```bash
cp .env.example .env
nano .env
```

- [ ] PROJECT_NAME
- [ ] DB_NAME, DB_USER, DB_PASSWORD, DB_ROOT_PASSWORD
- [ ] Génèrer et coller les salts ici → https://roots.io/salts.html

### 3. Configuration

Ajouter l'utilisateur WSL au groupe www-data (Apache)

```bash
#remplacer $USER par utilisateur wsl
sudo usermod -a -G www-data $USER #a faire que la première fois
sudo chown -R $USER:www-data web
sudo chmod -R 775 web
```

Modifier le nom du projet sur le **dossier theme** et dans le fichier vite.config.js

```bash
  cd web/app/themes
  mv zetruc-theme mon-projet
  cd mon-projet
  nano vite.config.js
  #ligne à remplacer : base: '/app/themes/mon-projet/public/build/',
```

### 4. Démarrer les containers Docker

Démarrage initial (dans le dossier racine)

```bash
docker compose --env-file .env up --build -d
```

### 5. Installer les dépendances

Dans le dossier themes (web/app/themes/mon-projet)

```bash
npm install
composer install
```

Dans le dossier racine

```bash
composer install
```

Compilation (dans le dossier du thème)

```bash
npm run build
```

### Finalisation

- [ ] Accéder à WordPress :
      http://localhost:8000/

- [ ] Installer WordPress normalement (compte admin, nom du site…)

- [ ] Activer le thème dans Apparence > Thèmes
      
- [ ] Installer Extension "Advanced Custom Fields	(ACF)" et l'Activer

- [ ] Régler les permaliens : Réglages > Permaliens > Titre de la publication

- [ ] Créer une page d'accueil dans pages

- [ ] Configurer la page d'accueil : Réglages > Lecture > Une page statique > Page d'accueil (sélectionner la page créée)

#### Pour augmenter la limite d’upload (facultatif)

Ajouter dans web/.htaccess :

```apache
php_value upload_max_filesize 10M
php_value post_max_size 20M
```

Fait avec ❤️ par Alice
# sage_woocommerce
# sage_woocommerce
