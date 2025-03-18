<?php

namespace App\Controller\Admin;

use App\Entity\Questions;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
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

    public function new(AdminContext $context)
    {
        return parent::new($context);
    }

    public function configureFields(string $pageName): iterable
    {
        $typeSection = AssociationField::new('typeSection')->renderAsNativeWidget();
        $question = TextField::new('question');
        $reponses = CollectionField::new('reponses')->useEntryCrudForm();
        $documentation = AssociationField::new('documentation')->renderAsNativeWidget();

        return [
            $typeSection, $question, $documentation, $reponses
        ];
    }
}
