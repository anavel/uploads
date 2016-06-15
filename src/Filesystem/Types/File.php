<?php

namespace Anavel\Uploads\Filesystem\Types;


class File extends Type
{
    /**
     * @var integer
     */
    protected $size;

    /**
     * @var string
     */
    protected $extension;

    /**
     * @var string
     */
    protected $filename;

    public function __construct($metadata)
    {
        $this->path = $metadata['path'];
        $this->timestamp = $metadata['timestamp'];
        $this->dirname = $metadata['dirname'];
        $this->basename = $metadata['basename'];
        $this->size = $metadata['size'];
        $this->extension = $metadata['extension'];
        $this->filename = $metadata['filename'];
    }

    public function getThumbnail()
    {
        return '<i class="fa fa-file" style="font-size: 100pt;"></i>';
    }
}
