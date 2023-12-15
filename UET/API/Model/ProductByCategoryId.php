<?php
namespace UET\API\Model;
use UET\API\APIInterface\ProductByCategoryIdInterface;
use Magento\Framework\View\Element\Template;


class ProductByCategoryId extends Template implements ProductByCategoryIdInterface
{
    protected $_productCollectionFactory;
  
    public function __construct(       
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;
    }
    
    
    public function getProductCollectionByCategories($ids)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        return $collection;
    }
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $name Users name.
     * @return string Greeting message with users name.
     */
    public function getProductByCategoryId($id) {
        $productCollection = $this->getProductCollectionByCategories($id);
        $data = [];
        foreach ($productCollection as $k => $product) {
        	array_push($data, [
                'ID' => $product['entity_id'],
                'NAME' => $product['name'],
                'PRICE' => $product['price'],
                'URL KEY' => $product['url_key'],
                'META_TITLE' => $product['meta_title'],
                'META_DESCRIPTION' => $product['meta_description'],
                'SHORT_DESCRIPTION' => $product['short_description'],
                'DESCRIPTION' => $product['description'],
            ]);
              
          }
          return $data;
        }
}
