<?php

namespace Enes5519\TurkAuth;

use Enes5519\TurkAuth\Dil\DilYoneticisi;
use pocketmine\plugin\PluginBase;

class TurkAuth extends PluginBase {

    /** @var TurkAuth $api */
    private static $api;

    /** @var  DilYoneticisi */
    private $dilyonet;

    /** @var \mysqli|null */
    private $vt = null;

    /**
     * @return TurkAuth
     */
    public static function getAPI(): TurkAuth{
        return self::$api;
    }

    public function onLoad(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $dil = $this->getConfig()->get("dil");
        if(!file_exists($this->getFile().'diller\dil_'.$dil.'.yml')){
            $this->getConfig()->set("dil", "tr");
        }
        $verikaydetme = ["MYSQL", "YAML"];
        if(!in_array($this->getConfig()->get("veri-kaydetme"), $verikaydetme)){
            $this->getConfig()->set("veri-kaydetme", "YAML");
        }
        $this->getConfig()->save();
    }

    public function onEnable(){
        self::$api = $this;
        $this->dilyonet = new DilYoneticisi($this->getConfig()->get("dil"));
        $this->konsol("§aTurkAuth Açılıyor...§c\n".base64_decode("DQogIF9fX19fX18gICAgICAgICBfICAgICAgICAgICAgICAgICAgIF8gICBfICAgICANCiB8X18gICBfX3wgICAgICAgfCB8ICAgICAgIC9cICAgICAgICB8IHwgfCB8ICAgIA0KICAgIHwgfF8gICBfIF8gX198IHwgX18gICAvICBcICBfICAgX3wgfF98IHxfXyAgDQogICAgfCB8IHwgfCB8ICdfX3wgfC8gLyAgLyAvXCBcfCB8IHwgfCBfX3wgJ18gXCANCiAgICB8IHwgfF98IHwgfCAgfCAgIDwgIC8gX19fXyBcIHxffCB8IHxffCB8IHwgfA0KICAgIHxffFxfXyxffF98ICB8X3xcX1wvXy8gICAgXF9cX18sX3xcX198X3wgfF98DQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIA0K")."\n§8» §c".$this->dilyonet->cevir("veri-kaydetme").": §f".$this->getVeriTipi());
        switch($this->getVeriTipi()){
            case "MYSQL":
                $this->veritabaniHazirla();
                break;
            case "YAML":
                // TODO
                break;
        }
    }

    public function konsol($mesaj){
        $this->getServer()->getLogger()->info("§cTurk§fAuth §8» §7".$mesaj);
    }

    public function dilKlasor(){
        return $this->getFile()."/resources/diller";
    }

    public function getVeriTipi(){
        return $this->getConfig()->get("veri-kaydetme");
    }

    public function veritabaniHazirla(){
        // TODO
    }

    /**
     * @return DilYoneticisi
     */
    public function getDilYonet(): DilYoneticisi{
        return $this->dilyonet;
    }
}