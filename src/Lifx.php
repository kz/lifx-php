<?php

namespace Kz\Lifx;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class Lifx
 * @package Kz\Lifx
 */
class Lifx
{
    const API_URL = 'https://api.lifx.com/';
    const API_VERSION = 'v1beta1';

    /**
     * @var Client
     */
    private $client;

    /**
     * Instantiates the Guzzle client using the authorization token.
     * A token can be obtained at: https://cloud.lifx.com/settings
     *
     * @param string $token Authorization token for the LIFX HTTP API.
     */
    public function __construct($token)
    {
        $client = new Client([
            'base_uri' => self::API_URL . self::API_VERSION . '/',
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);
        $this->client = $client;
    }


    /**
     * Sends a request to the LIFX HTTP API.
     *
     * @param $request
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendRequest($request, $options = [])
    {
        $client = $this->client;
        $response = $client->send($request, $options);

        return $response;
    }

    /**
     * Gets lights belonging to the authenticated account.
     *
     * @param string $selector Selector used to filter lights. Defaults to `all`.
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getLights($selector = 'all')
    {
        $request = new Request('GET', 'lights/' . $selector);
        $response = $this->sendRequest($request);

        return $response->getBody();
    }

    /**
     * Toggle off lights if they are on, or turn them on if they are off.
     * Physically powered off lights are ignored.
     *
     * @param string $selector Selector used to filter lights. Defaults to `all`.
     * @return \Psr\Http\Message\StreamInterface
     */
    public function toggleLights($selector = 'all')
    {
        $request = new Request('POST', 'lights/' . $selector . '/toggle');
        $response = $this->sendRequest($request);

        return $response->getBody();
    }

    /**
     * Turn lights on or off.
     *
     * @param string $selector Selector used to filter lights. Defaults to `all`.
     * @param string $state State of 'on' or 'off'.
     * @param float $duration (Optional) Fade to the given `state` over a duration of seconds. Defaults to `1.0`.
     * @return \Psr\Http\Message\StreamInterface
     */
    public function setLights($selector = 'all', $state = 'on', $duration = 1.0)
    {
        $request = new Request('PUT', 'lights/' . $selector . '/power');
        $response = $this->sendRequest($request,[
            'query' => [
                'state' => $state,
                'duration' => $duration
            ]
        ]);

        return $response->getBody();
    }

    /**
     * Set lights to any color.
     *
     * @param string $selector Selector used to filter lights. Defaults to `all`.
     * @param string $color Color the lights should be set to. Defaults to `white`.
     * @param float $duration (Optional) Fade to the given `state` over a duration of seconds. Defaults to `1.0`.
     * @param bool $power_on (Optional) Whether to turn light on first. Defaults to `true`.
     * @return \Psr\Http\Message\StreamInterface
     */
    public function setColor($selector = 'all', $color = 'white', $duration = 1.0, $power_on = true)
    {
        $request = new Request('PUT', 'lights/' . $selector . '/color');
        $response = $this->sendRequest($request,[
            'query' => [
                'color' => $color,
                'duration' => $duration,
                'power_on' => $power_on,
            ]
        ]);

        return $response->getBody();
    }

    /**
     * Performs a breathe effect by slowly fading between the given colors.
     * If `from_color` is omitted then the current color is used in its place.
     *
     * @param string $selector Selector used to filter lights. Defaults to `all`.
     * @param string $color Color the lights should be set to. Defaults to `purple`.
     * @param string|null $from_color (Optional) From color of the waveform. Defaults to `null`.
     * @param float $period (Optional) Period of the waveform in seconds. Defaults to `1.0`.
     * @param float $cycles (Optional) Number of times to repeat, cycle counts. Defaults to `1.0`.
     * @param bool $persist (Optional) Whether to keep state at the end of the effect. Defaults to `false`.
     * @param bool $power_on (Optional) Whether to turn light on first. Defaults to `true`.
     * @param float $peak (Optional) Defines where in a period the target color is at its maximum. Defaults to `0.5`. Minimum `0.0`, maximum `1.0`.
     * @return \Psr\Http\Message\StreamInterface
     */
    public function breatheLights(
        $selector = 'all',
        $color = 'purple',
        $from_color = null,
        $period = 1.0,
        $cycles = 1.0,
        $persist = false,
        $power_on = true,
        $peak = 0.5
    ) {
        $request = new Request('POST', 'lights/' . $selector . '/effects/breathe');
        $response = $this->sendRequest($request,[
            'query' => [
                'color' => $color,
                'from_color' => $from_color,
                'period' => $period,
                'cycles' => $cycles,
                'persist' => $persist,
                'power_on' => $power_on,
                'peak' => $peak,
            ]
        ]);

        return $response->getBody();
    }

    /**
     * Performs a pulse effect by quickly flashing between the given colors.
     * If `from_color` is omitted then the current color is used in its place.
     *
     * @param string $selector Selector used to filter lights. Defaults to `all`.
     * @param string $color Color the lights should be set to. Defaults to `purple`.
     * @param string|null $from_color (Optional) From color of the waveform. Defaults to `null`.
     * @param float $period (Optional) Period of the waveform in seconds. Defaults to `1.0`.
     * @param float $cycles (Optional) Number of times to repeat, cycle counts. Defaults to `1.0`.
     * @param bool $persist (Optional) Whether to keep state at the end of the effect. Defaults to `false`.
     * @param bool $power_on (Optional) Whether to turn light on first. Defaults to `true`.
     * @param float $duty_cycle (Optional) Ratio of the period where color is active. Defaults to `0.5`. Minimum `0.0`, maximum `1.0`.
     * @return \Psr\Http\Message\StreamInterface
     */
    public function pulseLights(
        $selector = 'all',
        $color = 'purple',
        $from_color = null,
        $period = 1.0,
        $cycles = 1.0,
        $persist = false,
        $power_on = true,
        $duty_cycle = 0.5
    ) {
        $request = new Request('POST', 'lights/' . $selector . '/effects/pulse');
        $response = $this->sendRequest($request,[
            'query' => [
                'selector' => $selector,
                'color' => $color,
                'from_color' => $from_color,
                'period' => $period,
                'cycles' => $cycles,
                'persist' => $persist,
                'power_on' => $power_on,
                'duty_cycle' => $duty_cycle,
            ]
        ]);

        return $response->getBody();
    }
}