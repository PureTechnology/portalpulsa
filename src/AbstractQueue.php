<?php

// src/AbstractQueue.php

namespace PureTechnology\portalpulsa;

/**
 * Implement this class based on each framework. For database layer, the
 * easiest that support daily numbering is to create myisam table such as:
 *
 * CREATE TABLE `odr_orders` (
     `dte` DATE NOT NULL DEFAULT '2013-01-01',
     `no` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
     'trxid_api' VARCHAR(255),
     'code' VARCHAR(255),
     'phone' VARCHAR(255),
     'idcust' VARCHAR(255)
     PRIMARY KEY (`dte`, `no`)
 )
 ENGINE = MyISAM
 AUTO_INCREMENT = 1;
 */
abstract class AbstractQueue
{
    public function push($params) {
        return array_merge($params, [ 'trxid_api' => uniqid(), 'no' => 'yyy' ]);
    }

    public function pop($trxid_api) {

    }
}
