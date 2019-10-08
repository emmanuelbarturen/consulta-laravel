<p align="center"><img src="https://consulta.pe/img/logo_consulta_pe.png"> </p>

<p align="center">
<a href="https://travis-ci.com/consulta/consulta-laravel"><img src="https://travis-ci.com/consulta/consulta-laravel.svg?branch=master" alt="Build Status"></a>

</p>

# Paquete Oficial para Laravel 
### Para Laravel < 5.5,otros frameworks o standalone, use el SDK [RENIEC-PHP](https://github.com/tecactus/reniec-php) o [SUNAT-PHP](https://github.com/tecactus/sunat-php)!!

## Instalación
Instalar usando composer:

```bash
   composer require consulta/laravel
```

O agregar la siguiente línea a tu archivo composer.json:

```
   "require": {
       ...
       "consulta/laravel": "1.*"
       ...
   }
```
## Configuración

### servicio consulta

agregar en `config/services.php` la siguiente entrada

 ```bash
 'consulta' => [
          'token' => env('CONSULTA_TOKEN')
       ],
```
    
### variable de entorno

agregar al `.env` la siguiente entrada:

 ```bash
CONSULTA_TOKEN=<tu-token-de-acceso>
```

** Puedes generar tu token registrándote en la web de [consulta.pe](https://consulta.pe/auth/register)

## Uso

### Consulta Persona
```php
use Consulta\Laravel\Consulta;

$person = Consulta::reniec()->find('43989177');

// respuesta:
array:6 [▼
  "dni" => "43989177"
  "nombres" => "CARLOS EMMANUEL"
  "apellido_paterno" => "CERVERA"
  "apellido_materno" => "BARTUREN"
  "caracter_verificacion" => "2"
  "caracter_verificacion_anterior" => null
]

```

### Consulta Empresa

#### Por DNI
```php
use Consulta\Laravel\Consulta;

$companybyDni = Consulta::sunat()->byDni('46126030');

//respuesta
array:12 [▼
  "ruc" => 10461260301
  "razon_social" => "VIDAL LUJAN PAUL EDWIN"
  "tipo_contribuyente" => "PERSONA NATURAL SIN NEGOCIO"
  "nombre_comercial" => "SERVICIOS MÚLTIPLES DMC"
  "fecha_inscripcion" => "16-09-2009"
  "fecha_inicio_actividades" => "01-10-2009"
  "estado_contribuyente" => "ACTIVO"
  "condicion_contribuyente" => "HABIDO"
  "direccion" => "-"
  "sistema_emision_comprobante" => "MANUAL"
  "actividad_comercio_exterior" => "SIN ACTIVIDAD"
  "sistema_contabilidad" => "MANUAL"
]
```

### Por RUC

```php
use Consulta\Laravel\Consulta;

$company = Consulta::sunat()->byRuc('20601772541');

//consulta
array:12 [▼
  "ruc" => 20601772541
  "razon_social" => "TECACTUS S.A.C."
  "tipo_contribuyente" => "SOCIEDAD ANONIMA CERRADA"
  "nombre_comercial" => "-"
  "fecha_inscripcion" => "03-01-2017"
  "fecha_inicio_actividades" => "03-01-2017"
  "estado_contribuyente" => "ACTIVO"
  "condicion_contribuyente" => "HABIDO"
  "direccion" => "CAL.TRES NRO. 231 DPTO. 613 URB. JACARANDA LIMA - LIMA - SAN BORJA"
  "sistema_emision_comprobante" => "MANUAL/COMPUTARIZADO"
  "actividad_comercio_exterior" => "IMPORTADOR/EXPORTADOR"
  "sistema_contabilidad" => "MANUAL/COMPUTARIZADO"
]
```

## Reglas de validación Disponibles

 - [`IsValidDNIDigit`](#isvaliddnidigit)
 - [`IsValidDNI`](#isvaliddni)
 - [`IsValidRUC`](#isvalidruc)
 
 
### `IsValidDNIDigit`

Determina si el dígito de verificación corresponde al dni ingresado

```php
// in a `FormRequest` 

public function rules()
{
    return [
        'dni' => "required|size:8",
        'validation_digit' => ['required','size:1',new IsValidDNIDigit($this->dni)],
    ];
}
```
### `IsValidDNI`
Determina si el número de DNI ingresado pertenece a un peruano mayor de edad

```php
// in a `FormRequest` 

public function rules()
{
    return [
        'dni' => ['required','size:1',new IsValidDNI()],
    ];
}
```

### `IsValidRUC`

Determina si el número de RUC ingresado pertenece a una empresa registrada en la Superintendencia Nacional de Aduanas y de Administración Tributaria (SUNAT).


#### parámetros:
 
La clase IsValidRUC admite un único parametro, cuando es ``true`` valida además que la empresa esté activa y habida.  


```php
// in a `FormRequest` 

public function rules()
{
    return [
        'ruc' => ['required','size:11',new IsValidRUC(true)],
    ];
}
```

## Docs
Para mayor información consulta la documentación de [consulta.pe](https://consulta.pe/) para:

 - [Identidad de personas](https://consulta.pe/identidad-personas)
 - [Datos Corporativos](https://consulta.pe/datos-corporativos)

