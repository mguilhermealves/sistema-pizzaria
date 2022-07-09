$("#period-input").bind("change", function () {
	let ID = $("option:selected", this).val();
	$("table[id^='tbl_extrato']").hide();
	$("table[id='tbl_extrato" + ID + "']").show();
});
$("#period-input").change();