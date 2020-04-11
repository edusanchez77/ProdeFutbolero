<section id="proximospartidos">
	<div class="proximospartidos">
			<?php
			
				$contador = 1;

				$query_resultados = "SELECT * FROM resultados ORDER BY res_id DESC LIMIT 8";
				$resultado_resultados = mysqli_query($conexion, $query_resultados);
				$resultado = mysqli_fetch_row($resultado_resultados);
				$titulo = "ÚLTIMOS RESULTADOS";
				if (!isset($resultado)) {
					$query_resultados = "SELECT pa_id, pa_id, NULL , NULL FROM partidos WHERE pa_dia >= sysdate() ORDER BY pa_dia ASC LIMIT 8 ";
					$resultado_resultados = mysqli_query($conexion, $query_resultados);
					$resultado = mysqli_fetch_row($resultado_resultados);
					$titulo = "PRÓXIMOS PARTIDOS";
				}
				echo "<p>".$titulo."</p>";
				echo "<ul>";
				while (isset($resultado))
					{
					$query = "SELECT * FROM partidos WHERE pa_id = '$resultado[1]'";
					$result = mysqli_query($conexion, $query);
					$equipos = mysqli_fetch_row($result);

					$query = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$equipos[2]'";
					$result = mysqli_query($conexion, $query);
					$bandera_local = mysqli_fetch_row($result);

					$query = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$equipos[3]'";
					$result = mysqli_query($conexion, $query);
					$bandera_visitante = mysqli_fetch_row($result);

					mysqli_set_charset($conexion, "utf8");

						if ($contador == 1) {
			echo "<li><div class='partido primerpartido'>";
						}else if ($contador == 4) {
			echo "<div class='partido ultimopartido'>";
						}else{
			echo "<div class='partido'>";
						}
				?>
			<div class="equipo">
				<img src="<?php echo $bandera_local[0] ?>">
				<p><?php echo mb_strtoupper($equipos[2],'utf-8'); ?></p>
				<input type="text" disabled="" value="<?php echo $resultado[2] ?>">
			</div>
			<div class="equipo">
				<img src="<?php echo $bandera_visitante[0] ?>">
				<p><?php echo mb_strtoupper($equipos[3],'utf-8'); ?></p>
				<input type="text" disabled="" value="<?php echo $resultado[3] ?>">
			</div>
		</div>
				
		<?php
			if ($contador == 4) {
				echo "</li>";
				$contador = 0;
			}
			$contador++;
			$resultado = mysqli_fetch_row($resultado_resultados);
		}
		?>
		</ul>
	</div>
</section>
