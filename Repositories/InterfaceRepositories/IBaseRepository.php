<?php
namespace app\Repositories\InterfaceRepositories;

/**
 * @template TModel
 */
interface IBaseRepository
{

    /**
     * @return  array<TModel>
     */
    function getAllResult();

    /**
     * @return  TModel
     */
    function getResult($resultId) ;

    /**
     * @return  TModel|null
     */
    function addResult($data)  ;

    /**
     * @return  bool
     */
    function updateResult($resultId , $data) : bool;

    /**
     * @return  bool
     */
    function deleteResultById(int $resultId) : bool ;


    //----------------------------------------------------------
    /**
     * @return  array|TModel
     */
    function preparationData($arg , $isCollection);

    /**
     * @return array
     */
    function getDataActive($data);

    /**
     * @return TModel
     */
    function getInstanceTable();

}