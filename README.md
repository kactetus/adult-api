# Porn Search Aggregation
> This project aims to allow for a simple way to query multiple "Tube" type porn sites with a simple api

## Usage
```php
<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Porn\Aggregator\SearchReactor as SearchReactor;
use Porn\Provider\ServiceFactory as ServiceFactory;

$factory = new ServiceFactory;
$reactor = new SearchReactor($factory);
$results = $reactor->search('blonde');

print_r($results);
```
