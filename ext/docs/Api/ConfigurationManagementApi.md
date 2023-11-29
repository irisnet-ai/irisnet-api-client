# Irisnet\APIV2\Client\ConfigurationManagementApi

All URIs are relative to https://api.irisnet.de, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**deleteConfig()**](ConfigurationManagementApi.md#deleteConfig) | **DELETE** /v2/config/{configId} | Delete an AI configuration. |
| [**getAllConfigs()**](ConfigurationManagementApi.md#getAllConfigs) | **GET** /v2/config/ | List all saved AI configurations. |
| [**getConfig()**](ConfigurationManagementApi.md#getConfig) | **GET** /v2/config/{configId} | Get a specific AI configuration. |
| [**setConfig()**](ConfigurationManagementApi.md#setConfig) | **POST** /v2/config/ | Create a new AI configuration. |


## `deleteConfig()`

```php
deleteConfig($config_id)
```

Delete an AI configuration.

Deletes the AI configuration with the given id.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\ConfigurationManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$config_id = 'config_id_example'; // string | The id of the configuration that should be deleted.

try {
    $apiInstance->deleteConfig($config_id);
} catch (Exception $e) {
    echo 'Exception when calling ConfigurationManagementApi->deleteConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **config_id** | **string**| The id of the configuration that should be deleted. | |

### Return type

void (empty response body)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `*/*`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getAllConfigs()`

```php
getAllConfigs(): \Irisnet\APIV2\Client\Model\Config[]
```

List all saved AI configurations.

Returns a list of all configurations with its id's and configured prototypes. There is a limit on how many configurations can be stored per license key. You can find this limit in the response of the info operation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\ConfigurationManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAllConfigs();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ConfigurationManagementApi->getAllConfigs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Irisnet\APIV2\Client\Model\Config[]**](../Model/Config.md)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getConfig()`

```php
getConfig($config_id): \Irisnet\APIV2\Client\Model\Config
```

Get a specific AI configuration.

Returns a specific AI configuration for the requested id.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\ConfigurationManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$config_id = 'config_id_example'; // string | The id of the configuration that is being requested.

try {
    $result = $apiInstance->getConfig($config_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ConfigurationManagementApi->getConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **config_id** | **string**| The id of the configuration that is being requested. | |

### Return type

[**\Irisnet\APIV2\Client\Model\Config**](../Model/Config.md)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setConfig()`

```php
setConfig($config): \Irisnet\APIV2\Client\Model\Config
```

Create a new AI configuration.

Create a new AI configuration with the desired prototypes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\ConfigurationManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$config = {"prototypes":["nudityCheck","ageEstimation","illegalSymbols","attributesCheck","nippleCheck","textRecognition","bodyAttributes","unwantedSubstances","violenceCheck","selfieCheck"]}; // \Irisnet\APIV2\Client\Model\Config | Define the prototypes to use for an AI check operation. View the _Config_ schema to see the available prototypes.

try {
    $result = $apiInstance->setConfig($config);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ConfigurationManagementApi->setConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **config** | [**\Irisnet\APIV2\Client\Model\Config**](../Model/Config.md)| Define the prototypes to use for an AI check operation. View the _Config_ schema to see the available prototypes. | |

### Return type

[**\Irisnet\APIV2\Client\Model\Config**](../Model/Config.md)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
