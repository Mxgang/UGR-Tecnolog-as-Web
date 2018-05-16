<?php
/*function FORM_listadoUsuarios($datos) {
echo <<< HTML
	<div class='miembros'> <table> <tr>
	<th>Nombre</th> <th>Especialidad</th> <th>Direccion</th> <th>Hobbies</th></tr>
HTML;
	foreach ($datos as $v) {
	echo '<tr>';
	echo "<td class='usu_nombre'>{$v['name']}</td>";
	echo "<td class='usu_especialidad'>{$v['especialidad']}</td>";
	echo "<td class='usu_direccion'>{$v['direccion']}</td>";
	echo "<td class='hobbies'>{$v['hobbies']}</td>";
	echo '</tr>';
	}
echo <<< HTML
</table>
</div>
HTML;
}*/

/*function FORM_addUsuario($titulo,$datos,$accion) {
	if (isset($datos['editable']) && $datos['editable']==false)
	$disabled='readonly="readonly"';
	else
	$disabled='';
	echo <<< HTML

	<div class='frm_user'>
	<h3>$titulo</h3>
	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<div class='frm_user_input'><label for='user_nombre'>Nombre:</label>
	<input type='text' name='user_nombre' value='{$datos["name"]}'' $disabled/></div>

	<div class='frm_user_input'> <label for='user_especialidad'>Especialidad:</label>
	<input type='text' name='user_especialidad' value='{$datos["especialidad"]}' $disabled/></div>

	<div class='frm_user_input'> <label for='user_direccion'>Direccion:</label>
	<input type='text' name='user_direccion' value='{$datos["direccion"]}' $disabled/></div>

	<div class='frm_user_input'> <label for='user_hobbies'>Hobbies:</label>
	<input type='text' name='user_hobbies' value='{$datos["hobbies"]}' $disabled/></div>

	<div class='frm_user_submit'> <input type='submit' name='accion' value='$accion' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
	
HTML;
}*/
?>