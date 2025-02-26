<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * @return string[]
     */
    public function uploadFiles(Request $request): array
    {
        $filesCount = count($request->file('files', []));
        $pathsCount = count($request->get('paths', []));

        $data = $request->validate([
            'files' => 'required|array|size:' . $pathsCount,
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mkv,avi,mov,webm,mp3,wav,aac,flac,m4a|max:50000',
            'paths' => 'required|array|size:' . $filesCount,
            'paths.*' => 'required|string',
        ]);

        $paths = [];

        foreach ($data['files'] as $key => $file) {
            $paths[] = Storage::put($data['paths'][$key], $file);
        }

        return $paths;
    }

    public function uploadOldFiles(Request $request): void
    {
        $filesCount = count($request->file('files', []));
        $pathsCount = count($request->get('paths', []));

        $data = $request->validate([
            'files' => 'required|array|size:' . $pathsCount,
            'files.*' => 'required|file',
            'paths' => 'required|array|size:' . $filesCount,
            'paths.*' => 'required|string',
        ]);

        foreach ($data['files'] as $key => $file) {
            $fileName = str($data['paths'][$key])->afterLast('/');
            $filePath = str($data['paths'][$key])->beforeLast('/');

            Storage::putFileAs($filePath, $file, $fileName);
        }
    }

    /**
     * @return string[]
     */
    public function uploadDocuments(Request $request): array
    {
        $docsCount = count($request->file('docs', []));
        $pathsCount = count($request->get('paths', []));

        $data = $request->validate([
            'docs' => 'required|array|size:' . $pathsCount,
            'docs.*' => 'required|file|max:5120',
            'paths' => 'required|array|size:' . $docsCount,
            'paths.*' => 'required|string',
        ]);

        $paths = [];

        foreach ($data['docs'] as $key => $file) {
            $paths[] = Storage::put($data['paths'][$key], $file);
        }

        return $paths;
    }

    public function deleteFiles(Request $request): void
    {
        $data = $request->validate([
            'paths' => 'required|array',
            'paths.*' => 'required|string',
        ]);

        foreach ($data['paths'] as $path) {
            Storage::delete($path);
        }
    }
}
