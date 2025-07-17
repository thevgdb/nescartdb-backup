# NESCartDB Backup

NESCartDB Backup is a complete backup and re-implementation of the NESCartDB web application project, made by Bootgod and the NESDev Community (https://forums.nesdev.org/). This project was made as a pre-emptive measure to ensure that the wealth of valuable information of NES Cart Profiles will never be lost forever, in case it goes offline one day, we still have it!

I backed up all the NES Cart Profiles, and all related images, that were part of the project. The breakdown of this is:

| Backed Up Item           | Count/Quantity | Filesize | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
|--------------------------|----------------|----------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| NES Cart Profiles (Data) | 4,599          | 22.9 MB  | NES Cart Profiles are the data/information documented of each NES Cartridge that has been backed up. This data is stored in a SQLite Database, contained within a single file, located at `database/nescartdb-backup.sqlite`.                                                                                                                                                                                                                                                                                       |
| Images                   | 22,013         | 2.44 GB  | Images are the images associated with the NES Cart Profiles, and are stored in the directory `storage/app/public/cart_images`.                                                                                                                                                                                                                                                                                                                                                                                      |
| Plugins                  | 74             | 160 KB   | Plugins are additional ZIP files that don't have anything to do with NES Cart Profiles, and are not necessary or required, but they were part of BootGod's original NESCartDB, so I backed them up here too. I believe they are software and additional tools for his CopyNES hardware, and other hardware related to NES development. Refer to the 'Plugins' page in the web application for a description and summary of what each plugin does and its purpose. These are stored in `storage/app/public/plugins`. |

The original web application by BootGod was done using PHP. This backup web application is also built using PHP, and uses the Laravel Web Application Framework (which is a PHP web application framework that I am very familiar with). I re-implemented all aspects of BootGod's original NESCartDB web application as faithfully as I could, including all Advanced Search features, everything.

## How To Install

Please have `php` (https://www.php.net/) and `composer` (https://getcomposer.org/) binaries installed and part of your shell environment, which are necessary to have as part of the installation process.

```shell
# Clone The Repository
git clone git@github.com:thevgdb/nescartdb-backup.git
cd nescartdb-backup

# Install Composer Dependencies
composer install

# Set Up The Web Application
cp .env.example .env
php artisan key:generate
php artisan storage:link

# Serve The Application
php artisan serve
```

Please note - The original `git clone` command will take some time, as it has to download around ~3 GB total worth of images and data that is part of the backup. That is normal.

The `php artisan serve` command should get the web application running on your local machine. You may now do what you want with it, including host a mirror yourself somewhere if your heart desires to do so!

## Custom Configuration Options

I have also implemented some additional custom configuration options, that you may easily change to customize as your heart desires, by simply changing the values in the custom configuration file.

The custom configuration file is located at `config/nescartdb.php`.

Use this configuration file to tweak various settings as you desire.

## Credits/Acknowledgements

The original NESCartDB project was made by BootGod, with tons of contributions of highly valuable and useful original research to the project made by him, and many other people who contributed to it, most of which of these people are members of the NESDev Community (https://forums.nesdev.org/). Full credit to all of them for making this wonderful and highly useful project and information.

* BootGod - For making the NESCartDB project originally.
* NESDev Community - For being the community where this project was originally made for, and where many of the original contributors/researchers of these NES Cart Profiles came from.
* Laravel PHP Framework - This is the PHP web framework that I used to faithfully re-implement BootGod's original PHP project.
* And lastly, but certainly not least, YOU. Thank YOU. YOU are fantastic. Give yourself a pat on the back, for being so great.💯

No Cheep-Cheeps were harmed in the making of this project.
