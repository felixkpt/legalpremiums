<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostContent;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Throwable;

class PostSeeder extends Seeder
{
    protected $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($counts = 50)
    {
        $this->faker = Factory::create();

        if (User::count() < 1) {
            return true;
        }

        for($i=0; $i<$counts; $i++) {
            $name = ucfirst(implode(' ', $this->faker->words($this->faker->numberBetween(1,4))));
            $content = '<p>'.implode('</p><p>', $this->faker->paragraphs($this->faker->numberBetween(5, 10))).'</p>';
            $title = Str::limit(ucfirst(implode(' ', $this->faker->words($this->faker->numberBetween(4, 20)))), 150);
            
            $post = [
                'company_name' => $name,
                'company_url' => $this->faker->url(),
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => Str::limit(strip_tags($content), $this->faker->numberBetween(50, 150)),
                'post_type' => 'post',
            ];
            
            try {
                $contents = file_get_contents('https://source.unsplash.com/random/200x200?sig=1');

                $path = 'public/images/'.date('Y').'/'.date('m').'/posts/'.Str::random(16).'.jpg';
                
                Storage::put($path, $contents);
                $path = preg_replace('#public/#', 'uploads/', $path);
                $post['image'] = $path;
            } catch(Throwable $t) {
                // echo $t->getMessage();
            }

            if (key_exists('image', $post) && !Post::where('title', $title)->first()) {
                
                try {
                    DB::beginTransaction();

                    $post = Post::create($post);
              
                    PostContent::create(['post_id' => $post->id, 'content' => $content]);

                    // Attaching authors (post_user table)
                    $take = [1,1,1,1,2,2,3];
                    $users = User::inRandomOrder()->take($take)->pluck('id');
                    
                    $manager_id = $users[rand(0, count($users) - 1)];
                    foreach ($users as $user) {
                        $post->authors()->attach($user, ['manager_id' => $manager_id]);
                    }
                    // Attaching categories
                    $categories = Category::inRandomOrder()->take($take)->pluck('id');
                    foreach($categories as $category) {
                        $post->categories()->attach($category);
                    }
                    
                    DB::commit();
                } catch (Throwable $e) {
                    DB::rollback();
                }
            
           }

        }

    }
}
