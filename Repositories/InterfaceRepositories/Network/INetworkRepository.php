<?php
namespace app\Repositories\InterfaceRepositories\Network;

use app\Repositories\InterfaceRepositories\IBaseRepository;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface INetworkRepository extends IBaseRepository
{
    /**
     * @return  array<T>
     */
    function getListNetworksWithStatus();
}