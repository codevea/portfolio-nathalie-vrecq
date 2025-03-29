<?php

namespace App\Controller\Admin;

use App\Entity\Timeline;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TimelineCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN')
            ->renderContentMaximized()
            ->setEntityLabelInSingular('une expérience')
            ->setEntityLabelInPlural('parcours professionnel')
            ->setPageTitle('index', 'Timeline du  %entity_label_plural%')
            ->setPageTitle('edit', fn (Timeline $project) => sprintf('Modification : <b>%s</b>', $project->getTitle()))
            ->setDefaultSort(['date' => 'DESC'])
            ->setPaginatorPageSize(15)
            ;
    }
    
    public static function getEntityFqcn(): string
    {
        return Timeline::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Timeline'),
            FormField::addColumn(6),
            TextField::new('title'),
            DateField::new('date', 'Date'),
            TextareaField::new('content')->hideOnIndex(),

            FormField::addColumn(6),
            TextField::new('imageFile', 'Image')->setFormType(VichImageType::class)->onlyOnForms(),            
            ImageField::new('imageName', 'Image')->setBasePath('/pictures/uploads/badge')->hideOnForm(),
            TextField::new('imageUrl'),
            SlugField::new('imageSlug')->setTargetFieldName('title')->hideOnIndex(),
        ];
    }
    
}
