<?php

// src/Client.php

namespace PureTechnology\portalpulsa;

final class Client
{
    private static $valid_banks = ['bca', 'bni', 'mandiri', 'bri', 'muamalat'];

    private $loginByFacebookUrl = 'http://portalpulsa.com/api/connect/';
    private $uid;
    private $key;
    private $secret;
    private $bag;

    public function __construct($uid, $key, $secret, Transaction $bag) {
        $this->uid = $uid;
        $this->key = $key;
        $this->secret = $secret;
        $this->bag = $bag;
    }

    private function send($data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        loginByFacebookUrl($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'portal-userid: '.$this->uid,
            'portal-key: '.   $this->key,
            'portal-secret: '.$this->secret,
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        return json_decode($result);
    }

    public function getDepositInvoice($bank, $nominal) {
        $bank = strtolower($bank);
        if (!in_array($bank, self::$valid_banks)) {
            return false;
        }

        return $this->send([
            'inquiry' => 'D',      // konstan
            'bank'    => $bank,    // bank tersedia: bca, bni, mandiri, bri, muamalat
            'nominal' => $nominal, // jumlah request
        ]);
    }

    public function getBalance() {
        return $this->send(['inquiry'=>'S']);
    }

    public function getProductPrice($product_group) {
        $product_group = strtoupper($product_group);
        if (!in_array($product_group, Product::$valid_groups)) {
            return false;
        }

        return $this->send([
            'inquiry' => 'C',
            'code'    => $product_group
        ]);
    }

    public function getTransactionStatus($trxid) {
        return $this->send([
            'inquiry'   => 'STATUS',
            'trxid_api' => $trxid
        ]);
    }

    public function buyTopup($product, $phone, $trxid, $daynum) {
        if (is_string($product)) {
            $product = strtoupper($product);
        } elseif (is_array($product)) {
            $product = Product::match($product, new Msisdn($phone));
            if ($product === false) return;
        }

        return $this->send($this->bag->push([
            'inquiry' => 'I',
            'code'    => $product,
            'phone'   => $phone,
        ]));
    }

    public function buyToken($product, $phone, $idcust, $trxid, $daynum) {
        return $this->send($this->bag->push([
            'inquiry' => 'PLN',
            'code'    => strtoupper($product),
            'phone'   => $phone,
            'idcust'  => $idcust,
        ]));
    }
}

// vim: ts=4 et
