<?php

namespace Anavel\Uploads\Filesystem\Types;

abstract class Type
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var integer
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $dirname;

    /**
     * @var string
     */
    protected $basename;

    public function getPath()
    {
        return $this->path;
    }

    public function getBasename()
    {
        return $this->basename;
    }

    public function isDir()
    {
        if ($this instanceof Directory) {
            return true;
        }

        return false;
    }

    abstract public function getThumbnail();
}
