# Explicación de la Autenticación (Líneas 23 en adelante)

Este bloque de código se ejecuta cuando las credenciales del usuario coinciden con la base de datos (es decir, cuando `$registro` contiene información válida). Es el proceso donde "oficialmente" se le da acceso al sistema al usuario. 

Aquí tienes la explicación línea por línea de lo que sucede:

```php
    if ($registro) {
```
**Comprueba si se encontró al usuario:** Si la variable `$registro` tiene datos, significa que la consulta SQL encontró un usuario con ese nombre y contraseña exactos. Si es así, se ejecuta todo el bloque interno.

```php
        session_regenerate_id(true); 
```
**Seguridad Anti-Hackeo (Session Fixation):** Esta es una medida de seguridad muy importante. Cambia el identificador único de la sesión PHP por uno nuevo (pero mantiene los datos que tenías). El `true` sirve para eliminar el identificador viejo por completo. Esto evita ataques donde un hacker intenta predecir o "fijar" el ID de sesión para robar la cuenta de un usuario recién logueado.

```php
        $_SESSION['usuario'] = $usuario;
```
**Guarda los datos en sesión:** Se crea una variable súper global (`$_SESSION`) llamada `usuario`. Al guardar este dato del lado del servidor, el resto de tus páginas (como `first.php` o `altas.php`) podrán comprobar si esta variable existe para saber si el usuario de verdad está logueado y cuál es su nombre.

```php
        $_SESSION["ultimo_acceso"] = time(); 
```
**Registro de tiempo:** Se guarda la marca de tiempo (timestamp) actual indicando el segundo exacto en el que el usuario inició la sesión. Esto se suele usar por si después quieres hacer que la sesión caduque por inactividad tras varios minutos.

```php
        if (isset($_POST["recordar"])){
```
**Verifica el Checkbox:** Pregunta si el usuario marcó la casilla de verificación en el formulario que decía "Mantener sesión iniciada" (cuyo `name` en HTML es "recordar").

```php
            $token = bin2hex(random_bytes(16));
```
**Crea un Token Seguro:** Si marcó la casilla, genera una cadena aleatoria y criptográficamente muy segura de 32 caracteres (16 bytes en formato hexadecimal). Esto servirá como una "llave" temporal única.

```php
            $queryUpdate = "UPDATE usuarios SET token = :token WHERE name = :usuario";
            $stmtUpdate = $pdo->prepare($queryUpdate);
            $stmtUpdate->execute([':token' => $token, ':usuario' => $usuario]);
```
**Guarda el Token en la Base de Datos:** Prepara y ejecuta una consulta a tu base de datos para actualizar la columna `token` de ese usuario específico y guardar la llave que acabamos de generar arriba.

```php
            setcookie("token", $token, time() + (60*60*24*30), "/", "", false, true); 
            setcookie("usuario", $usuario, time() + (60*60*24*30), "/", "", false, true);
        }
```
**Envía las Cookies al Navegador:** Ordena al navegador del usuario que guarde dos galletas (cookies). Una con el `token` seguro y otra con su nombre de `usuario`. 
*   La parte de `time() + (60*60*24*30)` indica que **durarán 30 días** antes de borrarse.
*   El último parámetro `true` las marca como *HttpOnly*, lo que significa que el JavaScript malicioso no podrá leerlas si hay un ataque XSS (Cross-Site Scripting).

```php
        header("Location: first.php"); 
        exit();
```
**Redirección y Cierre:** Finalmente, envía una cabecera HTTP (Header) al navegador diciéndole: "¡Todo salió bien! Ahora envíalo de inmediato a `first.php`" (el dashboard de recetas). El comando `exit()` detiene inmediatamente la ejecución de cualquier código que esté debajo para asegurar que el usuario sea redirigido forzosamente.
