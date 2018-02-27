<?php
declare(strict_types=1);

namespace SystemCtl\Tests\Unit\Template;

use PHPUnit\Framework\TestCase;
use SystemCtl\Template\Section\InstallSection;
use SystemCtl\Template\Section\TimerSection;
use SystemCtl\Template\Section\UnitSection;
use SystemCtl\Template\TimerUnitTemplate;
use SystemCtl\Unit\Timer;

/**
 * TimerUnitTemplateTest
 *
 * @package SystemCtl\Tests\Unit\Template
 * @author  icanhazstring <blubb0r05+github@gmail.com>
 */
class TimerUnitTemplateTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCreateASimpleInstance()
    {
        $unitTemplate = new TimerUnitTemplate('TestTimer');

        $this->assertInstanceOf(TimerUnitTemplate::class, $unitTemplate);
        $this->assertEquals(Timer::UNIT, $unitTemplate->getUnitSuffix());
        $this->assertEquals('TestTimer', $unitTemplate->getUnitName());
    }

    /**
     * @test
     */
    public function itShouldReturnEmptySectionsAfterInstantiation()
    {
        $unitTemplate = new TimerUnitTemplate('TestTimer');

        $this->assertInstanceOf(UnitSection::class, $unitTemplate->getUnitSection());
        $this->assertInstanceOf(InstallSection::class, $unitTemplate->getInstallSection());
        $this->assertInstanceOf(TimerSection::class, $unitTemplate->getTimerSection());

        $this->assertEmpty($unitTemplate->getSections());
        $this->assertEmpty($unitTemplate->getUnitSection()->getProperties());
        $this->assertEmpty($unitTemplate->getInstallSection()->getProperties());
        $this->assertEmpty($unitTemplate->getTimerSection()->getProperties());
    }

    /**
     * @test
     */
    public function itShouldReturnProperSectionValuesIfSet()
    {
        $unitTemplate = new TimerUnitTemplate('TestTimer');

        $unitTemplate
            ->getUnitSection()
            ->setDescription('TestDescription');

        $this->assertCount(1, $unitTemplate->getSections());
        $this->assertArrayHasKey('Unit', $unitTemplate->getSections());

        $unitTemplate
            ->getTimerSection()
            ->setUnit('superservice');

        $this->assertCount(2, $unitTemplate->getSections());
        $this->assertArrayHasKey('Timer', $unitTemplate->getSections());

        $unitTemplate
            ->getInstallSection()
            ->setWantedBy(['multi-user.target']);

        $this->assertCount(3, $unitTemplate->getSections());
        $this->assertArrayHasKey('Install', $unitTemplate->getSections());

        $this->assertNotEmpty($unitTemplate->getUnitSection()->getProperties());
        $this->assertNotEmpty($unitTemplate->getInstallSection()->getProperties());
        $this->assertNotEmpty($unitTemplate->getTimerSection()->getProperties());
    }
}