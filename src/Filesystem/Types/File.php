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
        if ($this->isImage()) {
            return sprintf('<img src="%s" alt="">', url(config('anavel-uploads.uploads_path').$this->getPath()));
        } else {
            return '<i class="fa fa-file" style="font-size: 100pt;"></i>';
        }
    }

    protected function isImage()
    {
        $imageExtensions = ['png', 'jpg', 'jpeg'];

        if (in_array($this->extension, $imageExtensions)) {
            return true;
        }

        return false;
    }
}
