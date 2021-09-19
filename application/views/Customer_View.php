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
		<li><a class="" href="<?= base_url().'Item'; ?>">{{ menu1 }}</a></li>
		<li><a class="active" href="<?= base_url().'Customer'; ?>">{{ menu2 }}</a></li>
		<li><a class="" href="<?= base_url().'Transaction'; ?>">{{ menu3 }}</a></li>
	</ul>

	<!-- <form id="formItem" @submit="checkForm" action="http://localhost/CODEIGNITER/RIMBA/Item/insert" method="post"> -->
	<form id="formItem" @submit="checkForm" method="post" enctype="multipart/form-data">
		<p v-if="errors.length">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="error in errors">{{ error }}</li>
			</ul>
		</p>
		<p>
			<label for="nameCustomer">Name Customer<label>
					<input type="text" name="nameCustomer" id="nameCustomer" v-model="nameCustomer">
		</p>
		<p>
			<label for="conatct">Conatct<label>
					<input type="text" name="conatct" id="conatct" v-model="conatct">
		</p>
		<p>
			<label for="email">Email<label>
					<input type="email" name="email" id="email" v-model="email">
		</p>
		<p>
			<label for="address">Address<label>
					<input type="text" name="address" id="address" v-model="address">
		</p>
		<p>
			<label for="discont">Discont<label>
					<input type="number" name="discont" id="discont" v-model="discont">%
		</p>
		<p>
			<label for="type">Type DIscont<label>
					<select name="type" id="type" v-model="type">
						<option>presentase</option>
						<option>fix diskon</option>
					</select>
		</p>
		<p>
			<label for="img">Ktp<label>
					<input type="file" accept="image/*" name="img" id="img"  @change="previewFiles" multiple>
		</p>
		<p>
			<!-- <button v-on:click="getPosts()" type="button">Login</button> -->
			<input type="submit" value="Submit">
		</p>
	</form>

	<table id="tableItem" >
		<tr>
			<th>Name</th>
			<th>Contact</th>
			<th>Email</th>
			<th>Address</th>
			<th>Discount</th>
			<th>Type Discount</th>
			<th>Ktp</th>
			<th>Action</th>
		</tr>
        <?php foreach ($getDataItem as $getDataItem):?>
		<tr>
			<td><?= (empty($getDataItem['name_customer']))? '-': $getDataItem['name_customer'] ?></td>
			<td><?= (empty($getDataItem['contact']))? '-': $getDataItem['contact'] ?></td>
			<td><?= (empty($getDataItem['email']))? '-': $getDataItem['email'] ?></td>
			<td><?= (empty($getDataItem['address']))? '-': $getDataItem['address'] ?></td>
			<td><?= (empty($getDataItem['diskon']))? '-': $getDataItem['diskon'] ?></td>
			<td><?= (empty($getDataItem['type_diskon']))? '-': $getDataItem['type_diskon'] ?></td>
			<td><?= (empty($getDataItem['img_ktp']))? '-': $getDataItem['img_ktp'] ?></td>
			<td>
                <a class="button" href="<?= base_url().'Customer/delete/'.$getDataItem['id_customer'] ?>" >Delete</a>
            </td>
		</tr>
        <?php endforeach; ?>
	</table>

	<script src="<?= $pageJS ?>"></script>
</body>

</html>
