<?php

namespace App\Services;

use App\Models\Module;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Exception;

/**
 * Service for zipping modules
 */
class Modules
{
    const modulePath = '/module/';

    /**
     * Get content for zipped module
     *
     * @param Module $module
     * @return string
     * @throws Exception
     */
    public function getZippedModule(Module $module)
    {
        $zip = new ZipArchive();
        $filename = public_path() . DIRECTORY_SEPARATOR . "module_{$module->id}.zip";

        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
            throw new Exception("Cannot open <$filename>\n");
        }

        $zip->addFromString("index.html", $this->getHtmlFile());
        $zip->addFromString("script.js", $this->getScriptFile($module));
        $zip->addFromString("style.css", $this->getCssFile($module));
        $zip->close();

        $content = file_get_contents($filename);
        unlink($filename);

        return $content;
    }

    /**
     * Get content for html file
     *
     * @return string
     */
    private function getHtmlFile()
    {
        return Storage::disk('local')->get(self::modulePath . 'index.html');
    }

    /**
     * Get content for javascript file
     *
     * @param Module $module
     * @return string
     */
    private function getScriptFile(Module $module)
    {
        return str_replace(
                'MODULE_URL_REPLACE',
                $module->url,
                Storage::disk('local')->get(self::modulePath . 'script.js')
            );
    }

    /**
     * Get content for css file
     *
     * @param Module $module
     * @return string
     */
    private function getCssFile(Module $module)
    {
        return str_replace(
                ['WIDTH_REPLACE', 'HEIGHT_REPLACE', 'COLOR_REPLACE'],
                [$module->width, $module->height, $module->color],
                Storage::disk('local')->get(self::modulePath . 'style.css')
            );
    }

}

