<script type="text/javascript">
	function confirmDelete(id,klas)
	{
		if(confirm("Weet je zeker dat je deze klas: "+ klas +" wil verwijderen?")) {
			window.location.href = "{DIR}klas/5/"+ id ;
		} else {
			
		}
	}
</script>
<h1>{TITEL}</h1>
<a href='{DIR}klas/1/'>Nieuwe Klas</a>
<table>
	<thead>
		<tr>
			<td>Naam</td>
			<td>Options</td>
		</tr>
	</thead>
	<!-- START KLASSEN -->
	<tr>
		<td>
			{KLASSEN.NAAM}
		</td>
		<td>
			<a href='{DIR}klas/6/{KLASSEN.ID}'>View</a>
			<a href='{DIR}klas/3/{KLASSEN.ID}'>Edit</a>
			<a onclick='{KLASSEN.CONFIRM}'>Delete</a>
		</td>
	</tr>
	<!-- END KLASSEN -->
</table>