<?php


namespace Anavel\Uploads\Http\Controllers;
use Anavel\Foundation\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class ModalController extends Controller
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

        return view('anavel-uploads::pages.modal.index', [
            'directoriesArray'  => $directoriesArray,
            'previousDirectory' => $previousDirectory,
            'contents'          => $contents
        ]);
    }
}