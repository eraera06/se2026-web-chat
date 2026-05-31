# Database Schema - WebChat

## 1. Overview

Databaza e projektit WebChat perdoret per ruajtjen e perdoruesve, bisedave, anetareve te bisedave dhe mesazheve. Sistemi perdor MySQL dhe menaxhohet permes phpMyAdmin.

## 2. Tables

### users

Tabela `users` ruan te dhenat e perdoruesve te regjistruar ne sistem.

| Field      | Type                             | Description                         |
| ---------- | -------------------------------- | ----------------------------------- |
| id         | INT, Primary Key, Auto Increment | Identifikues unik i perdoruesit     |
| name       | VARCHAR(100)                     | Emri i perdoruesit                  |
| email      | VARCHAR(150), Unique             | Email-i i perdoruesit               |
| password   | VARCHAR(255)                     | Fjalekalimi i enkriptuar            |
| is_online  | BOOLEAN                          | Tregon nese perdoruesi eshte online |
| created_at | DATETIME                         | Data e krijimit te llogarise        |

### chats

Tabela `chats` ruan informacionin per bisedat private dhe bisedat ne grup.

| Field      | Type                             | Description                                   |
| ---------- | -------------------------------- | --------------------------------------------- |
| id         | INT, Primary Key, Auto Increment | Identifikues unik i bisedes                   |
| name       | VARCHAR(100)                     | Emri i bisedes, perdoret kryesisht per grupet |
| type       | ENUM('private','group')          | Lloji i bisedes                               |
| created_by | INT, Foreign Key                 | Perdoruesi qe krijoi biseden                  |
| created_at | DATETIME                         | Data e krijimit te bisedes                    |

### chat_members

Tabela `chat_members` ruan lidhjen midis perdoruesve dhe bisedave ku ata marrin pjese.

| Field     | Type                             | Description                            |
| --------- | -------------------------------- | -------------------------------------- |
| id        | INT, Primary Key, Auto Increment | Identifikues unik                      |
| chat_id   | INT, Foreign Key                 | ID e bisedes                           |
| user_id   | INT, Foreign Key                 | ID e perdoruesit                       |
| joined_at | DATETIME                         | Data kur perdoruesi iu bashkua bisedes |

### messages

Tabela `messages` ruan mesazhet e derguara nga perdoruesit.

| Field      | Type                             | Description                         |
| ---------- | -------------------------------- | ----------------------------------- |
| id         | INT, Primary Key, Auto Increment | Identifikues unik i mesazhit        |
| chat_id    | INT, Foreign Key                 | ID e bisedes ku u dergua mesazhi    |
| sender_id  | INT, Foreign Key                 | ID e perdoruesit qe dergoi mesazhin |
| message    | TEXT                             | Permbajtja e mesazhit               |
| created_at | DATETIME                         | Data dhe ora e dergimit te mesazhit |

## 3. Relationships

* Nje perdorues mund te krijoje disa biseda.
* Nje bisede mund te kete disa anetare.
* Nje perdorues mund te jete pjese e disa bisedave.
* Nje bisede mund te kete shume mesazhe.
* Cdo mesazh i perket nje bisede dhe nje derguesi.

## 4. Primary Keys

* users.id
* chats.id
* chat_members.id
* messages.id

## 5. Foreign Keys

* chats.created_by references users.id
* chat_members.chat_id references chats.id
* chat_members.user_id references users.id
* messages.chat_id references chats.id
* messages.sender_id references users.id
