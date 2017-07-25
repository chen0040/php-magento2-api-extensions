<?php
namespace chen0040\reviews\Api;
 
interface ReviewManagerInterface
{
    /**
     * Returns list of reviews by product sku
     *
     * @api
     * @param string $sku Sku of the product.
     * @return \chen0040\reviews\Model\ReviewModelInterface[] list of reviews.
     */
    public function findReviewByProductSku($sku);
	
	/**
	 * Returns the rating summary of a product 
	 *
	 * @api
	 * @param string @sku SKU of the product
	 * @return int Rating summary of the product 
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 */
	public function getRatingSummary($sku);
	
	/**
	 * Returns the review count of a product 
	 *
	 * @api
	 * @param string @sku SKU of the product
	 * @return int Review count of the product 
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 */
	public function getReviewsCount($sku);
	
	/**
     * Load review model with data by passed id.
     * Return false if review was not loaded or review is not approved.
     *
     * @param int $reviewId
     * @return \chen0040\reviews\Model\ReviewModelInterface
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
	public function getReview($reviewId);
}