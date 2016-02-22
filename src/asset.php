<?php
/**
 * This class exist solely as a base class for the Style ans Script classes to extend.
 *
 *
 * This class mainly determines the base path for asset registration.
 *
 * The paths used for Base themes and child themes are different and this class determines which you are using so that
 * ultimately you need only provide a relative path and the class will figure out where it is.
 *
 * @package   Skava
 *
 * @author    William Wilkerson <william.wilkerson4@gmail.com>
 *
 *
 *
 */

namespace Skava;

class Asset
{
    /**
     * Template Directory
     *
     * This simply stores the value of the get_template_directory_uri() function.
     * @var string
     */
    protected $template_dir;
    /**
     * StyleSheet Directory
     *
     * This simply stores the value of the get_stylesheet_directory_uri() function
     * @var string
     */
    protected $stylesheet_dir;
    /**
     * Child Theme
     *
     * This simply stores the value of the is_child_theme()
     * function which determines if the current theme is a child theme or not.
     * @var string
     */
    protected $is_child;
    /**
     * Base Path
     *
     * This stores what is the ending base path after calculation have been completed.
     * @var string
     */
    public $base_path;

    /**
     * __construct()
     *
     *When the class is extended and the parent constructor called
     * this function figures out the base path for asset registration.
     *
     *
     *
     * @return Asset
     */
    public function __construct()
    {
        $this->template_dir = get_template_directory_uri();
        $this->stylesheet_dir = get_stylesheet_directory_uri();
        $this->is_child = is_child_theme();
        return $this->base_path = (($this->is_child)
            ? $this->stylesheet_dir
            : $this->template_dir);
    }

    /**
     * gankVers()
     *
     *In the event that you need to remove the WordPress default version query string
     * from asset registrations then you can do that here.
     *
     * Please note that this will only apply to scripts that you specifically pass into this function.
     *
     * @param $type |string the type of asset. js or css.
     *
     * @return void
     */

    public function gankVers($type)
    {
        if ($type == 'js') {
            if (!is_admin()) {
                add_filter('script_loader_src', array($this, 'removeQueryVersion'));
            }
        } else {
            if (!is_admin()) {
                add_filter('style_loader_src', array($this, 'removeQueryVersion'));
            }

        }

    }

    public function removeQueryVersion($src)
    {
        $parts = explode('?', $src);

        return $parts[0];
    }
}
