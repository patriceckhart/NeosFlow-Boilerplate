<?php
namespace SteinbauerIT\Flow\Essentials\Service;

/*
 * This file is part of the SteinbauerIT.Flow.Essentials package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\PersistenceManagerInterface;

class LoginOperations extends AbstractService
{

    /**
     * @Flow\InjectConfiguration(package="SteinbauerIT.Flow.Essentials", path="login")
     * @var array
     */
    protected $loginSettings;

    /**
     * @param string $operation
     * @return void
     */
    public function execute(string $operation): void
    {
        if(array_key_exists($operation, $this->loginSettings)) {
            if(array_key_exists('class', $this->loginSettings[$operation])) {
                $class = $this->objectManager->get($this->loginSettings[$operation]['class']);
                $class->execute();
            }
        }
    }

    /**
     * @param string $operation
     * @return bool|string
     */
    public function redirect(string $operation): bool|string
    {
        if(array_key_exists($operation, $this->loginSettings)) {
            if(array_key_exists('redirectToUri', $this->loginSettings[$operation])) {
                return $this->loginSettings[$operation]['redirectToUri'];
            }
        }
        return false;
    }

}
