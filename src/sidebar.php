<?php
/**
 * This Class is used to allow you to easily create sidebar or "Widgetable Areas" for your theme.
 *
 * This Class give you the ablility to create Sidebar areas and also the ability to render them.
 *
 * @package Skava
 *
 * @author  William Wilkerson <william.wilkerson4@gmail.com>
 *
 * @uses    register_sidebar()
 * @uses    dynamic_sidebar()
 *
 */
namespace Skava;

class Sidebar
{
    /**
     * Sidebar Name
     *
     * The Human readable name of the sidebar, this will be show as the name in the admin interface.
     * @var string
     */
    private $name;
    /**
     * Text Domain
     *
     * This where the text domain is defined for translations.
     * This must be the name of the sidebar all lowercased and spaces
     * replaced with dashes.
     * @var string
     */
    private $text_domain;
    /**
     * Sidebar ID.
     *
     * This is the id of the sidebar. Also what will be used to call the sidebar in the dynamic sidebar function.
     * @var string
     */
    private $id;
    /**
     * Sidebar Description
     *
     * This is the description that will show in the admin under the sidebar name.
     * Provide a description of your sidebar here
     * @var string
     */
    private $description;
    /**
     * Class
     *
     * CSS classname that will be applied to the widget HTML.
     * @var string
     */
    private $class;
    /**
     * Before Widget
     *
     * HTML to place before every
     * widget(default: '<li id="%1$s" class="widget %2$s">')
     * Note: uses sprintf for variable substitution
     * @var string
     */
    private $before_widget = '<li id="%1$s" class="widget %2$s">';
    /**
     * After Widget
     *
     * HTML to place after every widget (default: "</li>\n").
     * @var string
     */
    private $after_widget = '</li>';
    /**
     * Before Title
     *
     * HTML to place before every title (default: <h2 class="widgettitle">).
     * @var string
     */
    private $before_title = '<h2 class="widgettitle">';
    /**
     * After Title
     *
     * HTML to place after every title (default: "</h2>\n").
     * @var string
     */
    private $after_title = '</h2>';

    /**
     * register()
     *
     * This is the factory method that sets up an instance of the class
     *
     * @param none
     *
     * @return self
     */
    public static function register()
    {
        return new self();
    }

    /**
     * setName()
     *
     * Sets the name of the sidebar
     *
     * @param string $name The name of the sidebar.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = __($name);

        return $this;
    }

    /**
     * setTextDomain()
     *
     * Sets the text domain of the sidebar
     *
     * @param string $text_domain text domain of the sidebar.
     *
     * @return $this
     */
    public function setTextDomain($text_domain)
    {
        $this->text_domain = $text_domain;

        return $this;
    }

    /**
     * setID()
     *
     * Sets the ID of the sidebar. This will always be lowecased and spaces replaced with dashes.
     *
     * @param string $id The id of the sidebar.
     *
     * @return $this
     */
    public function setID($id)
    {
        strtolower($id);
        str_replace(' ', '-', $id);
        $this->id = $id;

        return $this;
    }

    /**
     * setDescription()
     *
     * Sets the description of the sidebar
     *
     * @param string $description The description of the sidebar.
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = __($description);

        return $this;
    }

    /**
     * setClass()
     *
     * Sets the CSS Classname of the sidebar.
     *
     * @param string $class The CSS classname of the sidebar.
     *
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * setBeforeWidget()
     *
     * Sets the HTML to be used before the widgets.
     *
     * @param string $before_widget The HTML to be output.
     *
     * @return $this
     */
    public function setBeforeWidget($before_widget)
    {
        $this->before_widget = $before_widget;

        return $this;
    }

    /**
     * setAfterWidget()
     *
     * Sets the HTML to be used after the widgets.
     *
     * @param string $after_widget The HTML to be output.
     *
     * @return $this
     */
    public function setAfterWidget($after_widget)
    {
        $this->after_widget = $after_widget;

        return $this;
    }

    /**
     * setBeforeTitle()
     *
     * Sets the HTML to be placed before every title
     *
     * @param string $before_title HTML to be output before the titles.
     *
     * @return $this
     */
    public function setBeforeTitle($before_title)
    {
        $this->before_title = $before_title;

        return $this;
    }

    /**
     * setAfterTitle()
     *
     * Sets the HTML to be placed after every title
     *
     * @param string $after_title HTML to be output after the titles.
     *
     * @return $this
     */
    public function setAfterTitle($after_title)
    {
        $this->after_title = $after_title;

        return $this;
    }

    /**
     * create()
     *
     * Registers the sidebar for use in wordpress using the parameters outlined above.
     * This is most effective when called at the end of chained
     * methods to get all of the config options.
     */
    public function create()
    {
        register_sidebar(array(
            'name' => __($this->name, $this->text_domain),
            'id' => $this->id,
            'description' => $this->description,
            'class' => $this->class,
            'before_widget' => $this->before_widget,
            'after_widget' => $this->after_widget,
            'before_title' => $this->before_title,
            'after_title' => $this->after_title
        ));
    }

    /**
     * render()
     *
     * This renders out the sidebar using the id that is passed as an argument.
     *
     * @param string $sidebarid The id of the sidebar to be output..
     */
    public static function render($sidebarid)
    {
        if (is_active_sidebar($sidebarid)) {
            dynamic_sidebar($sidebarid);
        }
    }
}
