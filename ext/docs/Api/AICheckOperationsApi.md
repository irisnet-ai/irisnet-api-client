# Irisnet\APIV2\Client\AICheckOperationsApi

All URIs are relative to https://api.irisnet.de, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**checkImage()**](AICheckOperationsApi.md#checkImage) | **POST** /v2/check-image/{configId} | Check an image with the AI. |
| [**checkStream()**](AICheckOperationsApi.md#checkStream) | **POST** /v2/check-stream/{configId} | Check a stream with the AI. |
| [**checkVideo()**](AICheckOperationsApi.md#checkVideo) | **POST** /v2/check-video/{configId} | Check a video with the AI. |


## `checkImage()`

```php
checkImage($config_id, $url, $data, $detail, $image_encode): \Irisnet\APIV2\Client\Model\CheckResult
```

Check an image with the AI.

The response (_CheckResult_ schema) is returned immediately after the request.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\AICheckOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$config_id = 'config_id_example'; // string | The configuration id from the Basic Configuration operations.
$url = 'url_example'; // string | <s>The url to the image that needs to be checked.</s> Deprecated: Use 'data' parameter instead. <b>This parameter will be removed in future releases.</b>
$data = 'data_example'; // string | The http(s) url or base64 encoded data uri of the image that needs to be checked.
$detail = 1; // int | Set the detail level of the response.  * _1_ - The response only contains the _Summary_ and possibly the _Encoded_ schemas for basic information's (better API performance). * _2_ - Additionally lists all broken rules (_BrokenRule_ schema) according to the configuration parameters that were requested. * _3_ - Also shows detections (e.g. _BaseDetection_ schema) that contains extended features to each found object.
$image_encode = false; // bool | Specifies whether or not to draw an output image that will be delivered in the response body as base64 encoded string. The _Encoded_ schema will be available in the response.

try {
    $result = $apiInstance->checkImage($config_id, $url, $data, $detail, $image_encode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AICheckOperationsApi->checkImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **config_id** | **string**| The configuration id from the Basic Configuration operations. | |
| **url** | **string**| &lt;s&gt;The url to the image that needs to be checked.&lt;/s&gt; Deprecated: Use &#39;data&#39; parameter instead. &lt;b&gt;This parameter will be removed in future releases.&lt;/b&gt; | [optional] |
| **data** | **string**| The http(s) url or base64 encoded data uri of the image that needs to be checked. | [optional] |
| **detail** | **int**| Set the detail level of the response.  * _1_ - The response only contains the _Summary_ and possibly the _Encoded_ schemas for basic information&#39;s (better API performance). * _2_ - Additionally lists all broken rules (_BrokenRule_ schema) according to the configuration parameters that were requested. * _3_ - Also shows detections (e.g. _BaseDetection_ schema) that contains extended features to each found object. | [optional] [default to 1] |
| **image_encode** | **bool**| Specifies whether or not to draw an output image that will be delivered in the response body as base64 encoded string. The _Encoded_ schema will be available in the response. | [optional] [default to false] |

### Return type

[**\Irisnet\APIV2\Client\Model\CheckResult**](../Model/CheckResult.md)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `checkStream()`

```php
checkStream($config_id, $in_url, $out_url, $cycle_length, $check_rate): \Irisnet\APIV2\Client\Model\CheckResult[]
```

Check a stream with the AI.

The body is continuously send per JSON stream until completion of the video stream. Only then the full _CheckResult_ schema will be shown (past _Events_ omitted).  <b>NOTICE: Depending on your configuration and parameters this operation can be quite expensive on your credit balance.<b>  <b>WARNING: Please do not use the 'Try it out' for this operation. The browser is not able to refresh the response preview until the completion of the video stream.<b>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\AICheckOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$config_id = 'config_id_example'; // string | The configuration id from the Basic Configuration operations.
$in_url = 'in_url_example'; // string | The URL of the video stream that the AI should check.
$out_url = 'out_url_example'; // string | The URL of where the AI should send the encoded stream.
$cycle_length = 500; // int | Determine how often (value in milliseconds) the the AI should give a feedback.
$check_rate = 0; // int | The milliseconds between each AI check. E.g. The AI will check 1 frame per second when checkRate is set to '1000'.

try {
    $result = $apiInstance->checkStream($config_id, $in_url, $out_url, $cycle_length, $check_rate);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AICheckOperationsApi->checkStream: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **config_id** | **string**| The configuration id from the Basic Configuration operations. | |
| **in_url** | **string**| The URL of the video stream that the AI should check. | |
| **out_url** | **string**| The URL of where the AI should send the encoded stream. | [optional] |
| **cycle_length** | **int**| Determine how often (value in milliseconds) the the AI should give a feedback. | [optional] [default to 500] |
| **check_rate** | **int**| The milliseconds between each AI check. E.g. The AI will check 1 frame per second when checkRate is set to &#39;1000&#39;. | [optional] [default to 0] |

### Return type

[**\Irisnet\APIV2\Client\Model\CheckResult[]**](../Model/CheckResult.md)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/x-ndjson`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `checkVideo()`

```php
checkVideo($config_id, $url, $config, $detail, $image_encode, $check_rate)
```

Check a video with the AI.

An empty response is returned immediately. The actual body (_CheckResult_ schema) is send to the _callbackUrl_ after the AI has finished processing.  <b>NOTICE: Depending on your configuration and parameters this operation can be quite expensive on your credit balance.<b>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: LICENSE-KEY
$config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKey('LICENSE-KEY', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Irisnet\APIV2\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('LICENSE-KEY', 'Bearer');


$apiInstance = new Irisnet\APIV2\Client\Api\AICheckOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$config_id = 'config_id_example'; // string | The configuration id from the Basic Configuration operations.
$url = 'url_example'; // string | The url to the video that needs to be checked.
$config = {"callbackUrl":"http://www.example.com/callback?video","headers":{"Authorization":"Basic Rm9yemEgTmFwb2xpLCBzZW1wcmUh"}}; // \Irisnet\APIV2\Client\Model\Config
$detail = 1; // int | Set the detail level of the response.  * _1_ - The response only contains the _Summary_ and possibly the _Encoded_ schemas for basic information's (better API performance). * _2_ - Additionally lists all broken rules (_BrokenRule_ schema) according to the configuration parameters that were requested. * _3_ - Also shows events (_Event_ schema) that contains extended features to each found object.
$image_encode = false; // bool | Specifies whether or not to draw an output video that can be downloaded afterwards. The _Encoded_ schema will be available in the response.
$check_rate = 0; // int | The milliseconds between each AI check. E.g. The AI will check 1 frame per second when checkRate is set to '1000'.

try {
    $apiInstance->checkVideo($config_id, $url, $config, $detail, $image_encode, $check_rate);
} catch (Exception $e) {
    echo 'Exception when calling AICheckOperationsApi->checkVideo: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **config_id** | **string**| The configuration id from the Basic Configuration operations. | |
| **url** | **string**| The url to the video that needs to be checked. | |
| **config** | [**\Irisnet\APIV2\Client\Model\Config**](../Model/Config.md)|  | |
| **detail** | **int**| Set the detail level of the response.  * _1_ - The response only contains the _Summary_ and possibly the _Encoded_ schemas for basic information&#39;s (better API performance). * _2_ - Additionally lists all broken rules (_BrokenRule_ schema) according to the configuration parameters that were requested. * _3_ - Also shows events (_Event_ schema) that contains extended features to each found object. | [optional] [default to 1] |
| **image_encode** | **bool**| Specifies whether or not to draw an output video that can be downloaded afterwards. The _Encoded_ schema will be available in the response. | [optional] [default to false] |
| **check_rate** | **int**| The milliseconds between each AI check. E.g. The AI will check 1 frame per second when checkRate is set to &#39;1000&#39;. | [optional] [default to 0] |

### Return type

void (empty response body)

### Authorization

[LICENSE-KEY](../../README.md#LICENSE-KEY)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
