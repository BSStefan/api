<?php
/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 0.0.1
 */
namespace Tmdb\Helper;

use Tmdb\Model\Configuration;
use Tmdb\Model\Image;

class ImageHelper {

    private $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * Load the image configuration collection
     *
     * @return \Tmdb\Model\Common\Collection
     */
    public function getImageConfiguration()
    {
        return $this->config->getImages();
    }

    /**
     * Get the url for the image resource
     *
     * @param Image $image
     * @param string $size
     * @return string
     */
    public function getUrl(Image $image, $size = 'original') {
        $config = $this->getImageConfiguration();

        return $config['base_url'] . $size . $image->getFilePath();
    }

    /**
     * Get an img html tag for the image in the specified size
     *
     * @param Image $image
     * @param string $size
     * @return string
     */
    public function getHtml(Image $image, $size = 'original') {
        return sprintf(
            '<img src="%s" width="%s" height="%s" />',
            $this->getUrl($image, $size),
            $image->getWidth(),
            $image->getHeight()
        );
    }
}