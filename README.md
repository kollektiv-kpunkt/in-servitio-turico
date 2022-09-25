
<p align="center">
  <a href="https://kpunkt.ch" target="_blank">
    <img src="./resources/images/gh_banner.png" alt="In servitio Turico" width="100%" height="auto">
  </a>
</p>

# In servitio Turico - In the service of Zürich

**Wordpress Theme originally built for the cantonal election campaign in the canton of Zürich in on February 12th 2023.**

## Roadmap
| Deadline              | Task                |
| ---------             | ---                 |
| 26.09.2022            | Clickable Protype on [staging Domain](https://pn53.kpunkt.ch) |
| 29.10.2022            | Fill data and feedback by client. |
| 03.06.2022            | Preparing for launch |
| 06.06.2022            | Launch of page on [hot domain](https://wahlen-kanton-zuerich.ch) |
| Post 06.06.2022       | Writing of documentation etc. |

## Requirements
- [DDEV](https://github.com/drud/ddev): Used as development environment
- [PHP](https://www.php.net/) version 7.4 or greater
- [MySQL](https://www.mysql.com/) version 5.7 or greater OR [MariaDB](https://mariadb.org/) version 10.3 or greater.
- [Composer](https://getcomposer.org/)
- [NodeJS](https://nodejs.org/en/) and [NPM](https://www.npmjs.com/)

> :warning: **This theme uses [Advanced custom fields ACF](https://www.advancedcustomfields.com/).** If you do not own a license for this plugin, consider buying it. If you are a member of the democratic socialist party of Switzerland, please contact [Timothy Oesch](mailto:timothy@kpunkt.ch)

## Setup
Clone respository. Make sure you have an instance of docker running, then
```
# cd into wordpress folder of repo
cd /path/to/repo/wordpress

# Config DDEV
ddev config
# Follow the steps of the setup

# Run DDEV SSH
ddev ssh

# cd into theme directory
cd wp-content/themes/in-servitio-turico

# Install composer dependencies
composer install

# Install NPM packages
npm install

# Run one of the build scripts
npm run watch
# Watching for changes OR
npm run prod
# Building a production ready bundle
```

## Todos
- [ ] Clickable Prototype
- [ ] Documentation
- [ ] ACF Alternative

<br>
<br>

```
,--.                                           ,--.  ,--.  ,--.           ,--------.               ,--.
|  |,--,--,      ,---.  ,---. ,--.--.,--.  ,--.`--',-'  '-.`--' ,---.     '--.  .--',--.,--.,--.--.`--' ,---. ,---.
|  ||      \    (  .-' | .-. :|  .--' \  `'  / ,--.'-.  .-',--.| .-. |       |  |   |  ||  ||  .--',--.| .--'| .-. |
|  ||  ||  |    .-'  `)\   --.|  |     \    /  |  |  |  |  |  |' '-' '       |  |   '  ''  '|  |   |  |\ `--.' '-' '
`--'`--''--'    `----'  `----'`--'      `--'   `--'  `--'  `--' `---'        `--'    `----' `--'   `--' `---' `---'
https://github.com/kollektiv-kpunkt/in-servitio-turico
________________________________________________________________________________________________________________________
 ______  __  __  ______  __    __  ______       ______  __  __       __  __
/\__  _\/\ \_\ \/\  ___\/\ "-./  \/\  ___\     /\  == \/\ \_\ \     /\ \/ /
\/_/\ \/\ \  __ \ \  __\\ \ \-./\ \ \  __\     \ \  __<\ \____ \    \ \  _"-.
   \ \_\ \ \_\ \_\ \_____\ \_\ \ \_\ \_____\    \ \_____\/\_____\    \ \_\ \_\
    \/_/  \/_/\/_/\/_____/\/_/  \/_/\/_____/     \/_____/\/_____/     \/_/\/_/
```
