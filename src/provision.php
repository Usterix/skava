<?php
/**
 * This class provides you with the ability to create plugin dependencies for your wordpress theme.
 *
 * Plugins defined by this method will prompt users on the backend to install and activate the plugins that you provide
 *
 * @package   Skava
 *
 * @author    William Wilkerson <william.wilkerson4@gmail.com>
 * @author    Thomas Griffin <thomasgriffinmedia.com>
 * @author    Gary Jones <gamajo.com>
 *
 *
 *
 */
namespace Skava;

//This class is used for provisioning and makes use of the Class made by @jthomasgriffin


class Plugin
{
    /**
     * Plugin Type
     *
     * This is the type of plugin that you wish to install,
     * there are three possible arguments which are
     * local,private, and public
     *
     * @var string
     */
    private $type;
    /**
     * Plugin Name
     *
     * This is the name of the plugin which you wish to install.
     * @var string
     */
    private $name;
    /**
     * Plugin Slug
     *
     * This is the slug or url of the plugin which you want to install
     * @var string
     */
    private $slug;
    /**
     * Plugin Source
     *
     * This parameter is used only for private or local plugin
     * instals and it defines the source path or url of the plugin.
     * @var string
     */
    private $source;
    /**
     * Required
     *
     * This defines whether or not the plugin should be required or not. this defaults to true unless set otherwise.
     * @var boolean
     */
    private $required = true;
    /**
     * Plugin Version
     *
     * This will allow you to specify the version of the plugin which you wish to download, this is optional.
     * @var int
     */
    private $version;
    /**
     * Plugin Activate
     *
     * This specifies whether or not the plugin should be auto activated on install.
     *
     * @var boolean
     */
    private $activate;
    /**
     * Plugin Specific
     *
     * This sets whether or not the plugin is theme specific meaning it should deactivate on theme switch
     *
     * @var boolean
     */
    private $specific;
    /**
     * Plugin External URL
     *
     * This is required for private plugins so that the class knows where to pull the plugin from.
     *
     * @var string
     */
    private $external_url;

    /**
     * reigster()
     *
     * Returns a new instance of the class for use
     *
     *
     * @return new self
     */
    public static function register()
    {
        return new self();
    }

    /**
     * setType()
     *
     * Sets the type of the plugin which is required
     *
     * @param string $type The type of plugin.
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * setName()
     *
     * Sets the name of the sidebar
     *
     * @param string $name The name of the plugin.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * setSlug()
     *
     * Sets the Slug of the plugin for use for public plugin installs
     * This value can be found in the URL on the wordpress page of the plugin you wish to install.
     *
     * @param string $slug The slug of the plugin.
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * setSource()
     *
     * Sets the source of the plugin on local installs
     *
     * @param string $source The path/source of the plugin.
     *
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * setRequired()
     *
     * Sets Whether or not the plugin should be required for the plugin to work.
     *
     * @param boolean $required
     *
     * @return $this
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * setVersion()
     *
     * Allows you to set the version of the plugin you want.
     * if left blank then the most recent will be pulled down.
     *
     * @param int $version the version number of the plugin
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * setActivate()
     *
     * Sets whether or not the plugin should auto-activate upon install.
     *
     * @param boolean $activate
     *
     * @return $this
     */
    public function setActivate($activate)
    {
        $this->activate = $activate;

        return $this;
    }

    /**
     * setSpecific()
     *
     * Sets whether or not the plugin should be theme specific.
     *
     * @param boolean $specific
     *
     * @return $this
     */
    public function setSpecific($specific)
    {
        $this->specific = $specific;

    }

    /**
     * setUrl()
     *
     * Used in private plugin type installs.
     * This specifies the external URL of the plugi nyou wish to install.
     *
     * @param string $url the url of the plugin
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->external_url = $url;

        return $this;
    }

    /**
     * install()
     *
     * This function is run at the end of the chained methods
     * to kick off the install procedure.
     *
     */
    public function install()
    {

        if ($this->type === 'private') {
            $plugin = array(
                array(
                    'name' => $this->name,
                    // The plugin name.
                    'slug' => $this->slug,
                    // The plugin slug (typically the folder name).
                    'source' => $this->source,
                    // The plugin source.
                    'required' => $this->required,
                    // If false, the plugin is only 'recommended' instead of required.
                    'external_url' => $this->external_url,
                    // If set, overrides default API URL and points to an external URL.
                )
            );

        } elseif ($this->type === 'local') {
            $plugin = array(
                array(
                    array(
                        'name' => $this->name,
                        // The plugin name.
                        'slug' => $this->slug,
                        // The plugin slug (typically the folder name).
                        'source' => get_stylesheet_directory() . $this->source,
                        // The plugin source.
                        'required' => $this->required,
                        // If false, the plugin is only 'recommended' instead of required.
                        'version' => $this->version,
                        // E.g. 1.0.0. If set, the active plugin must be this version or higher.
                        'force_activation' => $this->activate,
                        // If true, plugin is activated upon theme activation and cannot
                        //be deactivated until theme switch.
                        'force_deactivation' => $this->specific,
                        // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                        'external_url' => $this->external_url,
                        // If set, overrides default API URL and points to an external URL.
                    )
                )
            );

        } elseif ($this->type === 'public') {
            $plugin = array(
                array(
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'required' => $this->required,
                )
            );

        } else {
            trigger_error("Sorry, Plugins of the type {$this->type} are not currently supported");
        }
        $config = array(
            'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '', // Default absolute path to pre-packaged plugins.
            'menu' => 'skava-install-plugins', // Menu slug.
            'has_notices' => true, // Show admin notices or not.
            'dismissable' => true, // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false, // Automatically activate plugins after installation or not.
            'message' => '', // Message to output right before the plugins table.
            'strings' => array(
                'page_title' => __('Install Required Plugins', 'tgmpa'),
                'menu_title' => __('Install Plugins', 'tgmpa'),
                'installing' => __('Installing Plugin: %s', 'tgmpa'),
                // %s = plugin name.
                'oops' => __('Something went wrong with the plugin API.', 'tgmpa'),
                'notice_can_install_required' => _n_noop(
                    'This theme requires the following plugin: %1$s.',
                    'This theme requires the following plugins: %1$s.',
                    'tgmpa'
                ),
                // %1$s = plugin name(s).
                'notice_can_install_recommended' => _n_noop(
                    'This theme recommends the following plugin: %1$s.',
                    'This theme recommends the following plugins: %1$s.',
                    'tgmpa'
                ),
                // %1$s = plugin name(s).
                'notice_cannot_install' => _n_noop(
                    'Sorry, but you do not have the correct permissions to install the %s plugin.
                    Contact the administrator of this site for help on getting the plugin installed.',
                    'Sorry, but you do not have the correct permissions to install the %s plugins.
                     Contact the administrator of this site for help on getting the plugins installed.',
                    'tgmpa'
                ),
                // %1$s = plugin name(s).
                'notice_can_activate_required' => _n_noop(
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'tgmpa'
                ),
                // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'tgmpa'
                ),
                // %1$s = plugin name(s).
                'notice_cannot_activate' => _n_noop(
                    'Sorry, but you do not have the correct permissions to activate the %s plugin.
                     Contact the administrator of this site for help on getting the plugin activated.',
                    'Sorry, but you do not have the correct permissions to activate the %s plugins.
                     Contact the administrator of this site for help on getting the plugins activated.',
                    'tgmpa'
                ),
                // %1$s = plugin name(s).
                'notice_ask_to_update' => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum
                    compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure
                     maximum compatibility with this theme: %1$s.',
                    'tgmpa'
                ),
                // %1$s = plugin name(s).
                'notice_cannot_update' => _n_noop(
                    'Sorry, but you do not have the correct permissions to update the %s plugin.
                     Contact the administrator of this site for help on getting the plugin updated.',
                    'Sorry, but you do not have the correct permissions to update the %s plugins.
                     Contact the administrator of this site for help on getting the plugins updated.',
                    'tgmpa'
                ),
                // %1$s = plugin name(s).
                'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'tgmpa'),
                'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins', 'tgmpa'),
                'return' => __('Return to Required Plugins Installer', 'tgmpa'),
                'plugin_activated' => __('Plugin activated successfully.', 'tgmpa'),
                'complete' => __('All plugins installed and activated successfully. %s', 'tgmpa'),
                // %s = dashboard link.
                'nag_type' => 'updated'
                // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );
        tgmpa($plugin, $config);
    }
}
