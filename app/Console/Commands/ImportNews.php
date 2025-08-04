<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RssImporter;

class ImportNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import news from RSS feeds based on keywords';

    /**
     * Execute the console command.
     */
    public function handle(RssImporter $importer)
    {
        $this->info('Starting news import...');

        $importer->import(function ($newsData) {
           dump($newsData);
        });

        $this->info('News import completed successfully.');
    }
}
