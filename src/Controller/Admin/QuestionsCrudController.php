<?php

namespace App\Controller\Admin;

use App\Entity\Questions;
use App\Entity\Reponses;
use App\Repository\TypeSectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

class QuestionsCrudController extends AbstractCrudController
{
    public function __construct(readonly private TypeSectionRepository $typeSectionRepository)
    {
    }

    public static function getEntityFqcn(): string
    {
        return Questions::class;
    }

    public function new(AdminContext $context)
    {
        return parent::new($context);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        if(isset($this->getContext()->getRequest()->request->all('Questions')['yamlTextArea'])){

            $resultParse = Yaml::parse($this->getContext()->getRequest()->request->all('Questions')['yamlTextArea']);
            if($resultParse){

                $typeSectionId = $this->getContext()->getRequest()->request->all('Questions')['typeSection'];
                $typeSection = $this->typeSectionRepository->find($typeSectionId);

                $entityManager->beginTransaction();
                foreach ($resultParse['questions'] as $valueQuestion){

                    $question = new Questions();
                     $question->setTypeSection($typeSection);
                     $question->setQuestion($valueQuestion['question']);
                     foreach ($valueQuestion['options'] as $option){
                        $reponse = new Reponses();
                        $reponse->setReponse($option['text']);
                        if($valueQuestion['correctAnswer'] === $option['value']){
                            $reponse->setIsCorrect(true);
                        }
                        else{
                            $reponse->setIsCorrect(false);
                        }
                        $question->addReponse($reponse);
                     }
                     $entityManager->persist($question);
                     $entityManager->flush();
                }
                $entityManager->commit();
            }
        };
        parent::persistEntity($entityManager, $entityInstance); // TODO: Change the autogenerated stub
    }

    public function configureFields(string $pageName): iterable
    {

//        $yaml = Yaml::parse(file_get_contents(__DIR__ . '/../Resources/config/questions.yaml'));
        $yamlTextArea = TextareaField::new('yamlTextArea')->setFormTypeOptions([
            'mapped' => false,
        ]);

        $typeSection = AssociationField::new('typeSection')->renderAsNativeWidget();
        $question = TextField::new('question')->setFormTypeOptions([
            'required' => false,
        ]);
        $reponses = CollectionField::new('reponses')->useEntryCrudForm();
        $documentation = AssociationField::new('documentation')->renderAsNativeWidget();

        return [
            $typeSection, $question, $documentation, $reponses, $yamlTextArea
        ];
    }
}
