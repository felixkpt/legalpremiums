<?php

namespace Database\Seeders;

use App\Models\MediaLibrary;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Faker\Factory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Throwable;

class CategorySeeder extends Seeder
{
    protected $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($counts = 20)
    {
        $this->faker = Factory::create();

        for ($i=0; $i < $counts; $i++) {

            $name = ucfirst(implode(' ', $this->faker->words($this->faker->numberBetween(1,4))));
            $slug = Str::of($name)->slug('-')->value();
            
           
            $categories = array_column(Category::all()->toArray(), 'id');
            $parent = 0;
            if ($categories) {
                $arr = [0, $this->faker->randomElement($categories)];               
                $parent = $this->faker->randomElement($arr);
            }
            
            $description = '<p>'.implode('</p><p>', $this->faker->paragraphs($this->faker->numberBetween(1, 2))).'</p>';
            $data = ['name' => $name, 'slug' => $slug, 'description' => $description, 'parent' => $parent];
            
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
                $dat = ['user_id' => User::inRandomOrder()->first()->id, 'url' => $url, 'type' => $type, 'mime' => $mime, 'size' => $size, 'width' => $width, 'height' => $height];
    
                MediaLibrary::create($dat);
               
            } catch(Throwable $t) {
                echo $t->getMessage();
            }
    
            if (key_exists('image', $data) && !Category::where('name', $name)->first()) {
                Category::create($data);
            }
    
        }
    }
}
