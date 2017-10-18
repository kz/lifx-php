<?php

namespace Kz\Lifx\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Kz\Lifx\Lifx;

/**
 * Class LifxTest
 * @package Kz\Lifx\Test
 */
class LifxTest extends \PHPUnit_Framework_TestCase
{

    /**
     * assert constructor returns instance of Lifx
     * @return void
     */
    public function testConstructor()
    {
        $client = $this->getMockBuilder(Client::class)->getMock();
        $lifx = new Lifx('ABCD-EFGH', $client);
        $this->assertInstanceOf(Lifx::class, $lifx);
    }

    /**
     * assert getLights makes calls
     * @return void
     */
    public function testGetLights()
    {
        $client = $this->getMockBuilder(Client::class)->setMethods(['send'])->getMock();
        $client->expects($this->once())->method('send')->with(new Request('GET',
            'lights/all'))->willReturn(new Response());
        $lifx = new Lifx('ABCD-EFGH', $client);
        $lifx->getLights('all');
    }

    /**
     * assert toggleLights makes calls to endpoint
     * @return void
     */
    public function testToggleLights()
    {
        $client = $this->getMockBuilder(Client::class)->setMethods(['send'])->getMock();
        $client->expects($this->once())->method('send')->with(new Request('POST',
            'lights/all/toggle'))->willReturn(new Response());
        $lifx = new Lifx('ABCD-EFGH', $client);
        $lifx->toggleLights('all');
    }

    /**
     * assert setLights makes calls to endpoint
     * @return void
     */
    public function testSetLights()
    {
        $client = $this->getMockBuilder(Client::class)->setMethods(['send'])->getMock();
        $client->expects($this->once())->method('send')->with(
            new Request('PUT', 'lights/all/power'),
            ['query' => ['state' => 'on', 'duration' => 1.0]]
        )->willReturn(new Response());
        $lifx = new Lifx('ABCD-EFGH', $client);
        $lifx->setLights('all');
    }

    /**
     * assert setColor makes calls to endpoint
     * @return void
     */
    public function testSetColor()
    {
        $client = $this->getMockBuilder(Client::class)->setMethods(['send'])->getMock();
        $client->expects($this->once())->method('send')->with(
            new Request('PUT', 'lights/all/color'),
            ['query' => ['color' => 'white', 'duration' => 1.0, 'power_on' => true]]
        )->willReturn(new Response());
        $lifx = new Lifx('ABCD-EFGH', $client);
        $lifx->setColor('all');
    }

    /**
     * assert breathLights makes calls to endpoint
     * @return void
     */
    public function testBreatheLights()
    {
        $client = $this->getMockBuilder(Client::class)->setMethods(['send'])->getMock();
        $client->expects($this->once())->method('send')->with(
            new Request('POST', 'lights/all/effects/breathe'),
            [
                'query' => [
                    'color' => 'purple',
                    'from_color' => null,
                    'period' => 1.0,
                    'cycles' => 1.0,
                    'persist' => false,
                    'power_on' => true,
                    'peak' => 0.5,
                ]
            ]
        )->willReturn(new Response());
        $lifx = new Lifx('ABCD-EFGH', $client);
        $lifx->breatheLights('all');
    }

    /**
     * assert pulseLights makes calls to endpoint
     * @return void
     */
    public function testPulseLights()
    {
        $client = $this->getMockBuilder(Client::class)->setMethods(['send'])->getMock();
        $client->expects($this->once())->method('send')->with(
            new Request('POST', 'lights/all/effects/pulse'),
            [
                'query' => [
                    'selector' => 'all',
                    'color' => 'purple',
                    'from_color' => null,
                    'period' => 1.0,
                    'cycles' => 1.0,
                    'persist' => false,
                    'power_on' => true,
                    'duty_cycle' => 0.5,
                ]
            ]
        )->willReturn(new Response());
        $lifx = new Lifx('ABCD-EFGH', $client);
        $lifx->pulseLights('all');
    }
}
