<div class="LDS-easyui-layout" data-options="fit:true">
	<div data-options="region:'center'">
		<div id="tt" class="LDS-easyui-tabs" fit="true">
			<div title="Daftar Dokumen SP2D">
				<table id="contentCenter" fit="true" style="widht: 10000px;" >
				</table>
			</div>
		</div>
	</div>
</div>

		<!-- Toolbar==================================================================== -->
		<div id="toolbar" style="padding:5px;height:auto">
			<div style="margin-bottom:5px">
				<a href="#" id="btambah" class="LDS-easyui-linkbutton" iconCls="fa fa-plus" onclick="javascript:TambahDokSPPD();"plain="true">Tambah </a>
				<a href="#" class="LDS-easyui-linkbutton" iconCls="fa fa-check-square-o" plain="true" onclick="javascript:AksiKoreksi(this);"> Koreksi</a>
				<a href="#" class="LDS-easyui-linkbutton" iconCls="fa fa-refresh" plain="true" onclick="javascript:Refresh();">Refresh</a>
				<a href="#" class="LDS-easyui-linkbutton" iconCls="fa fa-file-image-o" plain="true"  onclick="javascript:LihatDokumen();">Lihat Dokumen</a>
				<a href="#" class="LDS-easyui-linkbutton" iconCls="fa fa-close" plain="true" onclick="javascript:AksiHapus();">Hapus</a>
				<!-- <a href="#" class="LDS-easyui-linkbutton" iconCls="icon-save" plain="true">Tampilkan Filter Dokumen</a> -->
				<label style="display:inline-block"><input type="checkbox" id='show'>Tampilkan Filter Dokumen</label>
			</div>
			<div style="padding:5px;height:auto;display:none;" id="formPencarian">
				<form name="pencarian" id="pencarian">
				<input name="cari" type="hidden" value="ok"> 
				
					<div style="display:inline-block; width:500px;">
					<legend title="Pilih">
						<div class="baris" >
						<label>

						<input name="skpd_id_ck" type="checkbox" > <span style="width:200px; display:inline-block"> SKPD </span>
						<input class="easyui-combobox" id="skpd_id-x" name="skpd_id" value="" style="width:200px;" placeholder="Pilih SKPD" 
						data-options="prompt:'Pilih SKPD',
						onLoadSuccess: function  () {
						    $('#reload-skpd_id-x').find('i').removeClass('fa-spin').addClass('fa-lg')
						}
						,onBeforeLoad:function  (data) {
						    $('#reload-skpd_id-x').find('i').removeClass('fa-lg').addClass('fa-spin')
						    },
						url:'{{route('suplay.skpd.combobox')}}',
						valueField:'id',
						textField:'nama_skpd'
						"> {!! button_refresh('reload-skpd_id-x') !!} --AND--
						</label></div>


						<div class="baris">
						<label><input name="jenis_sppd_id_ck" type="checkbox" > <span style="width:200px; display:inline-block"> Jenis SP2D</span>
						<input class="easyui-combobox"  id="jenis_sppd_id-x" name="jenis_sppd_id" value="" style="width:200px;"  placeholder="Pilih Jenis SP2D" 
						data-options="prompt:'Pilih Jenis SP2D',
						onLoadSuccess: function  () {
						    $('#reload-jenis_sppd_id-x').find('i').removeClass('fa-spin').addClass('fa-lg')
						}
						,onBeforeLoad:function  (data) {
						    $('#reload-jenis_sppd_id-x').find('i').removeClass('fa-lg').addClass('fa-spin')
						    },
						url:'{{route('suplay.jenis-sppd.combobox')}}',
						valueField:'id',
						textField:'nama_jenis_sppd'
						"> {!! button_refresh('reload-jenis_sppd_id-x') !!} --AND--
						</label></div>
						
						<div class="baris">
						<label><input name="penerima_id_ck" type="checkbox" > <span style="width:200px; display:inline-block"> Penerima SP2D </span>
						<input class="easyui-combobox" name="penerima_id"  id="penerima_id-x"   style="width:200px" value="" placeholder="penerima" 
						data-options="
						prompt:'penerima',
						onLoadSuccess: function  () {
						    $('#reload-penerima_id-x').find('i').removeClass('fa-spin').addClass('fa-lg')
						}
						,onBeforeLoad:function  (data) {
						    $('#reload-penerima_id-x').find('i').removeClass('fa-lg').addClass('fa-spin')
						    },
						url:'{{route('suplay.penerima.combobox')}}',
						valueField:'id',
						textField:'nama_penerima' 
						"> {!! button_refresh('reload-penerima_id-x') !!}--AND--
						</label> </div>
						
						<div class="baris">
						<label><input name="tahun_ck" type="checkbox" > <span style="width:200px; display:inline-block"> Tahun</span><input name="tahun"   class="easyui-textbox"  style="width:200px" value=""  placeholder="0000" data-options="prompt:'0000'">--OR--
						</label></div>
						
						<div class="baris">
						<label><input name="no_sppd_ck" type="checkbox" > <span style="width:200px; display:inline-block"> Nomor SP2D</span><input name="no_sppd"   class="easyui-textbox"   style="200px" value="" placeholder="No SP2D" data-options="prompt:'No SP2D'">--OR--
						</label></div>
						
						<div class="baris">
						<label><input name="keperluan_ck" type="checkbox" > <span style="width:200px; display:inline-block"> Keperluan</span><input name="keperluan"   class="easyui-textbox"    style="width:200px" value="" placeholder="Keperluan SP2D" data-options="prompt:'Keperluan SP2D'">--OR--
						</label></div>
					</legend>
						
					</div>
					<div style="display:inline-block; width:30%; position:absolute; top:0px; padding:20px;">
						<a id="cari" href="#" class="LDS-easyui-linkbutton" data-options="iconCls:'fa fa-search'" tyle="padding:50px;">Cari</a>
						<!-- <button type="button" id="cari" onclick="" style="padding:50px;"> Cari</button> -->
					</div>
				</form>
			</div>
		
		</div>
<style type="text/css">
	.baris:hover{
		background-color: red;
	}
	#pdf {
	  width: 100%;
	  height: 100%;
	  /*margin: 1em auto;*/
	  /*border: 2px solid #6699FF;*/
	}

	#pdf p {
	   /*padding: 1em;*/
	}

	#pdf object {
	   display: block;
	   border: solid 1px #666;
	}
</style>
<script type="text/javascript">
// var myKeyHandler = $.extend({},$.fn.combogrid.defaults.keyHandler,{
//     query:function(q){
//     	alert(q)
        
//     }
// });

// $('.easyui-combobox').combobox();
// $('#skpd_id-x,#jenis_sppd_id-x,#penerima_id-x').combobox();
// $('#jenis_sppd_id-x').combobox({
//     url:'{{route('suplay.jenis-sppd.combobox')}}',
//     // method:'get',
//     valueField:'id',
//     textField:'nama_jenis_sppd'
// });
// $('#skpd_id-x').combobox({
//     url:'{{route('suplay.skpd.combobox')}}',
//     // method:'get',
//     valueField:'id',
//     textField:'nama_skpd'
// });
// $('#penerima_id-x').combobox({
//   url:'{{route('suplay.penerima.combobox')}}',
//   valueField:'id',
//   textField:'nama_penerima'
// });

function Refresh (argument) {
	$('#contentCenter').datagrid('reload',{}); 
}

function loadpdf (url) {
  console.log(url);
  // window.onload = function (){
    var myPDF = new PDFObject({ 
      url: url,
      pdfOpenParams: {
        navpanes: 1,
        view: "FitV",
        pagemode: "thumbs"
      }
    
    }).embed("pdf");

  }

function LihatDokumen (argument) {
	var row = $('#contentCenter').datagrid('getSelected');
	if (row) {
			if (row.file_url.length){
			 	console.log(row.file_url);
			 	// var url=''
			 		$.download(row.file_url, {   }, 'get')
			 	return false;

			 	$('#windowA').window({href:url,
			 			iconCls:'icon-save',
			 			title:'Entry Dokumen SP2D',
			 			modal:true,
			 			cache:false,
			 			onBeforeClose:function  (argument) {
			 				// alert('on before')
			 				// return false

			 			},
			 			onBeforeLoad: function  (param) {
			 				// console.log('onbeforeLoad');
			 				// alert(param)
			 			}
			 		});
			    // $.messager.alert('Info', row.itemid+":"+row.productid+":"+row.attr1);
			}
			else{
				alert('File Belum ter upload')
			}
		
	}
	else{
		$.messager.alert('Info', 'Silahkan Pilih / Klik baris di bawah ', 'info');
	}
}
function AksiHapus() {
				var row = $('#contentCenter').datagrid('getSelected');
				
				if (row){
				 	// console.log(row.id);
					$.messager.confirm('Konfirmasi ', 'Apakah Anda ingin menghapus data '+row.no_sppd, function(r){
						if (r)
						{
						 	$.post('{{url('dokumens')}}/'+row.id, { _method: 'DELETE' }, function(data, textStatus, xhr) {
						 		// console.log(xhr)
							 		if (textStatus=='success') {
							 			$.messager.show({  
							 			title: 'Status' + data.msg,  
							 			msg: data.succes  
							 			});	
										$('#contentCenter').datagrid('reload');

							 		}
							 		else{
						 				$.messager.show({  
						 				title: 'Gagal !' + data.msg,  
						 				msg: 'Terjadi Kesalahan !'  
						 				});		
										$('#contentCenter').datagrid('re load');
							 		}
							 	}).fail(function(data) {
							 		
							 		$.messager.show({  
							 		title: 'Gagal !',  
							 		msg: 'Kegagalan koneksi , periksa lagi jaringan anda  !'  
							 		});	
										$('#contentCenter').datagrid('reload');
								    // alert( "error" );
								  });
						}
					});	
				    // $.messager.alert('Info', row.itemid+":"+row.productid+":"+row.attr1);
				}
				
			}
function  AksiKoreksi(ini) {
// console.log(ini);
	$(ini).attr('disabled', 'disabled');
		var row = $('#contentCenter').datagrid('getSelected');
		// console.log(row);
		console.log('koreksiii');

			// var url='google.com'
				// $('#content-x').empty()
				// $('#windowA').window().window('close').window('clear').empty()
			$('#windowA').empty();
			if (row){
			var daftar_file;
			 daftar_file=[];
				 $('#windowA').window({href:'{{route('ajaxgrid', ['page' => 'eds'])}}',
				 		iconCls:'icon-save',
				 		title:'Entry Dokumen SP2D',
				 		modal:true,
				 		cache:false,
				 onBeforeClose:function  (argument) {
				 		if(confirm('Apakah anda benar-benar ingin menutup window ini?\ndata di form isian anda akan hilang anda belum menyimpanya!!')) {
						 		// $('#tabX').panel('clear')
						 		// $('#windowA').window('clear')
							 	var tab = $('#tabX').tabs('getSelected');
							 	var index = $('#tabX').tabs('getTabIndex',tab);
							 	$('#tabX').tabs('close',index);
							 	return true 
				 			} else {return false } 
						},
				 		onLoad:function  (argument) {
					// $('#windowA').window('center').window('hventer')
		                $('#windowA').window('center'); 
							$('#F-INPUT').form('load','{{url('dokumens')}}/'+row.id+'/edit');
							$('#F-INPUT').form({
								onLoadSuccess: function  (res) {
									counter=1;
										// daftar_libur_nasional=res.ref_libur_nas;
										// console.log(res.ref_libur_nas);
										myLibur.set_libur(res.ref_libur_nas);
										// console.log(myLibur.libur());
										// console.log(obj.libur());

									// console.log(daftar_libur_nasional);
									$('#F-INPUT').attr('action', '{{url('dokumens')}}/'+row.id);
									$('#windowA').window('center')
										if (res.keterangan.length > 12 ) {
											$('#div_keterangan').show();
											$('#keterangan').val(res.keterangan);
										};
										ReloadButton()
						                windowHelper('A')
									// $('#thumbnail').html(res.image).show();
									 // loadpdf("http://local.sppd.net/file/get/php541B.tmp.pdf")
									// console.log(res.tgl_sppd);
									// $('#tgl_sppd').datebox('setValue', res.tgl_sppd);
								 	customTitleTab('tabX',' Koreksi Data Dokumen { '+row.nama_dokumen+' }')
									$('#simpan').attr('disabled', 'disabled');

									
									 var ref_skpd_id=res.ref_skpd_id;
									 var combogrid_skpd_id = $('#skpd_id').combogrid('grid'); 
									 combogrid_skpd_id.datagrid('loadData', ref_skpd_id); 

									 var ref_jenis_sppd_id=res.ref_jenis_sppd_id;
									 $('#jenis_sppd_id').combobox('loadData', ref_jenis_sppd_id); 

									 var ref_unit_kerja_id=res.ref_unit_kerja_id;
									 $('#unit_kerja_id').combobox('loadData', ref_unit_kerja_id); 

									 var ref_penerima_id=res.ref_penerima_id;
									 var combogrid_penerima_id = $('#penerima_id').combogrid('grid'); 
									 combogrid_penerima_id.datagrid('loadData', ref_penerima_id); 
									 // loadpdf(res.link_pdf[1]);
									 loadpdf(res.link_pdf[0]);
									 // daftar_file=res.link_pdf;
									 // console.log(res.link_pdf);
									 var link,link_start,link_end;
									 // console.log(Object.keys(res.link_pdf).length);
									 // for (var i = res.link_pdf.length; i >= 1; i--) {
									 	link_start='';
									 	// for (var i = Things.length - 1; i >= 0; i--) {
									 	// 	Things[i]
									 	// };
									 for (var i = Object.keys(res.link_pdf).length-1; i >= 0; i--) {
										 var urut=i+1;
										 console.log(i);
										 console.log(res.link_pdf[i]);
										 	link_start +='<li><a href="'+res.link_pdf[i]+'">File  '+urut+'</a></li>';

									 };
									 $('#daftar_file').append(link_start);
									 $('#daftar_file').on('click', function(event) {
									 	event.preventDefault();
									 		if ($(event.target).is('a') ) {
									 			console.log('link');
									 			loadpdf($(event.target).attr('href'));
									 	};

									 	/* Act on the event */
									 });

									// console.log(res);
								}
							});
				 			// $('#jenis_sppd_id').combobox({
				 			//     url:'{{route('suplay.jenis-sppd.combobox')}}',
				 			//     valueField:'id',
				 			//     textField:'nama_jenis_sppd'
				 			// });

				 			// $('#skpd_id').combogrid({
				 			//     delay: 500, panelWidth: 300,
				 			//     url:'{{route('suplay.skpd.combobox')}}',
				 			//     idField: 'id',
				 			//     textField: 'nama_skpd',
				 			//     columns: [[
				 			//         {field:'id',title:'ID',width:20,sortable:true},
				 			//         {field:'nama_skpd',title:'SKPD',width:300,sortable:true}
				 			//     ]]
				 			//     ,
				 			//       onChange:function  (newValue, oldValue) {
				 			//     		$('#unit_kerja_id').combobox({
				 			//     		    url:'{{route('suplay.unit-kerja.combobox')}}',
				 			//     		    valueField:'id',
				 			//     		    textField:'nama_unit_kerja',
				 			//     		    onBeforeLoad: function(param){
				 			//     		    	param.id = newValue;
				 			//     		    },
				 			//     		});
				 			//     }
				 			//     ,
				 			// 	onSelect:function  (data) {
				 			// 	    	console.log('ddd '+data);
				 			// 	    	var g = $('#skpd_id').combogrid('grid');
				 			// 	    	var r = g.datagrid('getSelected');	
				 			// 	    	// console.log(r);
				 			// 	    	$('#no_boks').textbox().textbox('setValue', r.nama_singkat_skpd.toUpperCase()+'-');
				 			// 	    }
				 			// });

				 			// $('#penerima_id').combogrid({
				 			//     delay: 500, panelWidth: 400,
				 			//     url:'{{route('suplay.penerima.combobox')}}',
				 			//     idField: 'id',
				 			//     textField: 'nama_penerima',
				 			//     columns: [[
				 			//         {field:'id',title:'ID',width:20,sortable:true},
				 			//         {field:'nama_penerima',title:'Nama Penerima',width:400,sortable:true}
				 			//     ]]
				 			// });
							$('#update').show();
							$('#simpan').hide();
							
							
							if ($('#F-INPUT').find("input[name='_method']").length <= 1) {
								$('#F-INPUT').append('<input type="hidden" name="_method" value="PATCH">');
							};
							$('#nama_dokumen').textbox({readonly:true})
							initForFormEDS()

				 		}

				 	});

				 // $('#windowA').window('refresh');
				 // $('#windowA').window('refresh');
			    // $.messager.alert('Info', row.itemid+":"+row.productid+":"+row.attr1);
			}
				else{
					$.messager.alert('Info', 'Anda harus memilih baris di tabel terlebih dulu', 'info');
				}
		
}

// windowHelper('A')



var ReloadButton= function  () {
	// alert('reload')
		$('#reload_penerima_id').on('click', function(event) {
			event.preventDefault();
			$('#penerima_id').combogrid({url:'{{route('suplay.penerima.combobox')}}'}); 
			
		});
		$('#reload_jenis_sppd_id').on('click', function(event) {
			event.preventDefault();
			// $(this).find('.fa').removeClass('fa-lg').addClass('fa-spin');

			$('#jenis_sppd_id').combobox('reload', '{{route('suplay.jenis-sppd.combobox')}}'); 

			// $('#jenis_sppd_id').combobox({
			// 				onLoadSuccess: function  () {
			// 					$('#reload_jenis_sppd_id').removeClass('fa-lg').addClass('fa-spin')	
			// 				}
			// 				,onBeforeLoad:function  (data) {
			// 		    		$('#reload_jenis_sppd_id').removeClass('fa-spin').addClass('fa-lg')
			// 		    		}

			// 		    	}).combobox('reload','{{route('suplay.jenis-sppd.combobox')}}'); 


			// $('#jenis_sppd_id').combobox({onLoadSuccess:function  (data) {
			// 		    	$('#reload_jenis_sppd_id').removeClass('fa-spin').addClass('fa-lg')
			// 		    	// body...
			// 		    }}).combobox('reload','{{route('suplay.jenis-sppd.combobox')}}'); 
			 // $( '#jenis_sppd_id' ).switchClass( "fa-lg", "fa-spin", 1000, "easeInOutQuad" );
			
		});
		$('#reload_skpd_id').on('click', function(event) {
			event.preventDefault();
			$('#skpd_id').combogrid({url:'{{route('suplay.skpd.combobox')}}'});  
			
		});
}

$('#reload-skpd_id-x').on('click', function(event) {
	event.preventDefault();
	$('#skpd_id-x').combobox('reload'); 
});
$('#reload-jenis_sppd_id-x').on('click', function(event) {
	event.preventDefault();
	$('#jenis_sppd_id-x').combobox('reload'); 
	
});
$('#reload-penerima_id-x').on('click', function(event) {
	event.preventDefault();
	$('#penerima_id-x').combobox('reload'); 
	
});

 
	function TambahDokSPPD () {
	$.get('{{route('token')}}', function(data) {
		console.log('tambah ...');
		
		$('#windowA').window({href:'{{route('ajaxgrid', ['page' => 'eds'])}}',
				iconCls:'icon-save',
				title:'Tambah Dokumen SP2D',
				modal:true,
				cache:false,
				 onBeforeClose:function  (argument) {
				 	if(confirm('Apakah anda benar-benar ingin menutup window ini?\ndata di form isian anda akan hilang anda belum menyimpanya!!')) {
					 	// $('#tabX').panel('clear')
					 	// $('#windowA').window('clear');
					 	// // $('#windowA').window('close')

					 	var tab = $('#tabX').tabs('getSelected');
					 	var index = $('#tabX').tabs('getTabIndex',tab);
					 	$('#tabX').tabs('close',index);
					 	return true 
				 	} else {return false } 
				 },
				onLoad:function  (param) {
					$('#F-INPUT').form('load','{{route('dokumens.create')}}');
						$('#F-INPUT').form({
							onLoadSuccess: function  (res) {
								counter=1;
									console.log(res.ref_libur_nas);
									myLibur.set_libur(res.ref_libur_nas);
									// console.log(res.ref_libur_nas);
									var ref_skpd_id=res.ref_skpd_id;
									var combogrid_skpd_id = $('#skpd_id').combogrid('grid'); 
									combogrid_skpd_id.datagrid('loadData', ref_skpd_id); 

									var ref_jenis_sppd_id=res.ref_jenis_sppd_id;
									$('#jenis_sppd_id').combobox('loadData', ref_jenis_sppd_id); 

									var ref_unit_kerja_id=res.ref_unit_kerja_id;
									$('#unit_kerja_id').combobox('loadData', ref_unit_kerja_id); 

									var ref_penerima_id=res.ref_penerima_id;
									var combogrid_penerima_id = $('#penerima_id').combogrid('grid'); 
									combogrid_penerima_id.datagrid('loadData', ref_penerima_id); 

								$('#thumbnail').show()
								$('#update').attr('disabled','disabled').hide();
									$('#simpan').show();
									// $('#F-INPUT').form('clear');// jangan gunakan ini saat inisialisasi 
									if ($('#F-INPUT').find("input[name='_method']").length >= 1) {
										$('#F-INPUT').find("input[name='_method']").remove();
									};
									initForFormEDS()

								// console.log(res);
							}
						});


		                $('#windowA').window('center'); 
		                windowHelper('A')
		                ReloadButton()
					 	customTitleTab('tabX',' Tambah Data Dokumen Baru')
						// $('#F-INPUT').form('clear');
						$("input:hidden[name=_token]").val(data);
						// $('#jenis_sppd_id').combobox({
						//     url:'{{route('suplay.jenis-sppd.combobox')}}',
						//     valueField:'id',
						//     textField:'nama_jenis_sppd'
						//     // icons:[{
						//     //     iconCls:'icon-add',
						//     //     handler:function(){
						//     //     	alert('add')
						//     //     }
						//     // },{
						//     //     iconCls:'icon-cut'
						//     // }]
						// });

						// $('#skpd_id').combogrid({
						//     delay: 500, panelWidth: 300,
						//     url:'{{route('suplay.skpd.combobox')}}',
						//     idField: 'id',
						//     textField: 'nama_skpd',
						//     columns: [[
						//         {field:'id',title:'ID',width:20,sortable:true},
						//         {field:'nama_skpd',title:'SKPD',width:300,sortable:true}
						//     ]]
						//     ,
						//       onChange:function  (newValue, oldValue) {
						//     		$('#unit_kerja_id').combobox({
						//     		    url:'{{route('suplay.unit-kerja.combobox')}}',
						//     		    valueField:'id',
						//     		    textField:'nama_unit_kerja',
						//     		    onBeforeLoad: function(param){
						//     		    	param.id = newValue;
						//     		    },
						//     		});
						//     }
						//     ,
						// 	    onSelect:function  (data) {
						// 	    	console.log('ddd '+data);
						// 	    	var g = $('#skpd_id').combogrid('grid');
						// 	    	var r = g.datagrid('getSelected');	
						// 	    	// console.log(r);
						// 	    	$('#no_boks').textbox().textbox('setValue', r.nama_singkat_skpd.toUpperCase()+'-');
						// 	    }
						// });
						// $('#unit_kerja_id').combobox({
						//     url:'{{route('suplay.unit-kerja.combobox')}}',
						//     valueField:'id',
						//     textField:'nama_unit_kerja'
						// });
						// $('#penerima_id').combogrid({
						//     delay: 500, panelWidth: 400,
						//     url:'{{route('suplay.penerima.combobox')}}',
						//     idField: 'id',
						//     textField: 'nama_penerima',
						//     columns: [[
						//         {field:'id',title:'ID',width:20,sortable:true},
						//         {field:'nama_penerima',title:'Nama Penerima',width:400,sortable:true}
						//     ]]
						// });
					// 	var ref_skpd_id=res.ref_skpd_id;
					// 	var combogrid_skpd_id = $('#skpd_id').combogrid('grid'); 
					// 	combogrid_skpd_id.datagrid('loadData', ref_skpd_id); 

					// 	var ref_jenis_sppd_id=res.ref_jenis_sppd_id;
					// 	$('#jenis_sppd_id').combobox('loadData', ref_jenis_sppd_id); 

					// 	var ref_unit_kerja_id=res.ref_unit_kerja_id;
					// 	$('#unit_kerja_id').combobox('loadData', ref_unit_kerja_id); 

					// 	var ref_penerima_id=res.ref_penerima_id;
					// 	var combogrid_penerima_id = $('#penerima_id').combogrid('grid'); 
					// 	combogrid_penerima_id.datagrid('loadData', ref_penerima_id); 

					// $('#thumbnail').show()
					// $('#update').attr('disabled','disabled').hide();
					// 	$('#simpan').show();
					// 	// $('#F-INPUT').form('clear');// jangan gunakan ini saat inisialisasi 
					// 	if ($('#F-INPUT').find("input[name='_method']").length >= 1) {
					// 		$('#F-INPUT').find("input[name='_method']").remove();
					// 	};
					// 	initForFormEDS()
				},
				onBeforeLoad: function  (param) {
					// console.log('onbeforeLoad');
				}
			});
		});
	// $('#windowA').window('refresh');
	}
function initForFormEDS() {
  // body...
  $.extend($.fn.validatebox.defaults.rules, {
      bukanNol : {
                  validator: function(value,param){
                    var nilai=$('#spm_benar').numberbox('getValue')
                    if (nilai >0 ) {
                        return true
                    };
                    return false 
          },
          message: 'Periksa Lagi Nilai ini tergantung pada  "SPM diajukan harus lebih besar dari SPM Potongan !"'
      }
  });


  /* date box ==========================================*/
      // $('#tgl_spm , #tgl_pengantar , #tgl_diterima , #tgl_acc_kasi , #tgl_acc_kabid , #tgl_acc_kadis , #tgl_referensi').datebox({
      // 	required:true,
      //     formatter:function  (date) {
      //       return DateIdFormatter(date)
      //     }, 
      //     parser: function  (date) {
      //       return DateIdParser(date)
      //     }

      // });
      // $('#tgl_sppd').datebox({
      // required:true
      // ,
      // onSelect: function(date){
      //     // console.log(AddDate(date,0,'m'));
      //     // console.log($('#mydate').datebox('getValue'));
      //     var date_for_retensi=AddDate($('#tgl_sppd').datebox('getValue'), 15,'Y');
      //     console.log(date_for_retensi);
      //     $('#tgl_referensi').datebox({readonly:true}).datebox('setValue',date_for_retensi);
      //     // console.log($('#mydate').datebox())
      //     // console.log(AddDate(date));
      //   } ,
      //   onChange:function function_name (argument) {
      //      var date_for_retensi=AddDate($('#tgl_sppd').datebox('getValue'), 15,'Y');
      //     console.log(date_for_retensi);
      //     $('#tgl_referensi').datebox({readonly:true}).datebox('setValue',date_for_retensi);
      //   }, 
      //   formatter:function  (date) {
      //     return DateIdFormatter(date)
      //   }, 
      //   parser: function  (date) {
      //     return DateIdParser(date)
      //   }
        
      // });

      
      $('#spm_diajukan, #potongan, #spm_benar').numberbox({
          precision:2
          ,groupSeparator:'.'
          ,decimalSeparator:','
          ,prefix:'Rp. '
        });
  	var d = new Date();
  	var n = d.getFullYear(); 
      $('#tahun').numberbox({
          min:1945,
          max:n,
          precision:0
      });
     
  $('#potongan').numberbox({
      value: 0,
      onChange:function  (potongan,old) {
             var ajukan= $('#spm_diajukan').numberbox('getValue');
          // console.log(ajukan);
          // console.log(parseFloat(potongan));
         if (parseFloat(potongan) >= parseFloat(ajukan) ) {
              // console.log('false');
              $('#spm_benar').numberbox('setValue', 0);
              $('#spm_diajukan').focus();
              return false;
          };
          var jumlah = parseFloat(ajukan) - parseFloat(potongan); 
          $('#spm_benar').numberbox('setValue', jumlah);
      }

  })

  $('#spm_diajukan').numberbox({
      value: 0,
      onChange:function  (ajukan,old) {
          var potongan=$('#potongan').numberbox('getValue');
          // console.log(ajukan);
          // console.log(potongan);
          if (potongan >= ajukan ) {
              // console.log('false');
              $('#spm_benar').numberbox('setValue', 0);
              $('#spm_diajukan').focus();
              return false;
          };
          var jumlah = parseFloat(ajukan) - parseFloat(potongan); 
          $('#spm_benar').numberbox('setValue', jumlah);
      }

  })


  $('#spm_benar').numberbox({
      value: 0,readonly:true,
      onChange:function  (benar,old) {
          // console.log(benar);
      }

  })
  $('#no_sppd').textbox({
      onChange:function  (newValue,old) {
            var up= $(this).val().toUpperCase();
            $('#no_sppd').textbox('setValue', up.toUpperCase());
            $('#nama_dokumen').textbox({readonly:true}).textbox('setValue','ARSIP PROSES SP2D-'+up)
            $('#no_map').textbox({readonly:true}).textbox('setValue',up)
            $('#no_spm').textbox({readonly:true}).textbox('setValue',up.replace("SP2D", "SPM"))  
            // $('#nama_dokumen').textbox({readonly:true}).textbox('setValue','ARSIPPROSESSP2D-');
          
      }

  })
          $('#update').bind('click', function(){
          	// $.messager.progress(); 
            // $('#F-INPUT').form('disableValidation');
              // $('#uploadx').fileupload('send', data);
              // $('#fileupload').fileupload('send', {files: 'filesList'})
                      // var row = $('#contentCenter').datagrid('getSelected');
                  // console.log($('#id').val());return false;
                      $('#F-INPUT').form('submit',{ url:'{{url('dokumens')}}/'+$('#id').val(),
                                      
                                              onSubmit: function(param){
                                              param._method = 'PATCH';
			                                      var isValid = $(this).form('validate');
			                                      if (!isValid){
	                                              	// $.messager.progress('close'); 
			                                      		keyrepeat = 0
			                                         	console.log('masuk');
			                                         	$('#simpan').removeAttr('disabled');
			                                            $.messager.show({  
			                                            title: 'Status',  
			                                            msg: 'data tidak lengkap'
			                                            });
			                                           return false

			                                      }
			                                      return isValid;
                                              },
                                              success: function(result){
                                              	counter=1;
                                              	// $.messager.progress('close'); 
                                              			keyrepeat = 0
                                                  if (result.code ==  200 ){
                                                      $.messager.show({  
                                                          title: 'Status',  
                                                          msg: 'Data SKPD Berhasil Dimasukkan !'  
                                                      });
                                                      // $('#this').dialog('close')
                                                      $('#contentCenter').datagrid('reload');
                                                  }
                                                  else {
                                                      $('#contentCenter').datagrid('reload');
                                                    	 pesan_top_center(result)
                                                      // $.messager.show({  
                                                      //     title: 'Status',  
                                                      //     msg: result  
                                                      // });
                                                  } 
                                              } 
                                          });
              });
          $('#simpan').bind('click', function(){
          	// console.log('baruuuuu ');
          	// $.messager.progress(); 
            // $('#F-INPUT').form('disableValidation');
             $('#simpan').attr('disabled', 'disabled');
                // var row = $('#contentCenter').datagrid('getSelected');
                    $('#F-INPUT').form('submit',{ url:'{{route('dokumens.store')}}',
                                              onSubmit: function(param){
                                                // param._token = 'PATCH';
                                                 // $('#simpan').attr('disabled', 'disabled');
                                              var isValid = $(this).form('validate');
                                              if (!isValid){
                                              	// $.messager.progress('close'); 

                                              		keyrepeat = 0
                                                  console.log('masuk');
                                                  $('#simpan').removeAttr('disabled');
                                                    $.messager.show({  
                                                    title: 'Status',  
                                                    msg: 'data tidak lengkap'
                                                    });
                                                   return false 
                                              }
                                              return isValid; // return false will stop the form submission
                                              },
                                success: function(result){
                                	counter=1;
                                	// $.messager.progress('close'); 
                                        $.get('{{route('token')}}', function(data) {

                                        		keyrepeat = 0
                                                // var cektambah=$( "#tambah:checked" ).length
                                                // // console.log(cektambah);
                                                // if (cektambah == 0) { 
                                                //     console.log('masuk on'+cektambah);
                                                //   // $('#windowA').window('close');
                                                //   // TambahDokSPPD ()
                                                //   $('#windowA').window('refresh','{{route('ajaxgrid', ['page' => 'eds'])}}')
                                                //     return false;
                                                // };
                                                var obj = jQuery.parseJSON( result );
                                                // console.log(obj.succes)
                                                // console.log(result.succes)
                                               if (obj.succes) {
                                                  $('#windowA').window('refresh','{{route('ajaxgrid', ['page' => 'eds'])}}')
	                                              $('#F-INPUT').form('clear');
                                               };
                                              $('#simpan').removeAttr('disabled');
                                              $("input:hidden[name=_token]").val(data);
                                          pesan_top_center(result)


                                        });

                                        // if (result.code ==  200 ){
                                        //   $.messager.show({  
                                        //     title: 'Status',  
                                        //     msg: 'Data SKPD Berhasil Dimasukkan !'  
                                        //   });
                                        //   // $('#this').dialog('close')
                                        //   $('#contentCenter').datagrid('reload');
                                        // }
                                        // else {
                                        //   $('#contentCenter').datagrid('reload');
                                        //   pesan_top_center(result)
                                        //   // $.messager.show({ 
                                        //   //   title: 'Status',  
                                        //   //   msg: result  
                                        //   // });
                                        // } 
                                        
                                } 
                              });
              });

}

	$('#contentCenter').datagrid(
	{
		url:'{{route('dokumens.data')}}',
	    // method:'get',
		
		// title:'Daftar Unit Kerja',
		toolbar: '#toolbar',
		remoteSort:true,
		columns:[[
		// {field:'productid',title:'No',width:200},
		{field:'tahun',title:'Tahun ',width:40, sortable:true},
		{field:'no_sppd',title:'No. SP2D ',width:150, sortable:true},
		{field:'tgl_sppd',title:'Tgl. SP2D ', sortable:true},
		{field:'tgl_diterima',title:'Tgl. diterima ', sortable:true},
		{field:'tgl_pengantar',title:'Tgl. Pengantar ', sortable:true},
		{field:'nama_jenis_sppd',title:'Jenis SP2D ', sortable:true},
		{field:'skpd_id',title:'SKPD ', sortable:true,
					formatter: function(value,row,index){
						if (row.nama_skpd){
							return row.nama_skpd;
						} else {
							return 'tidak terdaftar : '+value;
						}
					}
		},
		{field:'unit_kerja_id',title:'Unit Kerja ', sortable:true, 
			formatter: function(value,row,index){
				if (row.nama_unit_kerja){
					return row.nama_unit_kerja;
				} else {
					return 'tidak terdaftar : '+value;
				}
			}
		},
		// {field:'skpd_id',title:'SKPD ',width:20},
		{field:'penerima_id',title:'Penerima ', sortable:true,
			formatter: function(value,row,index){
				if (row.nama_penerima){
					return row.nama_penerima;
				} else {
					return 'tidak terdaftar : '+value;
				}
			}

		},
		{field:'email',title:'Operator '},
		{field:'file_status',title:'File '},
		{field:'tgl_input_file',title:'Tgl Input'},
		// {field:'penerima',title:'Penerima ',width:20},
		{field:'keperluan',title:'Keperluan '}
		// {field:'productname',title:'Singkatan'}
		]],
		// height: 200,
		pagination : true,
		// remoteSort:true,
		rownumbers : true,
		singleSelect:true,
		striped:true, 
		collapsible:true,
		autoRowHeight:true,
		fitColumns:false,
		queryParams: {
			_token: token
		},
		onLoadSuccess: function  (data) {
			 $('meta[name="csrf-token"]').attr('content',data.token);
			 // $('meta[name="csrf-token"]').attr('content','token modify');
			// $('#skpd_id-x,#jenis_sppd_id-x,#penerima_id-x').combobox();
		}
		// scrollbarSize:10,
		// pageSize:10
	});
$('#skpd_id-x,#jenis_sppd_id-x,#penerima_id-x').combobox();
						// $('#content-x').find('.easyui-combobox').combobox({
						// 		url:'combobox_data.json',
						// 		valueField:'id',
						// 		textField:'text',
						// 		onSelect: function(rec){
						// 			alert('selected')
						// 		// var url = 'get_data2.php?id='+rec.id;
						// 		// $('#cc2').combobox('reload', url);
						// 	}
						// }
						
						$('.LDS-easyui-layout').layout()
						$('.LDS-easyui-linkbutton').linkbutton()
						$('.LDS-easyui-tabs').tabs()


$('#show').change(function() {
    if ($(this).is(':checked')) {$( "#formPencarian" ).show( "slow" ); } else{$( "#formPencarian"  ).slideUp("slow"); } });

$(function  () {
	    $('#cari').bind('click', function(){
	    		// alert('cariiiii');
	    		var data = $( "#pencarian" ).serializeArray();
	    		var xx = new Object()
	    		jQuery.each( data, function( i, result ) {
	    			// console.log(result);
	    			xx[result.name]=result.value
	    			 
	    			

	    		  // $( "#results" ).append( field.value + " " );
	    		});
    			$('#contentCenter').datagrid('load', xx);
	    		// console.log(xx); 
	    		// return false;
	    		// console.log(data);
	    		// console.log({name: 'easyui', address: 'ho'});
	    			
	    			// $('#contentCenter').datagrid('load', {
	    			//     name: 'easyui',
	    			//     address: 'ho'
	    			// });
					// $('#pencarian').form('submit',{  
					// 	success: function(result){
					// 		if (result == "this"){
					// 			$.messager.show({  
					// 				title: 'Status',  
					// 				msg: 'Data Berhasil Dimasukkan !'  
					// 			});
					// 			$('#this').dialog('close')
					// 			$('#this').datagrid('reload');
					// 		}
					// 		else {
					// 			$.messager.show({  
					// 				title: 'Status',  
					// 				msg: result  
					// 			});
					// 		} 
					// 	} 
					// });	        // alert('easyui');
	    });
})
</script>