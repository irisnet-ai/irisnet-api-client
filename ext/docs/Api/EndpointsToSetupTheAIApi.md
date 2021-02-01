# OpenAPI\Client\EndpointsToSetupTheAIApi

All URIs are relative to *https://api.irisnet.de*

Method | HTTP request | Description
------------- | ------------- | -------------
[**setINDefine**](EndpointsToSetupTheAIApi.md#setINDefine) | **POST** /v1/set-definition | Set definitions via pre-defined prototypes.
[**setINParams**](EndpointsToSetupTheAIApi.md#setINParams) | **POST** /v1/set-parameters | Set the behaviour parameters for one object class.



## setINDefine

> setINDefine($in_define_ai)

Set definitions via pre-defined prototypes.

Each available prototype groups together a pre-defined set of parameters that will define the behaviour of the AI. This allows to configure multiple AI-checks per image. The image upload is only required once. Set the definition context with your needs in mind, credits are subtracted accordingly. See 'cost' endpoint for further information. Additionally you can overwrite specific parameters using 'set-parameters'. Any prior request to 'set-parameters' are invalidated when calling this request. This can also be used to reset the AI configuration.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new OpenAPI\Client\Api\EndpointsToSetupTheAIApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$in_define_ai = <?xml version="1.0" encoding="UTF-8"?>
<inDefineAI>
	<inImage proto="nudityCheck"/>
	<inImage proto="ageEstimation"/>
	<inImage proto="illegalSymbols"/>
</inDefineAI>; // \OpenAPI\Client\Model\INDefineAI | 

try {
    $apiInstance->setINDefine($in_define_ai);
} catch (Exception $e) {
    echo 'Exception when calling EndpointsToSetupTheAIApi->setINDefine: ', $e->getMessage(), PHP_EOL;
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

Set the behaviour parameters for one object class.

Overwrites or extends the default configuration of the AI. By setting precise behaviour parameters, the AI can be fine tuned for specific use cases. To reset the parameters to their default values, make a post request to 'set-definition'.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new OpenAPI\Client\Api\EndpointsToSetupTheAIApi(
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
	<inParam inClass="toy" min="0" max="0" drawMode="2" grey="127"/>
	<inParam inClass="oral" min="0" max="0" drawMode="2" grey="127"/>
	<inParam inClass="penetration" min="0" max="0" drawMode="2" grey="127"/>
</inParams>; // \OpenAPI\Client\Model\INParams | 

try {
    $apiInstance->setINParams($in_params);
} catch (Exception $e) {
    echo 'Exception when calling EndpointsToSetupTheAIApi->setINParams: ', $e->getMessage(), PHP_EOL;
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

