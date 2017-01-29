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

namespace WellCommerce\Bundle\DictionaryBundle\Entity;

use Knp\DoctrineBehaviors\Model\Blameable\Blameable;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Identifiable;

/**
 * Dictionary
 */
class Dictionary implements DictionaryInterface
{
    use Identifiable;
    use Timestampable;
    use Translatable;
    use Blameable;
    
    protected $identifier = '';
    
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
    
    public function setIdentifier(string $identifier)
    {
        $this->identifier = $identifier;
    }
}
