# PetstoreClient\StoreApi

All URIs are relative to https://petstore.swagger.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**deleteOrder()**](StoreApi.md#deleteOrder) | **DELETE** /store/order/{orderId} | Delete purchase order by ID |
| [**getInventory()**](StoreApi.md#getInventory) | **GET** /store/inventory | Returns pet inventories by status |
| [**getOrderById()**](StoreApi.md#getOrderById) | **GET** /store/order/{orderId} | Find purchase order by ID |
| [**placeOrder()**](StoreApi.md#placeOrder) | **POST** /store/order | Place an order for a pet |


## `deleteOrder()`

```php
deleteOrder($order_id)
```

Delete purchase order by ID

For valid response try integer IDs with positive integer value. Negative or non-integer values will generate API errors

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new PetstoreClient\Api\StoreApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of the order that needs to be deleted

try {
    $apiInstance->deleteOrder($order_id);
} catch (Exception $e) {
    echo 'Exception when calling StoreApi->deleteOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_id** | **int**| ID of the order that needs to be deleted | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getInventory()`

```php
getInventory(): array<string,int>
```

Returns pet inventories by status

Returns a map of status codes to quantities

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = PetstoreClient\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = PetstoreClient\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');


$apiInstance = new PetstoreClient\Api\StoreApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getInventory();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StoreApi->getInventory: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**array<string,int>**

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrderById()`

```php
getOrderById($order_id): \PetstoreClient\Model\Order
```

Find purchase order by ID

For valid response try integer IDs with value >= 1 and <= 10. Other values will generated exceptions

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new PetstoreClient\Api\StoreApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$order_id = 56; // int | ID of pet that needs to be fetched

try {
    $result = $apiInstance->getOrderById($order_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StoreApi->getOrderById: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_id** | **int**| ID of pet that needs to be fetched | |

### Return type

[**\PetstoreClient\Model\Order**](../Model/Order.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `placeOrder()`

```php
placeOrder($body): \PetstoreClient\Model\Order
```

Place an order for a pet

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new PetstoreClient\Api\StoreApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \PetstoreClient\Model\Order(); // \PetstoreClient\Model\Order | order placed for purchasing the pet

try {
    $result = $apiInstance->placeOrder($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StoreApi->placeOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body** | [**\PetstoreClient\Model\Order**](../Model/Order.md)| order placed for purchasing the pet | |

### Return type

[**\PetstoreClient\Model\Order**](../Model/Order.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
