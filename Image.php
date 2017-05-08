<?php

namespace eharango\opengraph;

use Yii;

/**
 * Description of Image
 *
 * @author ed
 */
class Image {
    /*
     * og:image:url - Identical to og:image.
      og:image:secure_url - An alternate url to use if the webpage requires HTTPS.
      og:image:type - A MIME type for this image.
      og:image:width - The number of pixels wide.
      og:image:height - The number of pixels high.
     */

    public $url;
    public $secure_url;
    public $type;
    public $width;
    public $height;

    function __construct() {
        $this->url = null;
        $this->secure_url = null;
        $this->type = null;
        $this->width = null;
        $this->height = null;
    }

    public function set($metas = []) {
        // Massive assignment by array
        foreach ($metas as $property => $content) {
            if (property_exists($this, $property)) {
                $this->$property = $content;
            }
        }
    }

    public function setArray($metas = []) {
        // Massive assignment by array
        foreach ($metas as $property => $content) {
            if (property_exists($this, $property)) {
                $this->$property = $content;
            }

            Yii::$app->controller->view->registerMetaTag(['property' => 'image:' . $property, 'content' => $this->$property,], uniqid());
        }
    }

    public function registerTags() {
        $this->checkTag('url');
        $this->checkTag('secure_url');
        $this->checkTag('type');
        $this->checkTag('width');
        $this->checkTag('height');
    }

    private function checkTag($property) {
        if ($this->$property !== null) {
            Yii::$app->controller->view->registerMetaTag(['property' => 'image:' . $property, 'content' => $this->$property,], 'image:' . $property);
        }
    }

}
