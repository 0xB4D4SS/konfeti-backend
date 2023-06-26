## SweetSweets

### Локальное развертывание

- запустить контейнеры:
```shell
cd docker
docker compose up -d или docker-compose up -d
cd mysql
docker cp db.txt konfeti_mysql:/var/tmp/db.txt
docker exec -ti konfeti_mysql 'mysql -u root -ptest konfeti < /var/tmp/db.txt'
```
- добавить в hosts:
```shell
127.0.0.1 konfeti.test
```

### API

- добавить в корзину товар с заданным айди (поштучно)
```http request
GET http://konfeti.test/php?method=addToCart&id=
```
- удалить из корзины товар с заданным айди (поштучно)
```http request
GET http://konfeti.test/php?method=removeFromCart&id=
```
- создать заказ из имеющейся корзины с заданными именем и емейлом покупателя
```http request
GET http://konfeti.test/php?method=createOrder&name=test&email=loh@test.com
```
- удалить заказ с заданным айди
```http request
GET http://konfeti.test/php?method=deleteOrder&id=
```
- получить все заказы (для админов?)
```http request
GET http://konfeti.test/php?method=getOrders
```
- получить заказ по айди
```http request
GET http://konfeti.test/php?method=getOrder&id=
```
- получить все доступные продукты
```http request
GET http://konfeti.test/php?method=getProducts
```
- получить свою текущую корзину
```http request
GET http://konfeti.test/php?method=getCart
```