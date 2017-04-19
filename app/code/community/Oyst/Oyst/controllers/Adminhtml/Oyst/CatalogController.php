<?php
/**
 *
 * File containing class Oyst_Oyst_Adminhtml_Oyst_CatalogController
 *
 * PHP version 5
 *
 * @category Onibi
 * @author   Onibi <dev@onibi.fr>
 * @license  Copyright 2017, Onibi
 * @link     http://www.onibi.fr
 */

/**
 * @category Onibi
 * @class  Oyst_Oyst_Adminhtml_Oyst_CatalogController
 */
class Oyst_Oyst_Adminhtml_Oyst_CatalogController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Test if user can access to this sections
     *
     * @return bool
     * @see Mage_Adminhtml_Controller_Action::_isAllowed()
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('oyst/oyst_oyst/catalog');
    }

    /**
     * Magento method for init layout, menu and breadcrumbs
     *
     * @return Oyst_Oyst_Adminhtml_Oyst_ActionsController
     */
    protected function _initAction()
    {
        $this->_activeMenu();
        return $this;
    }

    /**
     * Active menu
     *
     * @return Oyst_Oyst_Adminhtml_Oyst_ActionsController
     */
    protected function _activeMenu()
    {
        $this->loadLayout()
            ->_setActiveMenu('oyst/oyst_catalog')
            ->_title(Mage::helper('oyst_oyst')->__('Catalog'))
            ->_addBreadcrumb(Mage::helper('oyst_oyst')->__('Catalog'), Mage::helper('oyst_oyst')->__('Catalog'));
        return $this;
    }

    /**
     * Synchronize product from Magento to Oyst
     *
     * @return Oyst_Oyst_Adminhtml_Oyst_CatalogController
     */
    public function syncAction()
    {
        //get list of product
        $product = Mage::app()->getRequest()->getParam('product');
        $params = array('product_id_include_filter' => $product);
        Mage::helper('oyst_oyst')->log('Start of sending product id : ' . var_export($product, true));

        //sync product to Oyst
        $result = Mage::helper('oyst_oyst/catalog_data')->sync($params);
        Mage::helper('oyst_oyst')->log('End of sending product id : ' . var_export($product, true));

        //if api response is success
        if ($result && array_key_exists('success', $result) && $result['success'] == true) {
            $this->_getSession()->addSuccess(Mage::helper('oyst_oyst')->__('The sync was successfully done'));
        } else {
            $this->_getSession()->addError(Mage::helper('oyst_oyst')->__('An error was occured'));
        }

        $this->getResponse()->setRedirect($this->getRequest()->getServer('HTTP_REFERER'));
        return $this;
    }
}
