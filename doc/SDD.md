# Software Design Document (SDD) - WebChat

## 1. System Architecture

WebChat perdor arkitekturen Client-Server.

### Frontend

* HTML
* CSS
* JavaScript
* AJAX

### Backend

* PHP

### Database

* MySQL
* phpMyAdmin

## 2. System Components

### Authentication Module

Ky modul menaxhon regjistrimin, hyrjen dhe daljen e perdoruesve nga sistemi.

Funksionet:

* Regjistrimi i perdoruesit
* Login
* Logout
* Menaxhimi i sesioneve

### Chat Module

Ky modul menaxhon komunikimin midis perdoruesve.

Funksionet:

* Dergimi i mesazheve
* Marrja e mesazheve
* Bisedat private
* Bisedat ne grup
* Historiku i bisedave

### Database Module

Ky modul ruan dhe menaxhon te dhenat e sistemit.

Tabelat kryesore:

* users
* chats
* chat_members
* messages

### User Interface Module

Ky modul menaxhon nderfaqen grafike te aplikacionit.

Funksionet:

* Faqja Login
* Faqja Register
* Faqja Chat
* Lista e perdoruesve
* Lista e bisedave

## 3. Database Design

### users

* id
* name
* email
* password
* is_online
* created_at

### chats

* id
* name
* type
* created_by
* created_at

### chat_members

* id
* chat_id
* user_id
* joined_at

### messages

* id
* chat_id
* sender_id
* message
* created_at

## 4. Security

* Fjalekalimet ruhen te enkriptuara.
* Vetem perdoruesit e autentifikuar kane akses ne sistem.
* Sesionet menaxhohen ne server.

## 5. Performance

* Mesazhet perditesohen pa rifreskim te faqes duke perdorur AJAX.
* Sistemi duhet te pergjigjet brenda 2 sekondave per veprimet kryesore.
