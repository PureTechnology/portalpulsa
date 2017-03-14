<?php

use PureTechnology\portalpulsa\Msisdn;

class MsisdnTest extends PHPUnit_Framework_TestCase {
    public function testInternational()
    {
        $m = new Msisdn('+628121041620');
        $this->assertEquals('08121041620', $m->format());
    }
}
