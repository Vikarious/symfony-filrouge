<?php

namespace App\Controller\Admin;

use App\Entity\FormContact;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FormContact::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            TextField::new('message'),
        ];
    }
}
