# Test Report - WebChat

## Overview

Ky dokument paraqet rezultatet e testimit te funksionaliteteve kryesore te aplikacionit WebChat.

## Test 1 - User Registration

Input:

* Emri i perdoruesit
* Email valid
* Fjalekalim valid

Expected Result:
Perdoruesi regjistrohet me sukses dhe ruhet ne databaze.

Actual Result:
Perdoruesi u regjistrua me sukses.

Status:
PASS

---

## Test 2 - User Login

Input:

* Email valid
* Fjalekalim i sakte

Expected Result:
Perdoruesi identifikohet ne sistem dhe ridrejtohet ne faqen e chat-it.

Actual Result:
Perdoruesi u identifikua me sukses.

Status:
PASS

---

## Test 3 - User Logout

Input:
Klikim ne butonin Logout.

Expected Result:
Sesioni mbyllet dhe perdoruesi ridrejtohet ne Login.

Actual Result:
Perdoruesi doli me sukses nga sistemi.

Status:
PASS

---

## Test 4 - Send Message

Input:
Mesazh tekst.

Expected Result:
Mesazhi dergohet dhe shfaqet ne bisede.

Actual Result:
Mesazhi u dergua me sukses.

Status:
PASS

---

## Test 5 - Receive Message

Input:
Mesazh nga nje perdorues tjeter.

Expected Result:
Mesazhi shfaqet automatikisht ne bisede.

Actual Result:
Mesazhi u shfaq me sukses.

Status:
PASS

---

## Test 6 - View Chat History

Input:
Hapja e nje bisede ekzistuese.

Expected Result:
Shfaqet historiku i mesazheve.

Actual Result:
Historiku u shfaq sakte.

Status:
PASS

## Summary

Total Tests: 6

Passed: 6

Failed: 0

Result: SUCCESS
