<?php
namespace app\Repositories\ModelRepositories\Network;

use app\PowerShells\ContextPowerShell;
use app\Repositories\ContextRepository;
use app\Repositories\InterfaceRepositories\Network\INetworkRepository;
use app\Repositories\ModelRepositories\BaseRepository;
use app\Repositories\Tables\BaseTable;
use app\Repositories\Tables\Network\NetworkTable;
use SplFileInfo;
use Yii;
use yii\db\Query;

/**
 * @template-extends BaseRepository<NetworkTable>
 * @template-implements  INetworkRepository<NetworkTable>
 */
class NetworkRepository extends BaseRepository implements INetworkRepository {

    public function __construct()
    {
        parent::__construct(new NetworkTable());
    }

    /**
     * @return  array<NetworkTable>|null
     */
    function getListNetworksWithStatus()
    {

        $existNetwork = $this->saveNewListNetworks();
        $records = ContextRepository::NetworkRepository()->getAllResult();

        foreach ($records as $itemRecord){

            foreach ($existNetwork as $itemNetworkExist){
                if ($itemRecord->mac == $itemNetworkExist->mac){
                    $itemRecord->active = true;
                }
            }
        }

        return $records;
    }


    //---------------------------------------------

    /**
     * @param array<NetworkTable> $records
     * @return array<NetworkTable>|null
     */
    private function saveNewListNetworks(){
        $records = ContextRepository::NetworkRepository()->getAllResult();
        $existNetwork = ContextPowerShell::getListActiveNetworks();

        foreach ($existNetwork as $itemNetworkExist){
            $existInTable = false;
            foreach ($records as $itemRecord){
                if ($itemRecord->mac == $itemNetworkExist->mac){
                    $existInTable = true;
                }
            }

            if (!$existInTable){
                $data = [
                    "ip" => $itemNetworkExist->ip,
                    "mac" => $itemNetworkExist->mac,
                    "name" => $itemNetworkExist->name,
                ];
                ContextRepository::NetworkRepository()->addResult($data);
            }
        }

        return $existNetwork;
    }

}