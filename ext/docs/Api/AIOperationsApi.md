# OpenAPI\Client\AIOperationsApi

All URIs are relative to *https://api.irisnet.de*

Method | HTTP request | Description
------------- | ------------- | -------------
[**checkImage**](AIOperationsApi.md#checkImage) | **POST** /v1/check-image/{licenseKey} | Upload and check image against previously chosen configuration.
[**downloadProcessed**](AIOperationsApi.md#downloadProcessed) | **GET** /v1/download/{filename} | Get the resulting image file.
[**setINDefine**](AIOperationsApi.md#setINDefine) | **POST** /v1/set-definition | Set the definitions of the pre-defined rule sets.
[**setINParams**](AIOperationsApi.md#setINParams) | **POST** /v1/set-parameters | Set the behaviour parameters of the single classifications.



## checkImage

> \OpenAPI\Client\Model\IrisNet checkImage($license_key, $detail, $file)

Upload and check image against previously chosen configuration.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new OpenAPI\Client\Api\AIOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$license_key = 'license_key_example'; // string | License obtained from irisnet.de shop.
$detail = 1; // int | Sets the response details. Use 1 for minimum detail (better API performance), 2 for medium details and 3 for all details.
$file = "/path/to/file.txt"; // \SplFileObject | 

try {
    $result = $apiInstance->checkImage($license_key, $detail, $file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AIOperationsApi->checkImage: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **license_key** | **string**| License obtained from irisnet.de shop. |
 **detail** | **int**| Sets the response details. Use 1 for minimum detail (better API performance), 2 for medium details and 3 for all details. | [optional] [default to 1]
 **file** | **\SplFileObject****\SplFileObject**|  | [optional]

### Return type

[**\OpenAPI\Client\Model\IrisNet**](../Model/IrisNet.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: multipart/form-data
- **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## downloadProcessed

> \SplFileObject downloadProcessed($filename)

Get the resulting image file.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new OpenAPI\Client\Api\AIOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$filename = 'filename_example'; // string | 

try {
    $result = $apiInstance->downloadProcessed($filename);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AIOperationsApi->downloadProcessed: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **filename** | **string**|  |

### Return type

[**\SplFileObject**](../Model/\SplFileObject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## setINDefine

> setINDefine($in_define_ai)

Set the definitions of the pre-defined rule sets.

Each available prototype, groups together a pre-defined set of parameters that will define the behaviour of the AI. Additionally you can overwrite specific parameters using 'set-parameters'. Any prior request to 'set-parameters' are invalidated when calling this request. This can also be used to reset the AI configuration.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new OpenAPI\Client\Api\AIOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$in_define_ai = <?xml version="1.0" encoding="UTF-8"?>
<inDefineAI>
	<inImage proto="checkNudity"/>
</inDefineAI>; // \OpenAPI\Client\Model\INDefineAI | 

try {
    $apiInstance->setINDefine($in_define_ai);
} catch (Exception $e) {
    echo 'Exception when calling AIOperationsApi->setINDefine: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **in_define_ai** | [**\OpenAPI\Client\Model\INDefineAI**](../Model/INDefineAI.md)|  |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/xml, application/json
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## setINParams

> setINParams($in_params)

Set the behaviour parameters of the single classifications.

Overwrites or extends the default configuration of the AI. By setting precise behaviour parameters, the AI can be fine tuned for specific use cases. To reset the parameters to their default values, make a post request to 'set-definition'.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new OpenAPI\Client\Api\AIOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$in_params = <?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<inParams>
	<inDefault thresh="0.5" grey="127"/>
	<inParam inClass="face" min="-1" max="-1" drawMode="0" grey="127"/>
	<inParam inClass="hand" min="-1" max="-1" drawMode="0" grey="127"/>
	<inParam inClass="breast" min="0" max="0" drawMode="2" grey="127"/>
	<inParam inClass="vulva" min="0" max="0" drawMode="2" grey="127"/>
	<inParam inClass="penis" min="0" max="0" drawMode="2" grey="127"/>
	<inParam inClass="vagina" min="0" max="0" drawMode="2" grey="127"/>
	<inParam inClass="buttocks" min="0" max="0" drawMode="2" grey="127"/>
	<inParam inClass="anus" min="0" max="0" drawMode="2" grey="127"/>
</inParams>; // \OpenAPI\Client\Model\INParams | 

try {
    $apiInstance->setINParams($in_params);
} catch (Exception $e) {
    echo 'Exception when calling AIOperationsApi->setINParams: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **in_params** | [**\OpenAPI\Client\Model\INParams**](../Model/INParams.md)|  |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/xml, application/json
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

