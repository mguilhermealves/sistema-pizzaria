data_metas_json.template = '<table class="row_js#CLASS#"#ADD#>';
data_metas_json.template += '  <td class="table-cell" #ADD_DATA#>#DATA#</td>';
data_metas_json.template +=
	'  <td class="table-cell" #ADD_SOLICITANTE#>#SOLICITANTE#</td>';
data_metas_json.template +=
	'  <td class="table-cell" #ADD_N_DOCUMENTO#>#N_DOCUMENTO#</td>';
data_metas_json.template += '  <td class="table-cell" #ADD_NOME#>#NOME#</td>';
data_metas_json.template +=
	'  <td class="table-cell" #ADD_V_DOCUMENTO#>#V_DOCUMENTO#</td>';
data_metas_json.template +=
	'  <td class="table-cell" #ADD_NOME_CLIENTE#>#NOME_CLIENTE#</td>';
data_metas_json.template +=
	'  <td class="table-cell" #ADD_STATUS#>#STATUS#</td>';
data_metas_json.template += '  <td class="table-cell" #ADD_ACAO#>#ACAO#</td>';
data_metas_json.template += "</table>";

data_metas_json.footer = '<div class="row_js table_data_footer">';
data_metas_json.footer += ' <div class="cell cell_last table_data_footer">';
data_metas_json.footer += "     Linha por Página ";
data_metas_json.footer += '     <select id="per_page">';
data_metas_json.footer += '         <option value="20" selected>20</option>';
data_metas_json.footer += '         <option value="50">50</option>';
data_metas_json.footer += '         <option value="100">100</option>';
data_metas_json.footer += "     </select>";
data_metas_json.footer += " </div>";
data_metas_json.footer +=
	' <div class="cell cell_last table_data_footer" style="justify-content: space-around;" id="paginate_control"></div>';
data_metas_json.footer +=
	' <div class="cell cell_last table_data_footer" id="paginate_display">#DATA_TOTAL#</div>';
data_metas_json.footer += "</div>";

$("#periodInput").change(function () {
	var period_input = $("#periodInput").val();
	return_period(period_input);
});

function return_period(period_input) {
	$.ajax({
		type: "GET",
		url: data_metas_json.url,
		data: {
			period_input: period_input,
		},
		//beforeSend: function () {},
		success: function (data) {
			data_metas_json.out_data = data;
			fn_common.render_data(
				data_metas_json.template + '<div class="class="row_js"></div>',
				{
					"#CLASS#": " row_js_header",
					"#ADD#": "",
					"#DATA#":
						'<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_name" type="button">Data <i class="fa fa-border-none"></i></button>',
					"#SOLICITANTE#":
						'<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_mail" type="button">Solicitante <i class="fa fa-border-none"></i></button>',
					"#N_DOCUMENTO#":
						'<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_cpf" type="button">Nº Documento <i class="fa fa-border-none"></i></button>',
					"#NOME#":
						'<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_cpf" type="button">Nome <i class="fa fa-border-none"></i></button>',
					"#V_DOCUMENTO#":
						'<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_status" type="button">Valor Documento <i class="fa fa-border-none"></i></button>',
					"#NOME_CLIENTE#":
						'<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_categoria" type="button">Nome Cliente <i class="fa fa-border-none"></i></button>',
					"#STATUS#":
						'<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_categoria" type="button">Status <i class="fa fa-border-none"></i></button>',
					"#ACAO#": "AÇÃO",
					"#ADD_DATA#": "",
					"#ADD_SOLICITANTE#": "",
					"#ADD_N_DOCUMENTO#": "",
					"#ADD_NOME#": "",
					"#ADD_ACAO#": "",
					"#ADD_V_DOCUMENTO#": "",
				},
				"#solaris-head-data"
			);
			-$.each(data.row, function (i, o) {
				fn_common.render_data(
					data_metas_json.template,
					{
						"#CLASS#": " table_data_data",
						"#ADD#":
							' data-data="' +
							(o.request_at != null ? o.request_at : "") +
							'" data-user="#USER#" data-grupo="#GRUPO#" data-mail="#SOLICITANTE#" data-cpf="#N_DOCUMENTO#"  data-categoria="#DOCUMENTO#" data-status="#NOME#"',
						"#ADD_DATA#": "",
						"#ADD_SOLICITANTE#": ' title="#SOLICITANTE#"',
						"#ADD_N_DOCUMENTO#": ' title="#N_DOCUMENTO#"',
						"#ADD_NOME#": ' title="#NOME#"',
						"#ADD_V_DOCUMENTO#": ' title="#DOCUMENTO#"',
						"#ADD_NOME_CLIENTE#": ' title="#NOME_CLIENTE#"',
						"#ADD_STATUS#": ' title="#STATUS#"',
						"#ADD_ACAO#": "",
						"#DATA#": o.request_at != null ? o.request_at : "",
						"#SOLICITANTE#": o.requestors_attach[0]["first_name"],
						"#N_DOCUMENTO#": o.number,
						"#NOME#": o.users_attach[0]["first_name"],
						"#V_DOCUMENTO#": o.amount,
						"#NOME_CLIENTE#": o.nfimports_attach[0]["nome_cliente"],
						"#STATUS#": o.recordstatus_attach[0]["name"],
						"#ACAO#":
							(data_metas_json.edit
								? '<a href="' +
								  String(data_metas_json.action).replace("%d", o.idx) +
								  '" class="btn button info round"><i class="fontello-edit"></i> Editar</a>'
								: '<a href="' +
								  String(data_metas_json.action).replace("%d", o.idx) +
								  '" class="btn button info round"><i class="fontello-eye"></i> Ver</a>') +
							(data_metas_json.login
								? '<a href="' +
								  o.urlogin +
								  '" target="_blank" class="btn button info round"><i class="fontello-user"></i> Logar</a>'
								: ""),
					},
					"#solaris-head-data "
				);
			});
			$.each(
				[
					"data",
					"solicitante",
					"Nº Documento",
					"Nome",
					"Valor Documento",
					"Nome Cliente",
					"Status",
				],
				function (i, o) {
					$("#btn_ordenation_" + o).bind("click", function () {
						fn_common.ordenation(o);
					});
				}
			);
			fn_common.render_data(
				data_metas_json.footer,
				{
					"#DATA_TOTAL#": "",
				},
				"#solaris-head-data"
			);
			fn_common.paginate(1);
			$("#per_page").bind("change", function () {
				fn_common.paginate(1);
			});
		},
	});

	var fn_common = {
		render_data: function (template, data, destine) {
			$.each(data, function (r, p) {
				var t = new RegExp(r, "g");
				template = String(template).replace(t, p);
			});
			$(destine).append(template);
		},
		paginate: function (sr) {
			paginate_control_button =
				'<button type="button" id="btn_#ID#" class="btn">#CONTEXT#</button>';
			per_page = $("option:selected", "#per_page").val();
			paginate = sr * per_page;
			$("#paginate_control").html("");
			$.each(
				{
					first: '<i class="fa fa-angle-double-left"></i>',
					previous: '<i class="fa fa-angle-left"></i>',
					next: '<i class="fa fa-angle-right"></i>',
					last: '<i class="fa fa-angle-double-right"></i>',
				},
				function (i, o) {
					fn_common.render_data(
						paginate_control_button,
						{
							"#CONTEXT#": o,
							"#ID#": i,
						},
						"#paginate_control"
					);
				}
			);

			if (sr == 1) {
				$("#btn_first").prop("disabled", true).unbind("click");
				$("#btn_previous").prop("disabled", true).unbind("click");
			} else {
				$("#btn_first")
					.prop("disabled", false)
					.unbind("click")
					.bind("click", function () {
						fn_common.paginate(1);
					});
				$("#btn_previous")
					.prop("disabled", false)
					.unbind("click")
					.bind("click", function () {
						fn_common.paginate(sr - 1);
					});
			}

			paginate_text = paginate - per_page + 1;

			if (paginate < data_metas_json.out_data.total.total) {
				last_paginate =
					data_metas_json.out_data.total.total % per_page == 0
						? data_metas_json.out_data.total.total / per_page
						: Math.floor(data_metas_json.out_data.total.total / per_page) + 1;
				paginate_text += " - " + paginate;
				$("#btn_next")
					.prop("disabled", false)
					.unbind("click")
					.bind("click", function () {
						fn_common.paginate(sr + 1);
					});
				$("#btn_last")
					.prop("disabled", false)
					.unbind("click")
					.bind("click", function () {
						fn_common.paginate(last_paginate);
					});
			} else {
				$("#btn_next").prop("disabled", true).unbind("click");
				$("#btn_last").prop("disabled", true).unbind("click");
			}
			paginate_text += " de " + data_metas_json.out_data.total.total;

			$(".row_data .table_data_data").hide();
			$(".row_data .table_data_data")
				.slice(paginate - per_page, paginate)
				.css({ display: "flex" });
			$("#paginate_display").html(paginate_text);
		},
		ordenation: function (obj) {
			var ordernation = $("#btn_ordenation_" + obj + " i").hasClass(
				"fa-angle-up"
			);
			$.each($(".row_js_header button i"), function (i, o) {
				$(o)
					.removeClass("fa-border-none")
					.removeClass("fa-angle-up")
					.removeClass("fa-angle-down")
					.addClass("fa-border-none");
			});
			$("#btn_ordenation_" + obj + " i")
				.removeClass("fa-border-none")
				.addClass(ordernation ? "fa-angle-down" : "fa-angle-up");
			$(".row_data .table_data_data")
				.sort(function (a, b) {
					return (
						ordernation
							? $(b).data(obj) > $(a).data(obj)
							: $(b).data(obj) < $(a).data(obj)
					)
						? 1
						: -1;
				})
				.appendTo(".row_data");
		},
	};
}
