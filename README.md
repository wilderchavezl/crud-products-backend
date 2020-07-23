# crud-products-backend

Los servicios se realizaron en PHP con el uso del Framework Slim en su versión 3 y la base de datos en MySQL.


Servicios:
* Products
```TypeScript
interface Body {
    name: string;
    brand?: string;
    price: double;
    stock: int;
}
```
```TypeScript
interface Response {
    id: int;
    name: string;
    brand?: string;
    price: double;
    stock: int;
}
```