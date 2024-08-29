<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * @return string[]
     */
    public function uploadImages(Request $request): array
    {
        $filesCount = count($request->file('files', []));
        $pathsCount = count($request->get('paths', []));

        $data = $request->validate([
            'files' => 'required|array|size:' . $pathsCount,
            'files.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'paths' => 'required|array|size:' . $filesCount,
            'paths.*' => 'required|string',
        ]);

        $paths = [];

        foreach ($data['files'] as $key => $file) {
            $paths[] = Storage::put(sprintf('%s/%s/', config('app.env'), $data['paths'][$key]), $file);
        }

        return $paths;
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
            'docs.*' => 'required|file|max:4092',
            'paths' => 'required|array|size:' . $docsCount,
            'paths.*' => 'required|string',
        ]);

        $paths = [];

        foreach ($data['docs'] as $key => $file) {
            $paths[] = Storage::put(sprintf('%s/%s/', config('app.env'), $data['paths'][$key]), $file);
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
