<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\ImageManagerStatic as Image;


class FileController extends Controller
{
    public function index()
    {
        $files = Files::all();

        return view('file_storage.index', compact('files'));
    }
    public function show($id)
    {
        $file = Files::findOrFail($id);

        return view('file_storage.show', compact('file'));
    }

    public function store()
    {
        return view('file_storage.store');
    }

    public function create(Request $request)
    {
        $file = new Files();
        $img = $request->file('file');
//        $img = Image::make($request->file('file')->store('uploads', 'files'));
        $path = $img->hashName();
        $image = Image::make($img)->resize(100, 100);
        $image = Storage::disk('files')->put($path, $image->stream());

        $file->file = $path;
        $file->save();
        return redirect(route('index-file'));
    }

    public function download($id)
    {
        $file = Files::findOrFail($id);
        $file_full_path = 'files\\';
        $file_path = storage_path() . '\\app\\' . $file_full_path . $file->file;
        return response()->download($file_path);
    }

    public function delete($id)
    {
        $file = Files::findOrFail($id);
        $file_full_path = 'files\\';
        $file_path= storage_path('app\\' . $file_full_path . $file->file);
        if ($file->delete()) {
            app(Filesystem::class)->delete($file_path);
            return redirect(route('index-file'));
        }
    }

    public function draw_img()
    {
        $img = ImageManagerStatic::make('files/task_image.jpg')->resize(300, 300);
        $img->line(10, 100, 10, 195, function ($draw) {
            $draw->color('#f00');
        });
        $img->line(250, 100, 10, 100, function ($draw) {
            $draw->color('#f00');
        });
        $img->line(250, 195, 10, 195, function ($draw) {
            $draw->color('#f00');
        });
        $img->line(250, 100, 250, 195, function ($draw) {
            $draw->color('#f00');
        });
        $img->line(10, 100, 130, 30, function ($draw) {
            $draw->color('#f00');
        });
        $img->line(250, 100, 130, 30, function ($draw) {
            $draw->color('#f00');
        });
        return $img->response('jpg');
    }
}
