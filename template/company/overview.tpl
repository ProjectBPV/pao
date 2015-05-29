<script type="text/javascript">
	function confirmDelete(id)
	{
		if(confirm("Are you sure you want to delete this company?")) {
			window.location.href = "{DIR}company/5/"+ id ;
		} else {
			
		}
	}
</script>
<h1>{TITEL}</h1>
<a href='{DIR}company/1/'>Bedrijf toevoegen</a>
<table>
	<thead>
		<tr>
			<td>Bedrijf naam</td>
			<td>Options</td>
		</tr>
	</thead>
	<!-- START COMPANYS -->
	<tr>
		<td>
			{COMPANYS.NAAM}
		</td>
		<td>
			<a href='{DIR}company/6/{COMPANYS.ID}'>View</a>
			<a href='{DIR}company/3/{COMPANYS.ID}'>Edit</a>
			<a onclick='{COMPANYS.CONFIRM}'>Delete</a>
		</td>
	</tr>
	<!-- END COMPANYS -->
</table>