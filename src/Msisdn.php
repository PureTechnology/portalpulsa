<?php

// src/Msisdn.php

namespace PureTechnology\portalpulsa;

final class Msisdn
{
    var $my;
    var $country;

    // This has been cribbed from the Wikipedia page
    // http://en.wikipedia.org/wiki/List_of_country_calling_codes
    private $country_codes = array(
        'AC' => '247',
        'AD' => '376',
        'AE' => '971',
        'AF' => '93',
        'AG' => '1268',
        'AI' => '1264',
        'AL' => '355',
        'AM' => '374',
        'AO' => '244',
        'AQ' => '672',
        'AR' => '54',
        'AS' => '1684',
        'AT' => '43',
        'AU' => '61',
        'AW' => '297',
        'AX' => '358',
        'AZ' => '994',
        'BA' => '387',
        'BB' => '1246',
        'BD' => '880',
        'BE' => '32',
        'BF' => '226',
        'BG' => '359',
        'BH' => '973',
        'BI' => '257',
        'BJ' => '229',
        'BL' => '590',
        'BM' => '1441',
        'BN' => '673',
        'BO' => '591',
        'BQ' => '599',
        'BR' => '55',
        'BS' => '1242',
        'BT' => '975',
        'BW' => '267',
        'BY' => '375',
        'BZ' => '501',
        'CA' => '1',
        'CC' => '61',
        'CD' => '243',
        'CF' => '236',
        'CG' => '242',
        'CH' => '41',
        'CI' => '225',
        'CK' => '682',
        'CL' => '56',
        'CM' => '237',
        'CN' => '86',
        'CO' => '57',
        'CR' => '506',
        'CU' => '53',
        'CV' => '238',
        'CW' => '599',
        'CX' => '61',
        'CY' => '357',
        'CZ' => '420',
        'DE' => '49',
        'DJ' => '253',
        'DK' => '45',
        'DM' => '1767',
        'DO' => '1809',
        'DO' => '1829',
        'DO' => '1849',
        'DZ' => '213',
        'EC' => '593',
        'EE' => '372',
        'EG' => '20',
        'EH' => '212',
        'ER' => '291',
        'ES' => '34',
        'ET' => '251',
        'EU' => '388',
        'FI' => '358',
        'FJ' => '679',
        'FK' => '500',
        'FM' => '691',
        'FO' => '298',
        'FR' => '33',
        'GA' => '241',
        'GB' => '44',
        'GD' => '1473',
        'GE' => '995',
        'GF' => '594',
        'GG' => '44',
        'GH' => '233',
        'GI' => '350',
        'GL' => '299',
        'GM' => '220',
        'GN' => '224',
        'GP' => '590',
        'GQ' => '240',
        'GR' => '30',
        'GT' => '502',
        'GU' => '1671',
        'GW' => '245',
        'GY' => '592',
        'HK' => '852',
        'HN' => '504',
        'HR' => '385',
        'HT' => '509',
        'HU' => '36',
        'ID' => '62',
        'IE' => '353',
        'IL' => '972',
        'IM' => '44',
        'IN' => '91',
        'IO' => '246',
        'IQ' => '964',
        'IR' => '98',
        'IS' => '354',
        'IT' => '39',
        'JE' => '44',
        'JM' => '1876',
        'JO' => '962',
        'JP' => '81',
        'KE' => '254',
        'KG' => '996',
        'KH' => '855',
        'KI' => '686',
        'KM' => '269',
        'KN' => '1869',
        'KP' => '850',
        'KR' => '82',
        'KW' => '965',
        'KY' => '1345',
        'KZ' => '7',
        'LA' => '856',
        'LB' => '961',
        'LC' => '1758',
        'LI' => '423',
        'LK' => '94',
        'LR' => '231',
        'LS' => '266',
        'LT' => '370',
        'LU' => '352',
        'LV' => '371',
        'LY' => '218',
        'MA' => '212',
        'MC' => '377',
        'MD' => '373',
        'ME' => '382',
        'MF' => '590',
        'MG' => '261',
        'MH' => '692',
        'MK' => '389',
        'ML' => '223',
        'MM' => '95',
        'MN' => '976',
        'MO' => '853',
        'MP' => '1670',
        'MQ' => '596',
        'MR' => '222',
        'MS' => '1664',
        'MT' => '356',
        'MU' => '230',
        'MV' => '960',
        'MW' => '265',
        'MX' => '52',
        'MY' => '60',
        'MZ' => '258',
        'NA' => '264',
        'NC' => '687',
        'NE' => '227',
        'NF' => '672',
        'NG' => '234',
        'NI' => '505',
        'NL' => '31',
        'NO' => '47',
        'NP' => '977',
        'NR' => '674',
        'NU' => '683',
        'NZ' => '64',
        'OM' => '968',
        'PA' => '507',
        'PE' => '51',
        'PF' => '689',
        'PG' => '675',
        'PH' => '63',
        'PK' => '92',
        'PL' => '48',
        'PM' => '508',
        'PR' => '1787',
        'PR' => '1939',
        'PS' => '970',
        'PT' => '351',
        'PW' => '680',
        'PY' => '595',
        'QA' => '974',
        'QN' => '374',
        'QS' => '252',
        'QY' => '90',
        'RE' => '262',
        'RO' => '40',
        'RS' => '381',
        'RU' => '7',
        'RW' => '250',
        'SA' => '966',
        'SB' => '677',
        'SC' => '248',
        'SD' => '249',
        'SE' => '46',
        'SG' => '65',
        'SH' => '290',
        'SI' => '386',
        'SJ' => '47',
        'SK' => '421',
        'SL' => '232',
        'SM' => '378',
        'SN' => '221',
        'SO' => '252',
        'SR' => '597',
        'SS' => '211',
        'ST' => '239',
        'SV' => '503',
        'SX' => '1721',
        'SY' => '963',
        'SZ' => '268',
        'TA' => '290',
        'TC' => '1649',
        'TD' => '235',
        'TG' => '228',
        'TH' => '66',
        'TJ' => '992',
        'TK' => '690',
        'TL' => '670',
        'TM' => '993',
        'TN' => '216',
        'TO' => '676',
        'TR' => '90',
        'TT' => '1868',
        'TV' => '688',
        'TW' => '886',
        'TZ' => '255',
        'UA' => '380',
        'UG' => '256',
        'UK' => '44',
        'US' => '1',
        'UY' => '598',
        'UZ' => '998',
        'VA' => '379',
        'VA' => '39',
        'VC' => '1784',
        'VE' => '58',
        'VG' => '1284',
        'VI' => '1340',
        'VN' => '84',
        'VU' => '678',
        'WF' => '681',
        'WS' => '685',
        'XC' => '991',
        'XD' => '888',
        'XG' => '881',
        'XL' => '883',
        'XN' => '857',
        'XN' => '858',
        'XN' => '870',
        'XP' => '878',
        'XR' => '979',
        'XS' => '808',
        'XT' => '800',
        'XV' => '882',
        'YE' => '967',
        'YT' => '262',
        'ZA' => '27',
        'ZM' => '260',
        'ZW' => '263',
    );

    public function __construct($msisdn){
        $this->localize($msisdn);
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

    private function localize($msisdn) {
        $msisdn = preg_replace('/[^0-9]*/', '', $msisdn);

        $this->country = '62';
        $this->my = $msisdn;

        if ($msisdn{0} === '+') {
            // +62812xxx
            $country_start_pos = 1;
        } elseif (substr($msisdn, 0, 2) === '00') {
            // 0062812xxx
            $country_start_pos = 2;
        } else if (intval($msisdn{0}) > 0) {
            // 62812xxx
            $country_start_pos = 0;
        } elseif ($msisdn{0} === '0') {
            // 0812xxx
            return;
        } else {
            throw new \Exception('Invalid format');
        }

        if       ($k=array_search(substr($msisdn, $country_start_pos, 4), $this->country_codes)) {
            $country_length = 4;
        } elseif ($k=array_search(substr($msisdn, $country_start_pos, 3), $this->country_codes)) {
            $country_length = 3;
        } elseif ($k=array_search(substr($msisdn, $country_start_pos, 2), $this->country_codes)) {
            $country_length = 2;
        } else {
            throw new \Exception('Invalid country code');
        }

        if ($k !== 'ID') {
            throw new \Exception('Country '.$k.' is not supported');
        }

        $this->country =  substr($msisdn, $country_start_pos,  $country_length);
        $this->my = '0' . substr($msisdn, $country_start_pos + $country_length);
    }

    public function getOperator() {
        $msisdn = $this->my;
        if ('08' === substr($msisdn, 0, 2)) {
            return $this->getGsmOperatorByPrefix( substr($msisdn, 2, 2));
        } elseif (in_array(substr($msisdn, 0, 3), ['021', '022', '024', '031', '061'])) {
            return $this->getCdmaOperatorByPrefix(substr($msisdn, 3, 2));
        } else {
            return $this->getCdmaOperatorByPrefix(substr($msisdn, 4, 2));
        }
    }

    public function format($fmt='national') {
        switch($fmt) {
        case 'international':
            return $this->country . substr($this->my, 1);

        case 'national':
            return $this->my;
        }
    }
}
