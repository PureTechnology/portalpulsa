<?php

// src/Msisdn.php

namespace PureTechnology\portalpulsa;

final class Msisdn
{
    var $my;

    public function __construct($msisdn){
        $this->my = $msisdn;
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

    public function localize() {
        if ($this->my{0} === '6') {
            return '0' . substr($this->my, 2);
        } elseif ($this->my{0} === '+') {
            return '0' . substr($this->my, 3);
        }
        return $this->my;
    }

    public function getOperator() {
        $msisdn = $this->localize();
        if ('08' === substr($msisdn, 0, 2)) {
            return $this->getGsmOperatorByPrefix( substr($msisdn, 2, 2));
        } elseif (in_array(substr($msisdn, 0, 3), ['021', '022', '024', '031', '061'])) {
            return $this->getCdmaOperatorByPrefix(substr($msisdn, 3, 2));
        } else {
            return $this->getCdmaOperatorByPrefix(substr($msisdn, 4, 2));
        }
    }
}
