<?php
namespace CurrencySet\Subscriber;

use Enlight\Event\SubscriberInterface;
use Doctrine\DBAL\Connection;
use Enlight_Template_Manager;

class CurrencyTemplate implements subscriberInterface{
    /**
     * @var Enlight_Template_Manager
     */
    private $templateManager;
    /**
     * @var string
     */
    private $pluginDir;

    /**
     * @var connection
     */
    private $connection;

    /**
     * @param Enlight_Template_Manager $templateManager
     * @param string $pluginBaseDirectory
     */
    public function __construct(Enlight_Template_Manager $templateManager, connection $connection, $pluginDir)
    {
        $this->connection = $connection;
        $this->templateManager = $templateManager;
        $this->pluginDir = $pluginDir;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PreDispatch' => 'onActionPreDispatch',
        ];
    }

    public function onActionPreDispatch(\Enlight_Controller_ActionEventArgs $args)
    {
        $this->templateManager->addTemplateDir($this->pluginDir . '/Resources/views');
        $todayCurrency = $this->gettodayCurrency($args);
	$startDate = $this->makeTimeStamp('','','');

        $args->getSubject()->View()->assign('todayCurrency', $todayCurrency);
	$args->getSubject()->View()->assign('startDate', $startDate);
    }

    public function getTodayCurrency(\Enlight_Controller_ActionEventArgs $args){
        $query = $this->connection->createQueryBuilder();
        $query->select(['factor', 'templatechar'])
            ->from('s_core_currencies')
            ->Where('id=6');

        return $query->execute()->fetch();
    }

    public function makeTimeStamp($year='', $month='', $day='')
    {
        if(empty($year)) {
            $year = strftime('%Y');
        }
        if(empty($month)) {
            $month = strftime('%m');
        }
        if(empty($day)) {
            $day = strftime('%d');
        }

        return mktime(0, 0, 0, $month, $day, $year);
    }

}

