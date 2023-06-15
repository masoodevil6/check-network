<?php
namespace app\Repositories\ModelRepositories;

use app\Repositories\InterfaceRepositories\IBaseRepository;
use app\Repositories\Tables\BaseTable;
use Exception;
use Yii;
use yii\db\Query;

/**
 * @template TModel
 * @template-implements  IBaseRepository<TModel>
 */
class BaseRepository implements IBaseRepository {

    private string|null $tableName;
    private BaseTable $baseTable;
    private Query $query;
    public function __construct(BaseTable $baseTable)
    {
        $this->baseTable = $baseTable;
        $this->tableName = $baseTable->getTableName();
        $this->query = (new \yii\db\Query())->from($this->tableName);
    }


    /**
     * @return  array<TModel>
     */
    function getAllResult()
    {
        return $this->preparationData($this->query->all() , true);
    }

    /**
     * @return  TModel
     */
    function getResult($resultId)
    {
        return  $this->preparationData($this->query->where(['id' => $resultId])->one());
    }

    /**
     * @return  TModel|null
     */
    function addResult($data)
    {
        $dataActive = $this->getDataActive($data);

        try {
            Yii::$app->db->createCommand()
                ->insert($this->tableName, $dataActive)
                ->execute();
            return true;
        }
        catch (\Exception){
            return  false;
        }
    }

    /**
     * @return  bool
     */
    function updateResult($resultId, $data): bool
    {
        $dataActive = $this->getDataActive($data);

        try {
            Yii::$app->db->createCommand()
                ->update($this->tableName, $dataActive, ["id"=>$resultId])
                ->execute();
            return true;
        }
        catch (\Exception){
            return  false;
        }
    }

    /**
     * @return  bool
     */
    function deleteResultById(int $resultId): bool
    {
        try {
            Yii::$app->db->createCommand()
                ->delete($this->tableName, ["id"=>$resultId])
                ->execute();
            return true;
        }
        catch (\Exception){
            return  false;
        }
    }



    /**
     * @return  array|TModel
     */
    function preparationData($arg , $isCollection=false)
    {
        if ($isCollection){
            $resultExp = [];
            foreach ($arg As $item){
                $itemTable = $this->getInstanceTable();
                $itemTable->preparationData($item);
                array_push($resultExp , $itemTable);
            }
            return $resultExp;
        }
        else{
            $itemTable = $this->baseTable;
            $itemTable->preparationData($arg);
            return $itemTable;
        }
    }

    /**
     * @return array
     */
    function getDataActive($data)
    {
        $dataActive = [];
        foreach ($data as $key => $value){
            if ($this->baseTable->existInFillable($key)){
                $dataActive[$key] = $value;
            }
        }

        return $dataActive;
    }


    /**
     * @return TModel
     */
    public function getInstanceTable()
    {
        $nameSpaceClass = $this->baseTable::class;

        if ($nameSpaceClass != null && !empty($nameSpaceClass)){
            try{
                /**@var TModel $instance*/
                return (new \ReflectionClass($nameSpaceClass))->newInstance();
            }
            catch (Exception $e){
                return null;
            }
        }

        return null;
    }
}