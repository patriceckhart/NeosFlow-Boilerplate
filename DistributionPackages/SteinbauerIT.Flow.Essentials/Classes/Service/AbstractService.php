<?php
namespace SteinbauerIT\Flow\Essentials\Service;

/*
 * This file is part of the SteinbauerIT.Flow.Essentials package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Flow\ObjectManagement\ObjectManagerInterface;


abstract class AbstractService
{

    protected array $settings;

    public function injectSettings(array $settings): void
    {
        $this->settings = $settings;
    }

    protected ObjectManagerInterface $objectManager;

//    #[Flow\Inject]
//    protected PersistenceManagerInterface $persistenceManager;
//
//    #[Flow\Inject]
//    protected InputRepository $inputRepository;
//
//    #[Flow\Inject]
//    protected TemplateRepository $templateRepository;
//
//    #[Flow\Inject]
//    protected SectionRepository $sectionRepository;
//
//    #[Flow\Inject]
//    protected TaskRepository $taskRepository;
//
//    #[Flow\Inject]
//    protected CustomerService $customerService;
//
//    #[Flow\Inject]
//    protected OpenSSLService $openSSLService;
//
//    #[Flow\Inject]
//    protected UserService $userService;

}
