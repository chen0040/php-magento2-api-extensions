<?php
namespace chen0040\reviews\Model;
use chen0040\reviews\Api\ReviewManagerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
 
class ReviewManager implements ReviewManagerInterface
{
	private $_reviewFactory;
	private $_storeManager;
	private $_productFactory;
	private $_resourceModel;
	
	public function __construct(
		\Magento\Review\Model\ReviewFactory $reviewFactory,
		\Magento\Catalog\Model\ProductFactory $productFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Catalog\Model\ResourceModel\Product $resourceModel
	) {
		$this->_reviewFactory = $reviewFactory;
		$this->_storeManager = $storeManager;
		$this->_productFactory = $productFactory;
		$this->_resourceModel = $resourceModel;
	}
	
	private function getProductBySku($sku) {
		$product = $this->_productFactory->create();

		$productId = $this->_resourceModel->getIdBySku($sku);
		if (!$productId) {
			throw new NoSuchEntityException(__('Requested product doesn\'t exist'));
		}
		
		$product->load($productId);
		
		return $product;
	}

	/**
     * {@inheritdoc}
     */
	public function getRatingSummary($sku)
	{
		$product = $this->getProductBySku($sku);
		$this->_reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
		$ratingSummary = $product->getRatingSummary();
		var_dump($ratingSummary->getData());
		
		return (int)$ratingSummary->getRatingSummary();
	}  
	
	/**
     * {@inheritdoc}
     */
	public function getReviewsCount($sku)
	{
		$product = $this->getProductBySku($sku);
		$this->_reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
		$ratingSummary = $product->getRatingSummary();
		
		return (int)$ratingSummary->getReviewsCount();
	} 

    /**
     * {@inheritdoc}
     */
    public function findReviewByProductSku($sku) {
        return "Hello, " . $name;
    }
}