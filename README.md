[Blogza](http://blogza.net)
======

> Blogza is an open source blogging framework, designed to make blogging enjoyable and keep it simple. The software is designed to be structured well to keep development easy and keep the website fast.

[![Build Status](https://travis-ci.org/boboman13/Blogza.png?branch=master)](https://travis-ci.org/boboman13/Blogza)
[![Stories in Ready](https://badge.waffle.io/boboman13/Blogza.png?label=ready)](https://waffle.io/boboman13/Blogza) 

### Setup
```bash
$ cd /var/www
$ git clone https://github.com/boboman13/Blogza.git
```

Then set the web base directory (via Apache, nginx, Lighttpd, etc) to /var/www/Blogza, or the chosen web directory.

Then edit the `system/settings.php` to the wished settings. Right after, edit the `system/routes.php` and uncomment the 19th and 20th lines. Navigate to `http://{web_server}/install/` and follow the installation instructions. It will go up to the first admin user creation.

Immediately afterwards, navigate to `http://{web_server}/` and comment the 19th and 20th lines in `system/settings.php`. Your Blogza blog is now installed.

### Contributing
Simply fork the project, add your changes to the local repository, then submit a pull request in the `master` branch to contribute. The pull request will then be looked over by the project manager/s.

Should the pull request not follow the project's goals, it may or may not be accepted. If it isn't accepted, don't take it personally - keep the changes on your local fork! If the changes are large enough, we'll link to it in our README. Note: follow the license.

### Project Core Goals
* **Speed**: The software must be fast. All features designed to be used on a regular basis should load ~fast~. The admin panel is also 100% Ajax.
* **Simplicity**: There should be no learning curve with the user interface.