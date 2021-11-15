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
                'url'       => 'https://www.thedailystar.net/views/opinion/news/billion-covid-19-jabs-and-indias-hope-and-caution-2230046',
                'title'     => "A billion Covid-19 jabs and India’s hope and caution",
                'excerpt'   => "In October, India reached the important milestone of administering one billion
                                Covid-19 vaccine doses, accomplished in 278 days since the inoculation drive was
                                launched on January 16 this year.",
                'image'     => "https://img.thedailystar.net/sites/default/files/styles/social_share/public/images/2021/11/14/india-covid-19-jabs.jpg?itok=4SHTDGKK"
            ]);
            Content::create([
                'pocket_id' => 1,
                'url'       => 'https://www.thedailystar.net/youth/education/news/4150-public-university-teacher-posts-vacant-dipu-moni-2230471',
                'title'     => "4,150 public university teacher posts vacant: Dipu Moni",
                'excerpt'   => "Education Minister Dipu Moni today told the parliament that
                                some 4,150 teacher posts are vacant at 43 public universities of the country.",
                'image'     => "https://img.thedailystar.net/sites/default/files/styles/social_share/public/images/2021/11/15/dipu_moni_0.jpg?itok=v-qY2cqw"
            ]);
            Content::create([
                'pocket_id' => 1,
                'url'       => 'https://www.bloomreach.com/en/blog/2020/11/holiday-season-ecommerce.html#optimize-your-bopis',
                'title'     => "Holiday eCommerce in 2020: Three Quick-win Commerce Strategies for Holiday Season Success Busra Sahin",
                'excerpt'   => "With retailers everywhere gearing up for a very different shopping season, here are a few actionable strategies to ensure success.",
                'image'     => "https://www.bloomreach.com/binaries/ninecolumn/content/gallery/bloomreach.com_2/resources/thumbnails/how-much-has-holiday-shopping-moved-online--1.jpg"
            ]);
            Content::create([
                'pocket_id' => 2,
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
            Content::create([
                'pocket_id' => 3,
                'url'       => 'https://www.docker.com/',
                'title'     => "Developers Love Docker. Businesses Trust It.",
                'excerpt'   => "Learn how Docker helps developers bring their ideas to life by conquering the complexity of app development.",
                'image'     => "https://www.docker.com/sites/default/files/social/docker_facebook_share.png"
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
