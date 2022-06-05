@extends('layouts.app')

@section('content')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Data Tables</h3>
    </div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Add rows</h4>
                </div>
                <div class="panel-body">
                    <button type="button" class="btn btn-success m-b-sm" data-toggle="modal" data-target="#myModal">Add new row</button>
                    <!-- Modal -->
                    <form id="add-row-form" action="javascript:void(0);">
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" id="name-input" class="form-control" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="position-input" class="form-control" placeholder="Position" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" id="age-input" class="form-control" placeholder="Age" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="date-input" class="form-control date-picker" placeholder="Start Date" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" id="salary-input" class="form-control" placeholder="Salary" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" id="add-row" class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="table-responsive">
                        <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- /Page Inner -->

@endsection
