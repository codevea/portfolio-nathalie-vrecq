<?php

namespace App\Controller\Admin;

use App\Entity\Settings;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SettingsCrudController extends AbstractCrudController
{
    public function __construct(private EntityManagerInterface $entityManagerInterface)
    {
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN')
            ->renderContentMaximized()
            ->setEntityLabelInSingular('paramètre')
            ->setEntityLabelInPlural('paramètres généraux')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setPageTitle('edit', fn (Settings $project) => sprintf('Modification : <b>%s</b>', $project->getTitle()))
            ;
    }

    /**
     * Remove the display of the button that allows the creation of a second parameter entry if parameters have already been created.
     * Supprime l'affichage du bouton permettant de recréer une deuxième entrée de paramètres si des paramètres ont déjà été créés.
     *
     * @param Actions $actions
     * @return Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        $settingsTuple = $this->entityManagerInterface->getRepository(Settings::class)->findByIdSettings();
       
        if(!empty($settingsTuple)) {
          return $actions
            ->disable(Action::NEW);  
        } 
       return $actions;
    }

    public static function getEntityFqcn(): string
    {
        return Settings::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [

            FormField::addTab('Description'),
            FormField::addColumn(6),
            TextField::new('title'),
            TextField::new('subTitle', 'Sous-titre')->hideOnIndex(),
            TextEditorField::new('content', 'Présentation')->hideOnIndex(),
            FormField::addColumn(6),
            FormField::addFieldset('Informations supplémentaires'),
            TextEditorField::new('messageAbout', 'Information de la section à proros')->hideOnIndex(),
            TextEditorField::new('messageSkills', 'Information de la section compétence')->hideOnIndex(),

            FormField::addTab('Informations de contact'),
            FormField::addColumn(6),
            TextField::new('lastName', 'Nom')->hideOnIndex(),
            TextField::new('firstName', 'Prénom')->hideOnIndex(),
            TextField::new('address', 'Adresse')->hideOnIndex(),
            TextField::new('province', 'Région et Département')->hideOnIndex(),
            EmailField::new('email', 'Email')->hideOnIndex(),

            FormField::addColumn(6),
            UrlField::new('facebook', 'URL Facebook')->hideOnIndex(),
            UrlField::new('github', 'URL Github')->hideOnIndex(),
            UrlField::new('linkedin', 'URL Linkedin')->hideOnIndex(),
            FormField::addFieldset('Coordonnées téléphoniques'),
            TextField::new('phone', 'Téléphone')->hideOnIndex(),
            TextField::new('mobile', 'Mobile')->hideOnIndex(),
            
            FormField::addTab('Informations techniques'),
            TextField::new('copyright', 'Copyright et Droit d\'auteur')->hideOnIndex(),
            TextField::new('version', 'Version de l\'application')->hideOnIndex(),
            TextField::new('technology', 'Technologie employée')->hideOnIndex(),
        ];
    }
}
