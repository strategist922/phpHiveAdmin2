<div class="span10">
<?php echo $var_db_name;?>
<i class=icon-backward></i>  <a href="/index.php/manage/ShowTables/<?php echo $var_db_name;?>">返回</a>
<br><br>

<div class="btn-group">
<!--<a class="btn" href="sqlQuery.php?database=active&table=active_20121213">
<i class="icon-zoom-in"></i>
SQL查询-->
<!--<td>
<a href="getFilelist.php?database=active&table=active_20121213">
文件列表</a>
</td>-->
<a class="btn" href="/index.php/manage/LoadData/<?php echo $var_db_name;?>/<?php echo $table_name;?>">
<i class=icon-chevron-right></i>
<?php echo $common_load_data;?></a>
<a class="btn" href="/index.php/manage/CloneTable/<?php echo $var_db_name;?>/<?php echo $table_name;?>">
<i class=icon-random></i>
<?php echo $common_clone_table;?></a>
<a class="btn" href="/index.php/manage/TableDetail/<?php echo $var_db_name;?>/<?php echo $table_name;?>">
<i class=icon-zoom-in></i>
<?php echo $common_table_detail;?></a>
<a class="btn btn-warning" href="/index.php/manage/AlterTable/<?php echo $var_db_name;?>/<?php echo $table_name;?>">
<i class=icon-pencil></i>
<?php echo $common_alter_table;?></a>
<a class="btn btn-danger" href="#">
<i class=icon-remove></i>
<?php echo $common_drop_table;?></a>
</div>
<br>
<table class="table table-bordered table-striped table-condensed">
	<tr class="info">
		<?php foreach($column_name as $cname): ?>
			<td><?php echo $cname;?></td>
		<?php endforeach;?>
	</tr>
	<tr class="success">
		<?php foreach($column_type as $ctype): ?>
			<td><?php echo $ctype;?></td>
		<?php endforeach;?>
	</tr>
	<tr class="success">
		<?php foreach($column_comment as $ccomment): ?>
			<td><?php echo $ccomment;?></td>
		<?php endforeach;?>
	</tr>
	<?php foreach($example_data as $key => $value):?>
	<tr>
		<?php foreach($value as $ek => $ev): ?>
		<td><?php echo $ev;?></td>
		<?php endforeach;?>
	</tr>
	<?php endforeach;?>
</table>
<br>

<script src="/js/auto.js" type="text/javascript"></script>
	<script type="text/javascript">
		var hiveudfs = [];
		function initHiveudfsTextarea() {
			$.ajax("/index.php/manage/GetHiveUdfs/<?php echo $var_db_name;?>/<?php echo $table_name;?>", {
			//$.ajax("js/hiveudfs.txt", {
				success : function(data, textStatus, jqXHR) {
					hiveudfs = data.replace(/\r/g, "").split("\n");
					$("#hiveudf textarea").autocomplete({
						wordCount : 1,
						on : {
							query : function(text, cb) {
								var words = [];
								for (var i = 0; i < hiveudfs.length; i++) {
									if (hiveudfs[i].toLowerCase().indexOf(text.toLowerCase()) == 0)
										words.push(hiveudfs[i]);
									if (words.length > 5)
										break;
								}
								cb(words);
							}
						}
					});
				}
			});
		}
		$(document).ready(function() {
			initHiveudfsTextarea();
		});
	</script>

<form method=post name=form>
<div id="hiveudf">
<textarea cols="80" rows="10" name="sql" id="sql">select * from <?php echo $table_name;?> limit 30</textarea>
</div>
<br>

<button type=button class="btn btn-primary" name=check value="" onclick="getQueryPlan()"><i class=icon-ok></i> <?php echo $common_hql_validator;?></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type=button name=submit class="btn"><i class="icon-refresh"></i> <?php echo $common_submit;?></button>
<input type=hidden name=database value=<?php echo $var_db_name;?>>

</form>

</div>