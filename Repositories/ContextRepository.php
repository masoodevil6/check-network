<?php
namespace app\Repositories;

use app\Repositories\InterfaceRepositories\Network\INetworkRepository;
use app\Repositories\ModelRepositories\Network\NetworkRepository;
use app\Repositories\Tables\Network\NetworkTable;

class ContextRepository{


    //// =============================================
    //// admin
    //// =============================================

    /**@var INetworkRepository<NetworkTable> $networkRepository*/
    private static $networkRepository;

    /**@return INetworkRepository<NetworkTable> */
    public static function NetworkRepository() : INetworkRepository
    {
        if (self::$networkRepository == null){
            self::$networkRepository = new NetworkRepository();
        }
        return self::$networkRepository;
    }
}