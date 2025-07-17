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
git clone git@github.com:skcin7/nescartdb-backup.git
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

The custom configuration file is located at `config/nescartdb.php`. Use this configuration file to tweak various settings as you desire.

* `num_latest_dumps_to_show` - This is the number of latest NES Cart Profiles to show on the right-hand-side of the web application layout, which is included on every single page. Variable Type: `Integer`. Default Value: `10`.
* `show_backup_info_on_cart_profile_page` - This decides whether or not to show additional backup-from information on a NES Cart Profile page. If enabled, the original URL where the NES Cart Profile was made from, as well as the date the backup was made, will be shown at the top of each NES Cart Profile page. Variable Type: `Boolean`. Default Value: `false`.

## Credits/Acknowledgements

The original NESCartDB project was made by BootGod, with tons of contributions of highly valuable and useful original research to the project made by him, and many other people who contributed to it, most of which of these people are members of the NESDev Community (https://forums.nesdev.org/). Full credit to all of them for making this wonderful and highly useful project and information.

* BootGod - For making the NESCartDB project originally.
* NESDev Community - For being the community where this project was originally made for, and where many of the original contributors/researchers of these NES Cart Profiles came from.
* Laravel PHP Framework - This is the PHP web framework that I used to faithfully re-implement BootGod's original PHP project. 
* My Agent, Morty - He takes a 10% cut, but it's worth it to have him on my side.
* My God and Personal Lord & Savior, Shigeru Miyamoto.
* My Hair Stylist, Rodrigo - Nobody styles hair, or rides the Brazilian wave, quite you, bro. 🤙
* All The Haters Who Said I Couldn't Do It - WHO'S LAUGHING NOW HUHHHH HUHHHH??? THAT'S WHAT I THOUGHT!
* At this time I'd like to bring awareness to the most riveting and important issue of our day -- the Ending of the Exploitation of Toads in the Mushroom Kingdom. For decades, these loyal fungi have stood vigil in castles, risking their lives with full loyalty to the crown of the Mushroom Kingdom, just to say, "THANK YOU MARIO! BUT OUR PRINCESS IS IN ANOTHER CASTLE!".  No Power Mushroom.  No Fire Flower.  No recognition.  These Toads aren't just exploitation props to be used and abused--they're workers, and they're faithful, dutiful servants of the crown of the Mushroom Kingdom.  For too long, we've been treating them without the due respect they deserve, and taking them for granted.  These Toads and Toadettes deserve rights.  It's time we let the unionize.  Fair hours.  Better vests.  Full color interchangeable Mushroom hats.  We just keep jumping on their heads like it's fine.  Let our Toads unionize.  It's the least they deserve.  Thank you.
* *blows kisses, blows kisses* Oh thank you, thank you. *Walks off the stage*
* And lastly, but certainly not least, YOU. Thank YOU. YOU are fantastic. Give yourself a pat on the back, for being so great.💯

No Cheep-Cheeps were harmed in the making of this project.
