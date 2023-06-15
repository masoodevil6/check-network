<?php
namespace app\Repositories\Tables;

class BaseTable
{
    protected $tableName = "";
    protected $fillable = [];


    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }


    public function preparationData($data){
        foreach ($data as $key => $value){
            if ($this->existInFillable($key)){
                $this->$key = $value;
            }
        }
    }


    public function existInFillable($key){
        foreach ($this->fillable as $property){
            if ($key == $property){
                return true;
            }
        }
        return false;
    }
}