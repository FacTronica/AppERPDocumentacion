# 📦 Modelos Base

## 🎯 Finalidad de un Modelo Base

La finalidad de los **Modelos Base** es disponer de un **array estandarizado** con los **2 campos principales** de todos los registros de cada tabla.  
Este array se utiliza como índice y valor en los **objetos HTML `<select>`**.

- 🔑 **Índice:** Campo con ID único de la tabla (ej: `id_comuna`)
- 📝 **Valor:** Campo con Nombre o Descripción del registro (ej: `nombre`)

---

## 🛠️ Crear Modelos Base

En cada carpeta de los módulos de la aplicación se debe crear un archivo con el formato del modelo base y luego reemplazar las variables correspondientes.

📂 **Ejemplo de ruta de archivo:**

```bash
app/modulo/modelo/modelo_nnn.php
```

- **modulo:** corresponde al nombre de la carpeta del módulo (ej: `compras_mantencion_centroscosto`)
- **nnn:** corresponde al nombre del módulo (ej: `centroscosto`)

✅ De acuerdo a esto, el nombre final del archivo será:

```bash
compras_mantencion_centroscosto/modelo/modelo_centroscosto.php
```

---

### 🚀 Paso 1: Crear archivo

```bash
ventas_mantencion_clientes/modelo/modelo_clientes.php
```

---

### 🚀 Paso 2: Insertar contenido inicial

Dentro del archivo `modelo_clientes.php` copiar el siguiente contenido:

```php
<?php
#
# MÓDULO: ???
# CARPETA: ???
#
# ENDPOINT DE CONSULTA
$endpoint_modelo = "???";
#
# CREAR ARRAY CON LA PETICION
$peticion_array = array(
    "token" => $config["token"],
    "id_sesion" => $datos_recibidos["id_sesion"],
    "metodo" => "consultar",
    "select" => "???",
    "where" => "???",
    "orderby" => "???",
    "ordertype" => "asc",
    "limit" => 999999,
);
#
# ENVIAR PETICION AL SERVIDOR
$respuesta_json = EnviarDatosJson($config["puerto"],  $config["url_api"] . "/" . $endpoint_modelo . "/index.php", $peticion_array);
#
# TRANSFORMAR RESPUESTA EN ARRAY
$respuesta_array  = json_decode($respuesta_json, true);
#
# OBTENER DATOS
$respuesta_array_datos = $respuesta_array["datos"];
#
# CREAR ARRAY MAESTRO
$??? = [];
#
# RECORRER FILAS DE DATOS
foreach ($respuesta_array_datos as $fila_temporal) {
    $???[$fila_temporal['???']] = $fila_temporal['???'];
}
?>
```

---

### 🚀 Paso 3: Reemplazar variables

En este paso se deben modificar todas las variables donde aparezca `???`.  
🔧 Finalmente guardar los cambios y subir al servidor.

---

### 🚀 Paso 4: Crear Test Unitario

Editar el archivo:

```bash
app/ayuda_modelos_base/vista/modulo.php
```

E incluir el modelo:

```php
# retorna $???[]  // modificar
include("../../???/modelo/modelo_???.php"); // modificar
```

🔗 Luego agregar el objeto al **test unitario de modelos base**:

```php
<div class="row">
    <?php
    echo $objetosHtml->CampoSelect(
        "???",
        "???",
        $???,
        $valor = "",
        $disabled = false,
        $required = true,
        "col-12 col-md-6 col-lg-3",
        "row"
    );
    ?>
</div>
```

---

### 🚀 Paso 5: Ejecutar Test Unitario

1. Abrir la **ventana lateral derecha (aside)**
2. Seleccionar **Test Unitario Modelos Base**
3. Verificar que el **menú desplegable `<select>`** muestre correctamente los datos.

---

## 📌 Ejemplo Real: Modelo de Comunas

### 📂 Paso 1: Crear Archivo

```bash
parametros_tablas_comunas/modelo/modelo_comunas.php
```

### 📄 Paso 2: Insertar contenido inicial

```php
<?php
#
# MÓDULO: ???
# CARPETA: ???
#
# ENDPOINT DE CONSULTA
$endpoint_modelo = "???";
#
# CREAR ARRAY CON LA PETICION
$peticion_array = array(
    "token" => $config["token"],
    "id_sesion" => $datos_recibidos["id_sesion"],
    "metodo" => "consultar",
    "select" => "???",
    "where" => "???",
    "orderby" => "???",
    "ordertype" => "asc",
    "limit" => 999999,
);
$respuesta_json = EnviarDatosJson($config["puerto"],  $config["url_api"] . "/" . $endpoint_modelo . "/index.php", $peticion_array);
$respuesta_array  = json_decode($respuesta_json, true);
$respuesta_array_datos = $respuesta_array["datos"];
$??? = [];
foreach ($respuesta_array_datos as $fila_temporal) {
    $???[$fila_temporal['???']] = $fila_temporal['???'];
}
?>
```

### 🛠️ Paso 3: Reemplazar Variables

```php
<?php
# MÓDULO: comunas
# CARPETA: parametros_tablas_comunas

$endpoint_modelo = "parametros_tablas_comunas";

$peticion_array = array(
    "token" => $config["token"],
    "id_sesion" => $datos_recibidos["id_sesion"],
    "metodo" => "consultar",
    "select" => "id,nombre",
    "where" => "id>'0'",
    "orderby" => "nombre",
    "ordertype" => "asc",
    "limit" => 999999,
);

$respuesta_json = EnviarDatosJson($config["puerto"],  $config["url_api"] . "/" . $endpoint_modelo . "/index.php", $peticion_array);
$respuesta_array  = json_decode($respuesta_json, true);
$respuesta_array_datos = $respuesta_array["datos"];

$ModeloComunas = [];
foreach ($respuesta_array_datos as $fila_temporal) {
    $ModeloComunas[$fila_temporal['id']] = $fila_temporal['nombre'];
}
?>
```

### ✅ Paso 4: Crear Test Unitario

Editar el archivo:

```bash
app/ayuda_modelos_base/vista/modulo.php
```

E incluir el modelo:

```php
# retorna $???[]  // modificar
include("../../???/modelo/modelo_???.php"); // modificar
```

```php
<div class="row">
    <?php
    echo $objetosHtml->CampoSelect(
        "COMUNA",
        "id_comuna",
        $ModeloComunas,
        $valor = "",
        $disabled = false,
        $required = true,
        "col-12 col-md-6 col-lg-3",
        "row"
    );
    ?>
</div>
```

### ✅ Paso 5: Ejecutar Test Unitario

- Abrir la **ventana lateral derecha (aside)**
- Seleccionar **Test Unitario Modelos Base**
- Confirmar que el desplegable de **comunas** funciona correctamente.

---

## 💡 Tips & Buenas Prácticas

- 📑 Nombrar los archivos todo en minusculas (`modelo_modulo.php`).
- 📑 Nombrar los modelos siempre inicial con mayúsculas ej. (`ModeloComunas`).
- 🧪 Siempre agregar a los **tests unitarios** para validar funcionamiento.

---

✍️ Autor: **Equipo de Desarrollo ERP Factrónica**  
📅 Última actualización: 24 Agosto 2025
