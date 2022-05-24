<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\MediaLibrary;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MediaLibraryController extends Controller
{
    /**
     * @param string $image_rules
     * 
     */
    private $image_rules = 'mimes:jpg,png,jpeg,gif';

    private $route = 'admin.media';
    private $perPage = 30;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $media = MediaLibrary::latest()->with('author')->paginate($this->perPage);
        if ($request->wantsJson()) {
            return response()->json($media);
        }

        return view($this->route.'.index', ['media' => $media]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->route.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];
        if ($request->hasFile('file')) {
            $rules = array_merge($rules, ['image' => $this->image_rules]);
            $request->validate($rules);
            
            $file = $request->file('file');
            
            $path = $file->store('public/'.date('Y').'/'.date('m'));
            $path = preg_replace('#public/#', 'uploads/', $path);

            $url = asset($path);
            
            // Getting image dimensions
            $imagesize = getimagesize($url);
            $width = $imagesize[0];
            $height = $imagesize[1];
            // Getting image size
            $image = get_headers($url, 1);
            $bytes = $image["Content-Length"] ?? $image["content-length"];
            $kb = round($bytes/(1024));
            $mb = round($bytes/(1024 * 1024));
            $size = $kb.' KB';
            if ($mb >= 1) {
                $size = $mb.' MB';
            }
            
            
            $type = $file->getType();
            $mime = $file->getMimeType();
            $data = ['user_id' => Auth::user()->id, 'url' => $url, 'type' => $type, 'mime' => $mime, 'size' => $size, 'width' => $width, 'height' => $height];

            MediaLibrary::create($data);
            return response(['message' => 'success', 'mime' => $mime]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = MediaLibrary::findOrFail($id);
        return view($this->route.'.show', ['media' => $media]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $redirect = $request->redirect ?? url('admin/media');
        
        $media = MediaLibrary::findOrFail($request->id);
        Storage::delete(preg_replace("#uploads#", "public", $media->first()->url));
        $media->delete();
        return redirect($redirect)->with('success', 'File was deleted.');
    }
}
