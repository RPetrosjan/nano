<?php

namespace App\Controller\Admin;

use App\Entity\Questions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuestionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Questions::class;
    }

    public function configureFields(string $pageName): iterable
    {

        $typeSection = AssociationField::new('typeSection')->renderAsNativeWidget();
        $question = TextField::new('question');
        $reponses = CollectionField::new('reponses')->useEntryCrudForm();

        return [
            $typeSection, $question, $reponses
        ];
    }
}
