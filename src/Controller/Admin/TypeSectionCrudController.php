<?php

namespace App\Controller\Admin;

use App\Entity\TypeSection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeSectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeSection::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
        ];
    }

}
