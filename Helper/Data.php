<?php

namespace MaxMage\ForceLogin\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    const XML_PATH_ENABLE = 'forcelogin/general/enable';

    /**
     * @param null $storeId
     * @return mixed
     */
    public function enabled($storeId = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ENABLE, ScopeInterface::SCOPE_STORE, $storeId);
    }
}