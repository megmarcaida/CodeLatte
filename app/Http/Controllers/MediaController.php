<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Media;
use Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
class MediaController extends Controller
{
    public function index()
    {
        $media = Media::paginate(12);

        return view('admin.gallery.media', compact('media'));
    }

    public function add() {

        $file = Request::file('media');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
        $media = new Media();
        $media->mime = $file->getClientMimeType();
        switch ($media->mime){
            case ('image/jpeg'):
                $media->category = "Image";
                break;
            case ('image/png'):
                $media->category = "Image";
                break;
            case ('image/gif'):
                $media->category = "Image";
                break;
            case ('video/mp4'):
                $media->category = "Video";
                break;
            case ('application/vnd.openxmlformats-officedocument.wordprocessingml.document'):
                $media->category = "Word";
                break;
        }

        $media->original_filename = $file->getClientOriginalName();
        $media->filename = $file->getFilename().'.'.$extension;
        $media->title = Request::input('title');
        $media->description = Request::input('description');
        $media->status = 1;
        $media->save();

        return redirect('admin/media');

    }

    public function get($filename){

        $media = Media::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($media->filename);

        return (new Response($file, 200))
            ->header('Content-Type', $media->mime);
    }

    public function delete($id)
    {
        $media = Media::find($id)->delete();

        /*return response()->json([
            'message'=>'Media deleted successfully'
        ]);*/
        return redirect('admin/media');
    }

    public function update()
    {

        $media = Media::where('id', Request::input('mediaID'))->first();


        $media->update( Request::all());

        /*return response()->json([
            'message' => Request::input('mediaID')
        ]);*/
        return redirect('admin/media');
    }

    public function media()
    {

        $media = Media::latest()->paginate(10);

        $response = [
            'pagination' => [
                'total' => $media->total(),
                'per_page' => $media->perPage(),
                'current_page' => $media->currentPage(),
                'last_page' => $media->lastPage(),
                'from' => $media->firstItem(),
                'to' => $media->lastItem()
            ],
            'media' => $media
        ];

        return response()->json([
            'media' => $response
        ]);
    }

    public function getGalleryImage()
    {
        $media = Media::latest()->where('category','Image')->get();

        return view('gallery',compact('media'));
    }

}
