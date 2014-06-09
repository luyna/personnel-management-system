<?php
session_start();
if(!($_SESSION['manageID'])){
 echo " <script >alert('您还未登陆，请先登陆！');window.location.href='http://localhost/managesystem/login.html';</script>";

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎，您好</title>
<link rel="stylesheet" type="text/css" href="ext3build/resources/css/ext-all.css" />
<script type="text/javascript" src="ext3build/ext-base.js"></script>
<script type="text/javascript" src="ext3build/ext-all.js"></script>
<script type="text/javascript" src="ext3build/ext-lang-zh_CN.js"></script>
<script type="text/javascript" src="gridToExcel.js"></script>

//grid根据内容自动换行
<style type="text/css">
        .x-grid3-cell-inner
        {
            white-space: normal;
        }
 </style>
 
 <script type="text/javascript">
  Ext.onReady(function(){
  
 Ext.QuickTips.init();
 Ext.form.Field.prototype.msgTarget='side';

  


  //定义窗口center面板
   var centerPanel= new Ext.TabPanel({
         region:'center',
		 border:false,
	     bodyStyle:Ext.Elementapplystyles,
		 border:false,
		 autoScroll:true,
		 //collapsible:true,
		 activeTab:'main',
		 items:[{
		    title:'首页',
			id:'main',
			bodyStyle:'background:url(images/panel.jpg) ',//设置背景图片
			html:'<h1 align="center">人事管理系统</h1><h1>管理员： </h1><p> a.基本信息管理：<br />1&gt;基本信息添加 <br /> 2&gt;显示全部（包括在职、转出、辞退、退休所有员工信息） <br />3&gt;基本信息查询：（查询之后可修改、在数据库中彻底删除、保存，导出数据到Excel） <br /> a&gt;简单查询：员工号，性别、姓名、最高学历、部门、状态、婚姻状况、状态，婚姻状况、身份证号 <br />b&gt;高级查询：姓名、婚姻、性别、部门、状态、最高学历、出生日期、毕业时间、入职时间 <br /> B、高级信息管理： <br /> 调动记录、调动查询 <br />部门信息录入、部门信息查询 <br />惩奖记录、惩奖查询 <br />培训记录、培训查询 <br />修改员工状态、状态修改查看 <br />C、工资管理： <br /> 工资信息录入 <br /> 工资信息查询（可查到工资表字段信息和总工资，查询后可修改保存删除） <br /> D、系统管理： <br />数据备份 <br />数据还原 <br /> D、其他管理： <br />密码修改 <br />管理记录  </p><h1>普通用户：</h1><p> 查询自己信息 <br /> 修改密码 <br /> 查询同部门人员 </p>' 
		 }]
	 });
	
	     
	 
  //基本信息管理
   var tree1= new Ext.tree.TreePanel({
     loader:new Ext.tree.TreeLoader(),
	 rootVisible:false,
	 useArrows:true,
	 
	  root:new Ext.tree.AsyncTreeNode({
		     id:'root',
			 expanded:true,
			 leaf:false,
			 children:[{
			   text:'添加基本信息',
			   id:'add',
			   leaf:true,
			   icon:'images/query.gif'
			 },{
			   text:'显示全部',
			   id:'all',
			   leaf:true,
			   icon:'images/query.gif'
			 },{
			    text:'简单查询',
				id:'select',
				leaf:false,
				icon:'images/query.gif',
			    children:[{
				   text:'员工号',
				   id:'userID',
				   leaf:true,
				   icon:'images/se.gif'
				 },{
					text:'姓名',
					id:'username',
					leaf:true,
					icon:'images/se.gif'
				 },{
					text:'性别',
					id:'sex',
					leaf:true,
					icon:'images/se.gif'
				 },{
					text:'最高学历',
					id:'edu',
					leaf:true,
					icon:'images/se.gif'
				},{
					text:'部门',
					id:'dept',
					leaf:true,
					icon:'images/se.gif'
				},{
					text:'状态',
					id:'state',
					leaf:true,
					icon:'images/se.gif'
				},{
					text:'婚姻状况',
					id:'marriage',
					leaf:true,
					icon:'images/se.gif'
				},{
				    text:'身份证号',
					id:'id',
					leaf:true,
					icon:'images/se.gif'
				}]
			},{text:'高级查询',
				   id:'advance',
				   leaf:true,
				   icon:'images/query.gif'}]
		 }),
     listeners:{
	  'click':function(e){
	    if(e.leaf){
	         if(e.id=='add'){
				         //添加信息面板
					   
					   var jobStore= new Ext.data.JsonStore({
					      url:'jobComboBox.php',
						  autoLoad:false,
						  root:'job',
						  fields:['deptnum','jobname']
					   });
					 	   
					   var addform=new Ext.form.FormPanel({
						labelAlign:'right',
						labelWidth:80,
						frame:true,
						layout:'form',
						autoScroll:true,
						defaultType:'textfield',
						items:[
						{fieldLabel:'员工号',name:'userID',allowBlank:false,blankText:"用户ID不能为空",width:150},
						{fieldLabel:'姓名', name:'username',width:150},
						{fieldLabel:'性别',name:'sex',width:150,xtype:'combo',
						       store:new Ext.data.SimpleStore({
							      fields:['value','text'],
								  data:[['0','男'],['1','女']]
							  }),
							  displayField:'text',
							  valueField:'value',
							  mode:'local',
							  editable:false,
							  value:'0',
							  triggerAction:'all' }, 
						{fieldLabel:'出生日期',name:'birth',width:150,xtype:'datefield',format:'Y-m-d',value:new Date()},
						{fieldLabel:'身份证号',name:'id',id:'id',width:150,allowBlank:false,maxLength:23,minLength:23,maxLengthText:'身份证号为23位',minLengthText:'身份证号为23位'},
						{fieldLabel:'婚姻状况',name:'marriage',width:150,xtype:'combo',
						      store:new Ext.data.SimpleStore({
							      fields:['value','text'],
								  data:[['0','是'],['1','否']]
							  }),
							  displayField:'text',
							  valueField:'value',
							  mode:'local',
							  editable:false,
							  value:'0',
							  triggerAction:'all' },
						{fieldLabel:'民族',name:'nation',width:150},
					    {fieldLabel:'政治面貌',name:'zzmm',width:150},
						{fieldLabel:'联系电话',name:'tel',width:150},
						{fieldLabel:'地址',name:'addr',width:150},
						  {fieldLabel:'部门',name:'dept',xtype:'combo',width:150,
							  store: new Ext.data.Store({
							   proxy:new Ext.data.HttpProxy({url:'deptComboBox.php'}),
							   reader:new Ext.data.JsonReader({
							        root:'dept',
								    fields:[{name:'deptnum'},{name:'deptname'}]})
							   }),
							   displayField:'deptname',
							  valueField:'deptnum',
							  mode:'remote',
							  editable:false,
							  allowBlank:false,
							 // emptyText:'请选择',
							  triggerAction:'all',
							  listeners:{
							      "select":function(dept,record,index){
								    //addform.findById('job').setRawValue('');
								    var deptnum=dept.getValue();
									jobStore.load({params:{code:deptnum}});
									
								  }
							     }
							   
							  },
						{fieldLabel:'职务',name:'job',xtype:'combo',width:150,
						      store:jobStore,
							  displayField:'jobname',
							  valueField:'deptnum',
							  mode:'local',       //注意不能是remote，因为触发部门选项时，已将数据加载到本地
							  allowBlank:false,
							  editable:false,
							  //emptyText:'请选择',
							  triggerAction:'all'
						},
						{fieldLabel:'状态',name:'state',xtype:'combo',width:150,
						  store:new Ext.data.SimpleStore({
						      fields:['value','text'],
							  data:[['0','在职'],['1','转出'],['2','辞退'],['3','退休']]}),
							  displayField:'text',
							  valueField:'value',
							  mode:'local',
							  editable:false,
							  triggerAction:'all',
							  value:'0'},
						{fieldLabel:'最高学历',name:'edu',xtype:'combo',width:150,
						  store:new Ext.data.SimpleStore({
						        fields:['value','text'],
								data:[['0','博士'],['1','硕士'],['2','学士'],['3','高中'],['4','初中'],['5','小学']]
						  }),
						  displayField:'text',
						  valueField:'value',
						  mode:'local',
						  editable:false,
						  triggerAction:'all',
						  value:'2'},
						  {fieldLabel:'专业',name:'spec',width:150},
						  {fieldLabel:'外语',name:'fore',width:150},
						  {fieldLabel:'毕业院校',name:'school',width:150},
						  {fieldLabel:'毕业时间',name:'graduateTime',xtype:'datefield',format:'Y-m-d',value:new Date(),width:150},
						  {fieldLabel:'入职日期',name:'beginTime',xtype:'datefield',format:'Y-m-d',value:new Date(),width:150},
						  {fieldLabel:'终止日期',name:'endTime',xtype:'datefield',format:'Y-m-d',value:new Date(),width:150},
						  {fieldLabel:'备注',name:'mark',xtype:'textarea',width:170}
						]
					  });
					  //添加信息窗口
				        var addwin= new Ext.Window({
                         	layout:'fit',
	                        width:350,
							height:500,
							title:'添加',
	                        closeAction:'close',
						    //animEl:e.ui.textNode,
							animateTarget:document.body,
	                         modal:true,
	                         items:[addform],
	                         buttons:[
							 {text:'提交',type:'submit',
							    handler:function(){
							         if(addform.form.isValid()){
										 addform.form.doAction('submit',{
										   url:'add.php',
										   waitMsg:'正在提交，请稍后...',
										   method:'post',
										   params:'dosubmit=true',
										   success:function(addform,action){
													   if(action.result.msg=='ok'){
														  Ext.Msg.alert('添加','员工信息添加成功！',function(){addwin.close();});
														}
													  else if(action.result.msg=='id'){
													 Ext.Msg.alert('添加','该员工身份证号已存在，请重新输入',function(){Ext.get('id').focus(true);});
														}
													  else{
														  Ext.Msg.alert("添加",action.result.msg,function(){addform.reset();});
													   }
										   },
										   failure:function(addform,action){
											 if(action.failureType == Ext.form.Action.SERVER_INVALID)
											 Ext.MessageBox.alert('登录失败','服务器出现错误，请稍后再试');
											    addwin.close();
										   }
							           })
								     }
							  }
							},{text:'取消',handler:function(){addwin.close();}}]
                      });
                     addwin.show();
		     }else if(e.id=='all'){
			       var allCm=new Ext.grid.ColumnModel([
								 {header:'员工号',dataIndex:'userID',sortable:true,align:'center'},
								 {header:'姓名',dataIndex:'username',align:'center'},
								 {header:'性别',dataIndex:'sex',align:'center'},
								 {header:'出生日期',dataIndex:'birth',sortable:true,align:'center'},
								 {header:'身份证号',dataIndex:'id',sortable:true},
								 {header:'婚姻状况',dataIndex:'marriage',align:'center'},
								 {header:'民族',dataIndex:'nation',align:'center'},
								 {header:'政治面貌',dataIndex:'zzmm',align:'center'},
								 {header:'联系电话',dataIndex:'tel'},
								 {header:'地址',dataIndex:'addr'},
								 {header:'部门',dataIndex:'deptname',align:'center'},
								 {header:'职务',dataIndex:'job',align:'center'},
								 {header:'学历',dataIndex:'edu',align:'center'},
								 {header:'专业',dataIndex:'spec',align:'center'},
								 {header:'外语',dataIndex:'fore'},
								 {header:'毕业时间',dataIndex:'graduateTime',sortable:true},
								 {header:'毕业院校',dataIndex:'school'},
								 {header:'入职日期',dataIndex:'beginTime',sortable:true},
								 {header:'终止日期',dataIndex:'endTime',sortable:true},
								 {header:'状态',dataIndex:'state'},
								 {header:'备注',dataIndex:'mark'}]
								 );
	
			   var allStore= new Ext.data.Store({
				  proxy:new Ext.data.HttpProxy({url:'displayAll.php'}),
				  reader:new Ext.data.JsonReader({
					totalProperty:'totalProperty',
					root:'root'},[
					{name:'userID',type:'int'},
					{name:'username'},
					{name:'sex'},
					{name:'birth'},
					{name:'id',type:'int'},
					{name:'marriage'},
					{name:'nation'},
					{name:'zzmm'},
					{name:'tel'},
					{name:'addr'},
					{name:'deptname'},
					{name:'job'},
					{name:'edu'},
					{name:'spec'},
					{name:'fore'},
					{name:'graduateTime'},
					{name:'school'},
					{name:'beginTime'},
					{name:'endTime'},
					{name:'state'},
					{name:'mark'}
				  ]),
			  sortInfo:{field:'userID',direction:'ESC'}
			 });
							  
			 var allGrid=new Ext.grid.GridPanel({
				 height:500,
				 store:allStore,
				 cm:allCm,
				 layout:'fit',
				 loadMask:true,
				 trackMouseOver:true,  //高亮显示鼠标经过的行
				 stripeRows:true,
				 viewConfig:{forceFit:false},//强制显示所有列信息，不用滚动条
				 autoScroll:true,
				 animCollapse : true,		//设置关闭面板时的动态效果
				loadMask : {msg : '数据加载...'},
	
				 tbar:new Ext.Toolbar(['-',{text:'清空',width:70,handler:function(){
									  Ext.Msg.confirm('警告','您确定要清空所有数据？',function(btn){
										   if(btn=='yes'){
											  Ext.lib.Ajax.request('POST','deleteAll.php',{
												 success:function(response){
													var str=Ext.util.JSON.decode(response.responseText);
													Ext.Msg.alert('消息',str.msg);
													centerPanel.remove(tab);
													//centerPanel.setActiveTab(tab);
												 },
												 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}
											  });
										   }
									  })
				 }},'-',{text:'刷新',width:70,handler:function(){allStore.reload();}},'-',{text:'导出excel',width:70,handler:function(){
						var vExportContent = allGrid.getExcelXml();	
						//Ext.Msg.alert('',vExportContent);
						if (Ext.isIE6 || Ext.isIE7 || Ext.isSafari || Ext.isSafari2 || Ext.isSafari3) {
							var fd=Ext.get('frmDummy');
							if (!fd) {
								fd=Ext.DomHelper.append(Ext.getBody(),{tag:'form',method:'post',id:'frmDummy',
								action:'exportexcel.php', target:'_blank',name:'frmDummy',cls:'x-hidden',cn:[
									{tag:'input',name:'exportContent',id:'exportContent',type:'hidden'}
								]},true);
							}
							fd.child('#exportContent').set({value:vExportContent});
							fd.dom.submit();
						} else {
							document.location = 'data:application/vnd.ms-excel;base64,'+Base64.encode(vExportContent);
						}
				 }},'-']),
				 bbar:new Ext.PagingToolbar({
				   pageSize:20,
				   store:allStore,
				   displayInfo:true,
				   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
				   emptyMsg:'没有记录'
				 })
			 });
		   allStore.load({params:{start:0,limit:20}});
											
											
		  var tab=centerPanel.add({
				  title:'显示全部',
				  closable:true,
				  closeAction:'hide',
				  autoDestory:false,
				  items:[allGrid],
				  listeners:{
					 'beforedestory':function(tab){  //添加该事件之后遍不会出现销毁后不能再次打开的现象
						centerPanel.remove(tab,false);
						tab.hide();
						return false;
					 }
				  }
			});
		  centerPanel.activate(tab);                   
		 }
		 else  if(e.id=='advance'){
			
			   var advancePanel= new Ext.form.FormPanel({
			       title:'高级查询',
				   defaultType:'textfield',
				   labelWidth:100,
				   width:300,
				   height:400,
				   autoScroll:true,
				   frame:true,
				   labelAlign:'right',
				   defaults:{width:150},
				   layout:'form',
				   defaultType:'textfield',
				  items:[ 
					  {fieldLabel:'姓名',name:'username'},
					  {fieldLabel:'婚姻',name:'marriage',xtype:'combo',
						  store:new Ext.data.SimpleStore({
							  fields:['value','text'],
							  data:[['0','是'],['1','否']]
						  }),
						  displayField:'text',
						  valueField:'value',
						  mode:'local',
						  triggerAction:'all' },
					 
				     {fieldLabel:'性别',name:'sex',xtype:'combo',
						  store:new Ext.data.SimpleStore({
							  fields:['value','text'],
							  data:[['0','男'],['1','女']]
						  }),
						  displayField:'text',
						  valueField:'value',
						  mode:'local',
						  triggerAction:'all' },
				     {fieldLabel:'部门',name:'dept',xtype:'combo',width:150,
							  store: new Ext.data.Store({
							   proxy:new Ext.data.HttpProxy({url:'deptComboBox.php'}),
							   reader:new Ext.data.JsonReader({
							        root:'dept',
								    fields:[{name:'deptnum'},{name:'deptname'}]})
							   }),
							   displayField:'deptname',
							  valueField:'deptnum',
							  mode:'remote',
							  editable:false,
							  allowBlank:true,
							 // emptyText:'请选择',
							  triggerAction:'all'
							   
							  },
				   {fieldLabel:'状态',name:'state',xtype:'combo',
						  store:new Ext.data.SimpleStore({
							  fields:['value','text'],
							  data:[['0','在职'],['1','转出'],['2','辞退'],['3','退休']]
						  }),
						  displayField:'text',
						  valueField:'value',
						  mode:'local',
						  triggerAction:'all' },
				  {fieldLabel:'最高学历',name:'edu',xtype:'combo',width:150,
					  store:new Ext.data.SimpleStore({
							fields:['value','text'],
							data:[['0','博士'],['1','硕士'],['2','学士'],['3','高中'],['4','初中'],['5','小学']]
					  }),
					  displayField:'text',
					  valueField:'value',
					  mode:'local',
					  triggerAction:'all'},
				 {fieldLabel:'出生日期：from',name:'age0',xtype:'datefield',format:'Y-m-d'},
				 {fieldLabel:'to',name:'age1',xtype:'datefield',format:'Y-m-d'},
				  {fieldLabel:'毕业时间:from',name:'graduateTime0',xtype:'datefield',format:'Y-m-d'},
				 {fieldLabel:'to',name:'graduateTime1',xtype:'datefield',format:'Y-m-d'},
				 {fieldLabel:'入职时间:from',name:'beginTime0',xtype:'datefield',format:'Y-m-d'},
				 {fieldLabel:'to',name:'beginTime1',xtype:'datefield',format:'Y-m-d'}]
			   });
			   var advanceWin= new Ext.Window({
			       layout:'fit',
				   width:350,
				   height:500,
				   modal:true,
				   items:[advancePanel],
				   buttons:[{text:'查询',type:'submit',handler:function(form,action){
				       if(advancePanel.form.isValid()){
					   
					      advancePanel.getForm().submit({
						     url:'advancedSelect.php',
							 method:'POST',
							 success:function(form,action){
							   if(action.result.msg=='null'){
							     Ext.Msg.alert('高级查询','您输入的查询条件为空，请重新输入');
							   }
							   else if(action.result.msg=='ok'){
							       
								   var sm= new Ext.grid.CheckboxSelectionModel({handleMouseDown:Ext.emptyFn});//只允许用户通过复选框执行选择操作
								   var cm=new Ext.grid.ColumnModel([
										 new Ext.grid.RowNumberer(),sm,
										 {header:'员工号',dataIndex:'userID',align:'center',sortable:true},//主键不能修改
										 {header:'姓名',dataIndex:'username',align:'center',
											 editor: new Ext.form.TextField()},
										 {header:'性别',dataIndex:'sex',//align:'center',
											  editor: new Ext.form.ComboBox({
															  store:store1=new Ext.data.SimpleStore({
																	  fields:['value1','text1'],
																	  data:sexdata=[['男','男'],['女','女']]
																  }),
															  id:'combo1',
															  //name:'combo1',
															 // hiddenName:'com1',
															  displayField:'text1',
															  valueField:'value1',
															  autoLoad:true,
															  forceSelection:true,//选择的值只能是列表中的值
															  mode:'local',
															  selectOnFocus:true,
															  //value:'0',lazyRender:true
															  triggerAction:'all' 
															   }),
											  renderer:function(value){ 
													   var index1=store1.find(Ext.getCmp('combo1').valueField,value);
													   var record1=store1.getAt(index1);
													   var temp1="";
													   if(record1){temp1=record1.data.text1;}
													   return temp1;
											  }},
										 {header:'出生日期',dataIndex:'birth',sortable:true,//align:'center',
											   editor:new Ext.form.DateField({format:'Y-m-d'}),
											   renderer:new Ext.util.Format.dateRenderer('Y-m-d')},
										 {header:'身份证号',dataIndex:'id',sortable:true,
												 editor:new Ext.form.TextField()},
										 {header:'婚姻状况',dataIndex:'marriage',//align:'center',
											 editor: new Ext.form.ComboBox({
												   store:store=new Ext.data.SimpleStore({
													  fields:['value','text'],
													  data:[['是','是'],['否','否']]
												   }),
												   id:'combo',
												   displayField:'text',
												  valueField:'value',
												  autoLoad:true,
												  forceSelection:true,//选择的值只能是列表中的值
												  mode:'local',
												  selectOnFocus:true,
												  triggerAction:'all' 
												   }),
												renderer:function(value){ 
													   var index=store.find(Ext.getCmp('combo').valueField,value);
													   var record=store.getAt(index);
													   var temp="";
													   if(record){temp=record.data.text;}
													   return temp;
											   }
											 },
										 {header:'民族',dataIndex:'nation',align:'center',
											   editor:new Ext.form.TextField({allowBlank:true})},
										 {header:'政治面貌',dataIndex:'zzmm',align:'center',
												editor: new Ext.form.TextField({allowBlank:true})},
										 {header:'联系电话',dataIndex:'tel',
												 editor:new Ext.form.TextField({allowBlank:true})},
										 {header:'地址',dataIndex:'addr',
												 editor:new Ext.form.TextField({allowBlank:true})},
										 {header:'部门',dataIndex:'deptname'},   //职务和部门在此处不设修改，在高级信息管理里修改								
										 {header:'职务',dataIndex:'job'},
										  {header:'状态',dataIndex:'state'},//状态在此处也不设修改
										 {header:'外语',dataIndex:'fore',
												   editor:new Ext.form.TextField({allowBlank:true})},
										 {header:'学历',dataIndex:'edu',
											 editor:new Ext.form.ComboBox({
														  store:store3=new Ext.data.SimpleStore({
																  fields:['value3','text3'],
																 data:[['博士','博士'],['硕士','硕士'],['学士','学士'],
																		['高中','高中'],['初中','初中'],['小学','小学']]
														  }),
														  id:'combo3',
														  displayField:'text3',
														  valueField:'value3',
														   autoLoad:true,
														  forceSelection:true,
														  mode:'local',
														  //value:'0',
														  triggerAction:'all'  }),
											 renderer:function(value){ 
													   var index3=store3.find(Ext.getCmp('combo3').valueField,value);
													   var record3=store3.getAt(index3);
													   var temp3="";
													   if(record3){temp3=record3.data.text3;}
													   return temp3;
											  }},
										 {header:'专业',dataIndex:'spec',align:'center',
												  editor:new Ext.form.TextField({allowBlank:true})},
										 {header:'毕业时间',dataIndex:'graduateTime',sortable:true,
											 editor:new Ext.form.DateField({allowBlank:true,format:'Y-m-d'}),
											 renderer:new Ext.util.Format.dateRenderer('Y-m-d')},
										 {header:'毕业院校',dataIndex:'school',align:'center',
											  editor:new Ext.form.TextField({allowBlank:true})},
										 {header:'入职日期',dataIndex:'beginTime',sortable:true,
											 editor:new Ext.form.DateField({allowBlank:true,format:'Y-m-d'}),
											 renderer:new Ext.util.Format.dateRenderer('Y-m-d')},
										 {header:'终止日期',dataIndex:'endTime',sortable:true,
											 editor:new Ext.form.DateField({allowBlank:true,format:'Y-m-d'}),
											 renderer:new Ext.util.Format.dateRenderer('Y-m-d')},
										 {header:'备注',dataIndex:'mark',
										   editor: new Ext.form.TextField({allowBlank:true})}]
										 );
												 
											
										   var ds= new Ext.data.Store({//注意该处store与form的交互
											  proxy:new Ext.data.MemoryProxy(action.result),
											  pruneModifiedRecords:true,//True表示为，每次Store加载后，清除所有修改过的记录信息；
											  reader:new Ext.data.JsonReader({
												totalProperty:'totalProperty',
												root:'root'},[
												{name:'userID',type:'int'},
												{name:'username'},
												{name:'sex'},
												{name:'birth'},
												{name:'id',type:'int'},
												{name:'marriage'},
												{name:'nation'},
												{name:'zzmm'},
												{name:'tel'},
												{name:'addr'},
												{name:'deptname'},
												{name:'job'},
												{name:'fore'},
												{name:'edu'},
												{name:'spec'},
												{name:'graduateTime'},
												{name:'school'},
												{name:'beginTime'},
												{name:'endTime'},
												{name:'state'},
												{name:'mark'}
											  ]),
											   sortInfo:{field:'userID',direction:'ESC'}
											 });
								
								
								      
											 var grid=new Ext.grid.EditorGridPanel({
												 title:'高级查询结果',
												 height:500,
												 store:ds,
												 cm:cm,
												 sm:sm,
												 layout:'fit',
												 loadMask:true,
												 stripeRows:true,
												 trackMouseOver:true, 
												 viewConfig:{forceFit:false},//强制显示所有列信息，不用滚动条
												 autoScroll:true,
												 clicksToEdit:1,
												 tbar:new Ext.Toolbar(['-',
												          {text:'删除',width:70,
														   handler:function(){
														     if(grid.getSelectionModel().getCount()>0){
														        Ext.Msg.confirm('信息','此数据将会在数据库中彻底删除，是否继续？',function(btn) {
																				     if(btn=='yes'){
																					     var record=grid.getSelectionModel().getSelections();
																 //var record = grid.getSelectionmodel().getSelected();如果sm是RowSelectionModel 
                                                                 //(var records = grid.getSelectionModel().getSelections;如果是CheckboxSelectModel 
																						for(var i=0;i<record.length;i++)
																						    ds.remove(record[i]);
																						var del=[];
																						Ext.each(record,function(item){del.push(item.data);});
																						 Ext.lib.Ajax.request('POST','delete.php',{
																						     success:function(response){
																							      var json=Ext.util.JSON.decode(response.responseText) ;
																							      if(json.msg=='ok'){Ext.Msg.alert('信息','删除成功');}
																								  else Ext.Msg.alert('错误','删除失败');
																							 },
																							 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}},
																							 'id='+encodeURIComponent(Ext.encode(del))
																						 )
																					 }
																				 });
														      }else Ext.Msg.alert('提示','您未选中任何行，请先选中！');
														   }},'-',{text:'保存',width:70,handler:function(){
														              //var m=ds.modified.slice(0);
																	  var change=ds.getModifiedRecords();//获取所有更新过的记录
																	  //var count=ds.getCount();//获取数据集中记录的数量
																	  if(change.length==0) {Ext.Msg.alert('保存','您当前没有进行任何修改');}
																	  else{
																		  var json=[];
																		  Ext.each(change,function(item){
																			 json.push(item.data);
																		  })  ;
																		  Ext.lib.Ajax.request(
																			 'POST','save.php',{success:function(response){
																			      var str=Ext.util.JSON.decode(response.responseText);
																			      if(str.msg=='ok')
																				       Ext.Msg.alert('信息','保存成功');
																				   else Ext.Msg.alert('错误','保存失败');
																			 },failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}},
																			 'data=' + encodeURIComponent(Ext.encode(json)) 
	
																		  );
																	 }
														   }},'-',{text:'导出excel',width:70,handler:function(){
														        var vExportContent = grid.getExcelXml();
																//Ext.Msg.alert('',vExportContent);
																if (Ext.isIE6 || Ext.isIE7 || Ext.isSafari || Ext.isSafari2 || Ext.isSafari3) {
																	var fd1=Ext.get('frmDummy');
																	if (!fd1) {
																		fd1=Ext.DomHelper.append(Ext.getBody(),{tag:'form',method:'post',id:'frmDummy',
																		action:'exportexcel.php', target:'_blank',name:'frmDummy',cls:'x-hidden',cn:[
																			{tag:'input',name:'exportContent',id:'exportContent',type:'hidden'}
																		]},true);
																	}
																	fd1.child('#exportContent').set({value:vExportContent});
																	fd1.dom.submit();
																} else {
																	document.location = 'data:application/vnd.ms-excel;base64,'+Base64.encode(vExportContent);
																}
														   }},'-']),
												 bbar:new Ext.PagingToolbar({
												   pageSize:20,
												   store:ds,
												   displayInfo:true,
												   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
												   emptyMsg:'没有记录'
												 })
											 });
										 
											  ds.load({params:{start:0,limit:20}}); 
											  var win= new Ext.Window({
													  //layout:'fit',
													  width:900,
													  heigth:800,
													  title:'显示结果',
													  closeAction:'close',
													  animateTarget:document.body,
													  modal:true,
													  items:[grid],
													  autoScroll:true,
													  buttons:[{text:'确定',
																handler:function(){
																      var change=ds.getModifiedRecords();//获取所有更新过的记录
																	  //var count=ds.getCount();//获取数据集中记录的数量
																	  if(change.length!=0) {
																	      Ext.Msg.confirm('提示','当前页面的内容已修改，是否保存？',function(btn){
																		        if(btn=='yes'){
																				   var json=[];
																				  Ext.each(change,function(item){
																					 json.push(item.data);
																				  })  ;
																				  Ext.lib.Ajax.request(
																					 'POST','save.php',{success:function(response){
																						  var str=Ext.util.JSON.decode(response.responseText);
																						  if(str.msg=='ok')
																							   Ext.Msg.alert('信息','保存成功',function(){win.close();});
																						   else Ext.Msg.alert('错误','保存失败'),function(){win.close();};
																					 },failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}},
																					 'data=' + encodeURIComponent(Ext.encode(json)) 
			
																				  );
																				}
																		  });
																	 
																		 }
																	 
											                else{win.close();}	}
													  }]
															  
											});
											win.show();
											advanceWin.close();
										  
							   }else Ext.Msg.alert('错误','查询失败');
							 },
							 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}
						  });
					   }}
				   },{text:'取消',handler:function(){advanceWin.close();}}]
			   });
			   advanceWin.show();
			}
			else{
				 leafname="";
				if(e.id=='userID'){leafname="员工号";}
				  else if(e.id=='username'){leafname="员工姓名";}
				  else if(e.id=='sex'){leafname="性别（男/女）";}
				  else if(e.id=='dept'){leafname="部门（软件部/市场部/财务部/行政人力部）";}
				  else if(e.id=='state'){leafname="状态（在职/转出/辞退/退休）";}
				  else if(e.id=='edu'){leafname="最高学历（硕士/博士/学士/高中/初中/小学）";}
				  else if(e.id=='marriage'){leafname="婚姻状况（是/否）";}
				  else if(e.id=='id'){leafname="身份证号";}
			    Ext.Msg.prompt('选择查询','请输入您要查询的'+leafname,
			                   function(btn,text){
			                   
									 if(btn=='ok'){
									      //查询面板：列模式、数据存储、表格面板、显示窗口
									   if(text==''){Ext.Msg.alert('简单查询','您输入的数据为空');}
									   else{
								           var sm= new Ext.grid.CheckboxSelectionModel({handleMouseDown:Ext.emptyFn});//只允许用户通过复选框执行选择操作
									       var cm=new Ext.grid.ColumnModel([
												 new Ext.grid.RowNumberer(),sm,
												 {header:'员工号',dataIndex:'userID',align:'center',sortable:true},
												 {header:'姓名',dataIndex:'username',align:'center',
												     editor: new Ext.form.TextField()},
												 {header:'性别',dataIndex:'sex',//align:'center',
												      editor: new Ext.form.ComboBox({
													                  store:store1=new Ext.data.SimpleStore({
																			  fields:['value1','text1'],
																			  data:sexdata=[['男','男'],['女','女']]
																		  }),
																	  id:'combo1',
																	  displayField:'text1',
																	  valueField:'value1',
																	  autoLoad:true,
																	  forceSelection:true,//选择的值只能是列表中的值
																	  mode:'local',
																	  selectOnFocus:true,
																	  triggerAction:'all' 
																	   }),
													  renderer:function(value){ 
													           var index1=store1.find(Ext.getCmp('combo1').valueField,value);
															   var record1=store1.getAt(index1);
															   var temp1="";
															   if(record1){temp1=record1.data.text1;}
															   return temp1;
													  }},
												 {header:'出生日期',dataIndex:'birth',sortable:true,//align:'center',
												       editor:new Ext.form.DateField({format:'Y-m-d'}),
													   renderer:new Ext.util.Format.dateRenderer('Y-m-d')},
												 {header:'身份证号',dataIndex:'id',sortable:true,
												         editor:new Ext.form.TextField()},
												 {header:'婚姻状况',dataIndex:'marriage',//align:'center',
												     editor: new Ext.form.ComboBox({
													       store:store=new Ext.data.SimpleStore({
														      fields:['value','text'],
															  data:[['是','是'],['否','否']]
														   }),
														   id:'combo',
														   displayField:'text',
														  valueField:'value',
														  autoLoad:true,
														  forceSelection:true,//选择的值只能是列表中的值
														  mode:'local',
														  selectOnFocus:true,
														  //value:'0',lazyRender:true
														  triggerAction:'all' 
														   }),
													    renderer:function(value){ 
													           var index=store.find(Ext.getCmp('combo').valueField,value);
															   var record=store.getAt(index);
															   var temp="";
															   if(record){temp=record.data.text;}
															   return temp;
													   }
													 },
												 {header:'民族',dataIndex:'nation',align:'center',
												       editor:new Ext.form.TextField({allowBlank:true})},
												 {header:'政治面貌',dataIndex:'zzmm',align:'center',
												        editor: new Ext.form.TextField({allowBlank:true})},
												 {header:'联系电话',dataIndex:'tel',
												         editor:new Ext.form.TextField({allowBlank:true})},
												 {header:'地址',dataIndex:'addr',
												         editor:new Ext.form.TextField({allowBlank:true})},
												 {header:'部门',dataIndex:'deptname'},
												 {header:'职务',dataIndex:'job'},//align:'center',
												         // editor: new Ext.form.TextField({allowBlank:true})},
												   {header:'状态',dataIndex:'state'},
												 {header:'学历',dataIndex:'edu',//align:'center',
												     editor:new Ext.form.ComboBox({
																  store:store3=new Ext.data.SimpleStore({
																		 fields:['value3','text3'],
																		 data:[['博士','博士'],['硕士','硕士'],['学士','学士'],
																		        ['高中','高中'],['初中','初中'],['小学','小学']]
																  }),
																  id:'combo3',
																  //name:'combo3',
																  //hiddenName:'com3',
																  displayField:'text3',
																  valueField:'value3',
																   autoLoad:true,
																  forceSelection:true,
																  mode:'local',
																  //value:'0',
																  triggerAction:'all'  }),
										             renderer:function(value){ 
													           var index3=store3.find(Ext.getCmp('combo3').valueField,value);
															   var record3=store3.getAt(index3);
															   var temp3="";
															   if(record3){temp3=record3.data.text3;}
															   return temp3;
													  }},
												 {header:'专业',dataIndex:'spec',align:'center',
												          editor:new Ext.form.TextField({allowBlank:true})},
												 {header:'外语',dataIndex:'fore',align:'center',
												         editor:new Ext.form.TextField({allowBlank:true})},
												 {header:'毕业时间',dataIndex:'graduateTime',sortable:true,
												     editor:new Ext.form.DateField({allowBlank:true,format:'Y-m-d'}),
													 renderer:new Ext.util.Format.dateRenderer('Y-m-d')},
												 {header:'毕业院校',dataIndex:'school',align:'center',
												      editor:new Ext.form.TextField({allowBlank:true})},
												 {header:'入职日期',dataIndex:'beginTime',sortable:true,
												     editor:new Ext.form.DateField({allowBlank:true,format:'Y-m-d'}),
													 renderer:new Ext.util.Format.dateRenderer('Y-m-d')},
												 {header:'终止日期',dataIndex:'endTime',sortable:true,
												     editor:new Ext.form.DateField({allowBlank:true,format:'Y-m-d'}),
													 renderer:new Ext.util.Format.dateRenderer('Y-m-d')},
												 {header:'备注',dataIndex:'mark',
												   editor: new Ext.form.TextField({allowBlank:true})}]
												 );
												 
										
								 
										   var ds= new Ext.data.Store({
											  proxy:new Ext.data.HttpProxy({url:'query.php'}),
											  baseParams:{leaf:e.id,value:text},
											  pruneModifiedRecords:true,
											  reader:new Ext.data.JsonReader({
												totalProperty:'totalProperty',
												root:'root'},[
												{name:'userID',type:'int'},
												{name:'username'},
												{name:'sex'},
												{name:'birth'},
												{name:'id',type:'int'},
												{name:'marriage'},
												{name:'nation'},
												{name:'zzmm'},
												{name:'tel'},
												{name:'addr'},
												{name:'deptname'},
												{name:'job'},
												{name:'state'},
												{name:'edu'},
												{name:'spec'},
												{name:'fore'},
												{name:'graduateTime'},
												{name:'school'},
												{name:'beginTime'},
												{name:'endTime'},
												{name:'mark'}
											  ]),
											   sortInfo:{field:'userID',direction:'ESC'}
											 });
								
								
								      
											 var grid=new Ext.grid.EditorGridPanel({
												 //renderTo:'grid',
												 //autoHeight:true,
												 title:'简单查询结果',
												 height:500,
												 store:ds,
												 cm:cm,
												 sm:sm,
												 layout:'fit',
												 loadMask:true,
												 stripeRows:true,
												 clicksToEdit:1,
												 trackMouseOver:true, 
												 //autoWidth:true,
												 viewConfig:{forceFit:false},//强制显示所有列信息，不用滚动条
												 autoScroll:true,
												 //autoSizeColumns:true,
												 tbar:new Ext.Toolbar(['-',
												          {text:'删除',width:70,
														   handler:function(){
														     if(grid.getSelectionModel().getCount()>0){
														        Ext.Msg.confirm('信息','此数据将被从数据库中彻底删除，是否继续？',function(btn) {
																				     if(btn=='yes'){
																					     var record=grid.getSelectionModel().getSelections();
																 //var record = grid.getSelectionmodel().getSelected();如果sm是RowSelectionModel 
                                                                 //(var records = grid.getSelectionModel().getSelections;如果是CheckboxSelectModel 
																						
																						var del=[];
																						Ext.each(record,function(item){del.push(item.data);});
																						 Ext.lib.Ajax.request('POST','delete.php',{
																						     success:function(response){
																							      var json=Ext.util.JSON.decode(response.responseText) ;
																							      if(json.msg=='ok'){Ext.Msg.alert('信息','删除成功');
																								  for(var i=0;i<record.length;i++)
																						             ds.remove(record[i]);}
																								  else Ext.Msg.alert('错误','删除失败');
																							 },
																							 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}},
																							 'id='+encodeURIComponent(Ext.encode(del))
																						 )
																					 }
																				 });
														      }else Ext.Msg.alert('提示','您未选中任何行，请先选中！');
														   }},'-',{text:'保存',width:70,handler:function(){
														              //var m=ds.modified.slice(0);
																	  var change=ds.getModifiedRecords();//获取所有更新过的记录
																	  //var count=ds.getCount();//获取数据集中记录的数量
																	  if(change.length==0) {Ext.Msg.alert('保存','您当前没有进行任何修改');}
																	  else{
																		  var json=[];
																		  Ext.each(change,function(item){
																			 json.push(item.data);
																		  })  ;
																		  Ext.lib.Ajax.request(
																			 'POST','save.php',{success:function(response){
																			      var str=Ext.util.JSON.decode(response.responseText);
																			      if(str.msg=='ok')
																				       Ext.Msg.alert('信息','保存成功',function(){ds.reload();});
																				   else Ext.Msg.alert('错误','保存失败');
																			 },failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}},
																			 'data=' + encodeURIComponent(Ext.encode(json)) 
	
																		  );
																	 }
														   }},'-',{text:'导出excel',width:70,handler:function(){
														        var vExportContent = grid.getExcelXml();
																//Ext.Msg.alert('',vExportContent);
																if (Ext.isIE6 || Ext.isIE7 || Ext.isSafari || Ext.isSafari2 || Ext.isSafari3) {
																	var fd=Ext.get('frmDummy');
																	if (!fd) {
																		fd=Ext.DomHelper.append(Ext.getBody(),{tag:'form',method:'post',id:'frmDummy',
																		action:'exportexcel.php', target:'_blank',name:'frmDummy',cls:'x-hidden',cn:[
																			{tag:'input',name:'exportContent',id:'exportContent',type:'hidden'}
																		]},true);
																	}
																	fd.child('#exportContent').set({value:vExportContent});
																	fd.dom.submit();
																} else {
																	document.location = 'data:application/vnd.ms-excel;base64,'+Base64.encode(vExportContent);
																}
														   }},'-']),
												 bbar:new Ext.PagingToolbar({
												   pageSize:20,
												   store:ds,
												   displayInfo:true,
												   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
												   emptyMsg:'没有记录'
												 })
											 });
										 
											  ds.load({params:{start:0,limit:20}}); 
											  var win= new Ext.Window({
													  //layout:'fit',
													  width:900,
													  heigth:800,
													  title:'显示结果',
													  closeAction:'close',
													  animateTarget:document.body,
													  modal:true,
													  items:[grid],
													  autoScroll:true,
													  buttons:[{text:'确定',
																handler:function(){
																      var change=ds.getModifiedRecords();//获取所有更新过的记录
																	  //var count=ds.getCount();//获取数据集中记录的数量
																	  if(change.length!=0) {
																	      Ext.Msg.confirm('提示','当前页面的内容已修改，是否保存？',function(btn){
																		        if(btn=='yes'){
																				   var json=[];
																				  Ext.each(change,function(item){
																					 json.push(item.data);
																				  })  ;
																				  Ext.lib.Ajax.request(
																					 'POST','save.php',{success:function(response){
																						  var str=Ext.util.JSON.decode(response.responseText);
																						  if(str.msg=='ok')
																							   Ext.Msg.alert('信息','保存成功',function(){win.close();});
																						   else Ext.Msg.alert('错误','保存失败',function(){win.close();});
																					 },failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}},
																					 'data=' + encodeURIComponent(Ext.encode(json)) 
			
																				  );
																				}
																		  });
																	 
																		 }
																	 
											   else {win.close();}	}
													  }]
															  
											});
											win.show();
										}
									}	
								  							  
								});
			  }  
			} 
		 }
	  
	  } 
  });
  
	 
  //管理树
  //高级信息管理
   var tree3=new Ext.tree.TreePanel({
      loader:new Ext.tree.TreeLoader(),
	 rootVisible:false,
	 useArrows:true,
	 
	  root:new Ext.tree.AsyncTreeNode({
		     id:'root',
			 expanded:true,
			 leaf:false,
			 children:[{
			   text:'调动记录',
			   id:'moveRecord',
			   leaf:true,
			   icon:'images/query.gif'
			 },{
			    text:'调动查询',
				id:'moveQuery',
				leaf:true,
				icon:'images/query.gif'
			  },{
			    text:'部门信息录入',
				id:'deptRecord',
				leaf:true,
				icon:'images/query.gif'
			  },{
			    text:'部门信息查询',
				id:'deptQuery',
				leaf:true,
				icon:'images/query.gif'
			  },{
			    text:'惩奖记录',
				id:'chengjiangRecord',
				leaf:true,
				icon:'images/query.gif'
			  },{
			    text:'惩奖查询',
				id:'chengjiangQuery',
				leaf:true,
				icon:'images/query.gif'
			  },{
			    text:'培训记录',
				id:'trainRecord',
				leaf:true,
				icon:'images/query.gif'
			  },{
			    text:'培训查询',
				id:'trainQuery',
				leaf:true,
				icon:'images/query.gif'
			  },{
			    text:'修改员工状态',
				id:'changeState',
				leaf:true,
				icon:'images/query.gif'
			  },{
			    text:'状态修改查看',
				id:'changeStateQuery',
				leaf:true,
				icon:'images/query.gif'
			  }]
      
	  }),
	  listeners:{
	    'click':function(node){
		    if(node.leaf){
			  if(node.id=='moveRecord'){
			     var jobStore= new Ext.data.JsonStore({
					      url:'jobComboBox.php',
						  autoLoad:false,
						  root:'job',
						  fields:['deptnum','jobname']
					   });
			     var form = new Ext.form.FormPanel({
				     defaultType:'textfield',
					 labelAlign:'right',
					 title:'调动记录',
					 labelWidth:80,
					 frame:true,
					 layout:'form',
					 width:250,
					 items:[{fieldLabel:'用户号',name:'userID',blankText:'用户不能为空',allowBlank:false},
					         {fieldLabel:'调动时间',name:'time',xtype:'datefield',format:'Y-m-d',width:150},					
							  {fieldLabel:'部门',name:'dept',xtype:'combo',width:150,
							  store: new Ext.data.Store({
							   proxy:new Ext.data.HttpProxy({url:'deptComboBox.php'}),
							   reader:new Ext.data.JsonReader({
							        root:'dept',
								    fields:[{name:'deptnum'},{name:'deptname'}]})
							   }),
							   displayField:'deptname',
							  valueField:'deptnum',
							  mode:'remote',
							  editable:false,
							  allowBlank:false,
							  emptyText:'请选择',
							  triggerAction:'all',
							  listeners:{
							      "select":function(dept,record,index){
								    //addform.findById('job').setRawValue('');
								    var deptnum=dept.getValue();
									jobStore.load({params:{code:deptnum}});
									
								  }
							     }
							   
							  },
						{fieldLabel:'职务',name:'job',xtype:'combo',width:150,
						      store:jobStore,
							  displayField:'jobname',
							  valueField:'deptnum',
							  mode:'local',       //注意不能是remote，因为触发部门选项时，已将数据加载到本地
							  allowBlank:false,
							  editable:false,
							  emptyText:'请选择',
							  triggerAction:'all'
						},
					  {fieldLabel:'调动原因',name:'reason',xtype:'textarea',width:150}
					 ]
					 
				 });
				 var win=new Ext.Window({
					 layout:'fit',
					 width:300,
					 height:400,
					 modal:true,
					 closeAction:'close',
					 items:[form],
					 buttons:[{text:'提交',handler:function(){
					         if(form.form.isValid()){				
								  form.getForm().submit({
										 url:'moveRecord.php',
										 method:'POST',
										 success:function(form,action){
											if(action.result.msg=='null'){
											    Ext.Msg.alert('调动记录','员工号不存在请重新输入');
											}else if(action.result.msg=='ok'){
											    Ext.Msg.alert('调动记录','调动记录添加成功');win.close();
											}
                                          else{
											   Ext.Msg.alert('调动记录','调动记录添加失败');
											   win.close();
											}
										 },
										 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');win.close();}
								 });
							 }
						}
					 },{text:'取消',handler:function(){win.close();}}]
				 });
				win.show();
			  }
			else if(node.id=='moveQuery'){
			   Ext.Msg.prompt('调动记录查询','指定员工号或显示全部（缺省输入）',function(btn,text){
			      var cm=new Ext.grid.ColumnModel([
								 {header:'员工号',dataIndex:'userID',sortable:true,align:'center'},
								 {header:'调动时间',dataIndex:'movetime',align:'center'},
								 {header:'调后部门',dataIndex:'deptname',align:'center'},
								 {header:'调后职务',dataIndex:'jobname',align:'center'},
								 {header:'调动原因',dataIndex:'reason'}]
								 );
						 
				   var store= new Ext.data.Store({
					  proxy:new Ext.data.HttpProxy({url:'moveQuery.php'}),
					   baseParams:{value:text},
					  reader:new Ext.data.JsonReader({
						totalProperty:'totalProperty',
						root:'root'},[
						{name:'userID',type:'int'},
						{name:'movetime'},
						{name:'deptname'},
						{name:'jobname'},
						{name:'reason'},
						
					  ]),
				  sortInfo:{field:'userID',direction:'ESC'}
				 });
												  
			 var grid=new Ext.grid.GridPanel({
				 height:500,
				 store:store,
				 cm:cm,
				 layout:'fit',
				 loadMask:true,
				 trackMouseOver:true,  //高亮显示鼠标经过的行
				 stripeRows:true,
				 viewConfig:{forceFit:true},//强制显示所有列信息，不用滚动条
				 //autoScroll:true,
				 animCollapse : true,		//设置关闭面板时的动态效果
				loadMask : {msg : '数据加载...'},
				 bbar:new Ext.PagingToolbar({
						   pageSize:20,
						   store:store,
						   displayInfo:true,
						   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
						   emptyMsg:'没有记录'
						 })
				});
			 store.load({params:{start:0,limit:20}});
			 var win=new Ext.Window({
							  title:'调动记录查询结果',
							  width:600,
							  height:460,
							  modal:true,
							  items:[grid],
							  buttons:[{text:'确定',handler:function(){win.close();}}]
							});
			     if(btn=='ok'){ win.show();}
				}); 
			 }
			 else if(node.id=='deptRecord'){
			  
			     var form = new Ext.form.FormPanel({
				     defaultType:'textfield',
					 labelAlign:'right',
					 title:'部门信息录入',
					 labelWidth:80,
					 frame:true,
					 layout:'form',
					 width:250,
					 items:[{fieldLabel:'部门号',name:'deptnum',blankText:'部门号不能为空',allowBlank:false},
					         {fieldLabel:'部门名称',name:'deptname',width:150,blankText:'部门名称不能为空',allowBlank:false},					
							 {fieldLabel:'部门经理',name:'deptmanager',width:150},
						    {fieldLabel:'员工数',name:'employeenum',width:150},					
					        {fieldLabel:'部门描述',name:'deptdescribe',xtype:'textarea',width:150}
					 ]
					 
				 });
				 var win=new Ext.Window({
					 layout:'fit',
					 width:300,
					 height:400,
					 modal:true,
					 closeAction:'close',
					 items:[form],
					 buttons:[{text:'提交',handler:function(){
					         if(form.form.isValid()){				
								  form.getForm().submit({
										 url:'deptRecord.php',
										 method:'POST',
										 success:function(form,action){
										 if(action.result.msg=='exist'){
										      Ext.Msg.alert('部门信息录入','部门信息已存在，请重新输入');
										 } else if(action.result.msg=='managernull'){
											    Ext.Msg.alert('部门信息录入','部门经理不存在，请重新输入');
											}else if(action.result.msg=='ok'){
											    Ext.Msg.alert('部门信息录入','部门信息录入成功');win.close();
											}
                                          else{
											   Ext.Msg.alert('部门信息录入','部门信息录入失败');
											   win.close();
											}
										 },
										 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');win.close();}
								 });
							 }
						}
					 },{text:'取消',handler:function(){win.close();}}]
				 });
				win.show();
			 }
			 else if(node.id=='deptQuery'){
			     Ext.Msg.prompt('部门信息查询','按部门号查询或显示全部（缺省）',function(btn,text){
			      var cm=new Ext.grid.ColumnModel([
								 {header:'部门号',dataIndex:'deptnum',sortable:true,align:'center'},
								 {header:'部门名称',dataIndex:'deptname',align:'center'},
								 {header:'部门经理',dataIndex:'deptmanager',align:'center'},
								 {header:'员工数',dataIndex:'employeenum',align:'center'},
								 {header:'部门描述',dataIndex:'deptdescribe'}]
								 );
						 
				   var store= new Ext.data.Store({
					  proxy:new Ext.data.HttpProxy({url:'deptQuery.php'}),
					   baseParams:{value:text},
					  reader:new Ext.data.JsonReader({
						totalProperty:'totalProperty',
						root:'root'},[
						{name:'deptnum',type:'int'},
						{name:'deptname'},
						{name:'deptmanager'},
						{name:'employeenum'},
						{name:'deptdescribe'},
						
					  ]),
				  sortInfo:{field:'deptnum',direction:'ESC'}
				 });
												  
			 var grid=new Ext.grid.GridPanel({
				 height:500,
				 store:store,
				 cm:cm,
				 layout:'fit',
				 loadMask:true,
				 trackMouseOver:true,  //高亮显示鼠标经过的行
				 stripeRows:true,
				 viewConfig:{forceFit:true},//强制显示所有列信息，不用滚动条
				 //autoScroll:true,
				 animCollapse : true,		//设置关闭面板时的动态效果
				loadMask : {msg : '数据加载...'},
				 bbar:new Ext.PagingToolbar({
						   pageSize:20,
						   store:store,
						   displayInfo:true,
						   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
						   emptyMsg:'没有记录'
						 })
				});
			 store.load({params:{start:0,limit:20}});
			 var win=new Ext.Window({
							  title:'部门信息查询结果',
							  width:600,
							  height:460,
							  modal:true,
							  items:[grid],
							  buttons:[{text:'确定',handler:function(){win.close();}}]
							});
			   if(btn=='ok'){ win.show();}
			   });
			 }
			 else if(node.id=='chengjiangRecord'){
			     var form = new Ext.form.FormPanel({
				     defaultType:'textfield',
					 labelAlign:'right',
					 title:'奖惩记录',
					 labelWidth:80,
					 frame:true,
					 layout:'form',
					 width:250,
					 items:[{fieldLabel:'用户号',name:'userID',blankText:'用户不能为空',allowBlank:false},
					         {fieldLabel:'奖惩日期',name:'date',xtype:'datefield',format:'Y-m-d',width:150},					
							 {fieldLabel:'奖惩类型',name:'type',xtype:'combo',width:150,
									  store:new Ext.data.SimpleStore({
										  fields:['value','text'],
										  data:[['0','奖'],['1','惩']]
									  }),
									  displayField:'text',
									  valueField:'value',
									  mode:'local',
									  editable:false,
									  value:'0',
									  triggerAction:'all' },
						    {fieldLabel:'奖惩分数',name:'score',xtype:'numberfield',width:150},	
					       {fieldLabel:'奖惩原因',name:'reason',xtype:'textarea',width:150}
					 ]
					 
				 });
				 var win=new Ext.Window({
					 layout:'fit',
					 width:300,
					 height:400,
					 modal:true,
					 closeAction:'close',
					 items:[form],
					 buttons:[{text:'提交',handler:function(){
					         if(form.form.isValid()){				
								  form.getForm().submit({
										 url:'jiangchengRecord.php',
										 method:'POST',
										 success:function(form,action){
											if(action.result.msg=='null'){
											    Ext.Msg.alert('调动记录','员工号不存在请重新输入');
											}else if(action.result.msg=='ok'){
											    Ext.Msg.alert('调动记录','调动记录添加成功');win.close();
											}
                                          else{
											   Ext.Msg.alert('调动记录','调动记录添加失败');
											   win.close();
											}
										 },
										 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');win.close();}
								 });
							 }
						}
					 },{text:'取消',handler:function(){win.close();}}]
				 });
				win.show();
			 }
			 else if(node.id=='chengjiangQuery'){
			        Ext.Msg.prompt('奖惩记录查询','指定员工号或显示全部（缺省输入）',function(btn,text){
			      var cm=new Ext.grid.ColumnModel([
								 {header:'员工号',dataIndex:'userID',sortable:true,align:'center'},
								 {header:'奖惩时间',dataIndex:'date',align:'center'},
								 {header:'奖惩类型',dataIndex:'type',align:'center'},
								 {header:'奖惩分数',dataIndex:'score',align:'center'},
								 {header:'奖惩原因',dataIndex:'reason'}]
								 );
						 
				   var store= new Ext.data.Store({
					  proxy:new Ext.data.HttpProxy({url:'jiangchengQuery.php'}),
					   baseParams:{value:text},
					  reader:new Ext.data.JsonReader({
						totalProperty:'totalProperty',
						root:'root'},[
						{name:'userID',type:'int'},
						{name:'date'},
						{name:'type'},
						{name:'score'},
						{name:'reason'},
						
					  ]),
				  sortInfo:{field:'userID',direction:'ESC'}
				 });
												  
			 var grid=new Ext.grid.GridPanel({
				 height:500,
				 store:store,
				 cm:cm,
				 layout:'fit',
				 loadMask:true,
				 trackMouseOver:true,  //高亮显示鼠标经过的行
				 stripeRows:true,
				 viewConfig:{forceFit:true},//强制显示所有列信息，不用滚动条
				 //autoScroll:true,
				 animCollapse : true,		//设置关闭面板时的动态效果
				loadMask : {msg : '数据加载...'},
				 bbar:new Ext.PagingToolbar({
						   pageSize:20,
						   store:store,
						   displayInfo:true,
						   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
						   emptyMsg:'没有记录'
						 })
				});
			 store.load({params:{start:0,limit:20}});
			 var win=new Ext.Window({
							  title:'奖惩记录查询结果',
							  width:600,
							  height:460,
							  modal:true,
							  items:[grid],
							  buttons:[{text:'确定',handler:function(){win.close();}}]
							});
			     if(btn=='ok'){ win.show();}
				}); 
			 }
			 else if(node.id=='trainRecord'){
			     var form = new Ext.form.FormPanel({
				     defaultType:'textfield',
					 labelAlign:'right',
					 title:'培训记录',
					 labelWidth:80,
					 frame:true,
					 layout:'form',
					 width:250,
					 items:[{fieldLabel:'用户号',name:'userID',blankText:'用户不能为空',allowBlank:false},
					         {fieldLabel:'培训日期',name:'date',xtype:'datefield',format:'Y-m-d',width:150},					
						    {fieldLabel:'培训内容',name:'content',xtype:'textarea',width:150},	
					       {fieldLabel:'培训结果',name:'result',xtype:'textarea',width:150}
					 ]
					 
				 });
				 var win=new Ext.Window({
					 layout:'fit',
					 width:300,
					 height:400,
					 modal:true,
					 closeAction:'close',
					 items:[form],
					 buttons:[{text:'提交',handler:function(){
					         if(form.form.isValid()){				
								  form.getForm().submit({
										 url:'trainRecord.php',
										 method:'POST',
										 success:function(form,action){
											if(action.result.msg=='null'){
											    Ext.Msg.alert('培训记录','员工号不存在请重新输入');
											}else if(action.result.msg=='ok'){
											    Ext.Msg.alert('培训记录','培训记录添加成功');win.close();
											}
                                          else{
											   Ext.Msg.alert('培训记录','培训记录添加失败');
											   win.close();
											}
										 },
										 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');win.close();}
								 });
							 }
						}
					 },{text:'取消',handler:function(){win.close();}}]
				 });
				win.show();
			 }
			 else if(node.id=='trainQuery'){
			       Ext.Msg.prompt('培训记录查询','指定员工号或显示全部（缺省输入）',function(btn,text){
			      var cm=new Ext.grid.ColumnModel([
								 {header:'员工号',dataIndex:'userID',sortable:true,align:'center'},
								 {header:'培训时间',dataIndex:'date',align:'center'},
								 {header:'培训内容',dataIndex:'content',align:'center'},
								 {header:'培训结果',dataIndex:'result',align:'center'}]
								 );
						 
				   var store= new Ext.data.Store({
					  proxy:new Ext.data.HttpProxy({url:'trainQuery.php'}),
					   baseParams:{value:text},
					  reader:new Ext.data.JsonReader({
						totalProperty:'totalProperty',
						root:'root'},[
						{name:'userID',type:'int'},
						{name:'date'},
						{name:'content'},
						{name:'result'}
						
					  ]),
				  sortInfo:{field:'userID',direction:'ESC'}
				 });
												  
			 var grid=new Ext.grid.GridPanel({
				 height:500,
				 store:store,
				 cm:cm,
				 layout:'fit',
				 loadMask:true,
				 trackMouseOver:true,  //高亮显示鼠标经过的行
				 stripeRows:true,
				 viewConfig:{forceFit:true},//强制显示所有列信息，不用滚动条
				 //autoScroll:true,
				 animCollapse : true,		//设置关闭面板时的动态效果
				loadMask : {msg : '数据加载...'},
				 bbar:new Ext.PagingToolbar({
						   pageSize:20,
						   store:store,
						   displayInfo:true,
						   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
						   emptyMsg:'没有记录'
						 })
				});
			 store.load({params:{start:0,limit:20}});
			 var win=new Ext.Window({
							  title:'培训记录查询结果',
							  width:600,
							  height:460,
							  modal:true,
							  items:[grid],
							  buttons:[{text:'确定',handler:function(){win.close();}}]
							});
			     if(btn=='ok'){ win.show();}
				}); 
			 }
			 else if(node.id=='changeState'){
			     var form = new Ext.form.FormPanel({
				     defaultType:'textfield',
					 labelAlign:'right',
					 title:'更改员工状态',
					 labelWidth:80,
					 frame:true,
					 layout:'form',
					 width:250,
					 items:[{fieldLabel:'用户号',name:'userID',blankText:'用户不能为空',allowBlank:false},					
							{fieldLabel:'状态',name:'state',xtype:'combo',width:150,
								  store:new Ext.data.SimpleStore({
									  fields:['value','text'],
									  data:[['0','在职'],['1','转出'],['2','辞退'],['3','退休']]}),
									  displayField:'text',
									  valueField:'value',
									  mode:'local',
									  editable:false,
									  triggerAction:'all',
									  value:'0'}
					 ]
					 
				 });
				 var win=new Ext.Window({
					 layout:'fit',
					 width:300,
					 height:400,
					 modal:true,
					 closeAction:'close',
					 items:[form],
					 buttons:[{text:'提交',handler:function(){
					         if(form.form.isValid()){				
								  form.getForm().submit({
										 url:'changeState.php',
										 method:'POST',
										 success:function(form,action){
											if(action.result.msg=='null'){
											    Ext.Msg.alert('修改状态','员工号不存在请重新输入');
											}else if(action.result.msg=='ok'){
											    Ext.Msg.alert('修改状态','状态修改成功');win.close();
											}
                                          else{
											   Ext.Msg.alert('修改状态','状态修改失败');
											   win.close();
											}
										 },
										 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');win.close();}
								 });
							 }
						}
					 },{text:'取消',handler:function(){win.close();}}]
				 });
				win.show();
			 }
			 else if(node.id=='changeStateQuery'){
			     Ext.Msg.prompt('状态更改记录查询','指定员工号或显示全部（缺省输入）',function(btn,text){
			      var cm=new Ext.grid.ColumnModel([
								 {header:'员工号',dataIndex:'userID',sortable:true,align:'center'},
								 {header:'更改日期',dataIndex:'date',align:'center'},
								 {header:'状态',dataIndex:'state',align:'center'}]
								 );
						 
				   var store= new Ext.data.Store({
					  proxy:new Ext.data.HttpProxy({url:'changeStateQuery.php'}),
					   baseParams:{value:text},
					  reader:new Ext.data.JsonReader({
						totalProperty:'totalProperty',
						root:'root'},[
						{name:'userID',type:'int'},
						{name:'date'},
						{name:'state'}
						
					  ]),
				  sortInfo:{field:'userID',direction:'ESC'}
				 });
												  
			 var grid=new Ext.grid.GridPanel({
				 height:500,
				 store:store,
				 cm:cm,
				 layout:'fit',
				 loadMask:true,
				 trackMouseOver:true,  //高亮显示鼠标经过的行
				 stripeRows:true,
				 viewConfig:{forceFit:true},//强制显示所有列信息，不用滚动条
				 //autoScroll:true,
				 animCollapse : true,		//设置关闭面板时的动态效果
				loadMask : {msg : '数据加载...'},
				 bbar:new Ext.PagingToolbar({
						   pageSize:20,
						   store:store,
						   displayInfo:true,
						   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
						   emptyMsg:'没有记录'
						 })
				});
			 store.load({params:{start:0,limit:20}});
			 var win=new Ext.Window({
							  title:'状态更改记录查询结果',
							  width:600,
							  height:460,
							  modal:true,
							  items:[grid],
							  buttons:[{text:'确定',handler:function(){win.close();}}]
							});
			     if(btn=='ok'){ win.show();}
				}); 
			 }
		  }
		 
        }}
			    
				
});

//工资管理
  var tree4=new Ext.tree.TreePanel({
      loader:new Ext.tree.TreeLoader(),
	 rootVisible:false,
	 useArrows:true,
	 
	  root:new Ext.tree.AsyncTreeNode({
		     id:'root',
			 expanded:true,
			 leaf:false,
			 children:[{
			   text:'工资信息录入',
			   id:'wageRecord',
			   leaf:true,
			   icon:'images/query.gif'
			 },{
			    text:'工资信息查询',
				id:'wageQuery',
				leaf:true,
				icon:'images/query.gif'
			  }]
      
	  }),
	  listeners:{
	    'click':function(node){
		    if(node.leaf){
			   if(node.id=='wageRecord'){
			      var form = new Ext.form.FormPanel({
				     defaultType:'textfield',
					 labelAlign:'right',
					 title:'工资录入',
					 labelWidth:80,
					 frame:true,
					 layout:'form',
					 width:250,
					 items:[{fieldLabel:'用户号',name:'userID',blankText:'用户不能为空',allowBlank:false},					
							 {fieldLabel:'月份',name:'month',xtype:'combo',width:150,
									  store:new Ext.data.SimpleStore({
										  fields:['value','text'],
										  data:[['0','一月'],['1','二月'],['2','三月'],['3','四月'],['4','五月'],['5','六月'],
										  ['6','七月'],['7','八月'],['8','九月'],['9','十月'],['10','十一月'],['11','十二月']]
									  }),
									  displayField:'text',
									  valueField:'value',
									  mode:'local',
									  editable:false,
									  value:'0',
									  triggerAction:'all' },
						    {fieldLabel:'基本工资',name:'basewage',xtype:'numberfield',width:150},	
                            {fieldLabel:'津贴',name:'allowance',xtype:'numberfield',width:150},	
							{fieldLabel:'奖金',name:'prize',xtype:'numberfield',width:150},	
							{fieldLabel:'加班工资',name:'extrawork',xtype:'numberfield',width:150},	
					 ]
					 
				 });
				 var win=new Ext.Window({
					 layout:'fit',
					 width:300,
					 height:400,
					 modal:true,
					 closeAction:'close',
					 items:[form],
					 buttons:[{text:'提交',handler:function(){
					         if(form.form.isValid()){				
								  form.getForm().submit({
										 url:'wageRecord.php',
										 method:'POST',
										 success:function(form,action){
											if(action.result.msg=='null'){
											    Ext.Msg.alert('工资信息录入','员工号不存在请重新输入');
											}else if(action.result.msg=='ok'){
											    Ext.Msg.alert('工资信息录入','工资信息录入成功');win.close();
											}
                                          else{
											   Ext.Msg.alert('工资信息录入','工资信息录入失败');
											   win.close();
											}
										 },
										 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');win.close();}
								 });
							 }
						}
					 },{text:'取消',handler:function(){win.close();}}]
				 });
				win.show();
			   }
			   else if(node.id=='wageQuery'){
			       var form = new Ext.form.FormPanel({
				     defaultType:'textfield',
					 labelAlign:'right',
					 title:'工资信息查询',
					 labelWidth:80,
					 frame:true,
					 layout:'form',
					 width:250,
					 items:[{fieldLabel:'用户号',name:'userID'},					
							 {fieldLabel:'月份',name:'month',xtype:'combo',width:150,
									  store:new Ext.data.SimpleStore({
										  fields:['value','text'],
										  data:[['0','一月'],['1','二月'],['2','三月'],['3','四月'],['4','五月'],['5','六月'],
										  ['6','七月'],['7','八月'],['8','九月'],['9','十月'],['10','十一月'],['11','十二月']]
									  }),
									  displayField:'text',
									  valueField:'value',
									  mode:'local',
									  editable:false,
									  //value:'0',
									  triggerAction:'all' }
					 ]
					 
				 });
				 var win=new Ext.Window({
					 layout:'fit',
					 width:300,
					 height:400,
					 modal:true,
					 closeAction:'close',
					 items:[form],
					 buttons:[{text:'提交',handler:function(){
					         if(form.form.isValid()){				
								  form.getForm().submit({
										 url:'wageQuery.php',
										 method:'POST',
										 success:function(form,action){
											if(action.result.msg=='null'){
											    Ext.Msg.alert('工资信息查询','员工号不存在请重新输入');
											}else if(action.result.msg=='ok'){
											     var sm= new Ext.grid.CheckboxSelectionModel({handleMouseDown:Ext.emptyFn});
								                 var cm=new Ext.grid.ColumnModel([
										              new Ext.grid.RowNumberer(),sm,
													 {header:'员工号',dataIndex:'userID',align:'center',sortable:true},
													 {header:'月份',dataIndex:'month',align:'center'
													  },{header:'基本工资',dataIndex:'basewage',
													  editor:new Ext.form.NumberField({allowBlank:true})},
													  {header:'津贴',dataIndex:'allowance',
													  editor:new Ext.form.NumberField({allowBlank:true})},
													  {header:'奖金',dataIndex:'prize',
													  editor:new Ext.form.NumberField({allowBlank:true})},
													  {header:'加班工资',dataIndex:'extrawork',
													  editor:new Ext.form.NumberField({allowBlank:true})},
													   {header:'总工资',dataIndex:'total'}]
										 );
												 
											
										   var ds= new Ext.data.Store({//注意该处store与form的交互
											  proxy:new Ext.data.MemoryProxy(action.result),
											  pruneModifiedRecords:true,//True表示为，每次Store加载后，清除所有修改过的记录信息；
											  params:{start:'0',limit:'20'},
											  reader:new Ext.data.JsonReader({
												totalProperty:'totalProperty',
												root:'root'},[
												{name:'userID',type:'int'},
												{name:'month'},
												{name:'basewage'},
												{name:'allowance'},
												{name:'prize'},
												{name:'extrawork'},
												{name:'total'}
											  ]),
											   sortInfo:{field:'userID',direction:'ESC'}
											 });
								
								
								      
											 var grid=new Ext.grid.EditorGridPanel({
												 title:'工资查询结果',
												 height:500,
												 store:ds,
												 cm:cm,
												 sm:sm,
												 layout:'fit',
												 loadMask:true,
												 stripeRows:true,
												 trackMouseOver:true, 
												 viewConfig:{forceFit:true},//强制显示所有列信息，不用滚动条
												 //autoScroll:true,
												 clicksToEdit:1,
												 tbar:new Ext.Toolbar(['-',
												          {text:'删除',width:70,
														   handler:function(){
														     if(grid.getSelectionModel().getCount()>0){
															
														        Ext.Msg.confirm('信息','此数据将会在数据库中彻底删除，是否继续？',function(btn) {
																				     if(btn=='yes'){
																					     var record=grid.getSelectionModel().getSelections();
																						for(var i=0;i<record.length;i++)
																						    ds.remove(record[i]);
																						var del=[];
																						Ext.each(record,function(item){del.push(item.data);});
																						 Ext.lib.Ajax.request('POST','wageDelete.php',{
																						     success:function(response){
																							      var json=Ext.util.JSON.decode(response.responseText) ;
																							      if(json.msg=='ok'){Ext.Msg.alert('信息','删除成功');}
																								  else Ext.Msg.alert('错误','删除失败');
																							 },
																							 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}},
																							 'id='+encodeURIComponent(Ext.encode(del))
																						 )
																					 }
																				 });
														      }else Ext.Msg.alert('提示','您未选中任何行，请先选中！');
														   }},'-',{text:'保存',width:70,handler:function(){
																	  var change=ds.getModifiedRecords();//获取所有更新过的记录
																	  if(change.length==0) {Ext.Msg.alert('保存','您当前没有进行任何修改');}
																	  else{
																		  var json=[];
																		  Ext.each(change,function(item){
																			 json.push(item.data);
																		  })  ;
																		  Ext.lib.Ajax.request(
																			 'POST','wageSave.php',{success:function(response){
																			      var str=Ext.util.JSON.decode(response.responseText);
																			      if(str.msg=='ok')
																				       Ext.Msg.alert('信息','保存成功');
																				   else Ext.Msg.alert('错误','保存失败');
																			 },failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}},
																			 'data=' + encodeURIComponent(Ext.encode(json)) 
	
																		  );
																	 }
														   }},'-',{text:'导出excel',width:70,handler:function(){
														        var vExportContent = grid.getExcelXml();
																//Ext.Msg.alert('',vExportContent);
																if (Ext.isIE6 || Ext.isIE7 || Ext.isSafari || Ext.isSafari2 || Ext.isSafari3) {
																	var fd1=Ext.get('frmDummy');
																	if (!fd1) {
																		fd1=Ext.DomHelper.append(Ext.getBody(),{tag:'form',method:'post',id:'frmDummy',
																		action:'exportexcel.php', target:'_blank',name:'frmDummy',cls:'x-hidden',cn:[
																			{tag:'input',name:'exportContent',id:'exportContent',type:'hidden'}
																		]},true);
																	}
																	fd1.child('#exportContent').set({value:vExportContent});
																	fd1.dom.submit();
																} else {
																	document.location = 'data:application/vnd.ms-excel;base64,'+Base64.encode(vExportContent);
																}
														   }},'-']),
												 bbar:new Ext.PagingToolbar({
												   pageSize:20,
												   store:ds,
												   displayInfo:true,
												   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
												   emptyMsg:'没有记录'
												 })
											 });
										 
											  ds.load({params:{start:0,limit:20}}); 
											  var newwin= new Ext.Window({
													  //layout:'fit',
													  width:900,
													  heigth:800,
													  title:'工资查询显示结果',
													  closeAction:'close',
													  animateTarget:document.body,
													  modal:true,
													  items:[grid],
													  autoScroll:true,
													  buttons:[{text:'确定',
																handler:function(){
																      var change=ds.getModifiedRecords();//获取所有更新过的记录
																	  if(change.length!=0) {
																	      Ext.Msg.confirm('提示','当前页面的内容已修改，是否保存？',function(btn){
																		        if(btn=='yes'){
																				   var json=[];
																				  Ext.each(change,function(item){
																					 json.push(item.data);
																				  })  ;
																				  Ext.lib.Ajax.request(
																					 'POST','wageSave.php',{success:function(response){
																						  var str=Ext.util.JSON.decode(response.responseText);
																						  if(str.msg=='ok')
																							   Ext.Msg.alert('信息','保存成功',function(){newwin.close();});
																						   else Ext.Msg.alert('错误','保存失败'),function(){newwin.close();};
																					 },failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}},
																					 'data=' + encodeURIComponent(Ext.encode(json)) 
			
																				  );
																				}
																		  });
																	 
																		 }
																	 
											                else{newwin.close();}	}
													  }]
															  
											});
											newwin.show();
											win.close();
											}
                                          else{
											   Ext.Msg.alert('工资信息查询','工资信息查询失败');
											   win.close();
											}
										 },
										 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');win.close();}
								 });
							 }
						}
					 },{text:'取消',handler:function(){win.close();}}]
				 });
				win.show();
			   }
			 }
		 }
	  }
});	

//系统管理
 var tree5=new Ext.tree.TreePanel({
      loader:new Ext.tree.TreeLoader(),
	 rootVisible:false,
	 useArrows:true,
	 
	  root:new Ext.tree.AsyncTreeNode({
		     id:'root',
			 expanded:true,
			 leaf:false,
			 children:[{
			   text:'数据库备份',
			   id:'backup',
			   leaf:true,
			   icon:'images/query.gif'
			 },{
			    text:'数据库还原',
				id:'restore',
				leaf:true,
				icon:'images/query.gif'
			  }]
      
	  }),
	  listeners:{
	    'click':function(node){
		   if(node.leaf){
		      if(node.id=='backup'){
			     Ext.Msg.prompt('备份数据','请输入文件名称',function(btn,text){
				    if(btn=='ok'){
					  Ext.Ajax.request({
					     url:'backup.php',
						 params:{name:text},
						 success:function(response){
						    var str=Ext.util.JSON.decode(response.responseText);
						    if(str.msg=='exist'){
							  Ext.Msg.alert('备份数据','此文件名已存在');
							}else if(str.msg=='ok'){
							   Ext.Msg.alert('备份数据','备份成功');
							}else {
							   Ext.Msg.alert('备份数据','备份失败');
							}
						 },
						 failuer:function(){
						    Ext.Msg.alert('备份数据','与后台联系出错');
						 }
					  })
					}
				 })
			  }else if(node.id=='restore'){
			        var form = new Ext.form.FormPanel({
				     defaultType:'textfield',
					 labelAlign:'right',
					 title:'还原备份',
					 labelWidth:80,
					 frame:true,
					 layout:'form',
					 width:250,
					 items:[ {fieldLabel:'选择备份',name:'name',xtype:'combo',width:150,
									  store: new Ext.data.Store({
												   proxy:new Ext.data.HttpProxy({url:'restoreName.php'}),
												   reader:new Ext.data.JsonReader({
														root:'root',
														fields:[{name:'name'}]})
														
									  }),
									  displayField:'name',
									  //valueField:'name',
									  mode:'remote',
									  editable:false,
									  allowBlank:false,
									  emptyText:'请选择',
									  triggerAction:'all'}]
				 });
				 var win=new Ext.Window({
					 layout:'fit',
					 width:300,
					 height:200,
					 modal:true,
					 closeAction:'close',
					 items:[form],
					 buttons:[{text:'提交',handler:function(){
					         if(form.form.isValid()){				
								  form.getForm().submit({
										 url:'restore.php',
										 waitMsg:'正在还原，请稍后',
										 method:'POST',
										 success:function(form,action){
											if(action.result.msg=='ok'){
											    Ext.Msg.alert('还原备份','备份还原成功');
											}else {Ext.Msg.alert('还原备份','备份还原失败');}
										  },
										  failure:function(){ Ext.Msg.alert('备份数据','与后台联系出错');}
								  });
							 }
							}}]
				});				     
								
								      
				win.show();							
			  }
		   }
		}
	  }
});
			
 //其他管理
			
			
  var tree2=new Ext.tree.TreePanel({
      loader:new Ext.tree.TreeLoader(),
	 rootVisible:false,
	 useArrows:true,
	 
	  root:new Ext.tree.AsyncTreeNode({
		     id:'root',
			 expanded:true,
			 leaf:false,
			 children:[{
			   text:'修改密码',
			   id:'changePS',
			   leaf:true,
			   icon:'images/changePassword.gif'
			 },{
			    text:'管理记录',
				id:'edit',
				leaf:true,
				icon:'images/edit.gif'
			  },{
			    text:'设置',
				id:'set',
				leaf:true,
				icon:'images/set.gif'
			  },{
			    text:'帮助',
				id:'help',
				leaf:true,
				icon:'images/help.gif'
			  }]
      
	  }),
	  listeners:{
	    'click':function(node){
		    if(node.leaf){
			  if(node.id=='changePS'){
			     var form = new Ext.form.FormPanel({
				     //renderTo:'form',
				     defaultType:'textfield',
					 labelAlign:'right',
					 title:'修改密码',
					 labelWidth:80,
					 frame:true,
					 layout:'form',
					 autoScroll:true,
					 width:250,
					 url:'changePassword.php',
					 defaults:{width:150,allowBlank:false,msgTarget:'qtip',
					          minLength:5,minLengthText:'密码不能少于六位',
							  maxLength:10,maxLengthText:'密码不能超过十位'},
					 items:[{fieldLabel:'初始密码',name:'orign',blankText:'密码不能为空',inputType:'password'},
					         {fieldLabel:'新密码',id:'change',name:'change',blankText:'密码不能为空',inputType:'password'},
							 {fieldLabel:'确认密码',name:'confirm',inputType:'password',blankText:'密码不能为空'}
					 ]
					 
				 });
				 var changePassword=new Ext.Window({
				     //title:'',
					 layout:'fit',
					 width:300,
					 height:200,
					 modal:true,
					 closeAction:'close',
					 items:[form],
					 buttons:[{text:'提交',handler:function(){
					         if(form.form.isValid()){
							   //密码验证
								/*  var confirmPS=function(){
								     Ext.apply(Ext.form.VTypes,{password:function(val,field){
								      if(field.confirmTo){
									    var pwd=Ext.get(field.confirmTo);
										if(val.trim()==pwd.getValue().trim()){
										   return true;
										} else return false;
									  }
								   }});*/
								  form.getForm().submit({
										 url:'changePassword.php',
										 method:'POST',
										 success:function(form,action){
											if(action.result.msg=='wrong'){
											    Ext.Msg.alert('警告','初始密码不正确');
											}
											else if(action.result.msg=='different'){
												Ext.Msg.alert('警告','两次密码不一致，请重新输入');
												Ext.get('change').focus(true);
												//form.on('render',function(){this.findByType('textfield')[1].focus(true,true);});
											}
											 else{
											   Ext.Msg.alert('信息',action.result.msg);
											   changePassword.close();
											}
										 },
										 failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}
								 });
							 }
						}
					 },{text:'取消',handler:function(){changePassword.close();}}]
				 });
				changePassword.show();
			  }
			  else if(node.id=='edit'){
			     var editPanel= new Ext.form.FormPanel({
				     layout:'fit',
					 title:'管理记录',
					 width:600,
					 frame:false,
					 items:[{
					    xtype:'htmleditor',
						fieldLabel:'编辑器',
						id:'editor',
						//name:'editor',
						anchor:'98%'
					 }]
					
				 });
				 var findRecords=new Ext.form.FormPanel({
				   layout:'column',
				   title:'查看记录',
				   width:600,
				   height:180,
				   labelWidth:60,
				   labelAlign: 'right',
				   frame:true,
				   items:[{
					    xtype:'fieldset',
						title:'按管理员查看',
						width:280,
						height:100,
						//autoheight:true,
						defaultType:'textfield',
						items:[{
								 fieldLabel:'管理员ID',
								  name:'byManage'}]
					   },{
		                xtype:'fieldset',
						title:'按记录时间查看',
						height:100,
						width:280,
					    items:[{ fieldLabel:'&nbsp;&nbsp;从',width:150,name:'beginTime',xtype:'datefield',format:'Y-m-d'},
					           {fieldLabel:'&nbsp;&nbsp到',width:150,name:'endTime',xtype:'datefield',format:'Y-m-d'}]
					}],
					buttons:[{
					  text:'查询',
					  type:'submit',
					  width:120,
					  handler:function(){
					   if(findRecords.form.isValid()){
						findRecords.form.doAction('submit',
						{url:'findRecords.php',
						method:'post',
						success:function(form,action){
						   if(action.result.msg=='ok'){
							 var cm=new Ext.grid.ColumnModel([
							   {header:'管理员',dataIndex:'manageID',sortble:true},
							   {header:'日期',dataIndex:'date',sortble:true},
							   {header:'记录',dataIndex:'text',sortble:true}
							]);
							var store=new Ext.data.Store({
							  proxy:new Ext.data.MemoryProxy(action.result),   //注意此处不是httpProxy
							  reader:new Ext.data.JsonReader({
								 totalProperty:'totalProperty',
								 root:'root'},[
									{name:'manageID',type:'int'},
									 {name:'date'},
									 {name:'text'}
								 ]),sortInfo:{field:'manageID',direction:'ESC'}
							});
							var grid=new Ext.grid.GridPanel({
								height:400,
								store:store,
								cm:cm,
								layout:'fit',
								loadMask:true,
								stripeRows:true,
								autoStroll:true,
								trackMouseOver:true,
								//style:{white-space:'normal',overflow:'visible'},
								viewConfig:{forceFit:true},
								loadMask:{msg:'数据加载...'},
								bbar:new Ext.PagingToolbar({
											   pageSize:20,
											   store:store,
											   displayInfo:true,
											   displayMsg:'显示第{0}条到第{1}条记录，一共{2}条',
											   emptyMsg:'没有记录'
											 })
							});
							 store.load({params:{start:0,limit:20}});//若忘记加载，则窗口显示为空！！！！！！！！！
							var win=new Ext.Window({
							  title:'记录查询结果',
							  width:800,
							  height:460,
							  modal:true,
							  items:[grid],
							  buttons:[{text:'确定',handler:function(){win.close();}}]
							});
							win.show();
						   }
						   else if(action.result.msg=='null'){
						      Ext.Msg.alert('查询','您输入的数据为为空，请重新输入');
						   }else Ext.Msg.alert('查询','查询失败，请重试');
						},
						failure:function(){
							Ext.Msg.alert('错误','服务器出现错误请稍后再试！');}
						});
					   }
					  }
					}]
				 })
				var editWin=new Ext.Window({
				    title:'',
					layout:'fit',
					width:600,
					height:500,
					modal:true,
					layout:form,
					items:[findRecords,editPanel],
					 buttons:[
					 {text:'提交',type:'submit',handler:function(){
					   if(editPanel.form.isValid()){
					      Ext.MessageBox.show({title:'请稍等',
											  msg:'正在提交',
											  process:true,
											  closable:false,
											  animEl:'loding'});
						editPanel.form.doAction('submit',{url:'editSubmit.php',
						method:'post',
						success:function(form,action){
						   if(action.result.msg=='ok'){
							 Ext.Msg.alert('提交','提交成功');
							Ext.getCmp('editor').setValue('');
						   }else if(action.result.msg=='null'){
						      Ext.Msg.alert('提交','提交数据为空，提交失败');
						   }else if(action.result.msg=='wrong') Ext.Msg.alert('提交','提交时出错，提交失败');
						},
						failure:function(){
							Ext.Msg.alert('错误','服务器出现错误请稍后再试！');}
						});
					   }}},{text:'取消',handler:function(){editWin.close();}}
					 ]
				});
				editWin.show();
			  }
			  else if(node.id=='set'){Ext.Msg.alert('设置','设置部分尚待添加。。。');}
			  else if(node.id=='help'){
			    Ext.Msg.alert('人事管理系统','    version 1.0 数据库小组 ');
			  }
			}
		}
	   }
  });
  
     var west=new Ext.Panel({
	    region:'west',
			title:'主菜单',
			collapsible:true,
			border:false,
			split:true,
			width:190,
			minSize:170,
			maxSize:220,
			layout:'accordion',

			layoutConfig:{
			  titleCollapse:true,
			  animate:true,
			  activeOnTop:false,  //若为true，活动窗口始终在最上
			  hideCollapseTool:true,  //True表示为不出 展开/收缩的轮换按钮
			  fill:false        //面板展开时不会填充全部面板
			 },
			items:[{
			    title:'基本信息管理',
				collapsed:true,  //若为true渲染面板后即闭合
				
				items:[tree1]				
				
			},{
			    title:'高级信息管理',
				collapsed:false,
				items:[tree3]
			},{
			    title:'工资管理',
				collapsed:false,
				items:[tree4]
			},{
			    title:'系统管理',
				collapsed:false,
				items:[tree5]
			},{
			    title:'其他管理',
				collapsed:false,
				items:[tree2]
			}]
	   
	 });
	 
	
     var viewport = new Ext.Viewport({
	    layout:'border',
		items:[{
		    region:'north',
			height:100,
			//contentEl:'north-div',
			bodyStyle:'background:url(images/title.jpg)',
			bbar:new Ext.Toolbar(['-',{text:'  您好，管理员',xtype:'tbtext',hideOnClick:true,width:100},'-','->','-',{text:'刷新',width:70,handler:function(){window.location=window.location;}},'-',
			 {text:'注销',width:70,handler:function(){
			      Ext.Msg.confirm('提示','确定注销当前页面？',function(btn){
				       if(btn=='yes'){
						  Ext.lib.Ajax.request('POST','logout.php',{
							   success:function(response){
							        var str=Ext.util.JSON.decode(response.responseText);
							        if(str.msg=='ok'){ Ext.Msg.alert('消息','注销成功，正在跳转');window.location='http://localhost/managesystem/login.html';}
									else Ext.Msg.alert('消息',str.msg);
							   },
							   failure:function(){Ext.Msg.alert('错误','与后台联系时出现问题');}
							  }
				         )}
			       });
				  
     			}},'-'])
		},west,{
		    region:'south',
			contentEl:'south-div',
			height:20,
			//frame:true,
			border:false,
			bodyStyle:'background-color:#BBCCEE;'
		},centerPanel]
		
	 });
	 
	
  });
   
 </script>
</head>

<body>
  
  <div id="south-div">Copyright by Luyna</div>
  
</body>

</html>
