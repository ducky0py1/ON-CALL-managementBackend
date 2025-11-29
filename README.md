Gestion d'Astreinte – API Backend
Backend RESTful développé avec Laravel, destiné à une application de gestion des plannings d’astreinte du personnel.
Il fournit une interface sécurisée pour gérer les services, les agents, les utilisateurs, les plannings, ainsi que la rotation automatique des astreintes.

 Fonctionnalités
 Authentification Multi-Rôles
	• Administrateurs & Secrétaires : Authentification via token (Laravel Sanctum).
	• Agents : Connexion via matricule + code temporaire et token dédié.
	• Public : Consultation sécurisée des plannings via un token unique (UUID).
 Permissions & Rôles
	• Administrateur : Accès complet (utilisateurs, services, plannings, etc.).
	• Secrétaire : Gestion des agents et plannings de ses services.
	• Agent : Consultation de son planning + gestion de ses indisponibilités.
 API RESTful (CRUD)
	• Utilisateurs (Users)
	• Services (Services)
	• Agents (Agents)
	• Périodes d’Astreinte (PeriodesAstreinte)
	• Plannings (Plannings)
	• Indisponibilités (IndisponibilitesAgent)
🧠 Logique Métier
	• Génération automatique du planning via rotation alphabétique.
	• Prise en compte des indisponibilités.
	• Gestion des périodes journalières (jours fériés) ou hebdomadaires.

 Stack Technique
	• Laravel 11+
	• PHP 8.2+
	• MySQL 8.0+
	• Authentification : Laravel Sanctum
	• Gestion des dépendances : Composer

 Installation & Mise en Place
Prérequis
	• PHP 8.2+
	• Composer
	• MySQL / MariaDB
	• Git

Installation
	1. Cloner le dépôt
git clone https://github.com/VOTRE_NOM_UTILISATEUR/VOTRE_REPO.git
	2. Se rendre dans le dossier
cd gestion-astreinte-backend
	3. Installer les dépendances
composer install

 Configuration
	1. Créer le fichier .env
cp .env.example .env
	2. Générer la clé Laravel
php artisan key:generate
	3. Configurer la base de données dans .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_astreinte
DB_USERNAME=root
DB_PASSWORD=VOTRE_MOT_DE_PASSE_MYSQL
	4. Définir le driver de session
SESSION_DRIVER=array

 Base de Données
	1. Créer la base gestion_astreinte dans votre SGBD.
	2. Exécuter les migrations + seeders
php artisan migrate:fresh --seed

⚠️ Supprime toutes les données existantes.

▶️ Lancer l’API
php artisan serve
API disponible ici :
👉 http://127.0.0.1:8000

🔑 Endpoints (Aperçu)
🔐 Authentification
	• POST /api/login — Connexion Admin / Secrétaire
	• POST /api/agent/login — Connexion Agent
 Administrateur (is.admin)
	• GET/POST/PUT/DELETE /api/users
	• POST /api/plannings/generer
 Admin & Secrétaire (rôles authentifiés)
	• CRUD Services
	• CRUD Agents
	• CRUD Plannings
 Agent
	• GET /api/agent/me/planning
	• POST /api/agent/me/indisponibilites
 Public
	• GET /api/public/plannings/{token}

 Rôles & Permissions
Rôle	Accès
Admin	Total
Secrétaire	Services dont elle est responsable
Agent	Son planning + indisponibilités
<img width="880" height="3017" alt="image" src="https://github.com/user-attachments/assets/ce953ffa-d5a2-46ea-9797-46d2a7164f50" />
