# Guide du dépôt grav-twig-z

- En français. Ne jamais versionner de secret ni de configuration réelle de site.
- Déploiement : à chaque push sur `main`, `.github/workflows/deploy.yml` envoie le dépôt par rsync sur SSH (secrets
  `FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`) vers `<home>/shared/grav-2/user/plugins/twig-z/`.
  Le dossier du serveur est un miroir du dépôt (fichiers en trop supprimés) ; tout fichier remplacé ou supprimé est
  d'abord gardé dans `<home>/tmp/deploy-backups/grav-twig-z/<date>/`. Exclus : `.git`, `.github`, `.gitignore`, `AGENTS.md`.
- Utilisé par tous les sites Grav 2 de l'hébergement : tester avant de pousser.
- La tâche planifiée de mise à jour (php-global-page-router) ne touche jamais cette extension (« github.com/flavi1 »).
