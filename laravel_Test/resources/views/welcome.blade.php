<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">

            <div class="links">

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Office</label>
                        <select id="ddlOffice" name="ddlOffice" class="form-control" data-validation="required" data-validation-error-msg="Please enter status" required>
                            <option value="1">office1</option>
                            <option value="2">office2</option>
                            <option value="3">office3</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">Licence No
                        <input type="text" id="txtlicNo" class="form-control" placeholder="Licence Number*" class="form-control col-md-7 col-xs-12">
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">Licence Date
                        <input type="date" id="txtlicDate" class="form-control" placeholder="Licence Date*" class="form-control col-md-7 col-xs-12">
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">Licence Name
                        <input type="text" id="txtlicName" class="form-control" placeholder="Licence Name*" class="form-control col-md-7 col-xs-12">
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">Licence Address
                        <input type="text" id="txtaddr" class="form-control" placeholder="Address*" class="form-control col-md-7 col-xs-12">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Licence Type</label>
                        <select id="ddlLicType" name="ddlLicType" class="form-control" data-validation="required" data-validation-error-msg="Please enter LicType" required>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                        </select>
                    </div>
                </div>

                <input type="text" id="idEdit" value="">
                <div class="modal-footer">
                    <table class="form-group pull-right top_search">
                        <tr>
                            <td>
                                <button type="button" id="btnSave" class="btn btn-success" onclick="saveEnhan();">Save</button>

                            </td>
                        </tr>
                    </table>

                </div>
                <button type="button" id="btnShowPopup" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="getAll();"> find All</button>

                <!-- <button type="button" id="btnShowPopup" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="form_reset();">
                    Add Customers
                </button> -->
                <form id="addCustomers" name="addCustomers" method="post">
                    <table id="datatab" class="table table-bordered">

                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>office</th>
                                <th>Lic_No</th>
                                <th>Lic_Dt</th>
                                <th>Lic_Name</th>
                                <th>Lic_Addr</th>
                                <th>Lic_Type</th>
                                <th>ID</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </form>

               

            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#ddlOffice').val('');
        $('#txtlicNo').val('');
        $('#txtlicDate').val('');
        $('#txtlicName').val('');
        $('#txtaddr').val('');
        $('#ddlLicType').val('');
        $('#idEdit').val('');
    });

    function saveEnhan() {
        var officetype = $('#ddlOffice').val();
        var licno = $('#txtlicNo').val();
        var licdt = $('#txtlicDate').val();
        var licname = $('#txtlicName').val();
        var licadr = $('#txtaddr').val();
        var lictype = $('#ddlLicType').val();

        var id = $('#idEdit').val();

        alert(id);

        // if(cus == '' && add == ''){
        //     alert('please fill');
        //     return;
        // }
        $.ajax({
            url: '/api/v1/licence',
            method: 'post',
            dataType: 'json',
            data: {
                officetype: officetype,
                licno: licno,
                licdt: licdt,
                licname: licname,
                licadr: licadr,
                lictype: lictype,
                id: id
            },
            cache: false,
            crossDomain: false,
            success: function(response) {
                getAll();
                $('#ddlOffice').val('');
                $('#txtlicNo').val('');
                $('#txtlicDate').val('');
                $('#txtlicName').val('');
                $('#txtaddr').val('');
                $('#ddlLicType').val('');
                $('#idEdit').val('');

                alert('Successfully Saved');
            },
            error: function(response) {
                getAll();
                $('#ddlOffice').val('');
                $('#txtlicNo').val('');
                $('#txtlicDate').val('');
                $('#txtlicName').val('');
                $('#txtaddr').val('');
                $('#ddlLicType').val('');
                $('#idEdit').val('');
            }
        });
    }

    function getAll() {
        $.ajax({
            url: '/api/v1/getlicenceall',
            method: 'post',
            dataType: 'json',
            data: {
                dats: 1
            },
            cache: false,
            crossDomain: false,
            success: function(data) {
                var licence = data;
                var j = 1,
                    stat = '';
                console.log(data);
                $('#datatab tbody').empty();
                $tr = "";
                for (var i = 0; i < licence.length;) {
                    $tr += '<tr>'

                        +
                        '<td>' + j + '</td>' +
                        '<td>' + licence[i].office_type + '</td>' +
                        '<td>' + licence[i].lic_no + '</td>' +
                        '<td>' + licence[i].lic_date + '</td>' +
                        '<td>' + licence[i].lic_name + '</td>' +
                        '<td>' + licence[i].lic_address + '</td>' +
                        '<td>' + licence[i].lic_type + '</td>' +
                        '<td>' +licence[i].lic_id +'</td>'+
                        '<td><button type="button" id="btnEdit" class="btn btn-success" onclick="edit(' + licence[i].lic_id + ')">Edit</button> </td>' +
                        '<td><button type="button" id="btnDel" class="btn btn-success" onclick="deleteCustomer(' + licence[i].lic_id + ')">Delete</button> </td>' +
                        '</tr>';
                    i++;
                    j++;
                }
                $('#datatab tbody').append($tr);
            },
            error: function(data) {

            }
        });
    }

    function edit(id) {
        $.ajax({
            url: '/api/v1/licencegetID',
            method: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            cache: false,
            crossDomain: false,
            success: function(response) {

                $('#ddlOffice').val(response.office_type);
                $('#txtlicNo').val(response.lic_no);
                $('#txtlicDate').val(response.lic_date);
                $('#txtlicName').val(response.lic_name);
                $('#txtaddr').val(response.lic_address);
                $('#ddlLicType').val(response.ddlLicType);
                $('#idEdit').val(response.lic_id);
              
            },
            error: function(response) {}
        });
    }
    function deleteLicence(id) {
        $.ajax({
            url: '/api/v1/deleteLicence',
            method: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            cache: false,
            crossDomain: false,
            success: function(response) {

                getAll();
            },
            error: function(response) {
                getAll();

            }
        });
    }

    
</script>