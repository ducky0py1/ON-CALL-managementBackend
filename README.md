<<<<<<< HEAD
# 🚀 Gestion d'Astreinte - API Backend

> API RESTful développée avec Laravel pour une application de gestion de plannings d'astreinte du personnel.

Ce projet constitue le backend pour l'application de gestion d'astreinte. Il fournit une interface sécurisée pour gérer les services, les agents, les utilisateurs, les plannings et l'automatisation de la rotation des astreintes.

---

## ✨ Fonctionnalités Principales

*   **Authentification Multi-Rôles :**
    *   Authentification par token (Laravel Sanctum) pour les **Administrateurs** et **Secrétaires**.
    *   Système d'accès sécurisé par code temporaire et token dédié pour les **Agents**.
    *   Accès public sécurisé par token unique (UUID) pour la consultation de planning.
*   **Gestion des Permissions :**
    *   **Administrateurs :** Accès total, gestion des utilisateurs et des services.
    *   **Secrétaires :** Accès limité à la gestion des agents et plannings de leurs services respectifs.
*   **API RESTful CRUD Complète** pour les ressources suivantes :
    *   Utilisateurs (`Users`)
    *   Services (`Services`)
    *   Agents (`Agents`)
    *   Périodes d'Astreinte (`PeriodesAstreinte`)
    *   Plannings / Affectations (`Plannings`)
    *   Indisponibilités (`IndisponibilitesAgent`)
*   **Logique Métier Avancée :**
    *   Génération automatique des plannings basée sur un algorithme de **rotation alphabétique**.
    *   Gestion des indisponibilités des agents lors de la génération.
    *   Flexibilité pour gérer des périodes d'astreinte journalières (jours fériés) ou hebdomadaires.

---

## 🛠️ Stack Technique

*   **Framework :** Laravel 11+
*   **Langage :** PHP 8.2+
*   **Base de données :** MySQL 8.0+
*   **Authentification API :** Laravel Sanctum
*   **Gestion des dépendances :** Composer

---

## 🚀 Démarrage Rapide

Suivez ces instructions pour obtenir une copie du projet fonctionnelle sur votre machine locale à des fins de développement et de test.

### Prérequis

Assurez-vous d'avoir les outils suivants installés sur votre machine :
*   PHP (version 8.2 ou supérieure)
*   Composer
*   MySQL (ou un équivalent comme MariaDB)
*   Git

### Installation

1.  **Clonez le dépôt**
    ```bash
    git clone https://github.com/VOTRE_NOM_UTILISATEUR/VOTRE_REPO.git
    ```

2.  **Naviguez dans le dossier du projet**
    ```bash
    cd gestion-astreinte-backend
    ```

3.  **Installez les dépendances PHP**
    ```bash
    composer install
    ```

### Configuration

1.  **Créez votre fichier d'environnement**
    Copiez le fichier d'exemple `.env.example` pour créer votre propre configuration.
    ```bash
    cp .env.example .env
    ```

2.  **Générez la clé de l'application**
    C'est une étape cruciale pour la sécurité de Laravel.
    ```bash
    php artisan key:generate
    ```

3.  **Configurez votre base de données**
    Ouvrez le fichier `.env` que vous venez de créer et modifiez les lignes suivantes pour correspondre à votre configuration MySQL locale :
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=gestion_astreinte
    DB_USERNAME=root
    DB_PASSWORD=VOTRE_MOT_DE_PASSE_MYSQL
    ```

4.  **Configurez le driver de session pour l'API**
    Assurez-vous que le driver de session est bien configuré pour une API stateless dans votre fichier `.env` :
    ```dotenv
    SESSION_DRIVER=array
    ```

### 🗄️ Base de Données

1.  **Créez la base de données**
    Dans votre outil de gestion de base de données (phpMyAdmin, DBeaver, etc.), créez une nouvelle base de données vide nommée `gestion_astreinte`.

2.  **Lancez les migrations et les seeders**
    Cette commande unique va détruire les anciennes tables, recréer toute la structure de la base de données et la remplir avec les données de test initiales (comme l'utilisateur admin).
    ```bash
    php artisan migrate:fresh --seed
    ```
    > **Attention :** Cette commande efface toutes les données existantes dans la base.

### ▶️ Lancer l'Application

Vous pouvez maintenant lancer le serveur de développement local de Laravel :
```bash
php artisan serve
Votre API sera accessible à l'adresse http://127.0.0.1:8000.
🔑 Endpoints de l'API (Exemples)
L'API est accessible via le préfixe /api.
Authentification
POST /api/login : Connexion pour Admin/Secrétaire.
POST /api/agent/login : Connexion pour un Agent avec matricule et code temporaire.
Routes Administrateur (protégées par is.admin)
GET, POST, PUT, DELETE /api/users : CRUD pour les utilisateurs.
POST /api/plannings/generer : Déclenche la génération de planning.
Routes Authentifiées (Admin & Secrétaire)
GET, POST, PUT, DELETE /api/services : CRUD pour les services (limité par Policy).
GET, POST, PUT, DELETE /api/agents : CRUD pour les agents (limité par Policy).
GET, POST, PUT, DELETE /api/plannings : CRUD pour les affectations (limité par Policy).
Routes Agent (authentifié en tant qu'agent)
GET /api/agent/me/planning : Consulter son planning personnel.
POST /api/agent/me/indisponibilites : Soumettre une demande d'indisponibilité.
Route Publique
GET /api/public/plannings/{token} : Consulter un planning via un lien secret permanent.
👤 Rôles et Permissions
Le système de permissions est géré par des Middlewares et des Policies Laravel :
Admin : A un accès total à toutes les ressources de l'API.
Secrétaire : Peut uniquement voir et gérer les ressources (agents, plannings, etc.) appartenant aux services dont elle est responsable.
Agent : Peut uniquement consulter son propre planning et soumettre ses propres indisponibilités.
=======
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

🔑 Endpoints de l'API (Exemples)

L'API est accessible via le préfixe /api.

Authentification
-POST /api/login : Connexion pour Admin/Secrétaire.
-POST /api/agent/login : Connexion pour un Agent avec matricule et code temporaire.
-Routes Administrateur (protégées par is.admin)
-GET, POST, PUT, DELETE /api/users : CRUD pour les utilisateurs.
-POST /api/plannings/generer : Déclenche la génération de planning.
-Routes Authentifiées (Admin & Secrétaire)
-GET, POST, PUT, DELETE /api/services : CRUD pour les services (limité par Policy).
-GET, POST, PUT, DELETE /api/agents : CRUD pour les agents (limité par Policy).
-GET, POST, PUT, DELETE /api/plannings : CRUD pour les affectations (limité par Policy).
-Routes Agent (authentifié en tant qu'agent)
-GET /api/agent/me/planning : Consulter son planning personnel.
-POST /api/agent/me/indisponibilites : Soumettre une demande d'indisponibilité.
-Route Publique
-GET /api/public/plannings/{token} : Consulter un planning via un lien secret permanent.

👤 Rôles et Permissions
Le système de permissions est géré par des Middlewares et des Policies Laravel :
Admin : A un accès total à toutes les ressources de l'API.
Secrétaire : Peut uniquement voir et gérer les ressources (agents, plannings, etc.) appartenant aux services dont elle est responsable.
Agent : Peut uniquement consulter son propre planning et soumettre ses propres indisponibilités.


 Rôles & Permissions
Rôle	Accès
Admin	Total
Secrétaire	Services dont elle est responsable
Agent	Son planning + indisponibilités

>>>>>>> a128c5a1f55aa5cfb4627edb5c862dd202d46d38
