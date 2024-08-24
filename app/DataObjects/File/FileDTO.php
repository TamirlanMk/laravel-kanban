<?php

namespace App\DataObjects\File;

use App\DataObjects\CustomDTO;

class FileDTO extends CustomDTO
{
    public function __construct(
        public string $path,
        public string $filename,
        public string $extension,
    ) {
        //
    }
}
