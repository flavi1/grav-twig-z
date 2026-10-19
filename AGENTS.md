# Guide du dépôt grav-twig-z

- En français. Ne jamais versionner de secret ni de configuration réelle de site.
- Déploiement : à chaque push sur `main`, `.github/workflows/deploy.yml` envoie le dépôt par rsync sur SSH (secrets
  `FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`) vers `<home>/shared/grav-2/user/plugins/twig-z/`.
  Aucun fichier n'est supprimé sur le serveur ; un fichier n'est remplacé que si son contenu diffère, l'ancienne version
  étant gardée dans `<home>/tmp/deploy-backups/grav-twig-z/<date>/`. Exclus : `.git`, `.github`, `.gitignore`, `AGENTS.md`.
- Utilisé par tous les sites Grav 2 de l'hébergement : tester avant de pousser.
- La tâche planifiée de mise à jour (php-global-page-router) ne touche jamais cette extension (« github.com/flavi1 »).
- `.deploy-ok` : témoin du premier déploiement, à retirer une fois le déploiement confirmé.
