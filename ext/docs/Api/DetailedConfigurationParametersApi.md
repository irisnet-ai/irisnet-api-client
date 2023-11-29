# Irisnet\APIV2\Client\DetailedConfigurationParametersApi

All URIs are relative to https://api.irisnet.de, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**clearParameters()**](DetailedConfigurationParametersApi.md#clearParameters) | **DELETE** /v2/config/parameters/{configId} | Delete the parameters of the AI configuration. |
| [**getParameters()**](DetailedConfigurationParametersApi.md#getParameters) | **GET** /v2/config/parameters/{configId} | Get the parameters of the AI configuration. |
| [**setParameters()**](DetailedConfigurationParametersApi.md#setParameters) | **POST** /v2/config/parameters/{configId} | Set parameters to the given AI configuration. |


## `clearParameters()`

```php
clearParameters($config_id)
```

Delete the parameters of the AI configuration.

Clears the parameters and restores the defaults for all classifications.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\DetailedConfigurationParametersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$config_id = 'config_id_example'; // string | The id of the configuration where the parameters should be deleted.

try {
    $apiInstance->clearParameters($config_id);
} catch (Exception $e) {
    echo 'Exception when calling DetailedConfigurationParametersApi->clearParameters: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **config_id** | **string**| The id of the configuration where the parameters should be deleted. | |

### Return type

void (empty response body)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getParameters()`

```php
getParameters($config_id): \Irisnet\APIV2\Client\Model\ParamSet
```

Get the parameters of the AI configuration.

Returns the parameters stored in the given configuration.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\DetailedConfigurationParametersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$config_id = 'config_id_example'; // string | The id of the configuration for which the parameters are being requested.

try {
    $result = $apiInstance->getParameters($config_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DetailedConfigurationParametersApi->getParameters: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **config_id** | **string**| The id of the configuration for which the parameters are being requested. | |

### Return type

[**\Irisnet\APIV2\Client\Model\ParamSet**](../Model/ParamSet.md)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setParameters()`

```php
setParameters($config_id, $param_set): \Irisnet\APIV2\Client\Model\ParamSet
```

Set parameters to the given AI configuration.

Save or modify the parameters stored in the AI configuration.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\DetailedConfigurationParametersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$config_id = 'config_id_example'; // string | The id of the configuration where the parameters should be added.
$param_set = {"params":[{"classification":"breast","drawMode":3},{"classification":"vulva","drawMode":3},{"classification":"penis","drawMode":3},{"classification":"vagina","drawMode":3},{"classification":"buttocks","drawMode":3},{"classification":"anus","drawMode":3},{"classification":"toy","drawMode":3},{"classification":"oral","drawMode":3},{"classification":"penetration","drawMode":3}]}; // \Irisnet\APIV2\Client\Model\ParamSet | Define the parameters to use for an AI check operation. View the _ParamSet_ and _Param_ schema to see the available parameters.

try {
    $result = $apiInstance->setParameters($config_id, $param_set);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DetailedConfigurationParametersApi->setParameters: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **config_id** | **string**| The id of the configuration where the parameters should be added. | |
| **param_set** | [**\Irisnet\APIV2\Client\Model\ParamSet**](../Model/ParamSet.md)| Define the parameters to use for an AI check operation. View the _ParamSet_ and _Param_ schema to see the available parameters. | |

### Return type

[**\Irisnet\APIV2\Client\Model\ParamSet**](../Model/ParamSet.md)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
