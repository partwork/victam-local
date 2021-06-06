<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/admin/config/AdminController.php';

class SubscriptionManagementController extends AdminController
{
    public function index()
    {
        echo 'subscription';
    }
}