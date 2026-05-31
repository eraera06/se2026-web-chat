# Deployment Guide - WebChat

## Overview

Ky dokument pershkruan hapat per instalimin dhe ekzekutimin e aplikacionit WebChat ne nje mjedis lokal.

## Requirements

* XAMPP
* PHP 8+
* MySQL
* Web Browser (Chrome ose Firefox)

## Installation

### 1. Install XAMPP

Shkarko dhe instalo XAMPP.

### 2. Copy Project Files

Kopjo projektin WebChat ne folderin:

```text
xampp/htdocs/WebChat
```

### 3. Start Services

Hap XAMPP Control Panel dhe aktivizo:

* Apache
* MySQL

### 4. Create Database

Hap phpMyAdmin.

Krijo databazen:

```sql
WebChat
```

Importo skedarin SQL te projektit.

### 5. Configure Database Connection

Kontrollo skedarin:

```text
config/db.php
```

dhe vendos parametrat e databazes.

### 6. Run Application

Hap shfletuesin dhe vizito:

```text
http://localhost/WebChat
```

## Verification

Kontrollo qe:

* Regjistrimi funksionon
* Login funksionon
* Dergimi i mesazheve funksionon
* Historiku i bisedave shfaqet sakte

## Troubleshooting

### Apache nuk ndizet

* Kontrollo nese porti 80 eshte ne perdorim.
* Ndrysho portin ne konfigurimin e Apache.

### MySQL nuk ndizet

* Kontrollo nese porti 3306 ose 3307 eshte ne perdorim.

### Gabim ne lidhjen me databazen

* Verifiko emrin e databazes.
* Verifiko username dhe password ne db.php.
