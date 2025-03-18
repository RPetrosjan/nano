<?php

namespace App\Controller\Admin;

use App\Entity\Reponses;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReponsesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reponses::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('reponse'),
            BooleanField::new('isCorrect'),
        ];
    }
}
