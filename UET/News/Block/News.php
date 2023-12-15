<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace UET\News\Block;

use Magento\Framework\HTTP\ClientInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Block ShowVNE
 */
class News extends Template
{
    /**
     * @var ClientInterface
     */
    private $client;

    private const VNE_API = "https://vnexpress.net/rss/kinh-doanh.rss";

    public function getText(){
		return "News modules collected by HUYNHSPM";
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
     * Get data from VNE
     *
     * @return array|mixed|string|null
     */
    public function getDataVNE() {
        $this->client->get(self::VNE_API);
        $xml = simplexml_load_string($this->client->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        $jsonDecode = json_decode($json,TRUE);
        foreach ($jsonDecode["channel"]["item"] as &$item) {
            $html = $item["description"];
            $startImgTagPos = (int)strpos($html, 'src');
            $endImgTagPos = (int)strpos($html, '>', $startImgTagPos);
            $item["description"] = substr($html, $startImgTagPos + 4, $endImgTagPos - $startImgTagPos);
        }
        return $jsonDecode["channel"];
    }
}
