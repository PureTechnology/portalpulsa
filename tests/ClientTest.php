<?php

// tests/ClientTest.php

namespace PureTechnology\portalpulsa\Test;

use PureTechnology\portalpulsa\Client;

class ClientTest extends \PHPUnit_Framework_TestCase {
    public function testGetBalance()
    {
        $queue = $this->getMockBuilder('\PureTechnology\portalpulsa\AbstractQueue')
            ->getMock();

        $c = new Client(
            getenv('T_UID'),
            getenv('T_KEY'),
            getenv('T_SECRET'),
            $queue
        );

        $this->assertEquals(array(), $c->getBalance());
    }
}
