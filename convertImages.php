<?php
// Directory containing article images
$imagesDir = 'uploads';


// Get all image files
$allowedExtensions = ['png', 'gif', 'jpg', 'jpeg'];
$images = [];
foreach ($allowedExtensions as $extension) {
    $images = array_merge($images, glob("$imagesDir/*.$extension"));
}


// Convert each image to WebP format
foreach ($images as $image) {
    // Check if the image file exists
    if (file_exists($image)) {
        // Create Imagick object for the image
        $imagick = new Imagick($image);

        // Set image quality (optional)
        $imagick->setImageCompressionQuality(80);

        // Define the WebP image file name
        $webpImage = str_replace($allowedExtensions, 'webp', $image);

        // Convert the image to WebP format
        $imagick->setImageFormat('webp');
        $imagick->writeImage($webpImage);

        // Clear Imagick object from memory
        $imagick->clear();
        $imagick->destroy();

        echo "Image converted: $image\n";
    } else {
        echo "Image not found: $image\n";
    }
}

echo "Conversion completed.\n";