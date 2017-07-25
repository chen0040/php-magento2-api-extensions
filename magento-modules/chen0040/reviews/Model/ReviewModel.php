<?php
namespace chen0040\reviews\Model;
use chen0040\reviews\Model\ReviewModelInterface;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReviewModel
 *
 * @author chen0
 */
class ReviewModel implements ReviewModelInterface {
    //put your code here
    
    private $review_id;
    private $created_at;
    private $entity_id;
    private $entity_pk_value;
    private $status_id;
    private $detail_id;
    private $title;
    private $nickname;
    private $customer_id;
    
    public function __construct($review) {
        $this->review_id = $review->getReview_id();
        $this->created_at = $review->getCreated_at();
        $this->entity_id = $review->getEntity_id();
        $this->entity_pk_value = $review->getEntity_pk_value();
        $this->status_id = $review->getStatus_id();
        $this->detail_id = $review->getDetail_id();
        $this->detail = $review->getDetail();
        $this->title = $review->getTitle();
        $this->nickname = $review->getNickname();
        $this->customer_id = $review->getCustomer_id();
    }
    
    public function getReview_id() {
        return $this->review_id;
    }
	
    public function setReview_id($review_id) {
        $this->review_id = $review_id;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    public function getEntity_id() {
        return $this->entity_id;
    }

    public function setEntity_id($entity_id) {
        $this->entity_id = $entity_id;
    }

    public function getEntity_pk_value() {
        return $this->entity_pk_value;
    }

    public function setEntity_pk_value($entity_pk_value) {
        $this->entity_pk_value = $entity_pk_value;
    }

    public function getStatus_id() {
        return $this->status_id;
    }

    public function setStatus_id($status_id) {
        $this->status_id = $status_id;
    }

    public function getDetail_id() {
        return $this->detail_id;
    }

    public function setDetail_id($detail_id) {
        $this->detail_id = $detail_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDetail() {
        return $this->detail;
    }

    public function setDetail($detail) {
        $this->detail = $detail;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function getCustomer_id() {
        return $this->customer_id;
    }

    public function setCustomer_id($customer_id) {
        $this->customer_id = $customer_id;
    }
}
