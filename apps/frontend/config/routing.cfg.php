<?php
$r = array(
//	'__urlSuffix__' => '.html',

	/* default component
	 *  the Controllers process and response frontpage of project
	 */

	/* remap if optional config, when router can not find Controllers
	 *  '__remap__' => array(
	 *	  'Controllers' => 'path/to/Controllers'
	 *	  'action'	=> action_name
	 *	  'param'	 => [p1, p2, p3],
	 *   ),
	 *  exp: request ming.vn/tronghieu1012, we all know that no Controllers is tronghieu1012
	 *  , this is username and right Controllers is user
	 *  '__remap__' = array(
	 *	  'Controllers' => 'user',
	 *	  'action'	=> 'default'
	 *   ),
	 * 'tronghieu1012' will be set as first param
	 */
	'__remap__' => array('route' => 'home/default'),

	/*
	 * rules description
	 * exp
	 *  'pattern' => array(
	 *	  'route' => 'path/to/Controllers/action', path to controllers and action
	 *	  'params' => [p1, p2, p3], optional parameters
	 *	  'filter' => array(
	 *		  'method' => 'ANY' //filter by request method POST, GET, PUT, DELETE or all
	 *	  ),
	 *	  'options' => array(
	 *		  'suffix' => '' //url suffix
	 *	  ),
	 *  );
	 */
	//default controllers
	'/' => array(
		'route' => 'home/default'
	),
    'login' => array(
        'route' => 'auth/login'
    ),
    'logout' => array(
        'route' => 'auth/logout',
    ),
    '{controller}' => array(
        'route' => '{controller}/default'
    ),
    '{controller}/{action}/{id:\d+}' => array(
        'route' => '{controller}/{action}/'
    ),
    'categories/{slug:[a-zA-Z0-9-]+}.{id:\d+}' => array(
        'route' => 'category/default'
    ),
    'events/{slug:[a-zA-Z0-9-]+}.{id:\d+}' => array(
        'route' => 'events/default'
    ),
    'event/{slug:[a-zA-Z0-9-]+}.{id:\d+}' => array(
        'route' => 'events/detail'
    ),
    'post/{slug:[a-zA-Z0-9-]+}.{id:\d+}' => array(
        'route' => 'post/detail'
    )

	/*'{main_cat:[a-zA-Z0-9-]+}' => array(
		'route' => 'category/default'
	),
	'{main_cat:[a-zA-Z0-9-]+}/{sub_cat:[a-zA-Z0-9-]+}' => array(
		'route' => 'category/default'
	),*/
);

$r = \Toxotes\Cms::route($r);
return $r;