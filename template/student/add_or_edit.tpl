<form method="post" action="{DIR}student/{CASE}/{ID}">
	<table>
		<tr>
			<td>Studentnummer</td>
			<td><input type="text" name='studentnr' value="{STUDENTNR}"></td>
		</tr>
		<tr>
			<td>Voornaam</td>
			<td><input type='text' name='voornaam' value='{VOORNAAM}'></td>
		</tr>
		<tr>
			<td>Tussenvoegsel</td>
			<td><input type='text' name='ts' value='{TS}'></td>
		</tr>
		<tr>
			<td>Achternaam</td>
			<td><input type='text' name='achternaam' value='{ACHTERNAAM}'></td>
		</tr>
		<tr>
			<td>Adres</td>
			<td><input type='text' name='adres' value="{ADRES}" /></td>
		</tr>
		<tr>
			<td>Postcode</td>
			<td><input type='text' name='postcode' value="{POSTCODE}"></td>
		</tr>
		<tr>
			<td>Plaats</td>
			<td><input type='text' name="plaats" value="{PLAATS}"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type='text' name='email' value='{EMAIL}'></td>
		</tr>
		<tr>
			<td>Telefoonnummer</td>
			<td><input type='text' name='tn' value="{TN}" /></td>
		</tr>
		<tr>
			<td><a href="{DIR}student/"><input type='button' value='Terug' /></a></td>
			<td><input type='submit' value='Submit' /></td>
		</tr>
	</table>
	<h5>* : Leeg laten zorgd ervoor dat dit veld niet aangepast word.</h5>
</form>