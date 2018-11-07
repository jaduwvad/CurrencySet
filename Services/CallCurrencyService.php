<?php

namespace CurrencySet\Services;

use Doctrine\DBAL\Connection;

class CallCurrencyService{
    /**
     * @var connection
     */
    private $connection;

    /**
     * Shopware_Controllers_Frontend_CalcCurrency constructor.
     * @param connection $connection
     */
    public function __construct(connection $connection)
    {
        $this->connection = $connection;
    }

    public function getCurrency(){
        $query = $this->connection->createQueryBuilder();

        $query->select('factor', 'templatechar')
            ->from('s_core_currencies')
            ->where('id=6');

        return $query->execute()->fetch();
    }
}
