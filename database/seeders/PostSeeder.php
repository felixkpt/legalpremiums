<?php

namespace Database\Seeders;

use App\Models\MediaLibrary;
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
    public function run($counts = 205)
    {
        $this->faker = Factory::create();

        if (User::count() < 1) {
            return true;
        }

        for($i=0; $i<$counts; $i++) {
            $name = ucfirst(implode(' ', $this->faker->words($this->faker->numberBetween(1,4))));
            $content = '<p>'.implode('</p><p>', $this->faker->paragraphs($this->faker->numberBetween(5, 10))).'</p>';
            $title = Str::limit(ucfirst(implode(' ', $this->faker->words($this->faker->numberBetween(4, 20)))), 150);
            
            $data = [
                'company_name' => $name,
                'company_url' => $this->faker->url(),
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => Str::limit(strip_tags($content), $this->faker->numberBetween(50, 150)),
                'post_type' => 'post',
            ];
            
            try {
                $contents = file_get_contents('https://source.unsplash.com/random/200x200?sig=1');

                $path = 'public/'.date('Y').'/'.date('m').'/'.Str::random(16).'.jpg';
                
                Storage::put($path, $contents);
                $path = preg_replace('#public/#', 'uploads/', $path);
                
                $url = asset($path);
                $data['image'] = $url;

                // Getting image dimensions
                $imagesize = getimagesize($url);
                $width = $imagesize[0];
                $height = $imagesize[1];
                // Getting image size
                $image = get_headers($url, 1);
                $bytes = $image["Content-Length"] ?? $image["content-length"];
                $kb = round($bytes/(1024));
                $mb = round($bytes/(1024 * 1024));
                $size = $kb.' KB';
                if ($mb >= 1) {
                    $size = $mb.' MB';
                }
                
                $type = 'file';
                $mime = 'image/jpg';
                $dat = ['user_id' => User::inRandomOrder()->first()->id, 'url' => $url, 'type' => $type, 'mime' => $mime, 'size' => $size, 'width' => $width, 'height' => $height
            ];
    
                MediaLibrary::create($dat);

            } catch(Throwable $t) {
                echo $t->getMessage();
            }

            if (key_exists('image', $data) && !Post::where('title', $title)->first()) {
                
                try {
                    DB::beginTransaction();

                    $post = Post::create($data);
              
                    PostContent::create(['post_id' => $post->id, 'content' => $content]);

                    // Attaching authors (post_user table)
                    $take_arr = [1,1,1,1,1,2,2,3];
                    shuffle($take_arr);
                    $take = $take_arr[0];

                    $users = User::inRandomOrder()->take($take)->pluck('id');
                    
                    $manager_id = $users[rand(0, count($users) - 1)];
                    foreach ($users as $user) {
                        $post->authors()->attach($user, ['manager_id' => $manager_id]);
                    }
                    
                    // Attaching categories zero is uncategorized
                    $take_arr = [0,0,0,0,1,1,1,2,2,3];
                    shuffle($take_arr);
                    $take = $take_arr[0];
                    if ($take > 0) {
                        $categories = Category::inRandomOrder()->take($take)->pluck('id');
                        foreach($categories as $category) {
                            $post->categories()->attach($category);
                        }
                    }else {
                        $category = Category::where('slug', 'uncategorized')->first();
                        if ($category) {
                            $post->categories()->attach($category->id);
                        }
                    }
                    
                    DB::commit();
                } catch (Throwable $e) {
                    echo $e->getMessage();
                    DB::rollback();
                }
            
           }

        }

    }
}
