<?php
/**
 * This class provides you with the ability to create new WordPress pages through code.
 *
 * If you have the Need/Desire to define some or all of your WordPress pages in code you can achieve it with this class.
 *
 * @package Skava
 *
 * @author  William Wilkerson <william.wilkerson4@gmail.com>
 *
 * @uses    $wpdb
 *
 *
 */

namespace Skava;

class Page
{
    /**
     * Page Name
     *
     * The Human readable name of the page that you wish to create
     * @var string
     */
    private $page_name;
    /**
     * Page Slug
     *
     * The Slug of the page that you're creating.
     * @var string
     */
    private $page_slug;
    /**
     * Author
     *
     * The user id of the user you wish to attribute this pages creation to. This defaults to one for the admin uses but
     * it can be modified using a method outlined below.
     *
     * @var int
     */
    private $author = 1;
    /**
     *Post Type.
     *
     * This is the post type of the thing being created in this instance a page. this is not modifiable as the code for
     * other post types may differ from the code necessary to create a page so this is defaulted to page and left there.
     * @var string
     */
    private $post_type = 'page';
    /**
     *Page Parent
     *
     * If you wish to apply a parent to the pages you are creating then you may do so with this.
     * @var string  the slug or id of the page you wish to have as the parent.
     */
    private $page_parent;
    /**
     * Status
     *
     * The published status of the page you're creating.
     * @var string valid WordPress post status
     */
    private $status = 'publish';
    /**
     * WP Error
     *
     * To be entirely honest i have no idea what this does i just know that it's necessary.
     * @var bool
     */
    private $wp_error = true;

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
     * setPageName()
     *
     * This is the method that allows you to set the page name
     *
     * @param page_name
     *
     * @return Page
     */

    public function setPageName($page_name)
    {
        $this->page_name = $page_name;
        $page_slug = strtolower($page_name);
        $page_slug = str_replace(' ', '-', $page_slug);
        $this->page_slug = $page_slug;

        return $this;
    }

    /**
     * setPageSlug()
     *
     * This is the method that allows you to set the page slug
     *
     * @param page_slug
     *
     * @return Page
     *
     */

    public function setPageSlug($page_slug)
    {
        $this->page_slug = $page_slug;

        return $this;
    }

    /**
     * setPageAuthor()
     *
     * This is the method that allows you to set the page Author
     *
     * @param author
     *
     * @return Page
     */

    public function setPageAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * setPageParent()
     *
     * This is the method that allows you to set the page Parent
     *
     * @param page_parent
     *
     * @return Page
     */

    public function setPageParent($page_parent)
    {
        $this->page_parent = $page_parent;

        return $this;
    }

    /**
     * setStatus()
     *
     * This is the method that allows you to set the page status
     *
     * @param status
     *
     * @return Page
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * create()
     *
     *This is the method that actually creates the pages for you.
     * The method will alsodo a check to ensure that the page has
     * not already been created before trying to add it so that
     * you don't get duplicates.
     *
     * @uses $wpdb
     * @return void
     */
    public function create()
    {
        global $wpdb;
        $query = $wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts}
        WHERE post_title = %s
        AND post_type = 'page'",
            $this->page_name
        );
        $wpdb->query($query);
        if ($wpdb->num_rows === 0) {
            wp_insert_post(
                array(
                    'post_name' => $this->page_slug,
                    'post_title' => $this->page_name,
                    'post_author' => $this->author,
                    'post_parent' => $this->page_parent,
                    'post_status' => $this->status,
                    'post_type' => $this->post_type
                ),
                $this->wp_error
            );
        }
    }
}
