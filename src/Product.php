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

    private function msisdnLocalize($msisdn) {
        if ($msisdn{0} === '6') {
            return '0' . substr($msisdn, 2);
        } elseif ($msisdn{0} === '+') {
            return '0' . substr($msisdn, 3);
        }
        return $msidn;
    }

    /**
     * @see http://www.kangdede.web.id/nomor-awalan-operator-seluler-indonesia-2017/
     **/
    private function getGsmOperatorByPrefix($prefix) {
        switch($prefix) {
        case '11':
        case '12':
        case '13':
        case '21':
        case '22':
        case '23':
        case '51':
        case '52':
        case '53':
            return 'telkomsel';

        case '14':
        case '15':
        case '16':
        case '55':
        case '56':
        case '57':
        case '58':
            return 'indosat';

        case '17':
        case '18':
        case '19':
        case '59':
        case '77':
        case '78':
            return 'xl';

        case '96':
        case '97':
        case '98':
        case '99':
            return 'three';

        case '81':
        case '82':
        case '83':
        case '84':
        case '85':
        case '86':
        case '87':
            return 'smart';

        case '88':
        case '89':
            return 'fren';

        case '28':
            return 'ceria';

        case '31':
        case '32':
        case '33':
        case '38':
            return 'axis'; // xl?
        }
    }

    private function getCdmaOperatorByPrefix($prefix) {
        switch($prefix) {
        case '30':
        case '60':
        case '62':
            return 'indosat'; // starone

        case '91':
        case '92':
        case '93':
        case '98':
        case '99':
            return 'smart'; // esia

        case '32':
        case '68':
        case '70':
        case '71':
        case '72':
        case '77':
            return 'telkomsel'; // flexi

        case '40':
        case '50':
            return 'hepi';
        }
    }

    private function getOperator($msisdn) {
        $msisdn = $this->msisdnLocalize($msisdn);
        if ('08' === substr($msisdn, 0, 2)) {
            return $this->getGsmOperatorByPrefix( substr($msisdn, 2, 2));
        } elseif (in_array(substr($msisdn, 0, 3), ['021', '022', '024', '031', '061'])) {
            return $this->getCdmaOperatorByPrefix(substr($msisdn, 3, 2));
        } else {
            return $this->getCdmaOperatorByPrefix(substr($msisdn, 4, 2));
        }
    }

    /**
     * @param $products ['I5', 'S5', 'X5']
     * @param $msisdn   0812xxx
     * @return $product S5
     **/
    public static function getByMsisdn($products, $msisdn) {
        $operator = $this->getOperator($msisdn);
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
