<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /** @var Tag*/
    public $tag;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->tag = Tag::create([
            'content_id' => 3,
            'name'       => "optimize-your-bopis"
        ]);
    }
}
