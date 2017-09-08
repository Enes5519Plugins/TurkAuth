<?php

namespace Enes5519\TurkAuth\Dil;

use Enes5519\TurkAuth\TurkAuth;
use pocketmine\utils\Config;

class DilYoneticisi {

    private $cfg;

    public function __construct($dil){
        $api = TurkAuth::getAPI();
        $this->cfg = new Config($api->dilKlasor().'/dil_'.$dil.'.yml', Config::YAML);
    }

    public function renkCevir($yazi){
        return str_ireplace("&", "§", $yazi);
    }

    public function cevir($metin, ...$args){
        $yazi = $this->renkCevir($this->cfg->get($metin));
        foreach ($args as $key => $deger) {
            $yazi = str_ireplace("{%$key}", $deger, $yazi);
        }
        return $yazi;
    }
}