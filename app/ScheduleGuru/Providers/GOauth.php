<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 10/25/2014
 * Time: 9:03 PM
 */

namespace ScheduleGuru\Providers;


class GOauth {
    /**
     * @var ServiceFactory
     */
    private $_google_oauth;

    /**
     * Storege name from config
     * @var string
     */
    private $_storage_name = 'Session';

    /**
     * Client ID from config
     * @var string
     */
    private $_client_id;

    /**
     * Client secret from config
     * @var string
     */
    private $_client_secret;

    /**
     * Scope from config
     * @var array
     */
    private $_scope = array();

    /**
     * Constructor
     *
     * @param ServiceFactory $serviceFactory - (Dependency injection) If not provided, a ServiceFactory instance will be constructed.
     */
    public function __construct(ServiceFactory $serviceFactory = null)
    {
        if (null === $serviceFactory) {
            // Create the service factory
            $serviceFactory = new ServiceFactory();
        }
        $this->_serviceFactory = $serviceFactory;
    }

} 