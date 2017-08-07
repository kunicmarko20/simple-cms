<?php

namespace KunicMarko\SimpleCmsBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PageAdmin extends AbstractAdmin
{

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('path', 'url')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', ['class' => 'col-md-8'])
                ->add('name')
                ->add('pageBuilder', 'sonata_type_model_list', [
                    'btn_list' => false,
                    'btn_add' => "Add",
                    'required' => false
                ])
            ->end()
            ->with('Seo', ['class' => 'col-md-4'])
                ->add('title')
                ->add('metaDescription', TextareaType::class, ['required' => false])
            ->end()
            ->with('Options', ['class' => 'col-md-4 pull-right'])
                ->add('path')
                ->add('template')
            ->end()

        ;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->add('clear_cache');
    }

    /**
     * @param string $name
     * @return string
     */
    public function getTemplate($name)
    {
        if ($name === 'list') {
            return 'SimpleCmsBundle:CRUD:list.html.twig';
        }

        return parent::getTemplate($name);
    }
}
