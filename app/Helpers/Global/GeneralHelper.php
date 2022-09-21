<?php

use Carbon\Carbon;
use Intervention\Image\Facades\Image;


if (!function_exists('appName')) {
  /**
   * Helper to grab the application name.
   *
   * @return mixed
   */
  function appName()
  {
    return config('app.name', 'Laravel Boilerplate');
  }
}

if (!function_exists('carbon')) {
  /**
   * Create a new Carbon instance from a time.
   *
   * @param $time
   * @return Carbon
   *
   * @throws Exception
   */
  function carbon($time)
  {
    return new Carbon($time);
  }
}

if (!function_exists('homeRoute')) {
  /**
   * Return the route to the "home" page depending on authentication/authorization status.
   *
   * @return string
   */
  function homeRoute()
  {
    if (auth()->check()) {
      if (auth()->user()->isAdmin()) {
        return 'admin.dashboard';
      }

      if (auth()->user()->isUser()) {
        return 'frontend.user.dashboard';
      }
    }

    return 'frontend.index';
  }
}



if (!function_exists('store_picture')) {
  /**
   * @param $file
   * @param string $dir_path
   * @param null $name
   * @param bool $thumb
   * @param bool $resize
   * @return string
   */
  function store_picture($file, $dir_path = '/', $name = null, $thumb = false, $resize = false, $resizeWidth = 1080)
  {
    $imageName = $name ? $name . '.' . $file->getClientOriginalExtension() : $file->getClientOriginalName();
    $dir_path = 'storage/' . $dir_path;
    $pathDir = create_public_directory($dir_path); // manage directory
    $img = Image::make($file);
    $fileSize = round($img->filesize() / 1024); // convert to kb

    if ($resize) {
      $img->resize($resizeWidth, null, function ($c) {
        $c->aspectRatio();
      })->save($pathDir . '/' . $imageName, 90); // save converted photo
    } else {
      $img->save($pathDir . '/' . $imageName, 90); // save original photo
    }

    if ($thumb) {
      $thumbPathDir = create_public_directory($dir_path . '/thumbs'); // manage thumbs directory
      if ($img->width() > 400 || $fileSize > 150) {
        $img->resize(400, null, function ($c) {
          $c->aspectRatio();
        })->save($thumbPathDir . '/' . $imageName, 90); // save thumbs photo
      } else {
        $img->save($thumbPathDir . '/' . $imageName, 90); // save thumbs photo
      }
    }

    return $dir_path . '/' . $imageName;
  }
}


if (!function_exists('create_public_directory')) {
  /**
   * @param $path
   * @return string
   */
  function create_public_directory($path)
  {
    File::isDirectory(public_path('storage')) ?: Artisan::call('storage:link');
    File::isDirectory(public_path($path)) ?: File::makeDirectory(public_path($path), 0777, true, true);
    return public_path($path);
  }
}
