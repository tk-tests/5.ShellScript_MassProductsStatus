<?php
require_once 'abstract.php';
 
class Mass_Products_Status extends Mage_Shell_Abstract
{
    protected $_status = false;
 
    public function __construct() {
        parent::__construct();
        // Time limit to infinity
        set_time_limit(0);     
 
        // Get command line argument named "status"
        if($this->getArg('status')) {
            if($this->getArg('status') == 'enable'){
                $this->_status = 1;
            }else if($this->getArg('status') == 'disable'){
                $this->_status = 2; 
            }
            
        }

    }
 
    // Shell script point of entry
    public function run() {
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('id')
            ->addAttributeToFilter('price', array('lt' => 15));
            
        foreach ($collection as $product) {
            $product = Mage::getModel('catalog/product')->load($product->getId());
            $product->setStatus($this->_status); 
            $product->save();
        }
    }
 
    // Usage instructions
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php mass_products_status.php -- [status]
 
  --status <argvalue>       Argument status enable or disable
 
  help                   This help
 
USAGE;
    }
}
// Instantiate
$shell = new Mass_Products_Status();
 
// Initiate script
$shell->run();