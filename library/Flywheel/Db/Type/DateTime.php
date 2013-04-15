<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 4/15/13
 * Time: 6:07 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Flywheel\Db\Type;


class DateTime extends \DateTime {
    /**
     * @return string
     */
    public function toString() {
        return $this->format('Y-m-d H:i:s');
    }

    public function __toString() {
        return $this->toString();
    }
}