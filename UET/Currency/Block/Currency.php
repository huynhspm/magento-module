<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace UET\Currency\Block;

use Magento\Framework\HTTP\ClientInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Block ShowVCB
 */
class Currency extends Template
{
    /**
     * @var ClientInterface
     */
    private $client;

    private const VCB_API = "https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=68";

    public function getText(){
		return "Currency modules collected by HUYNHSPM";
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
     * Get data from VCB
     *
     * @return array|mixed|string|null
     */
    public function getDataVCB() {
        $this->client->get(self::VCB_API);
        $xml = simplexml_load_string($this->client->getBody());
        $json = json_encode($xml);
        $res = json_decode($json,TRUE);
        return $res;
    }
}
