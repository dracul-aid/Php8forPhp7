# Unit тесты

## Запуск конкретного теста

Запускает тесты из указанного класса (пример)
```bash
php tests/run.php tests/InterfacesTest.php
```

Запуск теста, с очисткой предыдущего результата в консоли (пример)
```bash
php clear && tests/run.php tests/InterfacesTest.php
```

## Запуск всех тестов

```bash
php tests/run.php tests
```

Запуск теста, с очисткой предыдущего результата в консоли
```bash
clear && php tests/run.php tests
```

## Docker для тестов

`docker-compose.yml` содержит все необходимое для проведения тестирования (PHP 7.4.x)

```
cd phpmocker/tests
docker-compose build
docker-compose up
```