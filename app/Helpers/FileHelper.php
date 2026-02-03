<?php
namespace App\Helpers;

use App;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use URL;

class FileHelper
{
    static function uploadFile(UploadedFile $file, string $subDir = "", $isImg = 0,$imgWidth=0,$imgHeight=0): array
    {
        $disk = config('filesystems.default');
        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
        $filTitle = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
        $storedPath = $file->storeAs($subDir, $filename, $disk);
        $physicalPath = storage_path('app/public/uploads')."/".$subDir."/".$filename;
        if ($isImg) {
            // resize & optimize
            Helper::imageResize($physicalPath, $imgWidth, $imgHeight);
            Helper::imageOptimize($physicalPath);
        }
        $publicURL = trim(env('APP_URL', 'http://localhost'), '/').'/storage/uploads/'.$subDir."/".$filename;
        return [
            'path' => $storedPath,
            'url' => $publicURL,
            'name' => $filename,
            'title' => $filTitle
        ];
    }
    static function cloneFile(string $fileName, string $subDir = ""): ?array
    {
        $disk = config('filesystems.default');
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = Str::uuid() . '.' . $extension;
        Storage::disk($disk)->copy($subDir."/".$fileName, $subDir."/".$newFileName);
        $fullPath = storage_path('app/public/uploads')."/".$subDir;
        $physicalURL = trim(env('APP_URL', 'http://localhost'), '/').'/storage/uploads/'.$subDir."/".$newFileName;

        return [
            'path' => $fullPath."/".$newFileName,
            'url' => $physicalURL,
            'name' => $newFileName,
            'title' => "",
        ];
    }

    static function deleteFile(string $path): bool
    {
        $disk = config('filesystems.default');
        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }
        return false;
    }
}

?>
