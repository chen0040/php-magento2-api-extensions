<?php
namespace chen0040\reviews\Model;
use chen0040\reviews\Api\ReviewManagerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Review\Model\ResourceModel\Review\Product\Collection as ProductCollection;
use Magento\Review\Model\ResourceModel\Review\Status\Collection as StatusCollection;
 
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
		if(!$sku) {
			throw new NoSuchEntityException(__('Requested review doesn\'t exist'));
		}
		
		$product = $this->getProductBySku($sku);
		$this->_reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
		$ratingSummary = $product->getRatingSummary();
		
		return (int)$ratingSummary->getRatingSummary();
	}  
	
	/**
     * {@inheritdoc}
     */
	public function getReviewsCount($sku)
	{
		if (!$sku) {
			throw new NoSuchEntityException(__('Requested review doesn\'t exist'));
		}
		
		$product = $this->getProductBySku($sku);
		$this->_reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
		$ratingSummary = $product->getRatingSummary();
		
		return (int)$ratingSummary->getReviewsCount();
	} 
	
	/**
     * {@inheritdoc}
     */
	public function getReview($reviewId)
    {
        if (!$reviewId) {
            throw new NoSuchEntityException(__('Requested review doesn\'t exist'));
        }
        /** @var \Magento\Review\Model\Review $review */
        $review = $this->_reviewFactory->create()->load($reviewId);
        if (!$review->getId()
            || !$review->isApproved()
            || !$review->isAvailableOnStore($this->_storeManager->getStore())
        ) {
            throw new NoSuchEntityException(__('Requested review doesn\'t exist'));
        }
        return new \chen0040\reviews\Model\ReviewModel($review);
        
    }

    /**
     * {@inheritdoc}
     */
    public function findReviewByProductSku($sku) {
        if (!$sku) {
			throw new NoSuchEntityException(__('Requested review doesn\'t exist'));
		}
		
		$productId = $this->_resourceModel->getIdBySku($sku);
		$reviewcollection = $this->_reviewFactory->create()->getResourceCollection()->addStoreFilter($this->_storeManager->getStore()->getId())
		->addStatusFilter(\Magento\Review\Model\Review::STATUS_APPROVED)
		->addFieldToFilter('entity_pk_value', $productId)
		->setDateOrder();
		$reviews = $reviewcollection->getItems();
		return '';
    }
}