# Irisnet\APIV1\Client\EndpointsToSetupTheAIApi

All URIs are relative to *https://api.irisnet.de/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**setINDefine**](EndpointsToSetupTheAIApi.md#setINDefine) | **POST** /set-definition | Set definitions via pre-defined prototypes.
[**setINParams**](EndpointsToSetupTheAIApi.md#setINParams) | **POST** /set-parameters | Set the behaviour parameters for one object class.



## setINDefine

> setINDefine($in_define_ai)

Set definitions via pre-defined prototypes.

Each available prototype groups together a pre-defined set of parameters that will define the behaviour of the AI. This allows to configure multiple AI-checks per image. The image upload is only required once. Set the definition context with your needs in mind, credits are subtracted accordingly. See 'cost' endpoint for further information. Additionally you can overwrite specific parameters using 'set-parameters'. Any prior request to 'set-parameters' are invalidated when calling this request. This can also be used to reset the AI configuration.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Irisnet\APIV1\Client\Api\EndpointsToSetupTheAIApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$in_define_ai = <?xml version="1.0" encoding="UTF-8"?>
<inDefineAI>
	<inImage proto="nudityCheck"/>
</inDefineAI>; // \Irisnet\APIV1\Client\Model\INDefineAI | 

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
 **in_define_ai** | [**\Irisnet\APIV1\Client\Model\INDefineAI**](../Model/INDefineAI.md)|  |

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

Overwrites or extends the default configuration of the AI. By setting precise behaviour parameters, the AI can be fine tuned for specific use cases. See inParam schema to learn more about the classification objects. To reset the parameters to their default values, make a post request to 'set-definition'.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Irisnet\APIV1\Client\Api\EndpointsToSetupTheAIApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$in_params = <?xml version="1.0" encoding="UTF-8"?>
<inParams>
	<inParam inClass="breast" drawMode="3" />
	<inParam inClass="vulva" drawMode="3" />
	<inParam inClass="penis" drawMode="3" />
	<inParam inClass="vagina" drawMode="3" />
	<inParam inClass="buttocks" drawMode="3" />
	<inParam inClass="anus" drawMode="3" />
	<inParam inClass="toy" drawMode="3" />
	<inParam inClass="oral" drawMode="3" />
	<inParam inClass="penetration" drawMode="3" />
</inParams>; // \Irisnet\APIV1\Client\Model\INParams | 

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
 **in_params** | [**\Irisnet\APIV1\Client\Model\INParams**](../Model/INParams.md)|  |

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

