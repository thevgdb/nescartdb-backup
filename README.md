# NesCartDB Backup

## About NesCartDB Backup

This is a backup of the wonderful and useful NesCartDB project, which was created by Bootgod, and contributed to by various members of the fantastic "NesDev" community. I made this as a pre-emptive measure in case the real NesCartDB project ever goes offline, to ensure that we will always have this wonderful research information available. I faithfully re-implemented (as closely as possible) the original NesCartDB web application, so all the original features like Advanced Search should still work just as good! All the NES cart profiles data, and all associated images are included as part of this backup.

Here's a breakdown of the size of the main components of this backup:

* NES Cart Profiles - 4,599 unique cart profiles are part of this backup, totaling 22.9MB. This data is stored in a SQLite database, which is included as part of this project.
* Images - 22,013 unique images have been saved, totaling 2.44GB.

## Installation

To install a copy of this NESCartDB backup and get it running on your local machine, first you must clone the repository from GitHub:

```

```

follow all of these instructions and hopefully it should work in no time! I'm not a seasoned experienced veteran at making README.md installation instructions, so if you have any feedback or suggestions how I can make these installation instructions clearer or easier/quicker to understand, I am open to hearing them!

### Step 1 - Clone a copy of this github repository on your local computer

```shell
git clone git@github.com:skcin7/nescartdb-backup.git
```

NOTE: It should take a few minutes to clone, because it needs to clone the full project which includes all 22,013 images (2.44GB). So sit back and grab a drink while you wait.

Once the repository finishes cloning, you can do the following:

```shell
cd nescartdb-backup
composer install
```

Now you can run the project locally with: `php artisan serve`.

## Configuration

I implemented a configuration file as part of this project which you can use to tweak a few various customizations.

This configuration file is located in `config/nescartdb.php`. Use this configuration file to tweak various settings.

| Key                                            | Description | Default |
|------------------------------------------------|-------------|-----------|
| num_latest_dumps_to_show                       | $250        | 10 |
| show_backed_up_from_info_on_cart_profile_page  | $80         | false |



## Contact Info

Here's how you can contact me:

Don't.

## Credits/Acknowledgements

Please

* Bootgod, who is the creator and main contributor/researcher of the original NesCartDB project, and is the person who deserves all the credit and praise.
* The NesDev community, who are the people who contributed data and information to this project.
* Laravel PHP Framework, which is the web framework I built this on.
* My agent, Morty.
* My hair stylist, Rodrigo.
* My god, Buddha.
* And lastly, and certainly not least, YOU. Give yourself a pat on the back. Thank you.
