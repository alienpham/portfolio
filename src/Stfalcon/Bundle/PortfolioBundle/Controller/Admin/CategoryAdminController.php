<?php

namespace Stfalcon\Bundle\PortfolioBundle\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController;
use A2lix\TranslationFormBundle\Annotation\GedmoTranslation;

/**
 * CategoryAdminController
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 */
class CategoryAdminController extends CRUDController
{
    /**
     * {@inheritdoc}
     *
     * @GedmoTranslation
     */
    public function createAction()
    {
        return parent::createAction();
    }

    /**
     * {@inheritdoc}
     *
     * @GedmoTranslation
     */
    public function editAction($id = null)
    {
        return parent::editAction($id);
    }
}
