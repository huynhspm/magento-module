<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace UET\Weather\Block;

use Magento\Framework\HTTP\ClientInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Block ShowWeather
 */
class Weather extends Template
{
    /**
     * @var ClientInterface
     */
    private $client;

    private const Weather_API = "https://openweathermap.org/themes/openweathermap/assets/vendor/mosaic/data/wind-speed-new-data.json";

    public function getText(){
		return "Weather modules collected by HUYNHSPM";
	}
    
    public function __construct(
        Context $context,
        ClientInterface $client,
        array $data = []
    ) {
        $this->client = $client;
        parent::__construct($context, $data);
    }

    /**
     * Get data from Weather
     *
     * @return array|mixed|string|null
     */
    public function getDataWeather() {
        $this->client->get(self::Weather_API);
        $xml = simplexml_load_string($this->client->getBody());
        $json = json_encode($xml);
        $res = json_decode($json,TRUE);
        return $res;
    }
}
