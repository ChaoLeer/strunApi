<?php 
  /**
  * 公共类
  */
  require_once ("Rest.php");
  class PubFun extends Rest {
    public function encodeHtml($responseData) {
        $htmlResponse = "<table border='1'>";
        foreach ($responseData as $key => $value) {
            $htmlResponse.= "<tr><td>" . $key . "</td><td>" . $value . "</td></tr>";
        }
        $htmlResponse.= "</table>";
        return $htmlResponse;
    }
    public function encodeJson($responseData) {
        $jsonResponse = json_encode($responseData);
        return $jsonResponse;
    }
    public function encodeXml($responseData) {
        // 创建 SimpleXMLElement 对象
        $xml = new SimpleXMLElement('<?xml version="1.0"?><site></site>');
        foreach ($responseData as $key => $value) {
            $xml->addChild($key, $value);
        }
        return $xml->asXML();
    }

    public function setErrorCode ($resInfo, $statusCustomErrorCode) {
        // $siteRestHandler = new SiteHandler();
        $response = $this->encodeJson($resInfo);
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCustomErrorCode);
        echo $response;
    }
    public function responseDatas ($rawData, $notFoundRes) {
      if (empty($rawData)) {
            $statusCode = 404;
            $rawData = $notFoundRes;
        } else {
            $statusCode = 200;
        }
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        $response = $this->encodeJson($rawData);
        echo $response;
    }
    public function responseInsertResult ($resState, $faildMessage) {
        if ($resState) {
            $statusCode = 200;
            $responseData = array('message' => '新增成功');
        } else {
            $statusCode = 417;
            $responseData = $faildMessage;
        }
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        $response = $this->encodeJson($responseData);
        echo $response;
    }
  }

?>