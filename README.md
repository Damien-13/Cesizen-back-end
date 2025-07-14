# 🛠️ Backend – CESIZen

Ce dépôt contient le **back-end de l’application CESIZen**, développé avec le framework **Laravel**. Il fournit l’API nécessaire au fonctionnement du front-end React/TypeScript.

CESIZen est un projet scolaire réalisé dans le cadre de la formation **Concepteur Développeur d’Applications (CDA)**. L’objectif est de proposer une plateforme autour de la **santé mentale** et de la **gestion du stress**, avec une attention particulière à la sécurité des données sensibles.

---

## 🔗 Modules disponibles

Cette API gère :

- 👤 **Utilisateurs** : création de compte, connexion, gestion des profils.
- 📚 **Articles d'information** : accès public, gestion via back-office.
- 🧘 **Exercices de respiration** : consultation et configuration.

> Les autres modules (diagnostics, tracker émotionnel...) **ne sont pas intégrés** dans ce dépôt.

---

## ⚙️ Installation & configuration

### 📦 Prérequis

- PHP >= 8.1
- Composer
- Base de données MySQL ou équivalent
- (Optionnel mais recommandé) Docker & Docker Compose

### 🐳 Installation avec Docker (recommandé)

```bash
cp .env.example .env
docker-compose up -d --build
docker exec -it app php artisan key:generate
docker exec -it app php artisan migrate
