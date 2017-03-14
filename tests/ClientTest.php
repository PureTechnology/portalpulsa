<?php

// tests/ClientTest.php

namespace PureTechnology\portalpulsa\Test;

use PureTechnology\portalpulsa\Client;

class ClientTest extends \PHPUnit_Framework_TestCase {

    protected $queue;
    protected function setUp()
    {
        $this->queue = $this->getMockBuilder('\PureTechnology\portalpulsa\AbstractQueue')
            ->getMock();
    }

    public function testGetBalance()
    {
        $client = new Client(
            getenv('T_UID'),
            getenv('T_KEY'),
            getenv('T_SECRET'),
            $this->queue
        );

        $result = $client->getBalance();
        $this->assertEquals('success', $result['result']);
        $this->assertContains('Sisa saldo Anda saat ini', $result['message']);
        $this->assertArrayHasKey('balance', $result);
    }

    public function testBuyTopupSingleProductMatching()
    {
        $this->queue->expects($this->once())
            ->method('push')
            ->will($this->returnValue(array(
                'inquiry'   => 'I',
                'code'      => 'S5',
                'phone'     => '081234567',
                'trxid_api' => 'xxx',
                'no'        => '1',
            )));

        $client = new Client(
            getenv('T_UID'),
            getenv('T_KEY'),
            getenv('T_SECRET'),
            $this->queue
        );

        $result = $client->buyTopup('S5', '081234567');
        $this->assertEquals('success', $result['result']);
        $this->assertEquals('S5 081234567 Akan diproses', $result['message']);
    }
}
