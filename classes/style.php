<?php
/**
 * This class exist as a way to register stylsheets in WordPress.
 *
 *
 * @package   Skava
 *
 * @author    William Wilkerson <william.wilkerson4@gmail.com>
 *
 *
 *
 */

namespace Skava;

class Style extends Asset
{
    /**
     * Type
     *  This says what type of script you're including. There are two possible options. Local and External.
     *  Local stylesheets would be those located in the them file structure such as the style.css.
     *  External stylesheets would be those located on other servers that need to be fetched via URL
     *  such as Google Fonts.
     * @var string
     */
    public $type = 'local';
    /**
     * Relative Path
     *
     * This is the relative path of the stylesheet. No need to determine template directory. This is done automatically.
     * @var string
     */
    public $path;
    /**
     * Name
     * This is the Handle of the stylesheet i.e (main-styles)
     * @var string
     */
    public $name;
    /**
     * Dependencies
     *
     * This accepts an array of dependent stylesheets that should be loaded before this one.
     * @var array
     */
    public $deps = array();

    /**
     * Version
     *
     * This Specifies the version number to pull if there is one.
     *
     * @var string
     */
    public $ver = false;
    /**
     * Media
     *
     * This defines the media type for the stylesheet default:all
     *
     * @var string
     */
    public $media = 'all';

    /**
     * register()
     *
     * This is the singleton method. On the first run this will create an instance of the style class.
     * then everything later in execution
     * will run off of the alread instantiated instance. This saves time because
     * PHP object creation is slow and this
     * will be called multiple multiple times during execution.
     *
     * If you dont like Singletons then get over yourself they're bloody useful.
     * @return Style
     */
    public static function register()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new self;
            $instance->superConstruct();
        }

        return $instance;
    }

    /**
     * superConstruct()
     *
     * This is a way for the Style class to call the constructor inside
     * @return Asset
     */
    public function superConstruct()
    {
        parent::__construct();
    }

//This method sets the path of the stylesheet
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

//This method sets the handle name of the stylesheet.
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

//This method sets the dependencies for the stylesheet
    public function setDeps($deps)
    {
        $this->deps = $deps;

        return $this;
    }

//This method sets the version number if applicable
    public function setVer($version)
    {
        $this->ver = $version;

        return $this;
    }

//This method sets the Media for the style sheet.
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function add()
    {
        if ($this->ver == false) {
            parent::gankVers('css');
        }
        if ($this->type != 'local') {
            wp_register_style($this->name, $this->path, $this->deps, $this->ver, $this->media);
            wp_enqueue_style($this->name);
        } else {
            wp_register_style($this->name, $this->base_path . $this->path, $this->deps, $this->ver, $this->media);
            wp_enqueue_style($this->name);
        }
        $this->reset();
    }

    private function reset()
    {
        $this->deps = array();
        $this->type = 'local';
        $this->ver = false;
        $this->media = 'all';
    }

    public function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}
