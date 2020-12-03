<?php

namespace Database\Factories\Data;

use App\Models\Data\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomFile = $this->getRandomFile();
        $originalFileName = str_replace('resources/images/', '', $randomFile);

        return [
            'name' => $originalFileName,
            'file_path' => Storage::putFile('storage', $randomFile)
        ];
    }

    /**
     * @return mixed
     */
    private function getRandomFile()
    {
        $files = glob('resources/images/*.*');
        $file = array_rand($files);

        return $files[$file];
    }
}