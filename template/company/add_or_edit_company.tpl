<form method="post" action="{DIR}company/{CASE}/{ID}">
	<table>
		<tr>
			<td>Bedrijfsnaam</td>
			<td><input type='text' name='bedrijfsnaam' value='{BEDRIJFSNAAM}'></td>
		</tr>
		<tr>
			<td>Adres</td>
			<td><input type='text' name='adres' value='{ADRES}'></td>
		</tr>
		<tr>
			<td>Postcode</td>
			<td><input type='text' name='postcode' value='{POSTCODE}'></td>
		</tr>
		<tr>
			<td>Plaats</td>
			<td><input type='text' name='plaats' value='{PLAATS}'></td>
		</tr>
		<tr>
			<td>telefoonnummer</td>
			<td><input type='text' name='telefoonnummer' value='{TELEFOONNUMMER}'></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type='text' name='email' value='{EMAIL}'></td>
		</tr>
		<tr>
			<td>Website</td>
			<td><input type='text' name='website' value='{WEBSITE}'></td>
		</tr>
		<tr>
			<td>Code leerbedrijf</td>
			<td><input type='text' name='code' value='{CODE}'></td>
		</tr>
		<tr>
			<td>Opmerking</td>
			<td><textarea name="opmerking">{OPMERKING}</textarea></td>
		</tr>
		<tr>
			<td>Opleidingen geschikt:</td>
			<td>
				<!-- START OPLEIDINGEN -->
				<input type='checkbox' name="{OPLEIDINGEN.NAME}" value="{OPLEIDINGEN.ID}"> {OPLEIDINGEN.NAME} <br/>
				<!-- END OPLEIDINGEN -->
			</td>
		</tr>
		<tr>
			<td><a href="{DIR}company/"><input type='button' value='Terug' /></a></td>
			<td><input type='submit' value='Submit' /></td>
		</tr>
	</table>
</form>