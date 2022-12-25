<?php

namespace Queents\ConsoleHelpers\Traits;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait HandleStub
{
    /**
     * @param string $from
     * @param string $to
     * @param array $replacements
     * @param array $directory
     * @return void
     */
    protected function generateStubs(string $from, string $to, array $replacements, array $directory=[]): void
    {
        if(File::exists($from)){
            $stubValue = File::get($from);

            $convertStubToText = Str::of($stubValue);

            foreach($replacements as $key=>$replacement){
                $convertStubToText = $convertStubToText->replace('{{ '.$key.' }}',$replacement);
            }

            foreach($directory as $dir){
                if(!File::exists($dir)){
                    File::makeDirectory($dir);
                }
            }

            if(File::exists($to)){
                File::delete($to);
            }

            File::put($to, $convertStubToText);
        }
    }
}
