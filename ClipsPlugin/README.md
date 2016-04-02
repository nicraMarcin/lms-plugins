# Clipslugin

Zarządzanie sesjami CLIPS dla SmartEdge.

## Konfiguracja

Dodaj sekcję [clips] do lms.ini:
```
[clips]
; SSH to context with CLIPS
ssh_user = user
ssh_pass = pass
ssh_port = 22
ssh_host = 127.0.0.1

; CLIPS setting
clips_session_info = "show subscribers active username"
forward_policy_default = "in:DEFAULT"
forward_policy_redirect = "in:REDIRECT"
http_redirect = "KOMUNIKATY"
context = "CLIPS"

; NAS client
nas_ip = 127.0.0.1
nas_pass = pass
```

## Instalacja 

* Aktywuj plugin w zakładce `Konfiguracja => Wtyczki`

## Kontakt

lukasz@alfa-system.pl
