<form method="post" action="{DIR}user/{CASE}/{ID}">
	<table>
		<tr>
			<td>Voornaam</td>
			<td><input type='text' name='voornaam' value='{VOORNAAM}'></td>
		</tr>
		<tr>
			<td>Tussenvoegsel</td>
			<td><input type='text' name='tussenvoegsel' value='{TS}'></td>
		</tr>
		<tr>
			<td>Achternaam</td>
			<td><input type='text' name='achternaam' value='{ACHTERNAAM}'></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type='text' name='email' value='{EMAIL}'></td>
		</tr>
		<tr>
			<td>Password*</td>
			<td><input type='password' name='pw'></td>
		</tr>
		<tr>
			<td>Re Password</td>
			<td><input type='password' name='repw'></td>
		</tr>
		<tr>
			<td>Groep</td>
			<td>
				<select name='groep'>
					<option></option>
					<!-- START GROUPS -->
						<option value='{GROUPS.VAL}' {GROUPS.SELECTED}>{GROUPS.NAME}</option>
					<!-- END GROUPS -->
				</select>	
			</td>
		</tr>
		<tr>
			<td><a href="{DIR}user/"><input type='button' value='Terug' /></a></td>
			<td><input type='submit' value='Submit' /></td>
		</tr>
	</table>
	<h5>* : Leeg laten zorg ervoor dat dit veld niet aangepast word.</h5>
</form>