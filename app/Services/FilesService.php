<?php

namespace App\Services;

use Illuminate\Support\Facades\URL;

class FilesService
{
    private function storeFile($file, $file_path)
    {
        $path = public_path() . $file_path;
        $new_file_name = time() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $new_file_name);
        return URL::asset($file_path . $new_file_name);
    }

    public function storeProfileImage($file)
    {
        /*
            you can also store the profile image info
             in the database here if you want
        */

        return $this->storeFile($file, '/storage/uploads/profiles/');
    }
}
