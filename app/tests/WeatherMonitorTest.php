<?php

use PHPUnit\Framework\TestCase;
use Classes\WeatherMonitor;
use Classes\TemperatureService;

class WeatherMonitorTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testCorrectAverageIsReturned()
    {
        $service = $this->createMock(TemperatureService::class);

        $tempMap = array(
            array('12:00', 20),
            array('14:00', 26)
        );

        $service->expects($this->exactly(2))
                ->method('getTemperature')
                ->will($this->returnValueMap($tempMap));

        $weather = new WeatherMonitor($service);

        $average = $weather->getAverageTemperature('12:00', '14:00');

        $this->assertEquals(23, $average);
    }

    public function testCorrectAverageIsReturnedUsingMockery()
    {
        $service = Mockery::mock(TemperatureService::class);

        $service->shouldReceive('getTemperature')
                ->once()
                ->with('12:00')
                ->andReturn(20);

        $service->shouldReceive('getTemperature')
                ->once()
                ->with('14:00')
                ->andReturn(26);

        $weather = new WeatherMonitor($service);

        $average = $weather->getAverageTemperature('12:00', '14:00');
        $this->assertEquals(23, $average);
    }
}