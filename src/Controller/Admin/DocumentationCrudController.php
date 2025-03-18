<?php

namespace App\Controller\Admin;

use App\Entity\Documentation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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
        return [
            TextEditorField::new('text')->setTrixEditorConfig([
                'blockAttributes' => [
                    'default' => ['tagName' => 'p'],
                    'heading1' => ['tagName' => 'h2'],
                ],
                'css' => [
                    'attachment' => 'admin_file_field_attachment',
                ],
            ]),
        ];
    }

}
