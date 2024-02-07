<?php

namespace App\Controller\Admin;

use App\Entity\PhoneNumber;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PhoneNumberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PhoneNumber::class;
    }
}
