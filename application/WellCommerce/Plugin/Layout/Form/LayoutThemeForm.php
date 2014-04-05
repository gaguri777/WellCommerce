<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */
namespace WellCommerce\Plugin\Layout\Form;

use WellCommerce\Core\Component\Form\AbstractFormBuilder;
use WellCommerce\Core\Component\Form\FormBuilderInterface;
use WellCommerce\Plugin\Layout\Event\LayoutThemeFormEvent;

/**
 * Class LayoutThemeForm
 *
 * @package WellCommerce\Plugin\LayoutTheme\Form
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LayoutThemeForm extends AbstractFormBuilder implements FormBuilderInterface
{
    /**
     * Initializes Form
     *
     * @param array $layout_themeData
     *
     * @return mixed|\WellCommerce\Core\Component\Form\Elements\Form
     */
    public function init($layoutThemeData = [])
    {
        $form = $this->addForm([
            'name' => 'layout_theme',
        ]);

        $requiredData = $form->addChild($this->addFieldset([
            'name'  => 'required_data',
            'label' => $this->trans('Required data')
        ]));

        $requiredData->addChild($this->addLocalFile([
            'name'        => 'theme',
            'label'       => $this->trans('Theme package'),
            'file_source' => 'themes/',
            'upload_url'  => $this->generateUrl('admin.layout_theme.add'),
            'traversable' => false,
            'file_types'  => [
                'zip'
            ]
        ]));

        $form->addFilters([
            $this->addFilterNoCode(),
            $this->addFilterTrim(),
            $this->addFilterSecure()
        ]);

        $event = new LayoutThemeFormEvent($form, $layoutThemeData);

        $this->getDispatcher()->dispatch(LayoutThemeFormEvent::FORM_INIT_EVENT, $event);

        $form->populate($event->getPopulateData());

        return $form;
    }
}
