<select class="selectDepartment"  id="deptDiv">
    <option value="" selected>Department</option>
    <!-- SELECT DEPT -->
   <?php
	include '../database/index.php';
	$sql = "SELECT *FROM tbldepartment";
	$query = $db->query($sql);
	while ($x = $query->fetch_assoc()) {
		echo '<option value="'.$x['deptCode'].'">'.$x['description'].'</option>';
	}
?>
</select>
<script>
$('#deptDiv').change(function(){
    $('#scanId').attr('disabled',false);
    $('#scanId').focus();

});
$('.selectDepartment').selectize({
sortField: 'text'
});


</script>