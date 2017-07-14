<?php
namespace chen0040\logout\Api;
 
interface LogoutInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $customerId Users customerId.
     * @return bool Logout message with users customerId.
     */
    public function logout($customerId);
}