<?php

  namespace UET\API\APIInterface;

  /**
   * interface get product data API XML by product id
   */
  interface ProductByCategoryIdInterface
  {
    /**
     * @api
     * @param string $id Product id.
     * @return string product data
     */
    public function getProductByCategoryId($id);
  }


 ?>
