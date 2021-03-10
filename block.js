var el=wp.element.createElement;
var InnerBlocks=wp.blockEditor.InnerBlocks;

var PluginDocumentSettingPanel = wp.editPost.PluginDocumentSettingPanel;
var TextControl=wp.components.TextControl;
var ToggleControl=wp.components.ToggleControl;
var select=wp.data.select;
var dispatch=wp.data.dispatch;
var withState=wp.compose.withState;
var withSelect=wp.data.withSelect;

var useSelect=wp.data.useSelect;
var useEntityProp=wp.coreData.useEntityProp;

var InspectorControls=wp.blockEditor.InspectorControls;
var PanelBody=wp.components.PanelBody;
var PanelRow=wp.components.PanelRow;
var BaseControl=wp.components.BaseControl;
var RadioControl=wp.components.RadioControl;
var ToggleControl=wp.components.ToggleControl;
var SelectControl=wp.components.SelectControl;
var ButtonGroup=wp.components.ButtonGroup;
var Button=wp.components.Button;

var assign=lodash.assign;

var json;

var mailXhr=new XMLHttpRequest();
var admin_url="http://192.168.1.111/genyeh/wp-admin/admin-ajax.php";
mailXhr.open('POST', admin_url, true);
mailXhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
mailXhr.onreadystatechange=function(){
	if(mailXhr.readyState==4 && mailXhr.status==200){
		json=JSON.parse(mailXhr.responseText);
		makeUserSelectControl(json);
	}
};
mailXhr.send("action=getuser");

//閲覧できるユーザーに指定
function makeUserSelectControl(options_json){
	
	wp.plugins.registerPlugin(
		'genyeh', 
		{
			render: 
			withSelect
			(function(select) {
				return { heyhey: select('core/editor').getEditedPostAttribute('meta')['user'] };
			})
			(function(props){
				return el(
					PluginDocumentSettingPanel,
					{
						className: '',
						title: '指定公開對象',
					},
					'',
					el(
						SelectControl,
						{
							options: JSON.parse(options_json),
							value:　select('core/editor').getEditedPostAttribute('meta')['user'],
							onChange: function(res){
								dispatch('core/editor').editPost({
									meta: {'user': res},
								});
							}
							// options: 
							// 	[
							// 		{ label: 'Big', value: '100%' },
							// 		{ label: 'Medium', value: '50%' },
							// 		{ label: 'Small', value: '25%' },
							// 	]
							
						}
						// ToggleControl,
						// {
						// 	checked: select('core/editor').getEditedPostAttribute('meta')['loading'],
						// 	label: '啟用載入動畫',
						// 	onChange: function(res){
						// 		dispatch('core/editor').editPost({
						// 			meta: { 'user': res },
						// 		});
						// 	}
						// },
					)
				)
			}),

			icon: '',
		}
	);
}
