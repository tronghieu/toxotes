<?php
require_once('./../../bootstrap.php');
$finder = new Flywheel\Finder\Finder();
$finder->in(EXTENSION_DIR);
$list = $finder->directories();
foreach ($list as $l) {
    /** @var \Flywheel\Finder\Finder $l */
    print $l->getRelativePathname() ."\n";
}