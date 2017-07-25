<?php

namespace chen0040\reviews\Model;

interface ReviewModelInterface {
    /**
     * return the review id
     * 
     * @api
     * @return int review id
     */
    public function getReview_id();

    /**
     * 
     * @param type $review_id
     * @return ReviewModelInterface
     */
    public function setReview_id($review_id);

    /**
     * 
     * @api
     * @return string created time in string
     */
    public function getCreated_at();

    /**
     * 
     * @param type $created_at
     * @return ReviewModelInterface
     */
    public function setCreated_at($created_at);

    /**
     * 
     * @api
     * @return int entity id
     */
    public function getEntity_id();

    /**
     * 
     * @param type $entity_id
     * @return ReviewModelInterface
     */
    public function setEntity_id($entity_id);

    /**
     * 
     * @api
     * @return int
     */
    public function getEntity_pk_value();

    /**
     * 
     * @param type $entity_pk_value
     * @return ReviewModelInterface
     */
    public function setEntity_pk_value($entity_pk_value);

    /**
     * 
     * @api
     * @return int
     * @return ReviewModelInterface
     */
    public function getStatus_id();

    /**
     * 
     * @param type $status_id
     * @return ReviewModelInterface
     */
    public function setStatus_id($status_id);

    /**
     * 
     * @api
     * @return int
     */
    public function getDetail_id();

    /**
     * 
     * @param type $detail_id
     * @return ReviewModelInterface
     */
    public function setDetail_id($detail_id);

    /**
     * 
     * @api
     * @return string
     */
    public function getTitle();

    /**
     * 
     * @param type $title
     * @return ReviewModelInterface
     */
    public function setTitle($title);

    /**
     * 
     * @api
     * @return string
     */
    public function getDetail();

    /**
     * 
     * @param type $detail
     * @return ReviewModelInterface
     */
    public function setDetail($detail);

    /**
     * 
     * @api
     * @return string
     */
    public function getNickname();

    /**
     * 
     * @param type $nickname
     * @return ReviewModelInterface
     */
    public function setNickname($nickname);

    /**
     * 
     * @api
     * @return int
     */
    public function getCustomer_id();

    /**
     * 
     * @param type $customer_id
     * @return ReviewModelInterface
     */
    public function setCustomer_id($customer_id);
}
