<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Faker\Factory;
use App\Models\Category;
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
            $arr = [0, $this->faker->randomElement($categories)];
            $parent = $this->faker->randomElement($arr);
            
            $description = '<p>'.implode('</p><p>', $this->faker->paragraphs($this->faker->numberBetween(1, 2))).'</p>';
            $data = ['name' => $name, 'slug' => $slug, 'description' => $description, 'parent' => $parent];
            
            try {
                $contents = file_get_contents('https://source.unsplash.com/random/200x200?sig=1');

                $path = 'public/images/'.date('Y').'/'.date('m').'/categories/'.Str::random(16).'.jpg';
                
                Storage::put($path, $contents);
                $path = preg_replace('#public/#', 'uploads/', $path);
                $data['image'] = $path;
            } catch(Throwable $t) {
                // echo $t->getMessage();
            }
    
            if (key_exists('image', $data) && !Category::where('name', $name)->first()) {
                Category::create($data);
            }
    
        }
    }
}
