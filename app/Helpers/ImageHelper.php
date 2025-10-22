<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Get the correct image URL
     * Handles both absolute URLs and relative storage paths
     */
    public static function getImageUrl($foto, $default = null)
    {
        if (!$foto) {
            // Return placeholder avatar from CDN
            return $default ?? 'https://ui-avatars.com/api/?name=User&background=random&color=fff&size=200';
        }

        // If it's already a full URL
        if (str_starts_with($foto, 'http')) {
            return $foto;
        }

        // If it's already a complete storage path
        if (str_starts_with($foto, 'storage/')) {
            return asset($foto);
        }

        // If it's just a filename or partial path, prepend karyawan folder
        if (!str_contains($foto, '/')) {
            // It's just a filename, add karyawan folder
            return asset('storage/karyawan/' . $foto);
        }

        // Otherwise treat it as a storage path
        return asset('storage/' . $foto);
    }
}
