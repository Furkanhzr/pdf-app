<?php

namespace Database\Factories;

use App\Models\Item;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Item::class;

    public function definition()
    {
        $client = new Client();

        $seed = rand(100, 160); // Generate a random seed value
        $imageUrl = $this->getValidImageUrl($client, $seed);

        $response = $client->get($imageUrl);
        $imageContents = $response->getBody()->getContents();

        // Generate a unique file name
        $fileName = time() . '.jpg';

        // Save the image to storage
        $publicPath = public_path('images/' . $fileName);
        file_put_contents($publicPath, $imageContents);

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(200),
            'image' => 'images/' . $fileName,
        ];
    }

    /**
     * Get a valid image URL.
     *
     * @param Client $client
     * @param int $seed
     * @return string
     */
    protected function getValidImageUrl($client, $seed)
    {
        $attempts = 0;
        $maxAttempts = 10; // Limit attempts to avoid infinite loops

        do {
            $imageUrl = "https://picsum.photos/id/{$seed}/650/400.jpg";
            $response = $client->get($imageUrl, ['http_errors' => false]);
            $statusCode = $response->getStatusCode();
            $attempts++;
            if ($statusCode === 200) {
                return $imageUrl;
            }
            // Increment seed and try again if image is not found
            $seed = rand(100, 160);
        } while ($attempts < $maxAttempts);

        // Fallback URL if no valid image found
        return "https://picsum.photos/id/100/650/400.jpg";
    }

}
