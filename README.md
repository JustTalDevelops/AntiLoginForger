# AntiLoginForger
A quite hacky work around to prevent login replay attacks on PM3 servers.

## How do I use this?
Drop in the .phar into your server's plugins, and edit the config.yml to contain the addresses that should be usable to
connect.

## How does this even work?
Login replay attacks do not allow the attacker to edit any of the client data. If it was edited, the JWT signature
would become epic borked and the login would be denied. Hacky but hey it works!
