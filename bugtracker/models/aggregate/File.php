<?php

namespace app\modules\bugtracker\models\aggregate;
use app\modules\bugtracker\interfaces\iFiles;

/**
 * Description of file
 *
 * @author DartVadius
 */
class File {
    private $file;
    public function __construct(iFiles $file) {
        $this->file = $file;
    }
    
    public function getPath() {
        return $this->file->getPath();
    }
    
    public function getFileName() {
        return $this->file->getFileName();
    }
}
