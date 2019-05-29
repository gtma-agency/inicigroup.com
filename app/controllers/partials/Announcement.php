<?php

namespace App;

use WP_Query;

trait Announcement
{

	/**
	 * Return a list of posts via category, post selection or tag queries
	 *
	 * @param $type
	 * @param int $limit limit the number of posts to display
	 * @param array $category
	 * @param array $posts
	 * @param array $tags
	 *
	 * @return WP_Query
	 */
	private function get_announcements()
    {
        return new WP_Query([
		        'post_type' => ['post'],
		        'posts_per_page' => 4,
		        'ignore_sticky_posts' => true,
	        ]
        );
    }

    private function announcement_output()
    {
    	return [
            'type' => 'announcement',
            'heading' => '',
            'title' => '',
            'query' => $this->get_announcements(),
        ];
    }
}
