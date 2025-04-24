<?php
include(__DIR__ . '/config/db.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = intval($_POST['id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $genero = $conn->real_escape_string($_POST['genero']);
    $email = $conn->real_escape_string($_POST['email']);
    $fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);
    $tiene_hijos = $conn->real_escape_string($_POST['tiene_hijos']);

    if ($conn->query("UPDATE usuarios SET nombre='$nombre', apellido='$apellido', genero='$genero', email='$email', fecha_nacimiento='$fecha_nacimiento', 
        tiene_hijos='$tiene_hijos' WHERE id=$id")) {
        echo "<script>Swal.fire('Actualizado', 'Usuario actualizado correctamente', 'success').then(() => { location.reload(); });</script>";
    } else {
        echo "<script>Swal.fire('Error', 'No se pudo actualizar', 'error');</script>";
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($conn->query("DELETE FROM usuarios WHERE id=$id")) {
        echo "<script>Swal.fire('Eliminado', 'Usuario eliminado correctamente', 'success').then(() => { location.href='crud.php'; });</script>";
    } else {
        echo "<script>Swal.fire('Error', 'No se pudo eliminar', 'error');</script>";
    }
}

$result = $conn->query("SELECT * FROM usuarios WHERE genero = 'femenino' AND tiene_hijos = 'si'") or die("Error en la consulta: " . $conn->error);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>DIA DE LA MADRE</title>
</head>
<body class="bg-[#E1EEE2] font-sans">
<header class="w-full bg-white mb-10 border-b-4 border-green-900">
    <div class="container mx-auto flex justify-between items-center p-5">
        <a href="../index.php"><img src="/static/img/TF.png" alt="Logo" class="h-16"></a>
        <nav class="hidden lg:flex space-x-8">
            <!-- <a href="/admin/años.php" class="text-green-900 font-bold text-lg">AÑOS</a>
            <a href="/admin/index.php" class="text-green-900 font-bold text-lg">PROYECTOS</a> -->
        </nav>
         <!-- Menú de navegación (se oculta en pantallas pequeñas) -->
        <nav id="navMenu" class="hidden lg:flex lg:items-center lg:space-x-8">
            <a href="crud.php" class="text-green-900 hover:text-lime-600 font-bold text-sm md:text-lg relative left-[-80px]">CUMPLEAÑOS</a>
            <a href="dia_hombre.php" class="text-green-900 hover:text-lime-600 font-bold text-sm md:text-lg relative left-[-70px]">DIA DEL HOMBRE</a>
            <a href="dia_mujer.php" class="text-green-900 hover:text-lime-600 font-bold text-sm md:text-lg relative left-[-60px]">DIA DE LA MUJER</a>
            <a href="dia_padre.php" class="text-green-900 hover:text-lime-600 font-bold text-sm md:text-lg relative left-[-50px]">DIA DEL PADRE</a>
            <a href="dia_madre.php" class="text-green-900 hover:text-lime-600 font-bold text-sm md:text-lg relative left-[-40px]">DIA DE LA MADRE</a>
        </nav>
        <a href="../../../logout.php" class="bg-green-600 hover:bg-lime-500 text-white font-bold py-3 px-6 rounded-lg shadow-md flex items-center">
            <img src="/static/img/cerrarsesion.png" class="w-4 h-4 mr-2"> CERRAR SESIÓN
        </a>
    </div>
</header>
    <div class="flex justify-center items-center mb-4 gap-x-6">
        <!-- Contenedor con ancho fijo para evitar que la tabla se agrande -->
        <div class="w-[250px] relative left-[-340px]">
            <input type="text" id="buscador" placeholder="Buscar usuario..." 
                class="w-[350px] px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 ml-[0px]"
                onkeyup="filtrarUsuarios()">
        </div>
        <a href="enviar_dia_madre.php?enviar=true" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-full flex items-center gap-x-2 relative right-[-345px]">🌸 ¡Felicitar Día de la Madre!</a>
        </div>
    <script>
    function capitalizarTexto(texto) {
        return texto.toLowerCase().replace(/\b\w/g, (letra) => letra.toUpperCase());
    }
    </script>
   <div class="flex justify-center overflow-y-auto max-h-[700px]">
        <table class="w-[1200px] bg-white shadow-lg rounded-lg border-none" role="table">
            <thead class="sticky top-0 bg-green-700 text-white z-10">
                <tr>
                    <th scope="col" class="py-2 border-r border-gray-300 text-center w-[200px]">Nombres</th>
                    <th scope="col" class="py-2 border-r border-gray-300 text-center w-[200px]">Apellidos</th>
                    <th scope="col" class="py-2 border-r border-gray-300 text-center w-[200px]">Género</th>
                    <th scope="col" class="py-2 border-r border-gray-300 text-center w-[200px]">Correo electrónico</th>
                    <th scope="col" class="py-2 border-r border-gray-300 text-center w-[150px]">Fecha de nacimiento</th>
                    <th scope="col" class="py-2 border-r border-gray-300 text-center w-[150px]">Tiene hijos</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-100 transition-all border-l-4 border-transparent hover:border-green-500">
                        <td class="py-1 px-4 border-r border-gray-300"><?= htmlspecialchars($row['nombre']) ?></td>
                        <td class="py-1 px-4 border-r border-gray-300"><?= htmlspecialchars($row['apellido']) ?></td>
                        <td class="py-1 px-4 border-r border-gray-300"><?= htmlspecialchars($row['genero']) ?></td>
                        <td class="py-1 px-4 border-r border-gray-300"><?= htmlspecialchars($row['email']) ?></td>
                        <td class="py-1 px-4 border-r border-gray-300 text-center"><?= htmlspecialchars($row['fecha_nacimiento']) ?></td>
                        <td class="py-1 px-4 border-r border-gray-300"><?= htmlspecialchars($row['tiene_hijos']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function filtrarUsuarios() {
            let input = document.getElementById("buscador").value.toLowerCase();
            let filas = document.querySelectorAll("tbody tr");

            filas.forEach(fila => {
                let nombre = fila.children[0].textContent.toLowerCase();
                let apellido = fila.children[1].textContent.toLowerCase();
                let email = fila.children[2].textContent.toLowerCase();

                if (nombre.includes(input) || apellido.includes(input) || email.includes(input)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        }

        function eliminarUsuario(id) {
            Swal.fire({
                title: "¿Seguro que quieres eliminar este usuario?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar"
            }).then((result) => {
                if (result.isConfirmed) window.location.href = 'crud.php?delete=' + id;
            });
        }

        function editarUsuario(id, nombre, apellido, genero, email, fecha_nacimiento, tiene_hijos) {
            Swal.fire({
                title: "Editar Usuario",
                html: `
                    <div class="w-[350px] mx-auto flex flex-col space-y-3">
                        <input id='nombre' class='w-full text-center px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm' placeholder='Nombre' value='${nombre}'>
                        <input id='apellido' class='w-full text-center px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm' placeholder='Apellido' value='${apellido}'>
                        <select id='genero' class='w-full text-center px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm'>
                            <option value="" disabled ${!genero ? "selected" : ""}>¿Género?</option>
                            <option value="masculino" ${genero === "masculino" ? "selected" : ""}>Masculino</option>
                            <option value="femenino" ${genero === "femenino" ? "selected" : ""}>Femenino</option>
                        </select>
                        <input id='email' class='w-full text-center px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm' placeholder='Email' value='${email}'>
                        <label>Fecha de nacimiento</label>
                        <input id='fecha' class='w-full text-center px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm' type='date' value='${fecha_nacimiento}'>
                        <select id="tiene_hijos" class="w-full text-center px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="" disabled ${!tiene_hijos ? "selected" : ""}>¿Tiene hijos?</option>
                            <option value="si" ${tiene_hijos === "si" ? "selected" : ""}>Sí</option>
                            <option value="no" ${tiene_hijos === "no" ? "selected" : ""}>No</option>
                        </select>                    
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                cancelButtonText: "Cancelar",
                customClass: {
                    confirmButton: "bg-green-600 hover:bg-lime-500 text-white font-bold py-2 px-4 rounded",
                    cancelButton: "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded",
                    actions: "flex justify-center gap-x-3"
                },
                buttonsStyling: false,
                preConfirm: () => {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'crud.php';
                    form.innerHTML = `
                        <input type='hidden' name='id' value='${id}'>
                        <input type='hidden' name='nombre' value='${document.getElementById('nombre').value}'>
                        <input type='hidden' name='apellido' value='${document.getElementById('apellido').value}'>
                        <input type='hidden' name='genero' value='${document.getElementById('genero').value}'>
                        <input type='hidden' name='email' value='${document.getElementById('email').value}'>
                        <input type='hidden' name='fecha_nacimiento' value='${document.getElementById('fecha').value}'>
                        <input type='hidden' name='tiene_hijos' value='${document.getElementById('tiene_hijos').value}'>
                        <input type='hidden' name='editar' value='1'>
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>
