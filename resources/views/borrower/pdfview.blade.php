<style type="text/css">
	/* tables */
  table{
  	border-collapse: collapse;
  	width: 100%;
  }
  table, th, td{
		border: 1px solid #black !important;
		text-align: left;
	}
 th{
 	height: 30px;
 	background-color: #eeeeee;
 }
 tr:nth-child(even){
 	background-color: #f2f2f2; }
 }
</style>
<div class="container">
	<h2>Niyiment Library</h2>
	<h3>List of Borrowers</h3>
	<table>
		<tr>
			<th>SNo</th>
			<th>Book</th>
			<th>Customer</th>
			<th>Status</th>
			<th>Date</th>
		</tr>
		@foreach ($borrowers as $key => $borrower)
		<tr>
			<td>{{ ++$key }}</td>
			<td>{{ $borrower->title }}</td>
			<td>{{ $borrower->name }}</td>
			<td>{{ $borrower->status }}</td>
			<td>{{ $borrower->issued_at }}</td>
		</tr>
		@endforeach
	</table>
</div>