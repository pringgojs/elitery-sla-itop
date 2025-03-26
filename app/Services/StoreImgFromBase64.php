<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreImgFromBase64
{
    /**
     * Save an image from base64 string to the specified disk and path.
     *
     * @param string $base64Image
     * @param string $path
     * @param string|null $disk
     * @return string|null The file path of the saved image or null if failed.
     */
    public function store(string $base64Image, string $path, string $disk = 'public'): ?string
    {
        try {
            // Check if the base64 string contains the header
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
                $extension = strtolower($matches[1]); // Extract the file extension

                // Validate the extension
                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                    throw new Exception('Unsupported image format.');
                }

                // Remove the base64 header from the string
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
            } else {
                throw new Exception('Invalid base64 image data.');
            }

            // Decode the base64 string
            $imageData = base64_decode($base64Image);

            if ($imageData === false) {
                throw new Exception('Failed to decode base64 image data.');
            }

            // Generate a unique filename
            $fileName = Str::random(40) . '.' . $extension;

            // Save the image to the specified disk and path
            $filePath = rtrim($path, '/') . '/' . $fileName;
            Storage::disk($disk)->put($filePath, $imageData);

            return $filePath;
        } catch (Exception $e) {
            // Log the error if necessary
            logger()->error('Failed to save base64 image: ' . $e->getMessage());
            return null;
        }
    }


}
