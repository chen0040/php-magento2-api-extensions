<?php
namespace chen0040\reviews\Api;
 
interface ReviewModelInterface
{
	public function getReview_id();
	
        public function setReview_id($review_id);
        
        public function getCreated_at();
        
        public function setCreated_at($created_at);
	 
	public function getEntity_id();
        
        public function setEntity_id($entity_id);
        
        public function getEntity_pk_value();
        
        public function setEntity_pk_value($entity_pk_value);
        
        public function getStatus_id();
        
        public function setStatus_id($status_id);
        
        public function getDetail_id();
        
        public function setDetail_id($detail_id);
	
        public function getTitle();
        
        public function setTitle($title);
        
        public function getDetail();
        
        public function setDetail($detail);
        
        public function getNickname();
        
        public function setNickname($nickname);
        
        public function getCustomer_id();
        
        public function setCustomer_id($customer_id);
}