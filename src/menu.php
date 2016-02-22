<?php
/**
 * This Class is used to define Theme menu locations and also
 * to setup the displaying of menus in your theme.
 *
 * This Class really exist as a way to easily create nav menu
 * locations and an easy way to show menus in your theme.
 *
 * @package Skava
 *
 * @author  William Wilkerson <william.wilkerson4@gmail.com>
 *
 * @uses    register_nav_menu()
 * @uses    wp_nav_menu()
 *
 */
namespace Skava;

class Menu
{

    /**
     * CreateLocation()
     *
     * @param string $location
     * @param string $description
     *
     * This defines the WordPress theme locations for menus.
     * Please note that if you do not currently
     * have a menu created on your site then theme locations
     * will not appear on the backend.
     *
     * @uses register_nav_menu()
     *
     * @return void
     *
     */
    public static function createLocation($location, $description)
    {
        $location_t = __($location);
        $description_t = __($description);
        register_nav_menu($location_t, $description_t);
    }

    //Menu Factory
    public static function register()
    {
        return new self();
    }

    /**
     * Theme Location
     *
     * The menu location .
     * @var string
     */
    private $theme_location = '';

    /**
     * Menu
     *
     * The name of the menu you wish to load.
     * If you are using a them location then this is optional as it will
     * display whatever menu is assigned to said location
     * However if you do not have a theme location then you may
     * set this variable to a string that represents the menu you wish to call
     * @var string
     */
    private $menu = '';

    /**
     * Container
     *
     * Whether to wrap the ul, and what to wrap it with. Allowed tags are div and nav. Use false for no container
     * @var string
     */
    private $container = '';

    /**
     * Container Class
     *
     * The class that is applied to the container
     * @var string
     */
    private $container_class = '';

    /**
     * Container ID
     *
     * The ID that is applied to the container
     * @var string
     */
    private $container_id = '';

    /**
     * Menu Class
     *
     * The class that is applied to the ul element which encloses the menu items.
     * Multiple classes can be separated with spaces. Formerly known as $wrap_class.
     * @var string
     */
    private $menu_class = '';

    /**
     * Menu ID
     *
     * The ID that is applied to the ul element which encloses the menu items.
     * Multiple classes can be separated with spaces. Formerly known as $wrap_id.
     * @var string
     */
    private $menu_id = '';

    /**
     * Echo
     *
     * Whether to echo the menu or return it. For returning menu use '0'
     * @var boolean
     */
    private $echo = true;

    /**
     *  Fallback Call Back
     *
     *  If the menu doesn't exist, the fallback function to use. Set to false for no fallback.
     * Note: Passes $args to the custom function.
     * @var string
     */
    private $fallback_cb = '';

    /**
     *  Before
     *
     *  Output text before the <a> of the link
     * @var string
     */
    private $before = '';

    /**
     *  After
     *  Output text after the <a> of the link
     * @var string
     */
    private $after = '';

    /**
     *  Link Before
     *  Output text before the link text
     * @var string
     */
    private $link_before = '';

    /**
     *  Link After
     *  Output text after the link text
     * @var string
     */
    private $link_after = '';

    /**
     *  Items Wrap
     *  Evaluated as the format string argument of a sprintf() expression.
     * The format string incorporates the other parameters by numbered token.
     * %1$s is expanded to the value of the 'menu_id' parameter,
     * %2$s is expanded to the value of the 'menu_class' parameter,
     * and %3$s is expanded to the value of the list items.
     * If a numbered token is omitted from the format string, the related parameter
     * is omitted from the menu markup.
     * Note: To exclude the items wrap (for instance, if the wrap is built into your theme),
     * you still need to pass %3$s as the parameter.
     * If you pass an empty string, your menu won't display at all.
     * @var string
     */
    private $items_wrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';

    /**
     *  Depth
     *  How many levels of the hierarchy are to be included where 0 means all.
     * -1 displays links at any depth and arranges them in a single, flat list.
     * @var integer
     */
    private $depth = 0;

    /**
     *  Walker
     *  Custom walker object to use (Note: You must pass an actual object to use, not a string)
     * @var object
     */
    private $walker = '';

    /**
     * setThemeLocation()
     *
     * Sets the theme location to use.
     *
     * @param string $theme_location The name of the theme location to use.
     *
     * @return $this
     */
    public function setThemeLocation($theme_location)
    {
        $this->theme_location = $theme_location;
        return $this;
    }

    /**
     * setMenu()
     *
     * Sets the menu to use.
     *
     * @param string $menu The name of the menu to use.
     *
     * @return $this
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
        return $this;
    }

    /**
     * setContainer()
     *
     * Sets the container for the menu.
     *
     * @param string $container name of the container for the menu accepts <div> and <nav>.
     *
     * @return $this
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * setContainerClass()
     *
     * Sets the Class for the container on the menu.
     *
     * @param string $container_class Class for the container on the menu.
     *
     * @return $this
     */
    public function setContainerClass($container_class)
    {
        $this->container_class = $container_class;
        return $this;
    }

    /**
     * setContainerID()
     *
     * Sets the ID for the container on the menu.
     *
     * @param string $container_id ID for the container on the menu.
     *
     * @return $this
     */
    public function setContainerID($container_id)
    {
        $this->container_id = $container_id;
        return $this;
    }

    /**
     * setMenuClass()
     *
     * Sets the Class for the menu.
     *
     * @param string $menu_class Class for the menu.
     *
     * @return $this
     */
    public function setMenuClass($menu_class)
    {
        $this->menu_class = $menu_class;
        return $this;
    }

    /**
     * setMenuID()
     *
     * Sets the ID for the menu.
     *
     * @param string $menu_id ID for the menu.
     *
     * @return $this
     */
    public function setMenuID($menu_id)
    {
        $this->menu_id = $menu_id;
        return $this;
    }

    /**
     * setMenuEcho()
     *
     * Sets whether or not the menu should echo.
     *
     * @param boolean $echo whether or not the menu should echo.
     *
     * @return $this
     */
    public function setMenuEcho($echo)
    {
        $this->echo = $echo;
        return $this;
    }

    /**
     * setFallbackCB()
     *
     * Sets a callback function to use as a callback in case the menu defined is not found.
     *
     * @param string $fallback_cb The name of the function to use as a callback in case the
     * menu defined is not found.
     *
     * @return $this
     */
    public function setFallbackCB($fallback_cb)
    {
        $this->fallback_cb = $fallback_cb;
        return $this;
    }

    /**
     * setBefore()
     *
     * Sets the text to output before the A tags in the menu.
     *
     * @param string $before Text to echo before the <a> tags.
     *
     * @return $this
     */
    public function setBefore($before)
    {
        $this->before = $before;
        return $this;
    }

    /**
     * setAfter()
     *
     * Sets the text to output after the A tags in the menu.
     *
     * @param string $after Text to echo after the <a> tags.
     *
     * @return $this
     */
    public function setAfter($after)
    {
        $this->after = $after;
        return $this;
    }

    /**
     * setLinkBefore()
     *
     * Sets the text to output before the link text.
     *
     * @param string $link_before Text to echo before the link text.
     *
     * @return $this
     */
    public function setLinkBefore($link_before)
    {
        $this->link_before = $link_before;
        return $this;
    }

    /**
     * setLinkAfter()
     *
     * Sets the text to output after the link text.
     *
     * @param string $link_after Text to echo after the link text.
     *
     * @return $this
     */
    public function setLinkAfter($link_after)
    {
        $this->link_after = $link_after;
        return $this;
    }

    /**
     * setItemsWrap()
     *
     * Sets the item wraps for the menu items.
     *
     * @param string $items_wrap Text to set as the item wrap.
     *
     * @return $this
     */
    public function setItemsWrap($items_wrap)
    {
        $this->items_wrap = $items_wrap;
        return $this;
    }

    /**
     * setDepth()
     *
     * Sets the depth of the menu.
     *
     * @param integer $depth depth of the menu tree.
     *
     * @return $this
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
        return $this;
    }

    /**
     * setWalker()
     *
     * Sets the Custom walker object to use
     * (Note: You must pass an actual object to use, not a string)
     *
     * @param object $walker ustom walker object to use.
     *
     * @return $this
     */
    public function setWalker($walker)
    {
        $this->walker = $walker;
        return $this;
    }

    /**
     * menuRender()
     *
     * Renders the menu using the configuration options available above.
     *
     * @uses wp_nav_menu()
     *
     * @param none
     *
     * @return void
     *
     */
    public function render()
    {
        wp_nav_menu(
            array(
                'theme_location' => $this->theme_location,
                'menu' => $this->menu,
                'container' => $this->container,
                'container_class' => $this->container_class,
                'container_id' => $this->container_id,
                'menu_class' => $this->menu_class,
                'menu_id' => $this->menu_id,
                'echo' => $this->echo,
                'fallback_cb' => $this->fallback_cb,
                'before' => $this->before,
                'after' => $this->after,
                'link_before' => $this->link_before,
                'link_after' => $this->link_after,
                'items_wrap' => $this->items_wrap,
                'depth' => $this->depth,
                'walker' => $this->walker
            )
        );
    }
}
