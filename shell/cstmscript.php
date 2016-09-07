<?php
require_once 'abstract.php';

/**
 * test script shell magento
 *
 * @category    Mage
 * @package     Mage_Shell
 * @author      Latifa BOUBEKRI
 */
class Mage_Shell_Cstmscript extends Mage_Shell_Abstract
{
	public function run() {
    //     echo 'run!';
    // }
		
    if ($this->getArg('enable')) {
            echo'enable';
        
           $product = Mage::getModel('catalog/product')
            			->getCollection()
            			//->addAttributeToSelect('name');
            			->addAttributeToSelect(array('name', 'product_url', 'price'))
            			->addAttributeToFilter('price', array('lt' => '15'))
            			->addAttributeToFilter('status', array('eq' => '1'))
            			->addAttributeToFilter('type_id', array('eq' => 'configurable'))
            			->load()
            			;
            
            print_r($product);
                
            
        
    }
        if($this->getArg('disable')){
        	echo'disable';
        	$product = Mage::getModel('catalog/product')
            			->getCollection()
            			->addAttributeToSelect(array('name', 'product_url', 'price'))
            			->addAttributeToFilter('price', array('lt' => '15'))
            			->addAttributeToFilter('status', array('eq' => '2'))
            			->addAttributeToFilter('type_id', array('eq' => 'configurable'))
            			;
            
            print_r($product);
        }

        else {
            echo $this->usageHelp();
        }
        
        
 }
    
        /**
     * Retrieve Usage Help Message
     *
     */
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php dataflow_export.php -- [profile_id]

  profile_id                    Specified dataflow profile to run

USAGE;
    }
    
}
	$shell=new Mage_Shell_Cstmscript();
    $shell->run();