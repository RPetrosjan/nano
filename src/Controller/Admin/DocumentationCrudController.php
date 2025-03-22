<?php

namespace App\Controller\Admin;

use App\Entity\Documentation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DocumentationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Documentation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $typeSection = AssociationField::new('typeSection')->renderAsNativeWidget();
        return [
        $typeSection->setColumns('col-12'),
        TextField::new('title')->setColumns('col-12'),
            TextareaField::new('text')->setColumns('col-12'),
        ];
    }

}
