<?php
namespace app\PowerShells;

use app\Repositories\InterfaceRepositories\Network\INetworkRepository;
use app\Repositories\ModelRepositories\Network\NetworkRepository;
use app\Repositories\Tables\Network\NetworkTable;
use SplFileInfo;
use Yii;

class ContextPowerShell{


    //// =============================================
    //// admin
    //// =============================================

    private static $listActiveNetworks;

    public static function getListActiveNetworks() : array|null
    {
        if (self::$listActiveNetworks == null){

            $path = new SplFileInfo(__DIR__."/Networks.ps1");
            $cmd = "powershell.exe -File $path";
            $res = shell_exec($cmd);
            self::$listActiveNetworks =  json_decode($res , false);
        }
        return self::$listActiveNetworks;
    }
}