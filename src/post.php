<?php
namespace Skava;

class Post {

	public $type;


	public static function register()
	{
		return new Post;
	}


	public static function getPosts($type, $num = null)
	{
		wp_reset_query();
		$args  = [ 'post_type' => $type, 'posts_per_page' => ( $num ? $num : -1 ) ];
		$loop  = new \WP_Query($args);
		$posts = [ ];
		foreach ($loop->posts as $post)
		{
			$posts[] = $post;
		}

		return $posts;
	}


	public static function simpleLoop()
	{
	}
}
