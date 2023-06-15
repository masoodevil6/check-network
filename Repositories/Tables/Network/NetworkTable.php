<?php
namespace app\Repositories\Tables\Network;

use app\Repositories\Tables\BaseTable;


/**
 * @property int $id
 * @property string $name
 * @property string $ip
 * @property string $mac
*/
class NetworkTable extends BaseTable
{

    protected $tableName = "networks";


    protected $fillable = [
        "id" , "name" , "ip" , "mac" , "active"
    ];


    //=====================================
    public $active= false;

}