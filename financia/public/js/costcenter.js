
// This function will be executed when DOM is loaded completely
$(document).ready(function() {
	$('#grid_costcenter').jqGrid(
		{
			caption  : "CostCenters List",
			url		 : "/fas/costcenter/getall?format=xml",
			colNames : [ "ID","Code","Name","Remarks"],
			pager	 : "#pager_costcenter",
			editurl	 : "/fas/costcenter/edit",
			sortname : "code",
			sortorder: "desc",
			colModel : [ 
			             {
			            	 name	:"id",
			            	 index	:"id",
			            	 hidden	: true
			             },
			             {
			            	 name				: "code",
			            	 index				: "code",
			            	 editable			: true,
			            	 searchoptions		: { sopt : [ 'eq'] },
			            	 editrules			: { required:true}
			             },
			             {
			            	 name	: "name",
			            	 index	: "name",
			            	 editable	: true,
			            	 searchoptions		: { sopt : [ 'eq'] },
			             },
			             {
			            	 name	: "remarks",
			            	 index	: "remarks",
			            	 editable	: true,
			            	 searchoptions		: { sopt : [ 'eq'] },
			             }				
				
				],
			autowidth	: true,
			multiselect	: true,
			rowList		: [10,20,30],
			rowNum		: 15,
			viewrecords	: true
			
			
			
		}	
	
	
	
	).navGrid('#pager_costcenter',			
		{
		add:true,
		view:true,
		edit:true,
		del:true
		
	});
	
	
	
	
}
);