# WooCommerce ERP Products Plugin
Este plugin permite obtener productos desde una API externa y mostrarlos en tu tienda WooCommerce sin guardar los datos en la base de datos de WordPress. También envía la información de la orden a otra API después de que el pago con tarjeta sea aprobado.

## Características
Obtiene productos desde una API externa y los muestra en tu tienda WooCommerce.
No almacena los datos de los productos en la base de datos de WordPress.
Agrega un menú de configuración en el panel de administración de WordPress para ingresar las credenciales de API.
Envía la información de la orden a otra API después de que el pago con tarjeta sea aprobado.

## Requisitos
WordPress 5.0 o superior.
WooCommerce 5.0 o superior.
PHP 7.2 o superior.

## Instalación
Sube el directorio woocommerce-erp-products a la carpeta /wp-content/plugins/ de tu instalación de WordPress.
Activa el plugin a través del menú 'Plugins' en WordPress.
Configura las credenciales de API en el menú 'WooCommerce > API Products Settings'.

## Uso
### Mostrar productos
Para mostrar los productos obtenidos de la API en tu tienda WooCommerce, utiliza el shortcode [wcap_products] en una página o publicación.

### Envío de la orden
Después de que el pago con tarjeta sea aprobado, el plugin enviará automáticamente la información de la orden a otra API. La URL de la API debe configurarse en el menú 'WooCommerce > API Products Settings'.

##Estructura de la API
El plugin espera que la API de productos devuelva los datos en formato JSON con la siguiente estructura:
```
{
  "m_product_id": "1005345",
  "value": "06-11-0005",
  "name": "21049-150-000, UNION UNIVERSAL LISA DE 1 1/2'' PVC",
  "fabricator": "CMP",
  "pricelist": "68.00",
  "pricelimit": "65.00",
  "warehouse": "DISTRIBUCIÓN ZONA 9",
  "actual_stock": "104",
  "imageurl": "http://erp.iflexsoftware.com/images/livehydrosolar/products/2958.jpg",
  "d_pricelist": "68.00",
  "d_pricelimit": "47.58",
  "stock_ph": "10",
  "stock_paneles": "3"
}
```
La API de envío de la orden debe aceptar los datos en formato JSON con la siguiente estructura:
```
{
  "id": 123,
  "number": "123",
  "currency": "USD",
  "total": "100.00",
  "subtotal": "80.00",
  "total_tax": "20.00",
  "shipping_total": "10.00",
  "customer": {
    "id": 456,
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.doe@example.com",
    "phone": "555-555-5555"
  },
  "billing_address": {
    "first_name": "John",
    "last_name": "Doe",
    "company": "Example Company",
    "address_1": "123 Main St",
    "address_2": "Apt 456",
    "city": "Anytown",
    "state": "CA",
    "postcode": "12345",
    "country": "US"
  },
  "shipping_address": {
    "first_name": "John",
    "last_name": "Doe",
    "company": "Example Company",
    "address_1": "123 Main St",
    "address_2": "Apt 456",
    "city": "Anytown",
    "state": "CA",
    "postcode": "12345",
    "country": "US"
  },
  "line_items": [
    {
      "id": 789,
      "name": "Product 1",
      "sku": "PROD-123",
      "quantity": 2,
      "price": "40.00"
    },
    {
      "id": 1011,
      "name": "Product 2",
      "sku": "PROD-456",
      "quantity": 1,
      "price": "40.00"
    }
  ]
}
```
Adapta la estructura JSON según las necesidades específicas de tu proyecto y las APIs utilizadas.
## Créditos
Carlos Vargas
