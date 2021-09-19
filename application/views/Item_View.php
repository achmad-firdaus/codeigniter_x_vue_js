<html>

<head>
	<link rel="stylesheet" href="<?= $pageCss ?>">
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js"
		integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
	<ul id="navbar-menu-name">
		<li><a class="active" href="<?= base_url().'Item'; ?>">{{ menu1 }}</a></li>
		<li><a class="" href="<?= base_url().'Customer'; ?>">{{ menu2 }}</a></li>
		<li><a class="" href="<?= base_url().'Transaction'; ?>">{{ menu3 }}</a></li>
	</ul>

	<form id="formItem" action="<?= base_url()?>Item/insert" method="post" enctype="multipart/form-data">
	<!-- <form id="formItem" @submit="checkForm" method="post" enctype="multipart/form-data"> -->
		<p v-if="errors.length">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="error in errors">{{ error }}</li>
			</ul>
		</p>
		<p>
			<label for="nameItem">Name Item<label>
					<input type="text" name="inputA" id="nameItem" v-model="nameItem">
		</p>
		<p>
			<label for="unit">Unit<label>
					<select name="inputB" id="unit" v-model="unit">
						<option>KG</option>
						<option>PCS</option>
					</select>
		</p>
		<p>
			<label for="stock">Stock<label>
					<input type="number" name="inputC" id="stock" v-model="stock" min="0">
		</p>
		<p>
			<label for="price">Price<label>
					<input type="number" name="inputD" id="price" v-model="price" min="0">
		</p>
		<p>
			<label for="img">Img<label>
					<!-- <input type="file" accept="image/*" name="img" id="img"  @change="previewFiles" multiple> -->
					<input type="file" class="form-control" name="photoUser" id="inputGroupFile03"
									aria-describedby="inputGroupFileAddon03" aria-label="Upload" accept="image/*">
		</p>
		<p>
			<!-- <button v-on:click="getPosts()" type="button">Login</button> -->
			<input type="submit" value="Submit">
		</p>
	</form>

	<table id="tableItem" >
		<tr>
			<th>Name</th>
			<th>Unit</th>
			<th>Stock</th>
			<th>Price</th>
			<th>Img</th>
			<th>Action</th>
		</tr>
        <?php foreach ($getDataItem as $getDataItem):?>
		<tr>
			<td><?= (empty($getDataItem['name_item']))? '-': $getDataItem['name_item'] ?></td>
			<td><?= (empty($getDataItem['unit']))? '-': $getDataItem['unit'] ?></td>
			<td><?= (empty($getDataItem['qty']))? '-': $getDataItem['qty'] ?></td>
			<td><?= (empty($getDataItem['price']))? '-': $getDataItem['price'] ?></td>
			<td><img style="width: 50px;" src="<?= (empty($getDataItem['img']))? '-': base_url().'assets/img/upload/'.$getDataItem['img'] ?>" alt=""></td>
			<td>
                <a class="button" href="<?= base_url().'Item/delete/'.$getDataItem['id_item'] ?>" >Delete</a>
            </td>
		</tr>
        <?php endforeach; ?>
	</table>

	<script src="<?= $pageJS ?>"></script>
</body>

</html>
