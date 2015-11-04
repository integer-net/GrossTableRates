<?php
/**
 * integer_net Magento Module
 *
 * @category   IntegerNet
 * @package    IntegerNet_GrossTableRates
 * @copyright  Copyright (c) 2015 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */ 
class IntegerNet_GrossTableRates_Model_Shipping_Carrier_Tablerate extends Mage_Shipping_Model_Carrier_Tablerate
{
    /**
     * Collect and get rates
     * Use gross prices of calculation if configured
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        // Added to use gross prices if configured
        if (Mage::helper('tax')->priceIncludesTax()) {
            foreach ($request->getAllItems() as $item) {
                $request->setPackageValue($request->getPackageValue() + $item->getTaxAmount());
            }
        }

        return parent::collectRates($request);
    }
}