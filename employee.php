
<?php
session_start();
if(!($_SESSION['manageID'])){
 echo " <script >alert('您还未登陆，请先登陆！');window.location.href='http://localhost/managesystem/login.html';</script>";}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>人事管理系统</title>
<link rel="stylesheet" type="text/css" href="ext3build/resources/css/ext-all.css" />
<script type="text/javascript" src="ext3build/ext-base.js"></script>
<script type="text/javascript" src="ext3build/ext-all.js"></script>
<script type="text/javascript" src="ext3build/ext-lang-zh_CN.js"></script>


<style>
 .x-btn-text-icon .x-btn-icon-small-left .x-btn-text{
    background-position: 0 center;/*默认*/
    background-repeat: no-repeat;/*默认*/
    padding-left:18px;/*默认*/
    height:16px;/*默认*/
    font-size:12px;/*字体大小设置*/
}
body {
	margin-left: 30px;
}
.STYLE1 {font-size: x-large}
</style>
<script type="text/javascript">
  Ext.onReady(function(){
  
 Ext.QuickTips.init();


 
  var form = new Ext.form.FormPanel({
		width:800,
		//title:'用户您好',
		buttonAlign:'center',
		layout:'fit',
       // frame: true,
     
        buttons: [{
            text:'员工基本信息',
			width:200,
			height:50,
			//style:'.x-btn-text-icon .x-btn-icon-small-left .x-btn-text',
			enableToggle:true,//True 是否在 pressed/not pressed 这两个状态间切换 （默认为false）。
			handler:function(){
			   
			   var cm=new Ext.grid.PropertyColumnModel([
			       {header:'员工号',dataIndex:'userID'},
				 {header:'姓名',dataIndex:'username'},
				 {header:'性别',dataIndex:'sex'},
				 {header:'出生日期',dataIndex:'birth'},
				 {header:'身份证号',dataIndex:'id'},
				 {header:'婚姻状况',dataIndex:'marriage'},
				 {header:'民族',dataIndex:'nation'},
				 {header:'政治面貌',dataIndex:'zzmm'},
				 {header:'联系电话',dataIndex:'tel'},
				 {header:'地址',dataIndex:'addr'},
				 {header:'部门',dataIndex:'dept'},
				 {header:'职务',dataIndex:'job'},
				 {header:'基本工资',dataIndex:'basewage'},
				 {header:'学历',dataIndex:'edu'},
				 {header:'专业',dataIndex:'spec'},
				 {header:'毕业时间',dataIndex:'graduateTime'},
				 {header:'毕业院校',dataIndex:'school'},
				 {header:'入职日期',dataIndex:'beginTime'},
				 {header:'终止日期',dataIndex:'endTime'},
				 {header:'备注',dataIndex:'mark'}	
			   ]);
			   var store= new Ext.data.JsonStore({
			      autoLoad:true,		  
				  url:'userMsg.php',
				  root:'root',			
				  fields:['userID','username','sex','birth','marriage','nation','zzmm','id','tel',
				  'addr','dept','job','basewage','edu','spec','school','graduateTime','beginTime','endTime','mark'],
				
				    listeners: {
						 load:{
						   fn:function(store ,records,options) {
							  //获取propety grid组件
							  var propGrid = Ext.getCmp('grid');
							  //保证property grid是存在的
							  if(propGrid) {
								//获得property grid的store数据
								propGrid.setSource(store.getAt(0).data);
							   }
							 }
						  }
					}
			   });
			   
			  //store.load();
			

			   var grid= new Ext.grid.PropertyGrid({
			      title:'员工基本信息',
				  width:400,
				  height:600,
				  id:'grid' ,  //必须要加，与store联系的标记
				  cm:cm,
				  autoSort:false,
				  columns:[
			       {header:'员工号',dataIndex:'userID'},
				 {header:'姓名',dataIndex:'username'},
				 {header:'性别',dataIndex:'sex'},
				 {header:'出生日期',dataIndex:'birth'},
				 {header:'身份证号',dataIndex:'id'},
				 {header:'婚姻状况',dataIndex:'marriage'},
				 {header:'民族',dataIndex:'nation'},
				 {header:'政治面貌',dataIndex:'zzmm'},
				 {header:'联系电话',dataIndex:'tel'},
				 {header:'地址',dataIndex:'addr'},
				 {header:'部门',dataIndex:'dept'},
				 {header:'职务',dataIndex:'job'},
				 {header:'基本工资',dataIndex:'basewage'},
				 {header:'学历',dataIndex:'edu'},
				 {header:'专业',dataIndex:'spec'},
				 {header:'毕业时间',dataIndex:'graduateTime'},
				 {header:'毕业院校',dataIndex:'school'},
				 {header:'入职日期',dataIndex:'beginTime'},
				 {header:'终止日期',dataIndex:'endTime'},
				 {header:'备注',dataIndex:'mark'}	
			   ],
				  //store:store,
				 loadMask:true,
				 trackMouseOver:true,  //高亮显示鼠标经过的行
				 stripeRows:true,
				 viewConfig:{forceFit:true},//强制显示所有列信息，不用滚动条
				 autoScroll:true,
				 animCollapse : true,		//设置关闭面板时的动态效果
				loadMask : {msg : '数据加载...'}
				 
				 
			   });
			   grid.on("beforeedit",function(e){
					e.cancel=true;
					return false;
					});

			  // store.load();
			   var win= new Ext.Window({
			     //title:'员工基本信息',
				 width:400,
				 height:600,
				 modal:true,
				 items:[grid],
				 buttons:[{text:'确定',handler:function(){win.close();}}]
			   });
			   
			   win.show();
			}
			  
        },{
		    text:'修改密码',
			width:200,
			height:50,
			enableToggle:true,//True 是否在 pressed/not pressed 这两个状态间切换 （默认为false）。
			handler:function(){
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
					 //url:'userChangePs.php',
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
								  form.getForm().submit({
										 url:'userChangePw.php',
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
		},{
            text:'显示同部门人员',
			width:200,
			height:50,
			enableToggle:true,//True 是否在 pressed/not pressed 这两个状态间切换 （默认为false）。
			handler:function(){
			    var cm=new Ext.grid.ColumnModel([
							   {header:'员工号',dataIndex:'userID',sortble:true},
							   {header:'姓名',dataIndex:'username',sortble:true}
							]);
				var store=new Ext.data.Store({
				  proxy:new Ext.data.HttpProxy({url:'sameDept.php'}),//注意格式
				  reader:new Ext.data.JsonReader({
					 totalProperty:'totalProperty',
					 root:'root'},[
						{name:'userID',type:'int'},
						 {name:'username'}
					 ]),sortInfo:{field:'userID',direction:'ESC'}
				});
				store.load();
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
				});
				 
				var win=new Ext.Window({
				  title:'同一部门人员',
				  width:400,
				  autoheight:true,
				  modal:true,
				  items:[grid],
				  buttons:[{text:'确定',handler:function(){win.close();}}]
				});
				win.show();	
			}
	    }]
    });
	
	//设置窗口显示位置
	var windowWidth=window.screen.availWidth;
	var left=windowWidth/2-300/2;
	var style='margin-top:200px;margin-left:'+left+'px;';
	var el=Ext.get('form').applyStyles(style);
    form.render(el);
  
});

 </script>
 </head>
 <body background="images/main.jpg">

 <div id="form" ></div>
 
</body>
</html>
