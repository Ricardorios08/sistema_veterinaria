<?php
// Esto es el código PHP existente para la conexión y consulta.
include("../../conexiones/config.inc.php");

$sql = "SELECT s.cod_socio, s.apellido, s.nombre, a.nombre mascota, d.fecha_diagnostico, d.diagnostico_presuntivo, d.diagnostico, d.tipo, d.veterinario FROM `diagnostico` d inner join socios s on d.cod_socio = s.cod_socio inner join animal a on a.cod_socio = d.cod_socio order by d.cod_socio; ";
$result2 = $db->Execute($sql);

if (!$result2) die("fallo".$db->ErrorMsg());
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Diagnósticos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Mantenemos tus estilos originales si son necesarios, ajusta o elimina si usas solo Bootstrap */
        .Estilo2 { font-weight: bold; color: #333; }
        .Estilo3 { text-align: center; }
        .Estilo4 { font-size: 14px; }
    </style>
</head>
<body>

<div class="container-fluid mt-4">
    <div class="row mb-3">
        <div class="col-12">
            <button class="btn btn-success float-end" onclick="exportTableToExcel('tabla-diagnosticos', 'Reporte_Diagnosticos')">
                Descargar a Excel 🔽
            </button>
        </div>
    </div>

    <table class="table table-striped table-bordered table-hover" id="tabla-diagnosticos">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">N° Socio</th>
                <th scope="col" class="text-center">APELLIDO</th>
                <th scope="col" class="text-center">NOMBRE</th>
                <th scope="col" class="text-center">MASCOTA</th>
                <th scope="col" class="text-center">FEC. DIAGNOSTICO</th>
                <th scope="col" class="text-center">DIAGNOSTICO PRESUNTIVO</th>
                <th scope="col" class="text-center">TIPO</th>
                <th scope="col" class="text-center">ATENDIDO</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Se asume que el puntero del resultado sigue válido después del 'if (!$result2) die...'
            while (!$result2->EOF) {
                // Recuperación de los campos...
                $apellido=$result2->fields["apellido"];
                $nombre=$result2->fields["nombre"];
                $mascota=$result2->fields["mascota"];
                $fecha_diagnostico=$result2->fields["fecha_diagnostico"];
                // Corregimos la asignación para reflejar la diferencia entre presuntivo y final
                $diagnostico_presuntivo=$result2->fields["diagnostico_presuntivo"]; 
                $diagnostico_final=$result2->fields["diagnostico"]; // Este campo estaba seleccionado pero no usado
                $tipo=$result2->fields["tipo"];
                $veterinario=$result2->fields["veterinario"];
                $cod_socio=$result2->fields["cod_socio"];
            ?>

            <tr>
                <td class="text-center"><?php echo $cod_socio;?></td>
                <td class="text-center"><?php echo $apellido;?></td>
                <td class="text-center"><?php echo $nombre;?></td>
                <td class="text-center"><?php echo $mascota;?></td>
                <td class="text-center"><?php echo $fecha_diagnostico;?></td>
                <td class="text-center"><?php echo $diagnostico_presuntivo;?></td> 
                <td class="text-center"><?php echo $tipo;?></td>
                <td class="text-center"><?php echo $veterinario;?></td>
            </tr>

            <?php
                $result2->MoveNext();
            }
            ?>
        </tbody>
    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        
        // Establecer nombre del archivo
        filename = filename ? filename + '.xls' : 'excel_data.xls';
        
        // Crear elemento de enlace de descarga
        downloadLink = document.createElement("a");
        
        document.body.appendChild(downloadLink);
        
        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        } else {
            // Crear un link al archivo
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        
            // Establecer el nombre de archivo
            downloadLink.download = filename;
            
            // Simular clic en el enlace
            downloadLink.click();
        }
    }
</script>

</body>
</html>