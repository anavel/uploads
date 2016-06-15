<?php
namespace Anavel\Uploads\Http\Controllers;

use Anavel\Foundation\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class MainController extends Controller
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

        return view('anavel-uploads::pages.index', [
            'directoriesArray'  => $directoriesArray,
            'previousDirectory' => $previousDirectory,
            'contents'          => $contents
        ]);
    }

    public function createDirectory(Request $request)
    {
        $this->filesystem->createDir($request->get('parent').'/'.$request->get('dirname'));

        return redirect()
            ->back()
            ->with('anavel-alert', [
                'type'  => 'success',
                'icon'  => 'fa-check',
                'title' => trans('anavel-uploads::messages.alert_success_create_directory_title'),
                'text'  => trans('anavel-uploads::messages.alert_success_create_directory_text')
            ]);
    }

    public function destroyDirectory(Request $request)
    {
        $this->filesystem->deleteDir($request->get('name'));

        return redirect()
            ->back()
            ->with('anavel-alert', [
                'type'  => 'success',
                'icon'  => 'fa-check',
                'title' => trans('anavel-uploads::messages.alert_success_destroy_dir_title'),
                'text'  => trans('anavel-uploads::messages.alert_success_destroy_dir_text')
            ]);
    }

    public function upload(Request $request)
    {
        $this->filesystem->writeFile($request->get('parent'), $request->file('file'));

        return redirect()
            ->back()
            ->with('anavel-alert', [
                'type'  => 'success',
                'icon'  => 'fa-check',
                'title' => trans('anavel-uploads::messages.alert_success_upload_file_title'),
                'text'  => trans('anavel-uploads::messages.alert_success_upload_file_text')
            ]);
    }

    public function destroyFile(Request $request)
    {
        $this->filesystem->deleteFile($request->get('name'));

        return redirect()
            ->back()
            ->with('anavel-alert', [
                'type'  => 'success',
                'icon'  => 'fa-check',
                'title' => trans('anavel-uploads::messages.alert_success_destroy_file_title'),
                'text'  => trans('anavel-uploads::messages.alert_success_destroy_file_text')
            ]);
    }
}
