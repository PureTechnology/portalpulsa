<?php

// src/Product.php

namespace PureTechnology\portalpulsa;

final class Product
{
    public static $valid_groups = [
        'AX', 'AXD',
        'BO',
        'C',
        'N',
        'P',
        'I',  'IDN', 'IDX', 'IFC', 'IS', 'ITR',
        'SM',
        'SPIN',
        'S',   'STG', 'TS', 'STR', 
        'T', 'TD',
        'X',  'BBX', 'XCX', 'XH',   'XHE',

        'PLN'
    ];

    private static $telco_mapping = [
        'AX'   => 'axis',      'AXD' => 'axis',
        //'BO'   => 'bolt',
        'C'    => 'ceria',
        'N'    => 'fren',
        'P'    => 'hepi',
        'I'    => 'indosat',   'IDN' => 'indosat',   'IDX' => 'indosat',   'IFC' => 'indosat',  'IS'  => 'indosat', 'ITR' => 'indosat',
        'SM'   => 'smart',
        //'SPIN' => 'speedy',
        'S'    => 'telkomsel', 'STG' => 'telkomsel', 'TS'  => 'telkomsel', 'STR' => 'telkomsel',
        'T'    => 'three',     'TD'  => 'three',
        'X'    => 'xl',        'BBX' => 'xl',        'XCX' => 'xl',        'XH'  => 'xl',       'XHE' => 'xl',
    ];

    /**
     * @param $products ['I5', 'S5', 'X5']
     * @param $msisdn   Msisdn object
     * @return $product S5
     **/
    public static function match($products, Msisdn $msisdn) {
        $operator = $msisdn->getOperator();
        foreach ($products as $p) {
            $p = strtoupper($p);
            $group = preg_replace('/(\d+)/', '', $p);
            if (!isset(self::$telco_mapping[ $group ])) {
                continue;
            }
            elseif ($operator === self::$telco_mapping[ $group ]) {
                return $p;
            }
        }
        return false;
    }
}
