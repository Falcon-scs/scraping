@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 50px !important;">
					<div class="row" style="margin-bottom: 20px;">
						<div class="col-sm-3">
							<a href="{{route('home')}}" class="btn btn-default">Go to Search</a>
						</div>
						<div class="col-sm-6"></div>
						<div class="col-sm-3">
							<button class="btn btn-primary" onclick="DataExport();">Export as CSV</button>
						</div>
					</div>
					<div class="row">
						<div class="row">
							<div class="col-sm-12">
								<p>Search Result: <?=count($data)?></p>	
							</div>
							
						</div>
						<?php  if(isset($data)) { ?>
							<table class="table table-bordered" style="font-size: 11px;">
								<thead>
									<th>Company Name</th>
									<th>Excutive Name</th>
									<th>Street Address</th>
									<th>City, State</th>
									<th>Zip</th>
									<th>Phone</th>
									<th>Website</th>
									<th>Facebook</th>
									<th>Advertising  Expenses</th>
								</thead>
								<tbody>
									<?php  foreach ($data as $key => $row) { ?>
									<tr>
										<td><?=$row[1]?></td>
										<td><?=$row[2]?></td>
										<td><?=$row[3]?></td>
										<td><?=$row[4]?></td>
										<td><?=$row[5]?></td>
										<td><?=$row[6]?></td>
										<td><?=$row[8]?></td>
										<td><?=$row[9]?></td>
										<td><?=$row[10]?></td>
									</tr>	
									<?php } ?>
								</tbody>
							</table>
						<?php } ?>
					</div>
					<form action="{{route('export.csv')}}" method="post" id="export_csv">
						{{ csrf_field() }}
					    <input type="hidden" name="count" value="<?=count($data)?>">
					    <?php foreach ($data as $key => $row) { ?>
					            <input type="hidden" name="companyName[]" value="<?=$row[1]?>">
					            <input type="hidden" name="excutiveName[]" value="<?=$row[2]?>">
					            <input type="hidden" name="address[]" value="<?=$row[3]?>">
					            <input type="hidden" name="city[]" value="<?=$row[4]?>"/>
					            <input type="hidden" name="zip[]" value="<?=$row[5]?>"/>
					            <input type="hidden" name="phone[]" value="<?=$row[6]?>"/>
					            <input type="hidden" name="website[]" value="<?=$row[8]?>"/>
					            <input type="hidden" name="facebook[]" value="<?=$row[9]?>"/>
					            <input type="hidden" name="advertising[]" value="<?=$row[10]?>"/>
					    <?php  } ?>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	function DataExport() {
       $("#export_csv").submit();
	}
</script>

@endsection