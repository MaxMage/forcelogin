<?php

namespace MaxMage\ForceLogin\Observer;

use \Magento\Framework\Event\ObserverInterface;
use \Magento\Customer\Model\Session;
use \Magento\Framework\App\Response\RedirectInterface;
use \Magento\Framework\Event\Observer;
use \MaxMage\ForceLogin\Helper\Data;
use \Magento\Framework\UrlInterface;

class CheckLoginObserver implements ObserverInterface
{

    /**
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
    protected $redirect;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \MaxMage\ForceLogin\Helper\Data
     */
    protected $helper;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlInterface;

    public function __construct(
        Session $customerSession,
        RedirectInterface $redirect,
        Data $helper,
        UrlInterface $urlInterface
    ) {
        $this->customerSession = $customerSession;
        $this->redirect = $redirect;
        $this->helper = $helper;
        $this->urlInterface = $urlInterface;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(Observer $observer)
    {
        if (!$this->helper->enabled()) {
            return $this;
        }

        $actionName = $observer->getEvent()->getRequest()->getFullActionName();
        /**
         * @var \Magento\Framework\App\Action\Action $controller
         */
        $controller = $observer->getControllerAction();

        $allowedActions = array(
            'customer_account_confirmation',
            'customer_account_create',
            'customer_account_createpassword',
            'customer_account_forgotpassword',
            'customer_account_login',
            'customer_account_logoutsuccess'
        );

        if (in_array($actionName, $allowedActions)) {
            return $this;
        }

        if (!$this->customerSession->isLoggedIn()) {
            $url = $this->urlInterface->getUrl('customer/account/login');
            $controller->getResponse()->setRedirect($url);
        }
    }
}