<?php

namespace Anavel\Uploads\Filesystem\Types;


class Directory extends Type
{
    public function __construct($metadata)
    {
        $this->path = $metadata['path'];
        $this->timestamp = $metadata['timestamp'];
        $this->dirname = $metadata['dirname'];
        $this->basename = $metadata['basename'];
    }

    public function getThumbnail()
    {
        return '<i class="fa fa-folder" style="font-size: 100pt;"></i>';
    }
}
