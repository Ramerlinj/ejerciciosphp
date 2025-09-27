<?php
/*
EJERCICIO 31 - VALORES DE INPUTS EN PHP
=======================================

DOCUMENTACION:
- $_POST: Datos enviados via método POST
- $_GET: Datos enviados via método GET  
- Input text: <input type="text" name="campo">
- Input radio: <input type="radio" name="opcion" value="valor">
- Input checkbox: <input type="checkbox" name="opciones[]" value="valor">
- Select: <select name="lista"><option value="valor">Texto</option></select>
- Textarea: <textarea name="mensaje"></textarea>

VALIDACIONES:
- isset(): Verifica si existe la variable
- empty(): Verifica si está vacía
- htmlspecialchars(): Escapa caracteres especiales
*/

echo "<h2>EJERCICIO 31 - VALORES DE INPUTS</h2>";

// Procesar formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>Datos Recibidos del Formulario</h3>";
    
    // INPUT TEXT
    $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $edad = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
    
    echo "<strong>Datos Personales:</strong><br>";
    echo "Nombre: " . ($nombre ? $nombre : 'No proporcionado') . "<br>";
    echo "Email: " . ($email ? $email : 'No proporcionado') . "<br>";
    echo "Edad: " . ($edad > 0 ? $edad . ' años' : 'No válida') . "<br><br>";
    
    // INPUT RADIO
    $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
    echo "<strong>Género seleccionado:</strong> " . 
         ($genero ? ucfirst($genero) : 'No seleccionado') . "<br><br>";
    
    // INPUT CHECKBOX (múltiples valores)
    $intereses = isset($_POST['intereses']) ? $_POST['intereses'] : [];
    echo "<strong>Intereses seleccionados:</strong><br>";
    if (!empty($intereses)) {
        foreach ($intereses as $interes) {
            echo "- " . htmlspecialchars($interes) . "<br>";
        }
    } else {
        echo "Ningún interés seleccionado<br>";
    }
    echo "<br>";
    
    // SELECT OPTION
    $pais = isset($_POST['pais']) ? $_POST['pais'] : '';
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
    
    echo "<strong>Ubicación:</strong><br>";
    echo "País: " . ($pais ? $pais : 'No seleccionado') . "<br>";
    echo "Ciudad: " . ($ciudad ? $ciudad : 'No seleccionada') . "<br><br>";
    
    // TEXTAREA
    $mensaje = isset($_POST['mensaje']) ? htmlspecialchars($_POST['mensaje']) : '';
    echo "<strong>Mensaje:</strong><br>";
    echo $mensaje ? nl2br($mensaje) : 'Sin mensaje';
    echo "<br><br>";
    
    // Validaciones adicionales
    echo "<h4>Validaciones:</h4>";
    $errores = [];
    
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Email inválido o vacío";
    }
    
    if ($edad <= 0 || $edad > 120) {
        $errores[] = "Edad debe estar entre 1 y 120 años";
    }
    
    if (empty($genero)) {
        $errores[] = "Debe seleccionar un género";
    }
    
    if (!empty($errores)) {
        echo "<span style='color: red;'>Errores encontrados:</span><br>";
        foreach ($errores as $error) {
            echo "- $error<br>";
        }
    } else {
        echo "<span style='color: green;'>Todos los datos son válidos</span><br>";
    }
    
    echo "<hr>";
}
?>

<!-- EJEMPLO 1: Formulario completo con todos los tipos de input -->
<h3>Ejemplo 1: Formulario de Registro</h3>

<form method="POST" action="">
    <fieldset>
        <legend>Información Personal</legend>
        
        <!-- INPUT TEXT -->
        <label for="nombre">Nombre completo:</label><br>
        <input type="text" id="nombre" name="nombre" 
               value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" 
               placeholder="Ingresa tu nombre completo"><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" 
               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
               placeholder="tu@email.com"><br><br>
        
        <label for="edad">Edad:</label><br>
        <input type="number" id="edad" name="edad" min="1" max="120"
               value="<?php echo isset($_POST['edad']) ? $_POST['edad'] : ''; ?>"><br><br>
    </fieldset>
    
    <fieldset>
        <legend>Preferencias</legend>
        
        <!-- INPUT RADIO -->
        <label>Género:</label><br>
        <input type="radio" id="masculino" name="genero" value="masculino"
               <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'masculino') ? 'checked' : ''; ?>>
        <label for="masculino">Masculino</label><br>
        
        <input type="radio" id="femenino" name="genero" value="femenino"
               <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'femenino') ? 'checked' : ''; ?>>
        <label for="femenino">Femenino</label><br>
        
        <input type="radio" id="otro" name="genero" value="otro"
               <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'otro') ? 'checked' : ''; ?>>
        <label for="otro">Otro</label><br><br>
        
        <!-- INPUT CHECKBOX -->
        <label>Intereses (selecciona varios):</label><br>
        <?php 
        $intereses_disponibles = ['programacion', 'deportes', 'musica', 'lectura', 'viajes', 'cocina'];
        $intereses_seleccionados = isset($_POST['intereses']) ? $_POST['intereses'] : [];
        
        foreach ($intereses_disponibles as $interes) {
            $checked = in_array($interes, $intereses_seleccionados) ? 'checked' : '';
            echo "<input type='checkbox' id='$interes' name='intereses[]' value='$interes' $checked>";
            echo "<label for='$interes'>" . ucfirst($interes) . "</label><br>";
        }
        ?>
        <br>
    </fieldset>
    
    <fieldset>
        <legend>Ubicación</legend>
        
        <!-- SELECT OPTION -->
        <label for="pais">País:</label><br>
        <select id="pais" name="pais">
            <option value="">Selecciona un país</option>
            <?php
            $paises = ['españa' => 'España', 'mexico' => 'México', 'argentina' => 'Argentina', 'colombia' => 'Colombia'];
            $pais_seleccionado = isset($_POST['pais']) ? $_POST['pais'] : '';
            
            foreach ($paises as $codigo => $nombre) {
                $selected = ($pais_seleccionado == $codigo) ? 'selected' : '';
                echo "<option value='$codigo' $selected>$nombre</option>";
            }
            ?>
        </select><br><br>
        
        <label for="ciudad">Ciudad:</label><br>
        <select id="ciudad" name="ciudad">
            <option value="">Selecciona una ciudad</option>
            <option value="madrid" <?php echo (isset($_POST['ciudad']) && $_POST['ciudad'] == 'madrid') ? 'selected' : ''; ?>>Madrid</option>
            <option value="barcelona" <?php echo (isset($_POST['ciudad']) && $_POST['ciudad'] == 'barcelona') ? 'selected' : ''; ?>>Barcelona</option>
            <option value="valencia" <?php echo (isset($_POST['ciudad']) && $_POST['ciudad'] == 'valencia') ? 'selected' : ''; ?>>Valencia</option>
        </select><br><br>
    </fieldset>
    
    <fieldset>
        <legend>Mensaje</legend>
        
        <!-- TEXTAREA -->
        <label for="mensaje">Cuéntanos algo sobre ti:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" cols="50" 
                  placeholder="Escribe aqui tu mensaje..."><?php echo isset($_POST['mensaje']) ? htmlspecialchars($_POST['mensaje']) : ''; ?></textarea><br><br>
    </fieldset>
    
    <button type="submit">Enviar Formulario</button>
    <button type="reset">Limpiar</button>
</form>

<?php
// EJEMPLO 2: Procesamiento con método GET
echo "<h3>Ejemplo 2: Búsqueda con GET</h3>";

if (isset($_GET['buscar']) && !empty($_GET['termino'])) {
    $termino = htmlspecialchars($_GET['termino']);
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'todos';
    
    echo "Búsqueda realizada:<br>";
    echo "Término: <strong>$termino</strong><br>";
    echo "Categoría: <strong>$categoria</strong><br>";
    echo "Resultados simulados para '$termino' en '$categoria'<br><br>";
}
?>

<form method="GET" action="">
    <input type="text" name="termino" placeholder="¿Qué estás buscando?" 
           value="<?php echo isset($_GET['termino']) ? htmlspecialchars($_GET['termino']) : ''; ?>">
    
    <select name="categoria">
        <option value="todos" <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'todos') ? 'selected' : ''; ?>>Todas las categorías</option>
        <option value="productos" <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'productos') ? 'selected' : ''; ?>>Productos</option>
        <option value="servicios" <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'servicios') ? 'selected' : ''; ?>>Servicios</option>
    </select>
    
    <button type="submit" name="buscar">Buscar</button>
</form>