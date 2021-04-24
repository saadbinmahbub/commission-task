# Commission Fee Calculation
##Install Application
`composer install`
##Run tests
`composer run test`
##Run the system
`php index.php transactions.csv`

`transactions.csv` is a csv file provided with the `src` 

##Description
###`config.php`
The `config.php` class contains various configurations of the application
eg: base currency can be changed from here.
### Clients
The system has 2 types of Clients `BusinessClient` and `PrivateClient`,
both classes inherit from the `Client` class.
The Client objects are generated using the Factory Pattern 
`ClientFactory` is the factory class.

###The `App` DI container
`App` implements a simple Dependency Injection container.
It helps various classes to fetch dependencies like configuration and objects

### `bootstrap.php`
The `bootstrap.php` class binds dependencies of the application using `App` class.
Dependencies bound to the application:
1. `config.php`
2. The transactions are parsed from the `csv`
3. `APIExchangeRate` object 

