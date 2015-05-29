<script type="text/javascript">
	function confirmDelete(id,student)
	{
		if(confirm("Weet je zeker dat je de student: "+ student +" wil verwijderen?")) {
			window.location.href = "{DIR}student/5/"+ id ;
		} else {
			
		}
	}
</script>
<h1>{TITEL}</h1>
<a href='{DIR}student/1/'>Nieuwe Student</a>
<table>
	<thead>
		<tr>
			<td>Naam</td>
			<td> </td>
			<td>Options</td>
		</tr>
	</thead>
	<!-- START STUDENTS -->
	<tr>
		<td>
			{STUDENTS.NAAM}
		</td>
		<td>
			
		</td>
		<td>
			<a href='{DIR}student/6/{STUDENTS.ID}'>View</a>
			<a href='{DIR}student/3/{STUDENTS.ID}'>Edit</a>
			<a onclick='{STUDENTS.CONFIRM}'>Delete</a>
		</td>
	</tr>
	<!-- END STUDENTS -->
</table>