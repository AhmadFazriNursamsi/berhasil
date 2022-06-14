<?php use App\Http\Controllers\HelpersController as Helpers;

$haveaccessadd = Helpers::checkaccess('divisions', 'add');
$haveaccessadd = Helpers::checkaccess('divisions', 'delete');
$haveaccessdelete = Helpers::checkaccess('users', 'delete');

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<title>{{ $datas['title'] }}</title>
{{-- {{ dd($datas) }} --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="bi bi-clipboard-fill"></i>
            {{ __('Divisions') }} <?php if($haveaccessadd): ?> <button class="btn btn-success btn-sm" id="btnmodaladd"
                onclick="BtnAddModal()">Add Divisions</button> <?php endif; ?>
        </h2>
    </x-slot>
                                                    {{-- HEADER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="table-responsive">
                        <table id="divisionTable"
                            class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <td></td> 
                                        <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Division " name="division_name" id="#division_name"></td>
                                    <td>
                                        <select name="active" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                                            <option value="">-- Status Active --</option>
                                            <option value="1">Active</option>
                                            <option value="0">Not Active</option>
                                        </select>                             
                                    </td>
                                </tr>
                                    <th><input type="checkbox" class="checkall" name="checkall"></th>
                                    <th class="align-center">Jabatan</th>
                                    <th class="align-center">Active</th>
                                    <th class="align-center">Action</th>
                                </tr>
                            </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th class="align-center">Jabatan</th>
                                        <th class="align-center">Active</th>
                                        <th class="align-center">Action</th>
                                    </tr>
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                                                    {{-- CLOSE HEADER --}}
                                                                
                                                                    {{-- MODAL ADD --}}
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-start ">
                    <i class="bi bi-clipboard-fill modal-title"></i>
                    <h5 id="titleaddmodal" class="ms-2 modal-title"></h5>
                    <div class="alert alert-danger" style="display:none"></div>
                </div>
                
                <div class="modal-body">
                    <form id="addpostmodal">
                        @csrf
                        <div class="mb-3">
                            <div class="col-md-6">
                                <label for="division_name" class="form-label">Jabatan</label>
                                <input type="text" class="form-control inpt-cst-add @error('division_name') is-invalid @enderror"
                                    placeholder="Jabatan" name="division_name" id="division_name1"
                                    aria-describedby="validationServer03Feedback" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="active" class="form-label">Status Active</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input " type="radio" value="1" name="active" id="active" checked>
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input " type="radio" value="0" name="active" id="non_active">
                                    <label class="form-check-label" for="non_active">
                                        Not Active
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- {{ dd($lo) }} --}}
                        <?php foreach ($datas['user_access'] as $key => $post) :?>
                      
                        <dt class="col-12" style="border: 1px solid #DDD; background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0; margin-top:15px; margin-bottom:15px;">
                            <input type="checkbox" class="form-check-input" id="endt-{{$post->name_access}}" onclick="checkpart('{{$post->name_access}}')">  || 
                            <label style="font-size: 18px" class="form-check-label" for="endt-{{$post->name_access}}"><?= $post->name_access?></label>
                        </dt>
                      
                        <div class="form-check">
                            <input type="hidden" name="eCheck1[{{$post->name_access}}][view]" value="0">
                            <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-view" name="eCheck1[{{$post->name_access}}][view]" value="1">
                            <label class="form-check-label" for="{{$post->name_access}}-view">view</label>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="eCheck1[{{$post->name_access}}][add]" value="0">
                            <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-add" name="eCheck1[{{$post->name_access}}][add]" value="1">
                            <label class="form-check-label" for="{{$post->name_access}}-add">add</label>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="eCheck1[{{$post->name_access}}][edit]" value="0">
                            <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-edit" name="eCheck1[{{$post->name_access}}][edit]" value="1">
                            <label class="form-check-label" for="{{$post->name_access}}-edit">edit</label>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="eCheck1[{{$post->name_access}}][delete]" value="0">
                            <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-delete" name="eCheck1[{{$post->name_access}}][delete]" value="1">
                            <label class="form-check-label" for="{{$post->name_access}}-delete">delete</label>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="eCheck1[{{$post->name_access}}][import]" value="0">
                            <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-import" name="eCheck1[{{$post->name_access}}][import]" value="1">
                            <label class="form-check-label" for="{{$post->name_access}}-import">import</label>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="eCheck1[{{$post->name_access}}][export]" value="0">
                            <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-export" name="eCheck1[{{$post->name_access}}][export]" value="1">
                            <label class="form-check-label" for="{{$post->name_access}}-export">export</label>
                        </div>
                 
                        <?php endforeach;?>
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" data-attid="" data-deleteval="1" id="saveee" class="btn btn-success saveclasss">Save</a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                                                                    {{-- CLOSE MODAL --}}
                                                                    
                                                                    <!-- MODAL VIEW -->
    <div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-lg-start">
                    <h4><i class="bi bi-clipboard2-minus"></i></i></h4>
                    <h5 id="titledetailmodal" class="ms-2 modal-title"></h5>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">Jabatan</dt>
                                <dd class="col-sm-8">: <span name="division_name" id="division_name"></dd>
                                <dt class="col-sm-4">Status</dt>
                                <dd class="col-sm-8">: <span id="activedetail"></span>
                                <dt class="col-sm-4">Status Delete</dt>
                                <dd class="col-sm-4">: <span id="flagdelete"></span></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="closeModalViewUser" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    @if ($haveaccessadd)
                        <button onClick="editmodaldevisi()" data-attid="" data-deleteval="1" id="editbtn" class="btn btn-success btn-sm">Edit</a>
                    @endif
                    @if ($haveaccessdelete)
                        <button onClick="deleteyesshow()" data-attid="" data-deleteval="1" id="deletevbtn" class="btn btn-danger btn-sm"></a>
                            <button onClick="undeleteyesshow()" data-attid="" data-deleteval="0" id="undeletevbtn" class="btn btn-warning btn-sm"></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
                                                                    {{-- Modal Edit --}}
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-lg-start">
                    <h4><i class="bi bi-pencil-square"></i></h4><h5 id="titleeditmodal" class="ms-2 modal-title"></h5>
                </div>
                <form id="editpostmodal">
                    <div class="modal-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <dl class="row mb-0">
                                        @csrf
                                        <dt class="col-sm-4">Jabatan</dt>
                                        <dd class="col-sm-8"><input type="text" name="division_name_edit" id="division_name_edit" class="division_name_edit"></dd>
                                        <dt class="col-sm-4">Status</dt>
                                        <dd class="col-sm-8">
                                            <div class="mb-3">
                                                <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input active_edit" type="radio" value="1" name="active_edit" id="active_edit" checked>
                                                            <label class="form-check-label" for="active_edit">
                                                                Active
                                                            </label>
                                                        </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input active_edit" type="radio" value="0" name="active_edit" id="active_edit2">
                                                        <label class="form-check-label" for="active_edit2">
                                                            Not Active
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </dd>

                                        <dt class="col-sm-4">
                                            <?php foreach ($datas['user_access'] as $key => $post) :?>
                      
                                            <dt class="col-12" style="border: 1px solid #DDD; background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0; margin-top:15px; margin-bottom:15px;">
                                                <input type="checkbox" class="form-check-input" name="list_access" id="endt-{{$post->name_access}}" onclick="checkpart('{{$post->name_access}}')">  || 
                                                <label style="font-size: 18px" class="form-check-label" for="endt-{{$post->name_access}}"><?= $post->name_access?></label>
                                            </dt>
                                          
                                            <div class="form-check">
                                                <input type="hidden" name="eCheck1[{{$post->name_access}}][view]" value="0">
                                                <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-view" name="eCheck1[{{$post->name_access}}][view]" value="1">
                                                <label class="form-check-label" for="{{$post->name_access}}-view">view</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="eCheck1[{{$post->name_access}}][add]" value="0">
                                                <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-add" name="eCheck1[{{$post->name_access}}][add]" value="1">
                                                <label class="form-check-label" for="{{$post->name_access}}-add">add</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="eCheck1[{{$post->name_access}}][edit]" value="0">
                                                <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-edit" name="eCheck1[{{$post->name_access}}][edit]" value="1">
                                                <label class="form-check-label" for="{{$post->name_access}}-edit">edit</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="eCheck1[{{$post->name_access}}][delete]" value="0">
                                                <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-delete" name="eCheck1[{{$post->name_access}}][delete]" value="1">
                                                <label class="form-check-label" for="{{$post->name_access}}-delete">delete</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="eCheck1[{{$post->name_access}}][import]" value="0">
                                                <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-import" name="eCheck1[{{$post->name_access}}][import]" value="1">
                                                <label class="form-check-label" for="{{$post->name_access}}-import">import</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="eCheck1[{{$post->name_access}}][export]" value="0">
                                                <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-export" name="eCheck1[{{$post->name_access}}][export]" value="1">
                                                <label class="form-check-label" for="{{$post->name_access}}-export">export</label>
                                            </div>
                                     
                                            <?php endforeach;?>
                                        </dt>
                                </dl>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer" >
                            @if ($haveaccessadd)
                                <button data-attid="" data-deleteval="1" id="editshow" class="btn btn-success btn-sm">Save</button>
                            @endif
                        </div>
                </form>
            </div>
        </div>
    </div>
    @section('script')
        <script type="text/javascript">
            /////////////////////////////////////////////   GetData Table ///////////////////////////////////////////
            var url = "{{ asset('/api/divi/getdata') }}";
            function searcAjax(a, skip = 0) {
                if ($(a).val().length > global_length_src || skip == 1) {
                    var getparam = getAllClassAndVal("src_class_user"); // helpers
                    $('#divisionTable').DataTable().ajax.url(url + "?" + getparam).load();
                }
            }
            $(document).ready(function() {
                var getndate = getNowdate(); // helpers
                var table = $('#divisionTable').DataTable({
                    ajax: url,
                    columnDefs: [{
                            'targets': 3,
                            'searchable': false,
                            'orderable': false,
                            'className': 'dt-body-center',
                            'render': function(data, type, full, meta) {
                                return '<span class="btn btn-info btn-sm" onclick="showdetail(' + full[3] + ')">details</span>';
                            }
                        },
                        {
                            'targets': 0,
                            'searchable': false,
                            'orderable': false,
                            'className': 'dt-body-center',
                            'render': function(data, type, full, meta) {
                                return '<input type="checkbox"  class="ckc" name="checkid[' + full[0] +
                                    ']" value="' + $('<div/>').text(data).html() + '">';
                            }
                        },
                        {
                            'targets': 2,
                            'className': 'dt-body-center',
                            'render': function(data, type, full, meta) {
                                <?php foreach ($datas as $key => $post) :?>
                                var dlt = '';
                          if(full[2] == 0)
                            dlt = '<span class="btn btn-danger btn-sm ms-2">deleted</span>';
                            else
                            dlt = '<span class="btn btn-warning btn-sm ms-2">active</span>';
                            <?php endforeach;?>
                                if (full[2] == 0){
                                    return '<span class="btn btn-danger btn-sm">not active</span>'+dlt;
                                }
                                else{

                                    return '<span class="btn btn-success btn-sm">active</span>'+dlt;
                                }
                            },
                            
                        },
                        
                    ],
                    searching: false,
                });
            });
            
                appendDivisionOption();
                appendRoleOption();         
            
            /////////////////////////////////      MODAL ADD        //////////////////////////////////////
            function BtnAddModal() {
                var url = "{{ asset('/division/store') }}/";
                $('#addmodal').modal('show');
                clearInput("inpt-cst-add");
                $("#titleaddmodal").html("Add Divisions");                
            }
        $(document).ready(function(){
            test = '@csrf';
            token = $(test).val();
            $('#addpostmodal').submit(function(e){
                idx = $('#saveee').attr('data-attid');
                var url = "{{ asset('/division/store') }}/";
                // var url = "{{ asset('/division/update3') }}/" + id;
                // var coba1 = $("#division_name").val();
                // var coba2 = $("#active").val();
                test = '@csrf';
                token = $(test).val();
                e.preventDefault();
                var form = $('#addpostmodal');
                
                $.ajax({
                    type: "post",
                    url: url,
                    data: form.serialize(),
                    success: function (response) {
                        data = response.data;
                        if(data[0] == 'success') {
                            Swal.fire({
                                title: 'Selamat!',
                                text: "Data Berhasil Disimpan",
                                icon: 'success'
                            });
                            $("#addmodal").modal('hide');
                            $("#addpostmodal")[0].reset();
                            reloaddata();
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: "Jabatan Sudah Terdaftar!",
                                icon: 'error'
                            });
                            
                        }
                        
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });  
        });
                    /////////////////////////////////      Modal SHOW DETAIL       //////////////////////////////////////
            function showdetail(id) {
                $('#saveee').attr('data-attid', id);
                var addurl = $('#deletevbtn').attr('data-attid', id);
                var url = "{{ asset('/division/detail') }}/" + id;
                var form = $('#viewUser');
                $('#undeletevbtn').html("Undelete");
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(response) {
                            data = response.data;
                            if (data) {
                                $("#division_name").html(data.division_name);
                                if (data.active == 0) {
                                    $("#activedetail").html("<span class='btn btn-danger btn-sm'><b>Not Active</b></span>");
                                } else {
                                    $("#activedetail").html("<span class='btn btn-success btn-sm'><b>Active</b></span>");
                                }
                                if (data.flag_delete == 0) {
                                    $("#flagdelete").html("<span class='btn btn-success btn-sm'><b>Active</b></span>");
                                } else {
                                    $("#flagdelete").html("<span class='btn btn-danger btn-sm'><b>Delete</b></span>");
                                }

                                if (data.flag_delete == 0){
                                    $('#deletevbtn').show();
                                    $('#undeletevbtn').hide();
                                }
                                if (data.flag_delete == 1){
                                    $('#deletevbtn').hide();
                                    $('#undeletevbtn').show();
                                }
                               
                            }
                            reloaddata();
                            $('#viewUser').modal('show');
                  
                        }
                    }); 
                $('#deletevbtn').attr('data-attid', id);
                $('#editbtn').attr('data-attid', id);
                $('#editshow').attr('data-attid', id);
                $('#undeletevbtn').attr('data-attid', id);
                $('#deletevbtn').html('<i class="fa fa-trash"></i> Delete User');
                $("#titledetailmodal").html("Detail Division")
            }
                $("#closeModalViewUser").click(function() {
                    $("#viewUser").modal('hide');
                });
                
                  /////////////////////////////////      Modal EDIT       //////////////////////////////////////
            function editmodaldevisi() {
                idx = $('#editbtn').attr('data-attid',);
                var url = "{{ asset('/division/update') }}/" + idx;
                var form = $('#editpostmodal');
                $("#titleeditmodal").html("Edit Division")
                $.ajax({
                    url: url,
                    type: "GET",
                        success: function(response) {
                            data = response.data;
                                if(data) {
                                    $("#division_name_edit").val(data.division_name);
                                    check_access();
                                    if(data.active == 0){
                                                // $("#active").removeAttr('checked');
                                                $("#active_edit2").attr('checked', true);
                                            }
                                            else {
                                                // $("#active").removeAttr('checked');
                                                $("#active_edit").attr('checked', true);
                                            }
                                }
                                $("#closemodaledit").modal('hide');
                                
                                $("#editmodal").modal('show');
                        }
                        
                });
            }
  function check_access(){
    idx = $('#editbtn').attr('data-attid',);
    test = '@csrf';
    token = $(test).val();
    var url = "{{ asset('/api/usersaccess') }}/" + idx;
    $.ajax({
        url: url,
        type: "post",
        data: {
            id : idx,
            _token: token
        },
        success: function (response) {
          $.each(response.data, function(i, item) {
            if(item.val_access == 1)
              $("#"+item.name_access+'-'+item.key_access).attr('checked', true);
            else 
              $("#"+item.name_access+'-'+item.key_access).attr('checked', false);
          });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('something wrong');
            console.log(textStatus, errorThrown);
        }
    });
  }
        $(document).ready(function(){
                $('#editpostmodal').submit(function(e){
                    test = '@csrf';
                    token = $(test).val();
                    e.preventDefault();
                    idx = $('#editshow').attr('data-attid');
                    var coba1 = $("#division_name_edit").val();
                   var ll = $('input[name="active_edit"]:checked').val();
                    // console.log(ll);
                    // var coba3 = $("#active_edit2").val();
                    var url = "{{ asset('/division/store') }}";
                        if(idx)
                            url = "{{ asset('/division/update3') }}/" + idx;
                        $.ajax({
                                url: url,
                                type: "get",
                                data: {
                                    division_name : coba1,
                                    active: ll,
                                    _token: token
                                },
                                success: function (response) {
                                    data = response.data;
                                 
                                    if(data[0] == 'success') {
                                        Swal.fire({
                                            title: 'Selamat!',
                                            text: "Data Berhasil Diubah",
                                            icon: 'success'
                                        });
                                        // $("#viewUser").modal('hide');
                                        $("#editmodal").modal('hide');
                                        $("#addpostmodal")[0].reset();
                                            reloaddata();
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: "You won't be able to revert this!",
                                            icon: 'error'
                                        });
                                    }
                                    
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }
                        });
                });  
        });

              /////////////////////////////////      Modal DELETE       //////////////////////////////////////
            function deleteyesshow() {
                idx = $('#deletevbtn').attr('data-attid');
                test = '@csrf';
                token = $(test).val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $('#viewUser');
                        var url = "{{ asset('/division/delete') }}/" + idx;
                        $.ajax({
                            url: url,
                            type: "get",
                            data: {
                                data: form.serialize(),
                                id: idx,
                                _token: token
                            },
                            cache: false,
                            success: function(response) {
                            
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                $("#viewUser")[0].reset();
                                $("#viewUser").modal('hide');
                                $("#viewUser")[0].reset();
                            reloaddata();
                                $("#addpostmodal")[0].reset();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                    }
                })
            }

            function undeleteyesshow(){
        $('#undeletevbtn').hide();
        idx = $('#undeletevbtn').attr('data-attid');
        test = '@csrf';
        token = $(test).val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, undelete it!'
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                var url = "{{ asset('/division/delete') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "get",
                    data: {
                        id : idx,
                        _token: token,
                        undeleted : 1
                    },
                    success: function (response) 
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Undeleted',
                            html:'Your file has been <b>Undeleted</b>'
                        });
                        var url = "{{ asset('/api/divi/getdata') }}";
                        $("#viewUser").modal('hide');
                        $("#viewUser")[0].reset();
                        $('#divisionTable').DataTable().ajax.url(url).load();
                        $('#deletevbtn').show();
                        $("#addpostmodal")[0].reset();
                        $("#activspan").html('Active');
                        $("#activspan").css('color', '#198754');
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(textStatus, errorThrown);
                    }
                });
    
            } else {
                $('#undeletevbtn').show();
            }
        });
    }
              /////////////////////////////////      APPENDDIVISOPTION       //////////////////////////////////////
            function appendDivisionOption() {
                // add division
                var url = "{{ asset('/api/getdivision') }}";
                $.ajax({
                    url: url,
                    type: "get",
                    // cache: false,
                    success: function(response) {
                        $.each(response.data, function(i, item) {
                            $('#divisionselect').append($('<option>', {
                                value: item.id_division,
                                text: item.division_name,
                            }));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
              /////////////////////////////////      APPEND R0LE OPTION       //////////////////////////////////////
            function appendRoleOption() {
                // add division
                var url = "{{ asset('/api/getrole') }}";
                $.ajax({
                    url: url,
                    type: "get",
                    success: function(response) {
                        $.each(response.data, function(i, item) {
                            $('#roleselect').append($('<option>', {
                                value: item.id_role,
                                text: item.role_name
                            }));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
              /////////////////////////////////      RELOAD DATA       //////////////////////////////////////
            function reloaddata() {
                $('#divisionTable').DataTable().ajax.url(url).load();
            }

            function checkpart(a){
		if($("#endt-"+a).is(':checked')) {
			$(".ec-"+a).each(function(){
			    $(this).attr('checked', true);
			});
		} else {
			$(".ec-"+a).each(function(){
			    $(this).attr('checked', false);
			});
		}
	}
        </script>
    @endsection
</x-app-layout>

