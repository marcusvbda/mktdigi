@extends("templates.admin")
@section('title',"Dashboard")

@section('breadcrumb')
<div class="row">
	<div class="col-12">
		<nav aria-label="breadcrumb">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-0">
					<li class="breadcrumb-item">
						<a href="/admin" class="link">Dashboard</a>
					</li>
		 			<li class="breadcrumb-item active" aria-current="page">Mostradores e Desempenho</li>					
				</ol>
			</nav>
		</nav>
	</div>
</div>
@endsection
@section('content')
<dashboard-content></dashboard-content>
@endsection
