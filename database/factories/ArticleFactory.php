<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'text' => $this->faker->text(100),
            // Check the image download from faker
            'image' => strstr(
                $this->faker->image(
                    public_path('storage/images'),
                    360,
                    360,
                    'animals',
                    true,
                    true,
                    'cats',
                    false
                ),
                'storage'
            ),
            'category_id' => Category::all()->random(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Article $article) {
            $article->tags()->sync(Tag::all()->random(rand(1, 3)));
        });
    }
}
