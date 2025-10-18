<?php

namespace Craft\Application\Drive\View;

use Craft\Application\Interfaces\ViewEngine;
use eftec\bladeone\BladeOne;

/**
 * #### Class BladeOneDrive for BladeOne view engine
 * This class integrates the BladeOne templating engine into the Craft application.
 * **Requires:** `eftec/bladeone` package via Composer.
 */
class BladeOneDrive implements ViewEngine
{
    protected $blade;

    /**
     * Constructor to set up BladeOne view engine.
     * 
     * @param string $viewPath The path to the view files.
     * @param array $options Options for BladeOne (e.g., cache_path).
     * 
     * **Note:** It is recommended to set a cache path for better performance.
     * null is not recommended because it will slow down rendering
     */
    public function __construct($viewPath, $options = [])
    {
        // Set up cache path for compiled templates (null is not recommended because it will slow down rendering)
        $cachePath = $options['cache_path']
            ?? (defined('INDEX_DIR') ? INDEX_DIR . 'cache/' : null);

        $mode = $cachePath ? BladeOne::MODE_AUTO : BladeOne::MODE_SLOW;

        $this->blade = new BladeOne($viewPath, $cachePath, $mode);
    }

    public function render(string $template, array $data = []): string
    {
        return $this->blade->run($template, $data);
    }
}
