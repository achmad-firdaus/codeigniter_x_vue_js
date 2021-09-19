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
	<div style="margin-top: 25px;">
		<label for="">Detail</label>
	</div>
	<table id="tableItem3" >
		<tr>
			<th>Nama Item</th>
			<th>Qty</th>
		</tr>
        <?php foreach ($detailTrans as $a):?>
		<tr>
			<td><?= (empty($a['name_item']))? '-': $a['name_item'] ?></td>
			<td><?= (empty($a['qty']))? '-': $a['qty'] ?></td>
		</tr>
        <?php endforeach; ?>
	</table>

</body>

</html>
