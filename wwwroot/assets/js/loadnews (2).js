$(function() {
	$("#manage_category").click(function(){
		loadcategory();
	});
	loadcategory();

});


function loadcategory(){
	$(window).resize(
			function() {
				var h = Math.max($(window).height() - 0, 420);
				$('#container, #data, #tree, #data .content').height(h).filter('.default').css('lineHeight', h + 'px');
			}).resize();
	$('#tree').jstree({
		'core' : {
			'data' : {
				'url' : '/admin/news/loadCategory/action/get_node/',
				'data' : function(node) {
					return {
						'id' : node.id
					};
				}
			},
			'check_callback' : true,
			'themes' : {
				'responsive' : false
			}
		},
		'plugins' : [ 'state', 'dnd', 'contextmenu', 'wholerow', 'types' ],
		
		"types" : {
			"default" : {
				"icon" : "glyphicon glyphicon-flash"
			},
			"demo" : {
				"icon" : "glyphicon glyphicon-ok"
			}
		},
		//"plugins" : [ "types" ]
		"callback": {
			/*onselect : function(node,tree_obj){//节点单击事件  
                var test = $(node).children("a").attr("href");//获取json串A标签中href属性值  
                alert(test);
                $(parent.document.body).find('#CONTENT_WORK_MAIN').attr('src', test);  
                //获取点击的A标签的href属性，然后获取右边的iframe对象，然后设置iframe的location  
			}, */ 
		}
	}).on('delete_node.jstree', function(e, data) {
		$.post('/admin/news/loadCategory/action/delete_node', {
			'id' : data.node.id
		}).fail(function() {
			data.instance.refresh();
		});
	}).on('create_node.jstree', function(e, data) {
//		console.log(data);
//		alert(data);
		$.post('/admin/news/loadCategory/action/create_node', {
			'id' : data.node.parent,
			'position' : data.position,
			'text' : data.node.text
		}).done(function(d) {
//			console.log(d);
			alert(d.id);
			data.instance.set_id(data.node, d.id);
		}).fail(function() {
			data.instance.refresh();
		});
	}).on('rename_node.jstree', function(e, data) {
		//alert(data.node.id);
		$.post('/admin/news/loadCategory/action/rename_node', {
			'id' : data.node.id,
			'text' : data.text
		}).fail(function() {
			//alert(d);
			data.instance.refresh();
		});
	}).on('changed.jstree',function(e, data) {
		
			/*if (data && data.selected && data.selected.length) {
				$.get('/admin/news/loadCategory/action/get_content/id/'+ data.selected.join(':'), function(d) {
					$('#data .default').html(d.content).show();
				});
			} else {
				$('#data .content').hide();
				$('#data .default').html('Select a file from the tree.').show();
			}*/
		
		//alert(url);
			//window.location.href=url;
		}).bind('dblclick.jstree', function(event) {
			//alert(event);
			/*console.log(event);
	        var eventNodeName = event.target.nodeName;    
	        var id = $(event.target).parents('li').attr('id');
	        var url = "/admin/news/index/category/"+id;
	        window.location.href=url;*/
	        //alert(eventNodeName);
	          /*console.log(event.target);
	          	if (eventNodeName == 'INS') {
	          		return;
				} else if (eventNodeName == 'A') {
				    var $subject = $(event.target).parent();                   
				    if ($subject.find('ul').length > 0) {
				    } else {
				      //选择的id值
				       alert($(event.target).parents('li').attr('id'));
				    }
				}*/
	    })
	}