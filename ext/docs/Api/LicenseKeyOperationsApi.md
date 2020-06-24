# OpenAPI\Client\LicenseKeyOperationsApi

All URIs are relative to *https://api.irisnet.de*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getAICost**](LicenseKeyOperationsApi.md#getAICost) | **GET** /v1/cost | Get the cost of the previously set parameters. The cost of the configuration is subtracted from the license key during each check.
[**getLicenseInfo**](LicenseKeyOperationsApi.md#getLicenseInfo) | **GET** /v1/info/{licenseKey} | Get information from given license key.



## getAICost

> int getAICost()

Get the cost of the previously set parameters. The cost of the configuration is subtracted from the license key during each check.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new OpenAPI\Client\Api\LicenseKeyOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getAICost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LicenseKeyOperationsApi->getAICost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

This endpoint does not need any parameter.

### Return type

**int**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getLicenseInfo

> \OpenAPI\Client\Model\LicenseInfo getLicenseInfo($license_key)

Get information from given license key.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new OpenAPI\Client\Api\LicenseKeyOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$license_key = 'license_key_example'; // string | License obtained from the https://www.irisnet.de/prices shop.

try {
    $result = $apiInstance->getLicenseInfo($license_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LicenseKeyOperationsApi->getLicenseInfo: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **license_key** | **string**| License obtained from the https://www.irisnet.de/prices shop. |

### Return type

[**\OpenAPI\Client\Model\LicenseInfo**](../Model/LicenseInfo.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

