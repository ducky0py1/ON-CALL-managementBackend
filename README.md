# Gestion d'Astreinte - API Backend

Backend RESTful développé avec Laravel pour une application de gestion des plannings d'astreinte. Fournit une API sécurisée pour gérer les services, les agents, les utilisateurs, les plannings et la rotation automatique des astreintes.

## Fonctionnalités principales

- Authentification multi-rôles
  - Administrateurs et secrétaires : authentification via token (Laravel Sanctum).
  - Agents : connexion via matricule + code temporaire et token dédié.
  - Public : consultation sécurisée des plannings via un token unique (UUID).
- Gestion des permissions
  - Administrateur : accès complet à toutes les ressources.
  - Secrétaire : gestion des agents et des plannings des services dont elle est responsable.
  - Agent : consultation de son planning et gestion de ses indisponibilités.
- API RESTful (CRUD) pour :
  - Users, Services, Agents, PeriodesAstreinte, Plannings, IndisponibilitesAgent.
- Logique métier
  - Génération automatique des plannings par rotation alphabétique.
  - Prise en compte des indisponibilités lors de la génération.
  - Support des périodes journalières (jours fériés) et hebdomadaires.

## Stack technique

- Framework : Laravel 11+
- PHP : 8.2+
- Base de données : MySQL 8.0+ (compatible MariaDB)
- Authentification API : Laravel Sanctum
- Gestion des dépendances : Composer

## Démarrage rapide

Instructions pour obtenir et exécuter le projet localement.

### Prérequis

- PHP 8.2 ou supérieur
- Composer
- MySQL ou MariaDB
- Git

### Installation

1. Cloner le dépôt
```bash
git clone https://github.com/VOTRE_NOM_UTILISATEUR/VOTRE_REPO.git
```

2. Se rendre dans le dossier du projet
```bash
cd gestion-astreinte-backend
```

3. Installer les dépendances PHP
```bash
composer install
```

### Configuration

1. Copier le fichier d'exemple d'environnement
```bash
cp .env.example .env
```

2. Générer la clé de l'application
```bash
php artisan key:generate
```

3. Configurer la base de données dans `.env` (exemple)
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_astreinte
DB_USERNAME=root
DB_PASSWORD=VOTRE_MOT_DE_PASSE_MYSQL
```

4. Configurer le driver de session pour l'API (stateless)
```dotenv
SESSION_DRIVER=array
```

### Base de données

1. Créer la base de données `gestion_astreinte` dans votre SGBD.

2. Lancer les migrations et les seeders (attention : efface les données existantes)
```bash
php artisan migrate:fresh --seed
```

### Lancer l'application

Démarrer le serveur de développement Laravel :
```bash
php artisan serve
```

L'API sera disponible par défaut sur : http://127.0.0.1:8000

## Endpoints principaux (exemples)

L'API est préfixée par `/api`.

Authentification
- POST /api/login
  - Description : connexion pour Admin / Secrétaire. Renvoie un token Sanctum.
  - Corps JSON attendu : `{ "email": "...", "password": "..." }`

- POST /api/agent/login
  - Description : connexion pour un agent via matricule et code temporaire.
  - Corps JSON attendu : `{ "matricule": "...", "code_temporaire": "..." }`

Routes administrateur (protégées par middleware `is.admin`)
- GET, POST, PUT, DELETE /api/users
  - CRUD pour les utilisateurs.
- POST /api/plannings/generer
  - Déclenche la génération automatique de plannings.

Routes authentifiées (Admin & Secrétaire)
- GET, POST, PUT, DELETE /api/services
- GET, POST, PUT, DELETE /api/agents
- GET, POST, PUT, DELETE /api/plannings

Routes agent (authentifié en tant qu'agent)
- GET /api/agent/me/planning
  - Consulter son planning personnel.
- POST /api/agent/me/indisponibilites
  - Soumettre une indisponibilité.

Route publique
- GET /api/public/plannings/{token}
  - Consulter un planning via un lien public sécurisé (UUID).

## Rôles et permissions

Les permissions sont gérées par des middlewares et des policies Laravel :

- Admin : accès total.
- Secrétaire : accès en écriture/lecture limité aux services dont elle est responsable.
- Agent : accès à ses propres données (planning, indisponibilités).

## Exemples d'utilisation (curl)

Connexion Admin/Secrétaire :
```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"secret"}'
```

Récupérer la liste des services (exemple avec token Bearer) :
```bash
curl -H "Authorization: Bearer VOTRE_TOKEN" http://127.0.0.1:8000/api/services
```


