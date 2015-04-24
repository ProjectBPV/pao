<h1>{TITEL}</h1>
<a href='{DIR}user/1/'>Nieuwe Gebruiker</a>
<table>
	<tr>
		<td>Naam</td>
		<td>Groep</td>
		<td>Options</td>
	</tr>
	<!-- START USERS -->
		<tr>
			<td>
				{USERS.NAAM}
			</td>
			<td>{USERS.GROUP}</td>
			<td>
				<a href='{DIR}user/3/{USERS.ID}'>Edit</a>
				<a href='{DIR}user/5/{USERS.ID}'>Delete</a>
			</td>
		</tr>
	<!-- END USERS -->
</table>