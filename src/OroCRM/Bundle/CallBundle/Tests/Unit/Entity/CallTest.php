<?php

namespace OroCRM\Bundle\CallBundle\Tests\Unit\Entity;

use Symfony\Component\PropertyAccess\PropertyAccess;

use OroCRM\Bundle\CallBundle\Entity\Call;

class CallTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getSetDataProvider
     */
    public function testGetSet($property, $value)
    {
        $obj = new Call();

        $accessor = PropertyAccess::createPropertyAccessor();
        $accessor->setValue($obj, $property, $value);
        $this->assertSame($value, $accessor->getValue($obj, $property));
    }

    public function getSetDataProvider()
    {
        return array(
            array('owner', $this->getMock('Oro\Bundle\UserBundle\Entity\User')),
            array('subject', 'test'),
            array('phoneNumber', 'test'),
            array('notes', 'test'),
            array('callDateTime', new \DateTime()),
            array(
                'callStatus',
                $this->getMockBuilder('OroCRM\Bundle\CallBundle\Entity\CallStatus')
                    ->disableOriginalConstructor()
                    ->getMock()
            ),
            array('duration', 1),
            array(
                'direction',
                $this->getMockBuilder('OroCRM\Bundle\CallBundle\Entity\CallDirection')
                    ->disableOriginalConstructor()
                    ->getMock()

            ),
            array('organization', $this->getMock('Oro\Bundle\OrganizationBundle\Entity\Organization')),
        );
    }

    public function testPrePersist()
    {
        $obj = new Call();

        $this->assertNull($obj->getCreatedAt());
        $this->assertNull($obj->getUpdatedAt());

        $obj->prePersist();
        $this->assertInstanceOf('\DateTime', $obj->getCreatedAt());
        $this->assertInstanceOf('\DateTime', $obj->getUpdatedAt());
    }

    public function testPreUpdate()
    {
        $obj = new Call();

        $this->assertNull($obj->getUpdatedAt());

        $obj->preUpdate();
        $this->assertInstanceOf('\DateTime', $obj->getUpdatedAt());
    }
}
