<?php
namespace chen0040\hello\Block;
 
class Hello extends \Magento\Framework\View\Element\Template
{
    public function getHelloWorldTxt()
    {
        return 'Hello world!';
    }
}