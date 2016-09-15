<?php


namespace Anavel\Uploads\Http\Controllers;

use Anavel\Foundation\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class CkEditorController extends Controller
{
    /**
     * @var \Anavel\Uploads\Filesystem\Filesystem
     */
    protected $filesystem;

    public function __construct(Application $app)
    {
        $this->filesystem = $app->make('anavel.filesystem');
    }

    public function index(Request $request)
    {
        $directory = null;
        $directoriesArray = array();
        $previousDirectory = null;
        if ($request->has('dir')) {
            $directory = $request->get('dir');
            $directoriesArray = explode('/', $directory);
            $withoutLastDir = $directoriesArray;
            array_pop($withoutLastDir);
            $previousDirectory = implode('/', $withoutLastDir);
        }

        $contents = $this->filesystem->listContents($directory);

        return view('anavel-uploads::pages.ckeditor.index', [
            'directoriesArray'  => $directoriesArray,
            'previousDirectory' => $previousDirectory,
            'contents'          => $contents
        ]);
    }

    /**
     * Store the files uploaded by ckeditor
     *
     * @param Request $request
     * @return Response
     */
    public function upload(Request $request)
    {
        $url = '';
        $message = '';

        if ($request->hasFile('upload')) {
            $this->filesystem->writeFile('', $request->file('upload'));

            $url = url(config('anavel-uploads.uploads_path') . DIRECTORY_SEPARATOR . $request->file('upload')->getClientOriginalName());
        } elseif (! empty($request->file('upload')) && ! $request->file('upload')->isValid()) {
            $message = $request->file('upload')->getErrorMessage();
        }

        return view('anavel-uploads::pages.ckeditor.uploader', [
            'funcNum' => $request->get('CKEditorFuncNum'),
            'url' => $url,
            'message' => $message
        ]);
    }
}
