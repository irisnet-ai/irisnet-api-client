# OpenAPIClient-php

Artificial Intelligence (AI) for image- and video-processing in real-time. This is an interactive documentation where you can quickly look up the endpoints and their schemas, while having the opportunity to try things out for yourself.

In the list below, you can see the available endpoints of the API, which can be expanded by clicking on them. Each expanded endpoint lists the request parameters (if available) and the request body (if available). The request body can list some example bodies and the schema, explaining each model in detail.

Additionally you'll find a 'Try it out' button that allows you to enter your custom parameters and custom body and execute that against the API. <b>Be sure to enter your license key to authorize the requests before using this documentation interactively.</b>

The responses section in the expanded endpoint lists the possible responses with their corresponding status codes. If you've executed an API call it will also show you the response from the server.

Underneath the endpoints you'll find the model schemas. These are the models used for the requests and responses. If you click on the right arrow, you can expand the model and get a description of the model and the model parameters. For nested models, you can keep clicking the right arrow for further details.

Clicking the link below the title at the top of this page opens the [OpenAPI specification](https://swagger.io/specification/) (OAS3) in JSON format. The OAS3 Spec allows the generation of clients in many programming languages. There are several free client generators available that can be used to get started easily.

For more information, please visit [https://irisnet.de/subscribe/](https://irisnet.de/subscribe/).

## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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

## API Endpoints

All URIs are relative to *https://api.irisnet.de*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AICheckOperationsApi* | [**checkImage**](docs/Api/AICheckOperationsApi.md#checkimage) | **POST** /v2/check-image/{configId} | Check an image with the AI.
*AICheckOperationsApi* | [**checkStream**](docs/Api/AICheckOperationsApi.md#checkstream) | **POST** /v2/check-stream/{configId} | Check a stream with the AI.
*AICheckOperationsApi* | [**checkVideo**](docs/Api/AICheckOperationsApi.md#checkvideo) | **POST** /v2/check-video/{configId} | Check a video with the AI.
*BalanceEndpointsApi* | [**getCost**](docs/Api/BalanceEndpointsApi.md#getcost) | **GET** /v2/cost/{configId} | Get the cost of the configuration for a single image.
*BalanceEndpointsApi* | [**getLicenseInfo**](docs/Api/BalanceEndpointsApi.md#getlicenseinfo) | **GET** /v2/info/ | Get information for the given license key.
*BalanceEndpointsApi* | [**getVideoCost**](docs/Api/BalanceEndpointsApi.md#getvideocost) | **GET** /v2/cost/{configId}/{frames} | Get the cost of the configuration for moving images.
*BalanceEndpointsApi* | [**getVideoCost1**](docs/Api/BalanceEndpointsApi.md#getvideocost1) | **GET** /v2/cost/{configId}/{fps}/{duration} | Get the cost of the configuration for moving images.
*ConfigurationManagementApi* | [**deleteConfig**](docs/Api/ConfigurationManagementApi.md#deleteconfig) | **DELETE** /v2/config/{configId} | Delete an AI configuration.
*ConfigurationManagementApi* | [**getAllConfigs**](docs/Api/ConfigurationManagementApi.md#getallconfigs) | **GET** /v2/config/ | List all saved AI configurations.
*ConfigurationManagementApi* | [**getConfig**](docs/Api/ConfigurationManagementApi.md#getconfig) | **GET** /v2/config/{configId} | Get a specific AI configuration.
*ConfigurationManagementApi* | [**setConfig**](docs/Api/ConfigurationManagementApi.md#setconfig) | **POST** /v2/config/ | Create a new AI configuration.
*DetailedConfigurationParametersApi* | [**clearParameters**](docs/Api/DetailedConfigurationParametersApi.md#clearparameters) | **DELETE** /v2/config/parameters/{configId} | Delete the parameters of the AI configuration.
*DetailedConfigurationParametersApi* | [**getParameters**](docs/Api/DetailedConfigurationParametersApi.md#getparameters) | **GET** /v2/config/parameters/{configId} | Get the parameters of the AI configuration.
*DetailedConfigurationParametersApi* | [**setParameters**](docs/Api/DetailedConfigurationParametersApi.md#setparameters) | **POST** /v2/config/parameters/{configId} | Set parameters to the given AI configuration.

## Models

- [ApiNotice](docs/Model/ApiNotice.md)
- [BaseAttribute](docs/Model/BaseAttribute.md)
- [BaseDetection](docs/Model/BaseDetection.md)
- [BreastDetection](docs/Model/BreastDetection.md)
- [BrokenRule](docs/Model/BrokenRule.md)
- [CheckResult](docs/Model/CheckResult.md)
- [CheckResultDetectionsInner](docs/Model/CheckResultDetectionsInner.md)
- [Config](docs/Model/Config.md)
- [Coordinates](docs/Model/Coordinates.md)
- [Encoded](docs/Model/Encoded.md)
- [Event](docs/Model/Event.md)
- [FaceDetection](docs/Model/FaceDetection.md)
- [HairAttribute](docs/Model/HairAttribute.md)
- [HairDetection](docs/Model/HairDetection.md)
- [LicenseInfo](docs/Model/LicenseInfo.md)
- [Param](docs/Model/Param.md)
- [ParamSet](docs/Model/ParamSet.md)
- [Pricing](docs/Model/Pricing.md)
- [Rectangle](docs/Model/Rectangle.md)
- [Summary](docs/Model/Summary.md)

## Authorization

Authentication schemes defined for the API:
### LICENSE-KEY

- **Type**: API key
- **API key parameter name**: LICENSE-KEY
- **Location**: HTTP header


## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

info@irisnet.de

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `v2`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
