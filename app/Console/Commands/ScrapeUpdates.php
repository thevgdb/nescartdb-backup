<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;
use Carbon\Carbon;

class ScrapeUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $updates_data = [
//            [
//                'title' => '',
//                'posted_at' => '',
//                'posted_by' => '',
//                'body_content' => '',
//            ],
            [
                'title' => 'FC profiles close to 80%',
                'posted_at' => '2011-09-10 10:09:40',
                'posted_by' => 'bootgod',
                'body_content' => '<p>Big thanks to Yakushi~Kabuto for another generous donation of Famicom carts to fill in the blanks and also to BigFred for a couple more previously undumped carts!</p>
<p>I\'ve also posted an updated XML for those of you interested</p>
<p>I have a good number of scans and info on missing games from the DB from various people. Rather than push them thru the normal client software, I\'d like to save these for testing with the upcoming web-based submission system.</p>
<p>Current plans are to continue working on new version of site and said submission system. Spare time is sparse as usual, so can\'t really give an ETA on when any of this will be ready.</p>',
            ],
            [
                'title' => 'Merry Christmas & Happy New Year',
                'posted_at' => '2012-12-23 09:39:10',
                'posted_by' => 'bootgod',
                'body_content' => '<img src="/images/sorryimdead.jpg"><br>
<p>I wish I had something to give, like being done with the new site, but unfortunately that is not the case. I do still work on it in spurts and have made good progress, but I\'m sure it will be a while yet.</p>
<p>I don\'t really have anything to report... I did post an updated XML a month or so ago for those interested. More than anything just wanted to let people know I haven\'t abandoned the project or anything. I just don\'t have a lot of time for it anymore.</p>
<p>Hopefully I\'ll have something better to report next time! Happy Holidays!</p>',
            ],
            [
                'title' => 'Site dying from neglect!',
                'posted_at' => '2013-09-15 20:35:16',
                'posted_by' => 'bootgod',
                'body_content' => '<p>I noticed a few days back that some images weren\'t displaying and just giving the old "red X". Upon further investigation it turns out a number of bad sectors on the hard drive have cropped up. Only site-specific problems were in the image cache and access log. The cache was purged so you may notice delays as thumbs get rebuilt on demand.</p>
<p>The hard drive is likely starting to fail, so as a precaution I will do a reinstall onto a new drive. I\'m planning on doing it this coming weekend (Sept. 21-22) so the site will be offline for a number of hours while work is being done.</p>',
            ],
            [
                'title' => 'Back online',
                'posted_at' => '2013-09-22 17:50:59',
                'posted_by' => 'bootgod',
                'body_content' => '<p>I did the reinstall this afternoon and everything seems to be OK so far. Let me know ASAP if you find any problems!</p>',
            ],
            [
                'title' => 'Finally back up!',
                'posted_at' => '2016-08-21 14:58:31',
                'posted_by' => 'bootgod',
                'body_content' => '<p>My apologies for the serious downtime. For those who don\'t know the story, probably 3 months ago the primary server HD died, so I go onto to start the recovery process only to find the backup drive was also dead and the scheduled network backups hadn\'t been running :( I ended up having to send a drive in for professional recovery. Luckily they were able to recover it 100% so no data was lost. So I start reinstalling everything only to run into some quirk with PHP that had me stumped and I\'ve had a severe lack of time lately to troubleshoot. Finally today I managed to figure something out and hopefully fully operational again!</p>
<p>I also want to thank the numerous people that donated money to cover the cost of the drive recovery. I will credit you all individually once I get everything in order.</p>
<p>People may be tempted to try and make backups of the site, I ask that you please do not attempt this simply because it is very taxing on the server, not just bandwidth, but CPU-wise because spiders aren\'t really "smart" enough to deal with script-based sites like this. Plus, there are measures in place to detect bots and block them, so if you try it you might end up getting auto-blocked.</p>
<p>I\'ve also posted an up-to-date XML.</p>',
            ],
            [
                'title' => 'NESCartDB.com - Temporary Mirror',
                'posted_at' => '2020-09-26 04:46:15',
                'posted_by' => 'brizzo',
                'body_content' => '<p>Hello everyone! I have created this temporary mirror as the original BootGod NESCartDB has been offline due to server issues since August 17 2020. BootGod has communicated he is working on getting it back online but has had limited time working away from home. In the mean time I have put together this database which has most (missing 15 profiles) of the data and images from the original website. Features are currently limited compared to the original site but this will do for now :)</p>',
            ],
        ];

        foreach( $updates_data as $update_data ) {

            $update = new Models\Update();
            $update->setAttribute('title', $update_data['title']);
            $update->setAttribute('posted_at', (new Carbon($update_data['posted_at'])) );
            $update->setAttribute('posted_by', $update_data['posted_by']);
            $update->setAttribute('body_content', $update_data['body_content']);
            $update->save();

            $this->info("Created Update: " . $update->getAttribute('title'));

        }
    }
}
