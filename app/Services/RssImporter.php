<?php
namespace App\Services;

use App\Models\Feed;
use App\Models\Keyword;
use App\Models\News;
use App\Models\SearchLog;

use FeedIo\FeedIo;
use Illuminate\Support\Facades\Log;

class RssImporter
{
    protected FeedIo $feedIo;

    public function __construct(FeedIo $feedIo)
    {
        $this->feedIo = $feedIo;
    }

    public function import(): void
    {
        $feeds = Feed::all();
        $keywords = Keyword::all();

        foreach($feeds as $feed) {
            try {
                $result = $this->feedIo->read($feed->url);
                $items = $result->getFeed()->getItems();
            } catch (\Throwable $e) {
                Log::error('Error reading rss: ' . $e->getMessage());
                continue;
            }
            foreach ($keywords as $keyword) {

                $foundCount = 0;

                foreach ($items as $item) {
                    $title = $item->getTitle() ?? '';
                    $description = $item->getDescription() ?? '';

                    if (str_contains(strtolower($title), strtolower($keyword->keyword)) ||
                        str_contains(strtolower($description), strtolower($keyword->keyword))) {
                        
                        $exist = News::where('feed_id', $feed->id)
                            ->where('title', $title)
                            ->exists(); 
                        
                        if ($exist) {
                            continue;
                        }

                        // Create the news item
                        News::create(
                            [
                            'title' => $title,
                            'description' => $description,
                            'url' => $item->getLink(),
                            'published_at' => $item->getLastModified(),
                            'feed_id' => $feed->id,
                            'keyword_id' => $keyword->id,
                            ]
                        );

                        $foundCount++;
                    }
                }
                // Log the search
                SearchLog::create([
                    'feed_id' => $feed->id,
                    'keyword_id' => $keyword->id,
                    'found_news_count' => $foundCount,
                    'searched_at' => now(),
                ]);
            }
        }
    }
    
}