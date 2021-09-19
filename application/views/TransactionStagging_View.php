<div style="margin-top: 25px;">
	<label for="">Stagging</label>
</div>
<table id="tableStangging">
	<tr>
		<th>name item</th>
		<th>qty</th>
		<th>total</th>
		<!-- <th>Action</th> -->
	</tr>
	<?php foreach ($getDataStagging as $getDataItem):?>
	<tr>
		<td><?= (empty($getDataItem['name_item']))? '-': $getDataItem['name_item'] ?></td>
		<td><?= (empty($getDataItem['qty']))? '-': $getDataItem['qty'] ?></td>
		<td><?= (empty($getDataItem['total_harga']))? '-': $getDataItem['total_harga'] ?></td>
		<!-- <td>
			<a class="button" href="<?= base_url().'Customer/delete/'.$getDataItem['id_customer'] ?>">Delete</a>
		</td> -->
	</tr>
	<?php endforeach; ?>
</table>