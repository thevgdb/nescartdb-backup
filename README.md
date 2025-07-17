# NESCartDB Backup

NESCartDB Backup is a complete backup and re-implementation of the NESCartDB web application project, made by Bootgod and the NESDev Community (https://forums.nesdev.org/). This project was made as a pre-emptive measure to ensure that the wealth of valuable information of NES Cart Profiles will never be lost forever, in case it goes offline one day, we still have it!

I backed up all the NES Cart Profiles, and all related images, that were part of the project. The breakdown of this is:

* 4,599 NES Cart Profiles (22.9 MB). This data is all stored in a SQLite Database, contained within a single file included in this repository located at `database/nescartdb-backup.sqlite`.
* 22,013 Images (2.44 GB). The images are located in a directory at `storage/app/public/cart_images`.
* 74 Plugins (160 KB). Plugins are additional ZIP files that were included in the original BootGod web application. No idea what they do, to be completely honest with you, and they aren't necessary for the NESCartDB Backup, but I included them anyway, since they were part of BootGod's NESCartDB original web application. The plugins are located in a directory at `storage/app/public/plugins`.

The original web application by BootGod was done using PHP. This backup web application is also built using PHP, and uses the Laravel Web Application Framework (which is a PHP web application framework that I am very familiar with). I re-implemented all aspects of BootGod's original NESCartDB web application as faithfully as I could, including all Advanced Search features, everything.

## How To Install

Please have `php` (https://www.php.net/) and `composer` (https://getcomposer.org/) binaries installed and part of your shell environment which are necessary as part of the installation process.

```shell
git clone git@github.com:thevgdb/nescartdb-backup.git
cd nescartdb-backup
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan serve
```

Please note - The original `git clone` command will take some time, as it has to download around ~3 GB total worth of images and data that is part of the backup. That is normal.

The `php artisan serve` command should get the web application running on your local machine. You may now do what you want with it, including host a mirror yourself somewhere if your heart desires to do so!

## Custom Configuration

I have also implemented some additional configuration options, that you may easily change and customize as your heart desires, by simply changing the values in the custom configuration file.

The custom configuration file is located at `config/nescartdb.php`. Use this configuration file to tweak various settings as you desire. View that file to see what configuration options are available to you, and a description/summary of what each one done and how to use it.

## Credits/Acknowledgements

The original NESCartDB project was made by BootGod, with tons of contributions of highly valuable and useful original research to the project made by him, and many other people who contributed to it, most of which of these people are members of the NESDev Community (https://forums.nesdev.org/). Full credit to all of them for making this wonderful and highly useful project and information.

* BootGod - For making the NESCartDB project originally.
* NESDev Community - For being the community where this project was originally made for, and where many of the original contributors/researchers of these NES Cart Profiles came from.
* Laravel PHP Framework - This is the PHP web framework that I used to faithfully re-implement BootGod's original PHP project.
* And lastly, but certainly not least, YOU. Thank YOU. YOU are fantastic. Give yourself a pat on the back, for being so great.💯

No Cheep-Cheeps were harmed in the making of this project.
