# spp-backend

Los servicios se realizaron en PHP con el uso del Framework Slim en su versión 3 y la base de datos en MySQL.


Servicios:
* Users
```TypeScript
interface Body {
    email: string;
    password: string;
}
```
```TypeScript
interface Response {
    id: int;
    email: string;
}
```
* Peoples
```TypeScript
interface Body {
    names: string;
    lastnames: string;
    phone: string;
    district: string;
    address: string;
    id_user: int;
}
```
```TypeScript
interface Response {
    id: int;
    names: string;
    lastnames: string;
    phone: string;
    district: string;
    address: string;
    id_user: int;
}
```
* Commerces
```TypeScript
interface Body {
    name: string;
    description?: string;
    ruc?: string;
    district: string;
    address: string;
    id_trader: int;
}
```
```TypeScript
interface Response {
    id: int;
    name: string;
    description?: string;
    ruc?: string;
    district: string;
    address: string;
    id_trader: int;
}
```
* Products
```TypeScript
interface Body {
    name: string;
    description?: string;
    photo?: string;
    price: double;
    type_product: string;
    id_commerce: int;
}
```
```TypeScript
interface Response {
    id: int;
    name: string;
    description?: string;
    photo?: string;
    price: double;
    type_product: string;
    id_commerce: int;
}
```
* Purchase_orders
```TypeScript
interface Body {
    date_order: string;
    date_status: string;
    status: string;
    id_shopper: int;
    id_commerce: int;
}
```
```TypeScript
interface Response {
    id: int;
    date_order: string;
    date_status: string;
    status: string;
    id_shopper: int;
    id_commerce: int;
}
```
* Purchase_orders_details
```TypeScript
interface Body {
    quantity: string;
    total: string;
    id_product: int;
    id_purchase_order: int;
}
```
```TypeScript
interface Response {
    id: int;
    quantity: string;
    total: string;
    id_product: int;
    id_purchase_order: int;
}
```