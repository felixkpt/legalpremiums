<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory;
use App\Models\Review;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Throwable;

class ReviewSeeder extends Seeder
{
    protected $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($counts = 20500)
    {
        $this->faker = Factory::create();

        for ($i=0; $i < $counts; $i++) {

            $author = User::inRandomOrder()->limit(1)->first();
            
            $user_id = $author->id;
            $post = Post::inRandomOrder()->limit(1)->first();
            
            if ($post) {
           
                if (!in_array($author->id, array_column($post->authors->toArray(), 'id'))) {
                    $post_id = $post->id;
                    $title = ucfirst(implode(' ', $this->faker->words($this->faker->numberBetween(1,4))));
                    $content = '<p>'.implode('</p><p>', $this->faker->paragraphs($this->faker->numberBetween(1, 3))).'</p>';

                    $fields = ['title' => $title, 'content' => $content, 'post_id' => $post_id,
                    'user_id' => $user_id, 'rating' => $this->faker->randomElement(range(0, 10)) ];
                    // dd($fields);
                    //  Review not pubished until approved by admin
                    // if (!$author->can('role-list')) {
                        $fields['published'] = 'published';
                    // }
                    
                    $review = Review::where('post_id', $post_id)->where('user_id', $user_id)->first();
                    
                    if (!$review) {
                        Review::create($fields);
                    }
                    
                }
                    
            }
            
        }
    }
}
