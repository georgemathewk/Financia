$(document).ready(
		function () {
			$('#grid').jqGrid({
					url	: "/fas/accounthead/getall/format/xml",
					editurl : "/fas/accounthead/edit",
					treeGrid : true,
					treeGridModel : 'adjacency',
					ExpandColumn : 'code',
					caption : "Accounthead List",
					height:'auto',
					datatype:'xml',
					mtype:'post',
					colNames : ["ID","Code","Name","Parent Account","Remarks"],
					autowidth:true,
					pager : '#pager',
					colModel : [
					            {
					            	name:"id",
					            	index:"id",
					            	hidden:true
					            },
					            {
					            	name:"code",
					            	index:"Code",
					            	editable : true
					            		
					            },
					            {
					            	name:"name",
					            	index:"Name",
					            	editable : true
					            },
					            {
					            	name:"parent_id",
					            	index:"parent_id",
					            	editable : true
					            },
					            {
					            	name:"remarks",
					            	index:"remarks",
					            	editable : true
					            }					            
					        ]
					}
			);
			
			$('#grid').navGrid('#pager',
					{
						edit:true,
						add:true,
						del:true,
						view:true
					},
					{
						width:'340'
					},
					{
						width:'340'
					}
			
			);
		}
);