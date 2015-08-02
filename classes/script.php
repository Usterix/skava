<?php
namespace Skava;

class Script extends Asset
{
    //Setting up Variables.

    public $type = 'local';
    //This is the handle of the script that is being registered
    public $name;
    //This is the relative path of the of the script.
    public $path;
    //This is the array of dependencies required for the script.
    public $deps = array();
    //This is for the version of the file to load if applicable
    public $ver = false;
    //This is what decides whether or not the script will be in the footer.
    public $footer = true;

    private $finSrc;

    //Function that calls the constructor of the parent class
    public function superConstruct()
    {
        parent::__construct();
    }

    //Singleton that sets up the script class.
    public static function register()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new self;
            $instance->superConstruct();
        }

        return $instance;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function setDeps($deps)
    {
        $this->deps = $deps;
        return $this;
    }

    public function setVer($ver)
    {
        $this->vers = $ver;
        return $this;
    }

  public function setType($type) {
    $this->type = $type;

    return $this;
  }
    public function setFooter($footer)
    {
        $this->footer = $footer;
        return $this;
    }

    public function add()
    {
        if ($this->ver === false) {
            parent::gankVers('js');
        }
        if ($this->type != 'local') {
            $this->finSrc = $this->path;
        } else {
            $this->finSrc = $this->base_path . $this->path;
        }

        wp_register_script($this->name, $this->finSrc, $this->deps, $this->ver, $this->footer);
        wp_enqueue_script($this->name);
        $this->reset();
    }

    private function reset()
    {
        $this->type = 'local';
        $this->deps = array();
        $this->ver = false;
        $this->footer = true;
    }

    //Overwritting the constructor so that it cannot be called.
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
