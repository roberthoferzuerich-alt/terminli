# Terminli 📅

Eine moderne, benutzerfreundliche Webapplikation zur unkomplizierten Terminfindung, Abstimmung und Anforderungsverwaltung. **Terminli** bietet eine datenschutzfreundliche Alternative zu gängigen Umfragetools (wie Doodle), ergänzt durch integrierte Tools zum Verwalten von User Stories und einer umfassenden Dokumentation.

---

## 🚀 Hauptfunktionen (Features)

### 📅 1. Terminfindung & Umfragen (Polls)
* **Einfache Erstellung:** Erstellen von Abstimmungen für Meetings, Events oder allgemeine Entscheidungen mit individuellen Termin- oder Textoptionen.
* **Teilnahme ohne Registrierung:** Teilnehmer können direkt über eine eindeutige UUID-URL an der Abstimmung teilnehmen – ganz ohne Zwang zur Erstellung eines Benutzerkontos.
* **Stimmen bearbeiten:** Flexibles Anpassen der eigenen Stimmen über einen individuellen Edit-Token.
* **Übersichtliches Dashboard:** Angemeldete Benutzer verwalten all ihre erstellten Umfragen an einem zentralen Ort.

### 📝 2. User Stories Management
* **Anforderungen festhalten:** Erstellen, Verwalten und Priorisieren von User Stories (inkl. Titel, Beschreibung, Priorität und Akzeptanzkriterien).
* **Live-Vorschau:** Überprüfung der Formatierung und Inhalte vor dem finalen Speichern.
* **Detailansicht & Export:** Übersichtliche Darstellung aller Stories inkl. Export-/Download-Funktion.

### 📖 3. Integriertes Benutzerhandbuch
* Dokumentation und Anleitung direkt in der Applikation unter `/handbuch` aufrufbar.

### 👤 4. Benutzer- & Profilverwaltung
* Sichere Registrierung und Authentifizierung (Laravel Breeze).
* Profilverwaltung mit Anpassungsmöglichen.

---

## 🛠️ Technologie-Stack

| Komponente | Technologie |
| :--- | :--- |
| **Backend** | PHP 8.3 / Laravel 13 |
| **Authentifizierung** | Laravel Breeze |
| **Frontend** | Laravel Blade Templates, Tailwind CSS |
| **Asset Bundling** | Vite / NPM |
| **Datenbank** | SQLite / MySQL / PostgreSQL (via Eloquent ORM) |
| **Code Formatting** | Laravel Pint |
| **Testing** | PHPUnit / Laravel Test Suite |

---

## 📋 Voraussetzungen (Requirements)

* **PHP:** `>= 8.3` (mit Erweiterungen: PDO, mbstring, openssl, tokenizer, xml)
* **Composer:** `>= 2.0`
* **Node.js & NPM:** Node `>= 18.x`
* **Datenbank:** SQLite (Standard) oder MySQL/PostgreSQL

---

## 📦 Installation & Setup

### 1. Repository klonen
```bash
git clone https://github.com/roberthoferzuerich-alt/terminli.git
cd terminli
```

### 2. PHP & Frontend-Abhängigkeiten installieren
```bash
composer install
npm install
```

### 3. Umgebungsdatei (.env) einrichten
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Datenbank einrichten & Migrationen ausführen
Falls Sie SQLite verwenden:
```bash
touch database/database.sqlite
php artisan migrate --seed
```

### 5. Entwicklungsserver starten
Starten Sie den Vite-Dev-Server und den Laravel-Entwicklungsserver parallel:
```bash
# Frontend Assets im Watch-Modus
npm run dev

# Laravel Server (in einem zweiten Terminal)
php artisan serve
```

Alternativ über Composer:
```bash
composer run dev
```

Die Anwendung ist nun unter `http://127.0.0.1:8000` erreichbar.

---

## 🧪 Testing & Codequalität

Das Projekt setzt auf automatisierte Tests und einheitliche Code-Standards.

* **Automatisierte Tests ausführen:**
  ```bash
  php artisan test
  ```
* **Code-Formatierung prüfen/korrigieren (Laravel Pint):**
  ```bash
  vendor/bin/pint
  ```

---

## 📄 Lizenz & Autor

Entwickelt von **Robert Hofer**.  
Lizenziert unter der [MIT License](LICENSE).
