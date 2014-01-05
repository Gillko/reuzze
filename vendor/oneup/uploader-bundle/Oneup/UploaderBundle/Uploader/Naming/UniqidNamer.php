<?php

namespace Oneup\UploaderBundle\Uploader\Naming;

use Oneup\UploaderBundle\Uploader\File\FileInterface;

class UniqidNamer implements NamerInterface
{
    public function name(FileInterface $file)
    {
        $array =  (array) $file;
        $i = 0;
        $filename = "filename";
        foreach($array as $val){
            if($i == 1){
                $filename = $val;
            }
            $i++;
        }

        return sprintf($filename);
        //return sprintf('%s.%s', uniqid(), $file->getExtension());
    }
}
