<form method="post" action="{DIR}user/{CASE}/{ID}">
	<table>
		<tr>
			<td>Voornaam</td>
			<td>{VOORNAAM}</td>
		</tr>
		<tr>
			<td>Tussenvoegsel</td>
			<td>{TS}</td>
		</tr>
		<tr>
			<td>Achternaam</td>
			<td>{ACHTERNAAM}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{EMAIL}</td>
		</tr>
		<tr>
			<td>Groep</td>
			<td>
				{GROUPS.NAME}
			</td>
		</tr>
		<tr>
			<td><a href="{DIR}user/"><input type='button' value='Terug' /></a></td>
			<td><input type='submit' value='Edit' /></td>
		</tr>
	</table>
	<h5>* : Leeg laten zorgd ervoor dat dit veld niet aangepast word.</h5>
</form>