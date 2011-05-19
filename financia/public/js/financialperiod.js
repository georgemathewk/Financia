$(document).ready(function(){
		$('#grid').jqGrid({
			url	: 'financialperiod/getall?format=xml',
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
			            	index : "code"
			            },
			            {
			            	name : "name",
			            	index : "name"
			            },
			            {
			            	name : "fdate",
			            	index : "fdate"
			            },
			            {
			            	name : "tdate",
			            	index : "tdate"
			            },
			            {
			            	name : "remarks",
			            	index : "remarks"
			            }
			      ]
		});
		$('#grid').navGrid('#pager');
	
	}
);
		