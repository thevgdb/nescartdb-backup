<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Observers\CustomCrawlerObserver;
use Spatie\Crawler\CrawlProfiles\CrawlInternalUrls;
use Spatie\Crawler\Crawler;
use App\Http\Controllers\Controller;
use GuzzleHttp\RequestOptions;

class CustomCrawlerController extends Controller
{

    public function __construct() {}

    /**
     * Crawl the website content.
     * @return true
     */
    public function fetchContent(){
        //# initiate crawler
        Crawler::create([RequestOptions::ALLOW_REDIRECTS => true, RequestOptions::TIMEOUT => 30])
            ->acceptNofollowLinks()
            ->ignoreRobots()
            // ->setParseableMimeTypes(['text/html', 'text/plain'])
            ->setCrawlObserver(new CustomCrawlerObserver())
            ->setCrawlProfile(new CrawlInternalUrls('https://www.lipsum.com'))
            ->setMaximumResponseSize(1024 * 1024 * 2) // 2 MB maximum
            ->setTotalCrawlLimit(100) // limit defines the maximal count of URLs to crawl
            // ->setConcurrency(1) // all urls will be crawled one by one
            ->setDelayBetweenRequests(100)
            ->startCrawling('https://www.lipsum.com');
        return true;
    }
}
