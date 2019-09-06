<?php

return [
	/*
	 *  The default route call
	 *  eg. /larapress/123
	 */
	'route' => 'larapress',

	/*
	 * The default title of the Page
	 * This can be modified in the larapress view
	 */
	'page_title' => 'Larapress',

	/*
	 * The post uri where we get the article post
	 * eg. http://website.com/json/file/
	 */
	'get_post_uri' => null,

	/*
	 * The identifier of the response we get from the post uri
	 * eg. {
	 *       "response": {
	 *          "content": "<article>This is the content</article>"
	 *       }
	 *    }
	 *  The identifier should be 'response.content'
	 */
	'response_identifier' => null,

	/*
	 * Flag if the cache should be enabled.
	 */
	'cache' => false,

	/*
	 * Enables dynamic get post routing
	 */
	'enable_routing' => false,
];