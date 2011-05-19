$(document).ready(function(){
		$('#grid').jqGrid({
			url	: 'financialperiod/getall?format=xml',
			editurl : 'financialperiod/edit',
			caption:"Financial Period List",
			colNames : [ "ID" , "Code","Name","From Date", "To Date", "Remarks"],
			pager : '#pager',
			autowidth:true,
			multiselect:true,
			colModel : [
			            {
			            	name  : "id",
			            	index : "id"
			            },
			            {
			            	name : "code",
			            	index : "code",
			            	editable:true,
			            },
			            {
			            	name : "name",
			            	index : "name",
			            	editable : true
			            },
			            {
			            	name : "fdate",
			            	index : "fdate",
			            	editable : true
			            },
			            {
			            	name : "tdate",
			            	index : "tdate",
			            	editable : true
			            },
			            {
			            	name : "remarks",
			            	index : "remarks",
			            	editable : true
			            }
			      ]
		});
		$('#grid').navGrid('#pager');
	
	}
);
		