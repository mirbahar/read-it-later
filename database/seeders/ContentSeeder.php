<?php

namespace Database\Seeders;

use App\Models\Content;
use Exception;
use Illuminate\Support\Facades\Log;

class ContentSeeder extends PocketSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Content::create([
                'pocket_id' => 1,
                'url'       => 'https://loremipsum.io/',
                'title'     => "Lorem Ipsum",
                'excerpt'   => "Generate Lorem Ipsum placeholder text for use in your graphic,
                                print and web layouts, and discover plugins for your favorite writing, 
                                design and blogging tools. Explore the origins, history and meaning of the 
                                famous passage, and learn how Lorem Ipsum went from scrambled Latin passage 
                                to ubiqitous dummy text.",
                'image'     => "https://loremipsum.io/assets/images/lorem-ipsum-generator-custom-placeholder-text.jpg"
            ]);

            Content::create([
                'pocket_id' => 2,
                'url'       => 'https://bigdata-madesimple.com/top-20-web-crawler-tools-scrape-websites/',
                'title'     => "Migrations & Seeding",
                'excerpt'   => "Web crawler tools are very popular these days as they have simplified
                                and automated the entire crawling process and made the data crawling easy.",
                'image'     => "https://bigdata-madesimple.com/wp-content/uploads/2017/06/datamining.jpg"
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
