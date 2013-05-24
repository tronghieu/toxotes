<?php
require_once __DIR__ .'./../bootstrap.php';
\Flywheel\Loader::import('global.model.*');
try {
    $smartPhone = Terms::findOneByName("Smart Phone");
    print_r($smartPhone->getName() ."\n");
    foreach($smartPhone->getDescendants() as $sb) {
        print_r($sb->getName() ."\n");
    }

    exit;
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
    $term->deleteDescendants();

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

    $Iphone = Terms::findOneByName("Iphone 3GS");
    $Iphone->setName('Iphone');
    $Iphone->save();

    $iphone3GS = new Terms();
    $iphone3GS->setName('Iphone 3GS');
    $Iphone->addChild($iphone3GS);

    $Iphone->moveToFirstChildOf($child2);

    $Iphone4 = new Terms();
    $Iphone4->setName('Iphone 4');
    $Iphone4->insertAsLastChildOf($Iphone);

    $smartPhone = $Iphone->getParent();

    $android = new Terms();
    $android->setName('Android');

    $featurePhone = $smartPhone->getNextSibling();
    $featurePhone->addChild($android);

    $winPhone = new Terms();
    $winPhone->setName('Windown Phone');
    $winPhone->insertAsFirstChildOf($featurePhone);

    $winPhone->moveToNextSiblingOf($Iphone);

    $iphones = $Iphone->getDescendants();
    $smartphones = $smartPhone->getBranch();
    $smartphoneds = $smartPhone->getDescendants();
    $root = $smartPhone->getAncestors();
    $featurePhones = $featurePhone->getDescendants();

    print_r("Ancestors of Smart Phone\n");
    foreach($root as $r) {
        print_r($r->getName() ."\n");
    }


    print_r("Branching of Smart Phone\n");
    foreach($smartphones as $s) {
        print_r($s->getName() ."\n");
    }

    print_r("Descendants of Smart Phone\n");
    foreach($smartphoneds as $s) {
        print_r($s->getName() ."\n");
    }

    print_r("Descendants of Iphone\n");
    foreach($iphones as $i) {
        print_r($i->getName() ."\n");
    }

    print_r("Descendants of Feature Phone\n");
    foreach($featurePhones as $f) {
        print_r($f->getName() ."\n");
    }

    echo "end";

} catch (Exception $e) {
    print_r($e);
}