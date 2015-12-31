<?php
use Toxotes\Cms;

$r = array(
  '__urlSuffix__'=>'.html',
  '__remap__'=> array(
     'route'=>'dashboard/default'
  ),
  '/'=>array(
     'route'=>'dashboard/default'
  ),
  '{controller}'=>array( 
    'route'=>'{controller}/default' 
  ),
  '{controller}/{action}'=>array( 
    'route'=>'{controller}/{action}' 
  ),
  '{controller}/{action}/{id:\d+}'=>array( 
    'route'=>'{controller}/{action}'
  ),
    /*'category/default/{taxonomy:[a-z]+}'=>array(
        'route'=>'category/default'
    ),*/
);
return Cms::route($r);