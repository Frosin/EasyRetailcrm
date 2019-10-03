Библиотека для разработки скриптов на основе api RetailCRM.
Поддержка:
- логирование Monolog,
- backup данных,
*Для добавления новой модели:
- Вписываем новую модуль в файл EasyRetailcrm/Library/EasyRequest/methods.xml
- Добавляем вызов класса в функции 'getClassByName' файла EasyRetailcrm/Library/EasyRequest/EasyRequest.php

Пример использования:

composer require frosin/easyretailcrm:dev-master

```

if (file_exists('vendor')) {
    require realpath(__DIR__ . '/vendor/autoload.php');
} else {
    require realpath(__DIR__ . '/../vendor/autoload.php');
}

use EasyRetailcrm\Library\EasyRequest\EasyRequest;
use EasyRetailcrm\Library\Library;
use RetailCrm\ApiClient;
use EasyRetailcrm\LoggerCustomizer\LoggerCustomizer;
use EasyRetailcrm\Backup\Backup;

try {
    $apiClient = new ApiClient("https://demo.retailcrm.ru", "pUtYoUrApIkEyHeRe", ApiClient::V5);
    $frameWork = new Library($apiClient);
    
    $log = new LoggerCustomizer('prefix');
    $backup = new Backup();

    $ordersRequest = new EasyRequest("ordersList");
    $ordersRequest->requestFilter->set('ids', ['33463']);
    $ordersResult = $frameWork->easyGet($ordersRequest, true);

    $customersRequest = new EasyRequest("customersList");
    $customersRequest->requestFilter->set('ids', ['5069']);
    $customersResult = $frameWork->easyGet($customersRequest, true);

    $log->info("its test notice: customers and orders", $customersResult, $ordersResult);

    $backup->make("test-customer", $customersResult, $ordersResult);
    print_r($backup->loadLast("test"));
} catch (\Exception $e) {
    echo $e . "\n";
}
```
Создание заказа:
```
    $order = new Order;
    $order
        ->set('email', "testk@mail.ru")
        ->set('firstName', "testFFF")
        ->set('lastName', "teskLLL");
    $id = $frameWork->orderCreate($order);
```
Изменение заказа:
```
    $order = new Order;
    $order
        ->set('id', 33468)
        ->set('email', "testk@mail.ru")
        ->set('firstName', "testFFF")
        ->set('lastName', "teskLLL");
    $frameWork->orderEdit($order);
```