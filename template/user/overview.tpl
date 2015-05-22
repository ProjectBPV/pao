<script type="text/javascript">
	function confirmDelete(id,user)
	{
		if(confirm("Weet je zeker dat je de gebruiker "+ user +" wil verwijderen?")) {
			window.location.href = "{DIR}user/5/"+ id ;
		} else {
			
		}
	}
</script>
<h1>{TITEL}</h1>
<a href='{DIR}user/1/'>Nieuwe Gebruiker</a>
<table>
	<thead>
		<tr>
			<td>Naam</td>
			<td>Groep</td>
			<td>Options</td>
		</tr>
	</thead>
	<!-- START USERS -->
	<tr>
		<td>
			{USERS.NAAM}
		</td>
		<td>
			{USERS.GROUP}
		</td>
		<td>
			<a href='{DIR}user/3/{USERS.ID}'>Edit</a>
			<a onclick='{USERS.CONFIRM}'>Delete</a>
		</td>
	</tr>
	<!-- END USERS -->
</table>