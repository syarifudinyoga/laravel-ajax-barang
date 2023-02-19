<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barang</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
  
    <!-- jQuery library file -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  
    <!-- Datatable plugin JS library file -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Nutech Integrasi</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route ('barang')}}">Barang</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <div class="container"><br>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-outline-primary" onclick="createBarang()">Tambah Data</button>
            </div>
            <div class="card-body">
                <div id="alert-div">
                 
                </div>

                <table id="tableID" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:3%">No</th>
                            <th style="width:22%">Nama</th>
                            <th style="width:15%">Harga Beli</th>
                            <th style="width:15%">Harga Jual</th>
                            <th style="width:15%">Stok</th>
                            <th style="width:15%">Image</th>
                            <th style="width:15%">Aksi</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
            <div class="card-footer text-center">
                Made With ♥ By Syarifudin Yoga Pinasty 2023
            </div>
        </div>&nbsp;&nbsp;&nbsp;
    </div>
  
    <!-- modal for creating function -->
    <div class="modal" tabindex="-1"  id="form-modal">
        <div class="modal-dialog" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error-div"></div>
                <form method="POST" id="upload_form" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name"><b>Foto Barang</b></label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="name"><b>Name</b></label>
                        <input type="text" class="form-control" id="file_nama" name="file_nama" required>
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="name"><b>Harga Beli</b></label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="name"><b>Harga Jual</b></label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="name"><b>Stok</b></label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                    </div>&nbsp;
                    
                    <button type="submit" class="btn btn-outline-primary mt-3" id="save-project-btn">Simpan</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- modal for edit function -->
    <div class="modal" tabindex="-1"  id="form-modal-edit">
        <div class="modal-dialog" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error-div"></div>
                <form method="POST" id="upload_form_edit" enctype="multipart/form-data">
                    <input type="hidden" name="uuid" id="uuid">
                    <div class="form-group">
                        <label for="name"><b>Foto Barang</b></label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="name"><b>Name</b></label>
                        <input type="text" class="form-control" id="file_nama_edit" name="file_nama" required>
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="name"><b>Harga Beli</b></label>
                        <input type="number" class="form-control" id="harga_beli_edit" name="harga_beli" required>
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="name"><b>Harga Jual</b></label>
                        <input type="number" class="form-control" id="harga_jual_edit" name="harga_jual" required>
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="name"><b>Stok</b></label>
                        <input type="number" class="form-control" id="stok_edit" name="stok" required>
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="name"><b>Foto lama Barang</b></label>
                        <p id="file_edit"></p>
                    </div>
                    
                    <button type="submit" class="btn btn-outline-primary mt-3" id="save-project-btn">Edit</button>
                </form>
            </div>
            </div>
        </div>
    </div>
 
  
    <!-- view record modal -->
    <div class="modal" tabindex="-1" id="view-modal">
        <div class="modal-dialog" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <b>Foto barang:</b>
                <p id="file_show"></p>
                <b>Nama:</b>
                <p id="file_nama_show"></p>
                <b>Harga Beli:</b>
                <p id="harga_beli_show"></p>
                <b>Harga Jual:</b>
                <p id="harga_jual_show"></p>
                <b>Stok:</b>
                <p id="stok_show"></p>
            </div>
            </div>
        </div>
    </div>
  
    <script type="text/javascript">
  
        showAllBarang();
     
        //retrieve data barang
        function showAllBarang()
        {
            let url = $('meta[name=app-url]').attr("content") + "/api/barang";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    console.log(response);
                    $("#tableID").DataTable().clear();
                    var length = Object.keys(response.data).length;
                    //console.log(length)
                    for(var i = 0; i < length; i++) {
                        let no = i+1
                        let showBtn =  '<button class="btn btn-outline-info" onclick="showBarang(' +"'"+ response.data[i].uuid + "'"+')"><i class="fa fa-eye" aria-hidden="true"></i></button> ';
                        let editBtn =  '<button class="btn btn-outline-success" onclick="editBarang(' +"'"+ response.data[i].uuid + "'"+ ')"><i class="fa fa-pencil" aria-hidden="true"></i></button> ';
                        let deleteBtn =  '<button class="btn btn-outline-danger" onclick="destroyBarang(' +"'"+ response.data[i].uuid + "'"+ ')"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                        
                        let barangImg = '<img src="'+ response.data[i].file +'" alt="Foto Produk" style="width:100px;height:100px;object-fit:cover;" />';
                        let actionTable = showBtn + editBtn + deleteBtn

                        $('#tableID').dataTable().fnAddData( [
                            no,
                            response.data[i].file_nama,
                            response.data[i].harga_beli,
                            response.data[i].harga_jual,
                            response.data[i].stok,
                            barangImg,
                            actionTable
                        ]);
                    }
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }

        //aksi insert barang
        $('#upload_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:$('meta[name=app-url]').attr("content") + "/api/barang",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    //Validasi Sukses
                    //$("#save-project-btn").prop('disabled', false);
                    if(data.status === "sukses") {
                        swal.fire("Done!", data.message, "success");
                        // refresh page after 2 seconds
                        //setTimeout(function(){
                            //location.reload();
                        //},2000);
                        $('#tableID').dataTable().fnClearTable();
                        $('#tableID').dataTable().fnDestroy();
                        showAllBarang();
                        $("#form-modal").modal('hide');
                    }

                    //Validasi Gagal
                    if(data.status === "error"){
                        if (data.error.hasOwnProperty('file')){
                            swal.fire("Error", data.error.file[0], "error");
                        } else if(data.error.hasOwnProperty('file_nama')){
                            swal.fire("Error", data.error.file_nama[0], "error");
                        } else if(data.error.hasOwnProperty('harga_beli')){
                            swal.fire("Error", data.error.harga_beli[0], "error");
                        } else if(data.error.hasOwnProperty('harga_jual')){
                            swal.fire("Error", data.error.harga_jual[0], "error");
                        } else if(data.error.hasOwnProperty('stok')){
                            swal.fire("Error", data.error.stok[0], "error");
                        }
                    }
                }
            })
        });
     
        //Initial Modal Create
        function createBarang()
        {
            $("#file").val("");
            $("#file_nama").val("");
            $("#harga_beli").val("");
            $("#harga_jual").val("");
            $("#stok").val("");
            $("#form-modal").modal('show'); 
        }
     
        //edit Barang
        function editBarang(id)
        {
            let url = $('meta[name=app-url]').attr("content") + "/api/barang/" + id ;
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    console.log(response)
                    let barang = response.data[0]
                    document.getElementById("uuid").value = barang.uuid;
                    document.getElementById("file_nama_edit").value = barang.file_nama;
                    document.getElementById("harga_beli_edit").value = barang.harga_beli;
                    document.getElementById("harga_jual_edit").value = barang.harga_jual;
                    document.getElementById("stok_edit").value = barang.stok;
                    $("#file_edit").html('<img src="'+barang.file+'" alt="Foto Produk" style="width:50%;height:50%;">');
                    $("#form-modal-edit").modal('show'); 
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }

        //aksi edit barang
        $('#upload_form_edit').on('submit', function(event){
            event.preventDefault();
            let id = document.getElementById("uuid").value;
            $.ajax({
                url:$('meta[name=app-url]').attr("content") + "/api/barang/"+id,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    //Validasi Sukses
                    if(data.status === "sukses") {
                        swal.fire("Done!", data.message, "success");
                        // refresh page after 2 seconds
                        //setTimeout(function(){
                            //location.reload();
                        //},2000);
                        $('#tableID').dataTable().fnClearTable();
                        $('#tableID').dataTable().fnDestroy();
                        showAllBarang();
                        $("#form-modal-edit").modal('hide');
                    }

                    //Validasi Gagal
                    if(data.status === "error"){
                        if (data.error.hasOwnProperty('file')){
                            swal.fire("Error", data.error.file[0], "error");
                        } else if(data.error.hasOwnProperty('file_nama')){
                            swal.fire("Error", data.error.file_nama[0], "error");
                        } else if(data.error.hasOwnProperty('harga_beli')){
                            swal.fire("Error", data.error.harga_beli[0], "error");
                        } else if(data.error.hasOwnProperty('harga_jual')){
                            swal.fire("Error", data.error.harga_jual[0], "error");
                        } else if(data.error.hasOwnProperty('stok')){
                            swal.fire("Error", data.error.stok[0], "error");
                        }
                    }
                }
            })
        });
     
        //list barang
        function showBarang(id)
        {
            $("#file_show").html("");
            $("#file_nama_show").html("");
            $("#harga_beli_show").html("");
            $("#harga_jual_show").html("");
            $("#stok_show").html("");
            let url = $('meta[name=app-url]').attr("content") + "/api/barang/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let barang = response.data[0];
                    //console.log(barang)
                    $("#file_show").html('<img src="'+barang.file+'" alt="Foto Produk" style="width:50%;height:50%;">');
                    $("#file_nama_show").html(barang.file_nama);
                    $("#harga_beli_show").html(barang.harga_beli);
                    $("#harga_jual_show").html(barang.harga_jual);
                    $("#stok_show").html(barang.stok);
                    $("#view-modal").modal('show'); 
     
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
        //Delete Barang
        function destroyBarang(id)
        {
            swal.fire({
                title: 'Are you sure delete this data?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    let url = $('meta[name=app-url]').attr("content") + "/api/barang/" + id;
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {_token: CSRF_TOKEN},
                        dataType: 'JSON',
                        success: function (results) {
                            //console.log(results)
                            if(results.status == 200){
                                swal.fire("Done!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function(){
                                    location.reload();
                                },2000);
                            }/*else {
                                swal.fire("Error!", results.message, "error");
                            }
                            */
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function (dismiss) {
                return false;
            })
        }
    </script>
</body>
</html>