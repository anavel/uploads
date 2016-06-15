<?php

namespace Anavel\Uploads\Filesystem;

use League\Flysystem\Filesystem as Flysystem;
use Exception;

class Filesystem
{
    /**
     * @var \League\Flysystem\Filesystem
     */
    protected $flysystem;

    protected $typesMap = [
        'dir'  => \Anavel\Uploads\Filesystem\Types\Directory::class,
        'file' => \Anavel\Uploads\Filesystem\Types\File::class
    ];

    public function __construct(Flysystem $flysystem)
    {
        $this->flysystem = $flysystem;
    }

    public function listContents($directory = null)
    {
        $contents = $this->flysystem->listContents($directory);

        $collection = collect();
        foreach ($contents as $object) {
            $collection->push($this->getType($object['type'], $object));
        }

        return $collection;
    }

    public function createDir($directory)
    {
        $this->flysystem->createDir($directory);
    }

    public function deleteDir($directory)
    {
        $this->flysystem->deleteDir($directory);
    }

    public function writeFile($directory, $file)
    {
        $stream = fopen($file->getRealPath(), 'r+');
        $this->flysystem->writeStream($directory . '/' . $file->getClientOriginalName(), $stream);
        fclose($stream);
    }

    public function deleteFile($file)
    {
        $this->flysystem->delete($file);
    }

    protected function getType($name, $metadata)
    {
        if (! isset($this->typesMap[$name])) {
            throw new Exception('Unknown type '.$name);
        }

        return new $this->typesMap[$name]($metadata);
    }
}
