<?php
namespace SteinbauerIT\Flow\Essentials\Service;

/*
 * This file is part of the SteinbauerIT.Flow.Essentials package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\RequestPatternInterface;
use Neos\Flow\Security\Policy\PolicyService;
use Neos\Flow\Security\Authentication\AuthenticationManagerInterface;
use Neos\Flow\Security\AccountFactory;
use Neos\Flow\Security\Cryptography\HashService;
use Neos\Flow\Security\AccountRepository;
use Neos\Flow\Security\Context;
use Neos\Flow\Security\Account;
use SteinbauerIT\Flow\Essentials\Service\AbstractService;

/**
 * @Flow\Scope("singleton")
 */
class UserService extends AbstractService
{

    /**
     * @var AuthenticationManagerInterface
     * @Flow\Inject
     */
    protected $authenticationManager;

    /**
     * @var AccountFactory
     * @Flow\Inject
     */
    protected $accountFactory;

    /**
     * @var HashService
     * @Flow\Inject
     */
    protected $hashService;

    /**
     * @var AccountRepository
     * @Flow\Inject
     */
    protected $accountRepository;

    /**
     * @var Context
     * @Flow\Inject
     */
    protected $securityContext;

    /**
     * @Flow\InjectConfiguration(package="SteinbauerIT.Flow.Essentials", path="account")
     * @var array
     */
    protected $accountSettings;

    /**
     * @param int $length
     * @return string
     */
    public function generatePassword(int $length = 12): string
    {
        $chars = '23456789bcdfhkmnprstvzBCDFHJKLMNPRSTVZ';
        $shuffled = str_shuffle($chars);
        return mb_substr($shuffled, 0, $length);
    }

    /**
     * @param string $email
     * @param string|null $password
     * @param string|null $role
     * @return string
     */
    public function createUserAndAccount(string $email, string|null $password = null, string|null $role = null): string
    {
        $authenticationProviderName = $this->accountSettings['authenticationProviderName'];

        if($role === null) {
            $role = $this->accountSettings['defaultRole'];
        }

        if($password === null) {
            $password = $this->generatePassword();
        }

        $account = $this->accountFactory->createAccountWithPassword($email, $password, [$role], $authenticationProviderName);
        $account->setCredentialsSource($this->hashService->hashPassword($password));
        $this->accountRepository->add($account);

        if(array_key_exists('afterCreateAccount', $this->accountSettings)) {
            if(array_key_exists('class', $this->accountSettings['afterCreateAccount'])) {
                $class = $this->objectManager->get($this->accountSettings['afterCreateAccount']['class']);
                $class->execute($account);
            }
        }

        return $password;
    }

//    /**
//     * @return User|null
//     */
//    public function getLoggedInUser(): User|null
//    {
//        if($this->securityContext->canBeInitialized()) {
//            if ($this->authenticationManager->isAuthenticated() === true) {
//                return $this->userRepository->findByAccount($this->securityContext->getAccount())->getFirst();
//            }
//        }
//        return null;
//    }

}
