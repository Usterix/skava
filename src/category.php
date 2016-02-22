<?php
/**
 * This class provides you with the ability to create new WordPress categories through code.
 *
 * If you have the Need/Desire to define some or all of your WordPress
 * categories in code you can achieve it with this class.
 *
 * @package Skava
 *
 * @author  William Wilkerson <william.wilkerson4@gmail.com>
 *
 * @uses    wp_insert_category
 *
 *
 */
namespace Skava;


class Category
{
    /**
     * Category Name
     *
     * The Human readable name of the category that you wish to create
     * @var string
     */
    private $title;
    /**
     *Post Type.
     *
     * This is the post type of the thing being created in this instance a category.
     * this is not modifiable as the code for other post types may differ
     * from the code necessary to create a category so this is defaulted
     * to category and left there.
     * @var string
     */
    private $type = "category";
    /**
     * Category Description
     *
     * This is the variable that will house the description for the category being created.
     * @var string
     */
    private $desc;
    /**
     * Category Slug
     *
     * The Slug of the Category that you're creating.
     * @var string
     */
    private $slug;
    /**
     *Category Parent
     *
     * If you wish to apply a parent to the categories you are creating then you may do so with this.
     *
     * @var string  the name of the category you wish to have as the parent.
     */
    private $parent = '';

    /**
     * register()
     *
     * This is the factory method that sets up an instance of the class.
     * This need to be called first when attempting to use
     * the class
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
     * setTitle()
     *
     * This is the method that sets the title of the category. If you ultimately do not supply a slug
     * for the category then this method will do so. by replacing spaces with dashes and making all characters lowercase
     *
     * @param title
     *
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->slug = str_replace(" ", "-", strtolower($title));

        return $this;
    }

    /**
     * setDesc()
     *
     * This is the method that allows you to set the description for the category that you're creating.
     *
     * @param desc
     *
     * @return Category
     *
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * setSlug()
     *
     * This is the method that sets the slug for the category.
     *
     * No matter what you provide to this method it will be sanatized by lowercasing characters and replacing spaces
     * with dashes.
     *
     * @param slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = str_replace(" ", "-", strtolower($slug));

        return $this;
    }

    /**
     * setParent()
     *
     * This is the method that allows you to set the parent category for the category being created.
     *
     * @param parent
     *
     * @return Category
     *
     */
    public function setParent($parent)
    {
        $catID = get_cat_ID($parent);
        $this->parent = $catID;

        return $this;

    }

    /**
     * create()
     *
     * This is the method that actually created the category.
     * This must be the last chained method in your implementation
     * and this method must be called in order for categories to be created.
     *
     * @return void
     *
     */
    public function create()
    {
        wp_insert_category(array(
            'cat_name' => $this->title,
            'category_description' => $this->desc,
            'category_nicename' => $this->slug,
            'category_parent' => $this->parent
        ));
    }
}
