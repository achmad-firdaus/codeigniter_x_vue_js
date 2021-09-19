<html>

<head>
	<link rel="stylesheet" href="<?= $pageCss ?>">
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js"
		integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
	<ul id="navbar-menu-name">
		<li><a class="" href="<?= base_url().'Item'; ?>">{{ menu1 }}</a></li>
		<li><a class="" href="<?= base_url().'Customer'; ?>">{{ menu2 }}</a></li>
		<li><a class="active" href="<?= base_url().'Transaction'; ?>">{{ menu3 }}</a></li>
	</ul>

	<!-- <form id="formItem" @submit="checkForm" action="http://localhost/CODEIGNITER/RIMBA/Item/insert" method="post"> -->
	<form id="formStaging" method="post" enctype="multipart/form-data">
		<p v-if="errors.length">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="error in errors">{{ error }}</li>
			</ul>
		</p>
		<p>
			<label for="codeTransaksi">Code Transaction<label>
					<input type="text" name="codeTransaksi" id="codeTransaksi" v-model="codeTransaksi">
		</p>
		<p>
			<label for="conatct">Date Transaction<label>
					<input type="date" name="conatct" id="conatct" v-model="conatct">
		</p>
		<p>
			<label for="cutomer">Customer{{ label2 }}<label>
					<select name="cutomer" id="cutomer" @change="onChange($event)" v-model="cutomer">
						<option value="" selected>--SELECT--</option>
						<?php foreach ($getDataCustomer as $a): ?>
						<option value="<?= $a['id_customer'] ?>">
							<?= $a['id_customer'] ?>&nbsp;:&nbsp;<?= $a['name_customer'] ?></option>
						<?php endforeach; ?>
					</select>
		</p>
		<p>
			<label for="totbay">Total Bayar Diskon<label>
					<input type="number" name="totbay" id="totbay" v-model="totbay" min='0'>
		</p>
		<p>
			<!-- <button v-on:click="getPosts()" type="button">Login</button> -->
			<input id="buttoninput" type="button" value="Submit">
		</p>
	</form>
	
		<p>
			<label for="tothar">Total Harga<label>
					<input type="number" name="tothar" id="tothar" v-model="tothar" min='0'>
		</p>

	<div style="margin-top: 25px;">
		<label for="">Barang</label>
	</div>
	<table id="tableItem" >
		<tr>
			<th>Name</th>
			<th>Unit</th>
			<th>Action</th>
		</tr>
		<tr>
			<td>
				<select name="name_item" id="name_item" v-model="id_item" >
					<option value="" selected>--SELECT--</option>
					<?php foreach ($getDataItem as $a): ?>
					<option value="<?= $a['id_item'] ?>">
						<?= $a['name_item'] ?>&nbsp;:&nbsp;<?= $a['name_item'] ?></option>
					<?php endforeach; ?>
				</select>
			</td>
			<td><input type="number" name="qty" id="qty" v-model="qty" v-on:input="PostsItemStagging($event)" min='0'></td>
			<td>
				<input type="submit" value="Submit" id="contentsforstagging" class="contentsforstagging" v-on:click="PostStagging($event)">
            </td>
		</tr>
	</table>

			<div id="contents-stagging">

			</div>

	<div style="margin-top: 25px;">
		<label for="">Sales</label>
	</div>
	<table id="tableItem3" >
		<tr>
			<th>Code Transaction</th>
			<th>Dtae Transaction</th>
			<th>Customer</th>
			<th>toatal_diskon</th>
			<th>toatal_harga</th>
			<th>toatal_bayar</th>
			<th>action</th>
		</tr>
        <?php foreach ($getDataTransaction as $getDataItem):?>
		<tr>
			<td><?= (empty($getDataItem['code']))? '-': $getDataItem['code'] ?></td>
			<td><?= (empty($getDataItem['date']))? '-': $getDataItem['date'] ?></td>
			<td><?= (empty($getDataItem['customer']))? '-': $getDataItem['customer'] ?></td>
			<td><?= (empty($getDataItem['toatal_diskon']))? '-': $getDataItem['toatal_diskon'] ?></td>
			<td><?= (empty($getDataItem['total_harga']))? '-': $getDataItem['total_harga'] ?></td>
			<td><?= (empty($getDataItem['total_bayar']))? '-': $getDataItem['total_bayar'] ?></td>
			<td>
                <a class="button" href="<?= base_url().'Transaction/index_detail/'.$getDataItem['id_transaction'] ?>" >View Detail</a>
            </td>
		</tr>
        <?php endforeach; ?>
	</table>

	<script src="<?= $pageJS ?>"></script>
	<script>
	$(document).ready(function() {
		const urlCheckQty = location.href+'/insert';
		$("#buttoninput").click(function() {
			$.ajax({
				url		: urlCheckQty,
				type	: 'POST',
				cache	: false,
				data	: {
					dataA: $('#codeTransaksi').val(),
					dataB: $('#conatct').val(),
					dataC: $('#totbay').val(),
				},
				success	: function(response) {
                    alert('Success, please refresh page!')
				}
			});
		});
		const urlCheckSTaggingTable = location.href+'/index_stagging';
		
		$("#contentsforstagging").click(function() {
			$.ajax({
				url		: urlCheckSTaggingTable,
				type	: 'POST',
				cache	: false,
				data	: {
				},
				success	: function(response) {
					// $('#contents-stagging').html(response);
					$('#contents-stagging').html(response);
				}
			});
		});
		const urltotalHarga = location.href+'/totalHarga';
		$(".contentsforstagging").click(function() {
			$.ajax({
				url		: urltotalHarga,
				type	: 'POST',
				cache	: false,
				data	: {
				},
				success	: function(response) {
					$('#tothar').val(response);
				}
			});
		});
		function totalHarga() {
			$.ajax({
				url		: urltotalHarga,
				type	: 'POST',
				cache	: false,
				data	: {
				},
				success	: function(response) {
					$('#tothar').val(response);
				}
			});
		}
	}); 
	</script>
</body>

</html>
