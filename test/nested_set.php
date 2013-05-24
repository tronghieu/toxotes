<?php
require_once __DIR__ .'./../bootstrap.php';
\Flywheel\Loader::import('global.model.*');
try {
    //test add Root
//    $term = new Terms();
//    $isRoot = $term->isRoot();
//    $isLeaf = $term->isLeaf();
//
//    $term->setScope('Category');
//    $term->setName('Uncategorized');
//    $term->makeRoot();
//    $term->save();

    $term = new Terms();
    $term = $term->findRoot('Category');
    $descendants = $term->getDescendants();
    $siblings = $term->getSiblings();
    $isRoot = $term->isRoot();
    $isLeaf = $term->isLeaf();
    $isInTree = $term->isInTree();

    $child = new Terms();
    $child->setName("Smart Phone");
    $child->insertAsFirstChildOf($term);

    $child3 = new Terms();
    $child3->setName("Feature Phone");
    $child3->insertAsLastChildOf($term);

    $child2 = new Terms();
    $child2->setName("Dump Phone");
    $child2->insertAsFirstChildOf($term);

    $child = $term->getFirstChild();
    $child = $term->getLastChild();
    $child2 = $child->getPrevSibling();

    $s3 = new Terms();
    $s3->setName('Iphone 3GS');
    $child->addChild($s3);


    echo "end";

} catch (Exception $e) {
    print_r($e);
}