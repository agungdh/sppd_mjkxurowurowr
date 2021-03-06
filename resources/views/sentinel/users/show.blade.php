

<div class="easyui-layout" data-options="fit:true">
	<div data-options="region:'center'">
		<div id="tt" class="easyui-tabs" fit="true">
			<div title="--== Profil Anda ==--">
				 <div class="easyui-layout" data-options="fit:true">
				    <div data-options="region:'west'" style="width:40%">
				    <div class="isi">
						<?php
		        // Determine the edit profile route
						if (($user->email == Sentry::getUser()->email)) {
							$editAction = route('sentinel.profile.edit');
						} else {
							$editAction =  action('\\Sentinel\Controllers\UserController@edit', [$user->hash]);
						}
						?>

						<div class="well clearfix">
							<div class="col-md-8">
								@if ($user->first_name)
								<p><strong > Nama Depan </strong> : {{ $user->first_name }} </p>
								@endif
								@if ($user->last_name)
								<p><strong>Nama Belakang </strong> : {{ $user->last_name }} </p>
								@endif
								<p><strong>Email</strong> : {{ $user->email }}</p>

							</div>
							<div class="col-md-4">
								<p><em><strong>Akun dibuat</strong>  : {{ $user->created_at }}</em></p>
								<p><em><strong>Akun terakhir diupdate</strong>  : {{ $user->updated_at }}</em></p>
								<button class="btn btn-primary" onClick="javascript:EditProfile('{{ $editAction }}')"><i class="fa fa-check-square-o"></i>  Edit Profile</button>
							</div>
						</div>

						<h4>Group Memberships:</h4>
						<?php $userGroups = $user->getGroups(); ?>
						<div class="well">
							<ul>
								@if (count($userGroups) >= 1)
								@foreach ($userGroups as $group)
								<li>{{ $group['name'] }}</li>
								@endforeach
								@else 
								<li>No Group Memberships.</li>
								@endif
							</ul>
						</div>
				        </div>   
				    </div>
				    <div data-options="region:'center'"style="width:20%">
				        <div id="FormProfile" fit="true" >

				        </div>
				    </div>
				</div>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#content-x').find('.easyui-layout').layout()
	$('#content-x').find('.easyui-tabs').tabs()
	$('.easyui-datagrid').datagrid();
	function EditProfile (url) {
		$('#FormProfile').panel({
		    // width:500,
		    href:url,
		    title:'Edit Profile '
		    // ,
		    // tools:[{
		    //     iconCls:'icon-add',
		    //     // handler:function(){alert('new')}
		    // },{
		    //     iconCls:'icon-save',
		    //     // handler:function(){alert('save')}
		    // }]
		}); 
	}
	// function EditProfile_xx (url) {
	// 		$('#windowA').empty()
	// 		// $('#SubForm').empty()
	// 	 //    $('#SubForm').panel({
	// 		// href:url,
	// 		// onLoad:function(){
	// 		//     alert('loaded successfully');
	// 		// }
	// 		// });
	// 	$('#windowA').window({href:url,
	// 		iconCls:'icon-save',
	// 		title:'Edit User ',
	// 		modal:true,
	// 		cache:false,
	// 		onBeforeClose:function  (argument) {
	//                 // alert('on before')
	//                 // return false

	//             },
	//             onLoad:function  (param) {
	//                 // $('#jenis_sppd_id').combobox({
	//                 //     url:'{{route('suplay.jenis-sppd.combobox')}}',
	//                 //     valueField:'id',
	//                 //     textField:'nama_jenis_sppd'
	//                 // });
	//                 // $('#skpd_id').combobox({
	//                 //     url:'{{route('suplay.skpd.combobox')}}',
	//                 //     valueField:'id',
	//                 //     textField:'nama_skpd'
	//                 // });
	//                 // $('#penerima_id').combobox({
	//                 //     url:'{{route('suplay.skpd.combobox')}}',
	//                 //     valueField:'id',
	//                 //     textField:'nama_singkat_skpd'
	//                 // });
	//                 // $('#update').hide();
	//                 //     $('#simpan').show();
	//                 //     $('#F-INPUT').form('clear');
	//                 //     if ($('#F-INPUT').find("input[name='_method']").length >= 1) {
	//                 //         $('#F-INPUT').find("input[name='_method']").remove();
	//                 //     };

	                
	//             },
	//             onBeforeLoad: function  (param) {
	//                 // console.log('onbeforeLoad');
	//                 // alert(param)
	//             }
	//         });
	//     // $('#windowA').window('refresh');
	// }
</script>
