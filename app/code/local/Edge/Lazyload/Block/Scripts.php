<?php

class Edge_Lazyload_Block_Scripts extends Edge_Base_Block_Scripts
{
    protected $_element         = '.products-grid';
    protected $_toolbar         = '.toolbar';
    protected $_triggerHeight   = 300;

    protected function _beforeToHtml()
    {
        $this->addScript('https://code.jquery.com/jquery-2.1.4.min.js');
        $this->addScriptRaw('jQuery.noConflict();');
        $this->addSkinJs('edge/lazyload/lazyload.js');
        $this->runLazyload();
        return parent::_beforeToHtml();
    }

    public function runLazyload()
    {
        $script = $this->__("jQuery('%s').lazyload(%s,%s,'%s');", $this->_getElement(), $this->_getPages(), $this->_getTriggerHeight(), $this->_getToolbar());
        $this->addScriptRaw($script);
    }

    public function setElement($element)
    {
        $this->_element = $element;
    }

    public function setToolbar($toolbar)
    {
        $this->_toolbar = $toolbar;
    }

    public function setTriggerHeight($triggerHeight)
    {
        $this->_triggerHeight = $triggerHeight;
    }

    protected function _getElement()
    {
        return $this->_element;
    }

    protected function _getToolbar()
    {
        return $this->_toolbar;
    }

    protected function _getTriggerHeight()
    {
        return $this->_triggerHeight;
    }

    protected function _getPages()
    {
        return Mage::app()
            ->getLayout()
            ->getBlock('product_list')
            ->getLoadedProductCollection()
            ->getLastPageNumber();
    }
}
