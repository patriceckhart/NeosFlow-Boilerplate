<?php
namespace SteinbauerIT\Flow\Essentials\Service;

/*
 * This file is part of the SteinbauerIT.Flow.Essentials package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\PersistenceManagerInterface;

class MailService extends AbstractService
{

    /**
     * @Flow\InjectConfiguration(package="SteinbauerIT.Flow.Essentials", path="mail")
     * @var array
     */
    protected $mailSettings;


}
